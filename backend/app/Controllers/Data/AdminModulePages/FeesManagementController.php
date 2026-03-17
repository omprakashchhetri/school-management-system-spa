<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\FeesSlabsModel;
use App\Models\FeesGenerationModel;
use App\Models\FeesPaymentsModel;
use App\Models\FeesAllocationModel;
use App\Models\FeesDiscountModel;
use App\Models\StudentsModel;
use App\Models\SectionsModel;


class FeesManagementController extends BaseController
{
    protected $feesSlabModel;
    protected $feesGenerationModel;
    protected $feesPaymentsModel;
    protected $feesAllocationModel;
    protected $feesDiscountModel;
    protected $studentsModel;
    protected $sectionsModel;


    public function __construct()
    {
        $this->feesSlabModel       = new FeesSlabsModel();
        $this->feesGenerationModel = new FeesGenerationModel();
        $this->feesPaymentsModel   = new FeesPaymentsModel();
        $this->feesAllocationModel = new FeesAllocationModel();
        $this->feesDiscountModel   = new FeesDiscountModel();
        $this->studentsModel       = new StudentsModel();
        $this->sectionsModel       = new SectionsModel();
    }


    /* =====================================================
       FEES SLAB DATATABLE
    ===================================================== */
    public function getFeesSlabList(array $postData)
    {
        $draw        = intval($postData['draw']   ?? 1);
        $start       = intval($postData['start']  ?? 0);
        $length      = intval($postData['length'] ?? 10);
        $searchValue = $postData['search']['value'] ?? '';

        $builder = $this->feesSlabModel->builder()
            ->select('
                fees_slabs.id,
                fees_slabs.total_amount,
                fees_slabs.late_fee,
                fees_slabs.fees_periodicity,
                fees_slabs.late_fee_periodicity,
                c.class_name,
                fees_slabs.class
            ')
            ->join('classes c', 'c.id = fees_slabs.class', 'left')
            ->where('fees_slabs.deleted_at', null);

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('c.class_name', $searchValue)
                ->orLike('fees_slabs.total_amount', $searchValue)
                ->groupEnd();
        }

        if (!empty($postData['order'])) {
            $columns  = ['fees_slabs.id', 'c.class_name', 'fees_slabs.total_amount'];
            $colIndex = $postData['order'][0]['column'];
            $dir      = $postData['order'][0]['dir'];
            if (isset($columns[$colIndex])) {
                $builder->orderBy($columns[$colIndex], $dir);
            }
        } else {
            $builder->orderBy('fees_slabs.id', 'DESC');
        }

        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $records       = $builder->get()->getResultArray();
        $totalFiltered = $builder->countAllResults(false);
        $totalRecords  = $this->feesSlabModel->where('deleted_at', null)->countAllResults();

        $data = [];

        foreach ($records as $row) {
            $data[] = [
                'checkbox' => '<input type="checkbox" class="form-check-input" value="' . $row['id'] . '">',

                'class_name' => '<span class="fw-medium text-gray-700">' . $row['class_name'] . '</span>',

                'total_amount' => '<span class="fw-medium text-gray-700">₹ ' . $row['total_amount'] . '</span>',

                'fees_periodicity' => '<span class="badge bg-primary">' . ucfirst($row['fees_periodicity']) . '</span>',

                'late_fee' => '<span class="fw-medium text-gray-700">₹ ' . $row['late_fee'] . '</span>',

                'late_fee_periodicity' => '<span class="badge bg-warning text-dark">' . ucfirst($row['late_fee_periodicity']) . '</span>',

                'actions' => '
                    <button
                        class="edit-fees-slab-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill"
                        data-id="' . $row['id'] . '"
                        data-class="' . $row['class'] . '"
                        data-amount="' . $row['total_amount'] . '"
                        data-late-fee="' . $row['late_fee'] . '"
                        data-fees-periodicity="' . $row['fees_periodicity'] . '"
                        data-late-fee-periodicity="' . $row['late_fee_periodicity'] . '">
                        Edit
                    </button>
                    <button
                        class="delete-fees-slab-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill"
                        data-id="' . $row['id'] . '">
                        Delete
                    </button>
                ',
            ];
        }

        return service('response')->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data'            => $data,
        ]);
    }


    /* =====================================================
       ADD FEES SLAB
    ===================================================== */
    public function addFeesSlab(array $data): array
    {
        if (
            empty($data['class']) ||
            empty($data['total_amount']) ||
            empty($data['late_fee']) ||
            empty($data['fees_periodicity']) ||
            empty($data['late_fee_periodicity'])
        ) {
            return ['error' => 'All fields are required'];
        }

        $exists = $this->feesSlabModel
            ->where('class', $data['class'])
            ->where('deleted_at', null)
            ->first();

        if ($exists) {
            return ['error' => 'Fees slab already exists for this class'];
        }

        $this->feesSlabModel->insert([
            'class'                => $data['class'],
            'total_amount'         => $data['total_amount'],
            'late_fee'             => $data['late_fee'],
            'fees_periodicity'     => $data['fees_periodicity'],
            'late_fee_periodicity' => $data['late_fee_periodicity'],
        ]);

        return ['message' => 'Fees slab added successfully'];
    }


    /* =====================================================
       EDIT FEES SLAB
    ===================================================== */
    public function editFeesSlab(array $data): array
    {
        $id = $data['id'] ?? null;

        if (!$id) {
            return ['error' => 'Fees slab ID required'];
        }

        $record = $this->feesSlabModel->find($id);

        if (!$record) {
            return ['error' => 'Fees slab not found'];
        }

        if (
            empty($data['class']) ||
            empty($data['total_amount']) ||
            empty($data['late_fee']) ||
            empty($data['fees_periodicity']) ||
            empty($data['late_fee_periodicity'])
        ) {
            return ['error' => 'All fields are required'];
        }

        $exists = $this->feesSlabModel
            ->where('class', $data['class'])
            ->where('id !=', $id)
            ->where('deleted_at', null)
            ->first();

        if ($exists) {
            return ['error' => 'Another fees slab already exists for this class'];
        }

        $this->feesSlabModel->update($id, [
            'class'                => $data['class'],
            'total_amount'         => $data['total_amount'],
            'late_fee'             => $data['late_fee'],
            'fees_periodicity'     => $data['fees_periodicity'],
            'late_fee_periodicity' => $data['late_fee_periodicity'],
        ]);

        return ['message' => 'Fees slab updated successfully'];
    }


    /* =====================================================
       DELETE FEES SLAB
    ===================================================== */
    public function deleteFeesSlab(int $id): array
    {
        if (!$id) {
            return ['error' => 'Fees slab ID required'];
        }

        $record = $this->feesSlabModel->find($id);

        if (!$record) {
            return ['error' => 'Fees slab not found'];
        }

        $this->feesSlabModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        return ['message' => 'Fees slab deleted successfully'];
    }


    /* =====================================================
       GET SECTIONS BY CLASS
    ===================================================== */
    public function getSectionsByClass($classId)
    {
        $sections = $this->sectionsModel
            ->select('id, section_label')
            ->where('deleted_at', null)
            ->orderBy('section_label', 'ASC')
            ->findAll();

        return ['sections' => $sections];
    }


    /* =====================================================
       GET STUDENTS BY CLASS + SECTION
    ===================================================== */
    public function getStudentsByClassSection($classId, $sectionId)
    {
        if (!$classId || !$sectionId) {
            return ['students' => []];
        }

        $students = $this->studentsModel
            ->select('id, roll_no, CONCAT(firstname, " ", lastname) as name')
            ->where('related_class', $classId)
            ->where('related_section', $sectionId)
            ->where('deleted_at', null)
            ->orderBy('roll_no', 'ASC')
            ->findAll();

        return ['students' => $students];
    }


    /* =====================================================
       GET STUDENT FEES LEDGER
    ===================================================== */
    public function getStudentFeesLedger($studentId)
    {
        if (!$studentId) {
            return ['ledger' => []];
        }

        /* 1. Fetch generated fees + student's class */
        $generatedFees = $this->feesGenerationModel
            ->select('
                fees_generation.id,
                fees_generation.month,
                fees_generation.year,
                fees_generation.amount,
                fees_generation.due_date,
                fees_generation.late_fee_start_date,
                students.related_class
            ')
            ->join('students', 'students.id = fees_generation.student_id', 'left')
            ->where('fees_generation.student_id', $studentId)
            ->where('fees_generation.deleted_at', null)
            ->orderBy('fees_generation.due_date', 'ASC')
            ->findAll();

        if (empty($generatedFees)) {
            return ['ledger' => []];
        }

        $generatedIds = array_column($generatedFees, 'id');

        /* 2. Bulk fetch discounts */
        $discountRows = $this->feesDiscountModel
            ->select('generated_fee')
            ->selectSum('discount_amount', 'total_discount')
            ->whereIn('generated_fee', $generatedIds)
            ->where('deleted_at', null)
            ->groupBy('generated_fee')
            ->findAll();

        $discountMap = array_column($discountRows, 'total_discount', 'generated_fee');

        /* 3. Bulk fetch payments */
        $paidRows = $this->feesAllocationModel
            ->select('related_generated_fee')
            ->selectSum('amount', 'total_paid')
            ->whereIn('related_generated_fee', $generatedIds)
            ->where('deleted_at', null)
            ->groupBy('related_generated_fee')
            ->findAll();

        $paidMap = array_column($paidRows, 'total_paid', 'related_generated_fee');

        /* 4. Fetch slabs for late fee rules */
        $classIds = array_unique(array_column($generatedFees, 'related_class'));

        $slabs   = $this->feesSlabModel->whereIn('class', $classIds)->where('deleted_at', null)->findAll();
        $slabMap = array_column($slabs, null, 'class');

        /* 5. Build ledger */
        $ledger = [];

        foreach ($generatedFees as $fee) {

            $id             = $fee['id'];
            $discountAmount = $discountMap[$id] ?? 0;
            $paidAmount     = $paidMap[$id]     ?? 0;
            $lateFeeAmount  = 0;
            $daysLate       = 0;

            $today     = strtotime(date('Y-m-d'));
            $lateStart = strtotime($fee['late_fee_start_date']);

            if ($today > $lateStart) {
                $daysLate = floor(($today - $lateStart) / 86400);
                $slab     = $slabMap[$fee['related_class']] ?? null;

                if ($slab) {
                    if ($slab['late_fee_periodicity'] === 'daily') {
                        $lateFeeAmount = $daysLate * $slab['late_fee'];
                    }
                    if ($slab['late_fee_periodicity'] === 'monthly') {
                        $lateFeeAmount = $slab['late_fee'];
                    }
                }
            }

            $balance = max(0, $fee['amount'] + $lateFeeAmount - $discountAmount - $paidAmount);

            $ledger[] = [
                'generated_fee_id' => $id,
                'month'            => $fee['month'],
                'year'             => $fee['year'],
                'amount'           => $fee['amount'],
                'late_fee'         => $lateFeeAmount,
                'discount'         => $discountAmount,
                'paid'             => $paidAmount,
                'balance'          => $balance,
                'days_late'        => $daysLate,
            ];
        }

        return ['ledger' => $ledger];
    }


    /* =====================================================
       RECORD PAYMENT

       After the FIFO allocation loop, any amount that
       couldn't be allocated (because all fees are paid)
       is stored as `advance_credit` on the payment record.
       It will be automatically applied when the next
       fee is generated for this student.
    ===================================================== */
    public function recordPayment(array $data)
    {
        $studentId   = $data['student_id']  ?? null;
        $amount      = $data['amount']       ?? 0;
        $paymentMode = $data['payment_mode'] ?? null;
        $paymentDate = $data['payment_date'] ?? null;

        if (!$studentId || !$amount || !$paymentMode || !$paymentDate) {
            return ['error' => 'Missing required fields'];
        }

        /* 1. Insert the payment record */
        $paymentId = $this->feesPaymentsModel->insert([
            'student_id'        => $studentId,
            'paid_amount'       => $amount,
            'status'            => 'completed',
            'payment_mode'      => $paymentMode,
            'payment_date_time' => $paymentDate,
            'advance_credit'    => 0,
        ]);

        /* 2. Fetch all generated fees for this student (FIFO order) */
        $generatedFees = $this->feesGenerationModel
            ->where('student_id', $studentId)
            ->where('deleted_at', null)
            ->orderBy('due_date', 'ASC')
            ->findAll();

        if (empty($generatedFees)) {
            /* No fees at all — entire amount is advance credit */
            $this->feesPaymentsModel->update($paymentId, ['advance_credit' => $amount]);
            return ['message' => 'Payment recorded as advance credit'];
        }

        $generatedIds = array_column($generatedFees, 'id');

        /* 3. Bulk fetch all discounts keyed by generated_fee id */
        $discountRows = $this->feesDiscountModel
            ->select('generated_fee')
            ->selectSum('discount_amount', 'total_discount')
            ->whereIn('generated_fee', $generatedIds)
            ->where('deleted_at', null)
            ->groupBy('generated_fee')
            ->findAll();

        $discountMap = array_column($discountRows, 'total_discount', 'generated_fee');

        /* 4. Bulk fetch all previously paid amounts keyed by related_generated_fee id */
        $paidRows = $this->feesAllocationModel
            ->select('related_generated_fee')
            ->selectSum('amount', 'total_paid')
            ->whereIn('related_generated_fee', $generatedIds)
            ->where('deleted_at', null)
            ->groupBy('related_generated_fee')
            ->findAll();

        $paidMap = array_column($paidRows, 'total_paid', 'related_generated_fee');

        /* 5. FIFO allocation loop — no DB reads inside, only inserts */
        $remainingAmount = $amount;

        foreach ($generatedFees as $fee) {

            if ($remainingAmount <= 0) {
                break;
            }

            $id             = $fee['id'];
            $discountAmount = $discountMap[$id] ?? 0;
            $paidAmount     = $paidMap[$id]     ?? 0;
            $balance        = $fee['amount'] - $discountAmount - $paidAmount;

            if ($balance <= 0) {
                continue;
            }

            $allocate = min($remainingAmount, $balance);

            $this->feesAllocationModel->insert([
                'related_generated_fee' => $id,
                'related_payment'       => $paymentId,
                'related_discount'      => 0,
                'amount'                => $allocate,
            ]);

            $remainingAmount -= $allocate;
        }

        /* 6. Store any unallocated amount as advance credit */
        if ($remainingAmount > 0) {
            $this->feesPaymentsModel->update($paymentId, [
                'advance_credit' => $remainingAmount,
            ]);
        }

        return ['message' => 'Payment recorded successfully'];
    }


    /* =====================================================
       GENERATE FEES

       After inserting each fee record:
         1. Student's `discount` is saved into fees_discount.
         2. Any advance credit the student has (from previous
            overpayments) is automatically applied to the
            new fee — oldest payment first — and the consumed
            credit is deducted from fees_payments.
    ===================================================== */
    public function generateFees(array $data)
    {
        $month     = $data['month']               ?? null;
        $year      = $data['year']                ?? null;
        $dueDate   = $data['due_date']            ?? null;
        $lateStart = $data['late_fee_start_date'] ?? null;

        if (!$month || !$year || !$dueDate || !$lateStart) {
            return ['error' => 'Month, year, due date and late fee start date required'];
        }

        $students = $this->studentsModel
            ->where('deleted_at', null)
            ->findAll();

        if (!$students) {
            return ['error' => 'No students found'];
        }

        foreach ($students as $student) {

            $studentId = $student['id'];
            $classId   = $student['related_class'];

            $slab = $this->feesSlabModel
                ->where('class', $classId)
                ->where('deleted_at', null)
                ->first();

            if (!$slab) {
                continue;
            }

            $exists = $this->feesGenerationModel
                ->where('student_id', $studentId)
                ->where('month', $month)
                ->where('year', $year)
                ->where('deleted_at', null)
                ->first();

            if ($exists) {
                continue;
            }

            /* Insert the generated fee record */
            $generatedId = $this->feesGenerationModel->insert([
                'student_id'          => $studentId,
                'month'               => $month,
                'year'                => $year,
                'amount'              => $slab['total_amount'],
                'due_date'            => $dueDate,
                'late_fee_start_date' => $lateStart,
            ]);

            /* Apply discount if the student has one */
            if (!empty($student['discount']) && $student['discount'] > 0) {
                $this->feesDiscountModel->insert([
                    'generated_fee'   => $generatedId,
                    'discount_amount' => $student['discount'],
                ]);
            }

            /* Apply any existing advance credit to this new fee */
            $advancePayments = $this->feesPaymentsModel
                ->where('student_id', $studentId)
                ->where('advance_credit >', 0)
                ->orderBy('payment_date_time', 'ASC')
                ->findAll();

            if (empty($advancePayments)) {
                continue;
            }

            /* Net balance after discount */
            $discountAmount = $student['discount'] ?? 0;
            $feeBalance     = $slab['total_amount'] - $discountAmount;

            foreach ($advancePayments as $advPayment) {

                if ($feeBalance <= 0) {
                    break;
                }

                $available = $advPayment['advance_credit'];
                $allocate  = min($available, $feeBalance);

                $this->feesAllocationModel->insert([
                    'related_generated_fee' => $generatedId,
                    'related_payment'       => $advPayment['id'],
                    'related_discount'      => 0,
                    'amount'                => $allocate,
                ]);

                /* Deduct consumed credit from the payment */
                $this->feesPaymentsModel->update($advPayment['id'], [
                    'advance_credit' => $available - $allocate,
                ]);

                $feeBalance -= $allocate;
            }
        }

        return ['message' => 'Fees generated successfully'];
    }
}