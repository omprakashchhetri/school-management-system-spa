<?php
/**
 * View: pages/student-module-pages/document-list.php
 *
 * Variables:
 *   $documents   – ['rows', 'total', 'pager']
 *   $studentData – student row array
 */

function docStatusBadge(string $status): array {
    return match (strtolower($status)) {
        'verified' => ['bg-success-50 text-success-600', 'bg-success-600', 'Verified'],
        'rejected' => ['bg-danger-50 text-danger-600',   'bg-danger-600',  'Rejected'],
        default    => ['bg-warning-50 text-warning-600', 'bg-warning-600', 'Pending'],
    };
}

function docIcon(string $type): string {
    $type = strtolower($type ?? '');
    if (str_contains($type, 'id') || str_contains($type, 'card'))        return 'ph-identification-card';
    if (str_contains($type, 'birth'))                                     return 'ph-baby';
    if (str_contains($type, 'transfer') || str_contains($type, 'tc'))    return 'ph-file-arrow-up';
    if (str_contains($type, 'mark') || str_contains($type, 'result'))    return 'ph-graduation-cap';
    if (str_contains($type, 'photo') || str_contains($type, 'image'))    return 'ph-user-circle';
    if (str_contains($type, 'medical') || str_contains($type, 'health')) return 'ph-heart';
    if (str_contains($type, 'address'))                                   return 'ph-house-line';
    return 'ph-file-text';
}

$page = max(1, (int) (service('request')->getGet('documents_page') ?? 1));
$from = (($page - 1) * 10) + 1;
$to   = min($page * 10, $documents['total']);

// Count statuses from current page rows (summary cards use total, not just page rows)
$verified = $stats['verified'] ?? 0;
$pending  = $stats['pending'] ?? 0;
$rejected = $stats['rejected'] ?? 0;
?>

<div class="dashboard-body">

    <!-- ── Breadcrumb + Actions ──────────────────────────────────── -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-0">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?= base_url('student/dashboard') ?>"
                       class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">My Documents</span></li>
            </ul>
        </div>

        <div class="flex-align gap-8 flex-wrap">
            <!-- Sort -->
            <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-funnel-simple"></i></span>
                <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4"
                        onchange="applyDocSort(this.value)">
                    <option value="latest"   <?= ((service('request')->getGet('doc_sort') ?? 'latest') === 'latest')   ? 'selected':'' ?>>Latest First</option>
                    <option value="oldest"   <?= (service('request')->getGet('doc_sort') === 'oldest')   ? 'selected':'' ?>>Oldest First</option>
                    <option value="verified" <?= (service('request')->getGet('doc_sort') === 'verified') ? 'selected':'' ?>>Verified Only</option>
                    <option value="pending"  <?= (service('request')->getGet('doc_sort') === 'pending')  ? 'selected':'' ?>>Pending Only</option>
                </select>
            </div>

            <!-- Upload button -->
            <!-- <button class="btn btn-main rounded-pill py-9 px-20 text-14"
                    data-bs-toggle="modal" data-bs-target="#uploadDocModal">
                <i class="ph ph-upload me-6"></i>Upload Document
            </button> -->
        </div>
    </div>

    <!-- ── Summary Cards ─────────────────────────────────────────── -->
    <div class="row gy-4 mb-24">
        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-main-50">
                <span class="text-white bg-main-600 w-44 h-44 rounded-circle flex-center text-xl flex-shrink-0">
                    <i class="ph ph-files"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $stats['total'] ?></h4>
                    <span class="fw-medium text-14 text-main-600">Total Documents</span>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-success-50">
                <span class="text-white bg-success-600 w-44 h-44 rounded-circle flex-center text-xl flex-shrink-0">
                    <i class="ph ph-seal-check"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $verified ?></h4>
                    <span class="fw-medium text-14 text-success-600">Verified</span>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-warning-50">
                <span class="text-white bg-warning-600 w-44 h-44 rounded-circle flex-center text-xl flex-shrink-0">
                    <i class="ph ph-clock"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $pending ?></h4>
                    <span class="fw-medium text-14 text-warning-600">Pending Review</span>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-danger-50">
                <span class="text-white bg-danger-600 w-44 h-44 rounded-circle flex-center text-xl flex-shrink-0">
                    <i class="ph ph-x-circle"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $rejected ?></h4>
                    <span class="fw-medium text-14 text-danger-600">Rejected</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Table Card ────────────────────────────────────────────── -->
    <div class="card overflow-hidden">
        <div class="card-body p-0">

            <?php if (empty($allRows)): ?>
                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-folder-open" style="font-size:3rem;"></i>
                    <p class="mt-12 mb-4 text-16 fw-medium">No documents uploaded yet.</p>
                    <p class="text-13">Click <strong>Upload Document</strong> to add your files.</p>
                </div>
            <?php else: ?>

            <div class="table-responsive">
                <table id="documentTable" class="table table-striped align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-24" style="width:44px;">
                                <div class="form-check mb-0">
                                    <input class="form-check-input border-gray-200 rounded-4"
                                           type="checkbox" id="selectAll" />
                                </div>
                            </th>
                            <th class="h6 text-gray-300">Document</th>
                            <th class="h6 text-gray-300">Type</th>
                            <th class="h6 text-gray-300 text-nowrap">Upload Date</th>
                            <th class="h6 text-gray-300 text-center">Status</th>
                            <th class="h6 text-gray-300 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allRows as $doc):
                            [$badgeBg, $dotBg, $badgeLabel] = docStatusBadge($doc['status'] ?? 'pending');
                            $icon    = docIcon($doc['document_type'] ?? '');
                            $fileUrl = base_url('uploads/documents/' . $doc['file']);
                        ?>
                        <tr>
                            <!-- Checkbox -->
                            <td class="ps-24">
                                <div class="form-check mb-0">
                                    <input class="form-check-input border-gray-200 rounded-4 row-checkbox"
                                           type="checkbox" value="<?= $doc['id'] ?>" />
                                </div>
                            </td>

                            <!-- Document name + icon -->
                            <td>
                                <div class="flex-align gap-12">
                                    <span class="w-40 h-40 bg-main-50 text-main-600 rounded-8 flex-center text-xl flex-shrink-0">
                                        <i class="ph <?= $icon ?>"></i>
                                    </span>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="h6 mb-0 fw-semibold text-dark">
                                            <?= esc($doc['document_name']) ?>
                                        </span>
                                        <span class="text-gray-400 text-12">
                                            <?= esc($doc['file']) ?>
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Type -->
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">
                                    <?= esc($doc['document_type'] ?? '–') ?>
                                </span>
                            </td>

                            <!-- Upload date -->
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300 text-nowrap">
                                    <?= date('d M Y', strtotime($doc['created_at'])) ?>
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                <span class="text-13 py-2 px-8 <?= $badgeBg ?> d-inline-flex align-items-center gap-6 rounded-pill">
                                    <span class="w-6 h-6 <?= $dotBg ?> rounded-circle flex-shrink-0"></span>
                                    <?= $badgeLabel ?>
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="flex-align justify-content-center gap-6">
                                    <a href="<?= $fileUrl ?>" target="_blank"
                                       class="bg-main-50 text-main-600 py-4 px-14 rounded-pill text-13 hover-bg-main-600 hover-text-white">
                                        <i class="ph ph-eye me-4"></i>View
                                    </a>
                                    <a href="<?= $fileUrl ?>" download
                                       class="bg-info-50 text-info-600 py-4 px-14 rounded-pill text-13 hover-bg-info-600 hover-text-white">
                                        <i class="ph ph-download-simple me-4"></i>Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php endif; ?>
        </div>

        <!-- Footer: count + pager -->
        <?php if (!empty($allRows)): ?>
        <div class="card-footer flex-between flex-wrap gap-8 py-16 px-24">
            <span class="text-gray-900 text-14">
                Showing <strong><?= $from ?></strong>–<strong><?= $to ?></strong>
                of <strong><?= $documents['total'] ?></strong> document(s)
            </span>
            <?php if (!empty($documents['pager'])): ?>
                <?= $documents['pager'] ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

</div>

<!-- ── Upload Document Modal ─────────────────────────────────────── -->
<div class="modal fade" id="uploadDocModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('student/documents/upload') ?>" method="POST"
                  enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-12">
                            <label class="form-label h6 mb-8">
                                Document Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="document_name"
                                   class="form-control py-11"
                                   placeholder="e.g. Birth Certificate"
                                   required />
                        </div>
                        <div class="col-12">
                            <label class="form-label h6 mb-8">Document Type</label>
                            <select name="document_type" class="form-control form-select py-11">
                                <option value="">Select Type</option>
                                <option value="Birth Certificate">Birth Certificate</option>
                                <option value="Transfer Certificate">Transfer Certificate</option>
                                <option value="ID Card">ID Card</option>
                                <option value="Marksheet">Marksheet</option>
                                <option value="Medical Certificate">Medical Certificate</option>
                                <option value="Address Proof">Address Proof</option>
                                <option value="Photo">Photo</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label h6 mb-8">
                                Select File <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="document_file"
                                   class="form-control py-11"
                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   required />
                            <small class="text-gray-400 text-12 mt-4 d-block">
                                Allowed: PDF, JPG, PNG, DOC, DOCX. Max 5 MB.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-main rounded-pill py-9 px-20"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-main rounded-pill py-9 px-20">
                        <i class="ph ph-upload me-6"></i>Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Select-all toggle
document.getElementById('selectAll')?.addEventListener('change', function () {
    document.querySelectorAll('.row-checkbox').forEach(b => b.checked = this.checked);
});

// Sort: append ?doc_sort= and reset page
function applyDocSort(val) {
    const url = new URL(window.location.href);
    url.searchParams.set('doc_sort', val);
    url.searchParams.delete('documents_page');
    window.location.href = url.toString();
}
</script>