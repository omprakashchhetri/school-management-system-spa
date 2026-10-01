<?php

namespace App\Controllers\Data\AcademicModulePages;

use App\Controllers\BaseController;

class ClassRoutineController extends BaseController
{
    protected $schedulesModel;
    protected $periodTimeSlotsModel;
    protected $classTeachersModel;

    public function __construct()
    {
        $this->schedulesModel = model('SchedulesModel');
        $this->periodTimeSlotsModel = model('PeriodTimeSlotsModel');
        $this->classTeachersModel = model('ClassTeachersModel');
    }

    /**
     * All period time slots (shared school-wide, not per-class), ordered by
     * start time. Empty until a routine has been generated+saved at least
     * once via saveRoutine().
     */
    public function getPeriodSlots(): array
    {
        return $this->periodTimeSlotsModel
            ->where('deleted_at', null)
            ->orderBy('start_time', 'ASC')
            ->findAll();
    }

    /**
     * The weekly routine for one class+section: period slots (columns) and
     * each day's assigned subject/teacher per period (for the view to
     * render as a grid), plus the assigned class teacher if any.
     */
    public function getRoutine($classId, $sectionId): array
    {
        $periods = $this->getPeriodSlots();

        // period_time_slots are shared school-wide, so a slot's 1-based
        // position in this chronological list ("Period 1", "Period 2", ...)
        // is what both the builder and viewer UIs key their grid on — not
        // the slot's own (arbitrary) primary key.
        $periodIdToNumber = [];
        foreach (array_values($periods) as $index => $period) {
            $periodIdToNumber[$period['id']] = $index + 1;
        }

        $rows = $this->schedulesModel->builder()
            ->select('schedules.day, schedules.related_period, schedules.related_subject, schedules.related_teacher, sub.subject_name, e.firstname, e.lastname, schedules.updated_at')
            ->join('subjects sub', 'sub.id = schedules.related_subject', 'left')
            ->join('employees e', 'e.id = schedules.related_teacher', 'left')
            ->where('schedules.related_class', $classId)
            ->where('schedules.related_section', $sectionId)
            ->where('schedules.deleted_at', null)
            ->get()
            ->getResultArray();

        $grid = [];
        $lastUpdated = null;
        foreach ($rows as $row) {
            $periodNumber = $periodIdToNumber[$row['related_period']] ?? null;
            if ($periodNumber === null) {
                continue;
            }

            $grid[$row['day']][$periodNumber] = [
                'subject_id' => $row['related_subject'],
                'subject_name' => $row['subject_name'],
                'teacher_id' => $row['related_teacher'],
                'teacher_name' => trim(($row['firstname'] ?? '') . ' ' . ($row['lastname'] ?? '')),
            ];
            if ($lastUpdated === null || $row['updated_at'] > $lastUpdated) {
                $lastUpdated = $row['updated_at'];
            }
        }

        $classTeacher = $this->classTeachersModel->builder()
            ->select('class_teachers.*, e.firstname, e.lastname, e.contact_number1')
            ->join('employees e', 'e.id = class_teachers.teacher', 'left')
            ->where('class_teachers.class', $classId)
            ->where('class_teachers.section', $sectionId)
            ->where('class_teachers.deleted_at', null)
            ->get()
            ->getRowArray();

        return [
            'periods' => $periods,
            'grid' => $grid,
            'has_routine' => !empty($rows),
            'last_updated' => $lastUpdated,
            'class_teacher' => $classTeacher ? trim($classTeacher['firstname'] . ' ' . $classTeacher['lastname']) : null,
            'class_teacher_contact' => $classTeacher['contact_number1'] ?? null,
        ];
    }

    /**
     * Ensure global period_time_slots exist for a routine's period count
     * (upserted by label "Period N" so re-generating doesn't create
     * duplicates), computing each slot's start/end time from the
     * requested duration/start-time/lunch settings, then replace this
     * class+section's schedules with the submitted grid.
     *
     * period_time_slots has no class/section column — it's one shared
     * school-wide timetable, not per-class — so "Period 1" etc. always
     * refers to the same time slot for every class. Saving a routine with
     * different period-count/duration/start-time settings than another
     * class used will shift *that* class's period times too. This mirrors
     * how most schools actually run (one bell schedule for everyone); a
     * genuinely per-class timetable would need a schema change.
     *
     * @param array $periodConfig ['period_count'=>int,'period_duration'=>int,'lunch_after'=>?int,'lunch_duration'=>int,'start_time'=>'HH:MM']
     * @param array $entries list of ['day'=>string,'period'=>int,'subject'=>int,'teacher'=>int]
     */
    public function saveRoutine($classId, $sectionId, array $periodConfig, array $entries): array
    {
        $periodCount = (int) ($periodConfig['period_count'] ?? 0);
        $periodDuration = (int) ($periodConfig['period_duration'] ?? 0);
        $lunchAfter = $periodConfig['lunch_after'] !== '' ? (int) $periodConfig['lunch_after'] : null;
        $lunchDuration = (int) ($periodConfig['lunch_duration'] ?? 0);
        $startTime = $periodConfig['start_time'] ?? '';

        if ($periodCount < 1 || $periodDuration < 1 || !$startTime) {
            return ['error' => 'Period count, duration, and start time are required'];
        }

        $periodIds = [];
        $current = $startTime . ':00';
        for ($i = 1; $i <= $periodCount; $i++) {
            $end = date('H:i:s', strtotime($current) + $periodDuration * 60);
            $label = 'Period ' . $i;

            $existing = $this->periodTimeSlotsModel
                ->where('label', $label)
                ->where('deleted_at', null)
                ->first();

            $payload = ['label' => $label, 'start_time' => $current, 'end_time' => $end];

            if ($existing) {
                $this->periodTimeSlotsModel->update($existing['id'], $payload);
                $periodIds[$i] = $existing['id'];
            } else {
                $periodIds[$i] = $this->periodTimeSlotsModel->insert($payload, true);
            }

            $current = $end;

            if ($lunchAfter === $i && $lunchDuration > 0) {
                $current = date('H:i:s', strtotime($current) + $lunchDuration * 60);
            }
        }

        // Full replace: this class+section's existing routine is superseded
        // by what was just submitted.
        $this->schedulesModel
            ->where('related_class', $classId)
            ->where('related_section', $sectionId)
            ->delete();

        $now = date('Y-m-d H:i:s');
        $rows = [];
        foreach ($entries as $entry) {
            $period = (int) ($entry['period'] ?? 0);
            if (!isset($periodIds[$period]) || empty($entry['subject']) || empty($entry['teacher'])) {
                continue;
            }

            $rows[] = [
                'related_class' => $classId,
                'related_section' => $sectionId,
                'related_period' => $periodIds[$period],
                'day' => $entry['day'],
                'related_subject' => $entry['subject'],
                'related_teacher' => $entry['teacher'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($rows)) {
            $this->schedulesModel->insertBatch($rows);
        }

        return ['message' => 'Routine saved successfully', 'periods_saved' => count($rows)];
    }
}
