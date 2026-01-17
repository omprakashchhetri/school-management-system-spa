<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Modules</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->
    </div>
    <div class="main-wrapper">
        <div class="row g-3">

            <?php foreach ($roleToolPermissions['tools'] as $tool): ?>

                <?php
                // Permission check
                if ($tool['can_view'] != 1)
                    continue;

                $details = $tool['tool_details'];

                // Safety + visibility checks
                if (
                    empty($details['tool_name']) ||
                    empty($details['base_route']) ||
                    $details['is_active'] == 0
                ) {
                    continue;
                }

                // Fallbacks (never break UI)
                $icon = !empty($details['icon']) ? $details['icon'] : 'ph-squares-four';
                $color = !empty($details['color']) ? $details['color'] : 'text-gray-400';
                ?>

                <div class="col-md-4">
                    <div class="nav_js cursor-pointer d-flex flex-column bg-white justify-content-start align-items-center
                   text-center p-15 gap-5 border rounded-10 text-secondary-light
                   hover-bg-main-50 h-100 hover-text-primary transition-2"
                        data-route="<?= esc($details['base_route']); ?>">

                        <span class="px-10 py-7 rounded-circle bg-light">
                            <i class="ph <?= esc($icon); ?> text-4xl <?= esc($color); ?>"></i>
                        </span>

                        <span class="fw-medium text-13">
                            <?= esc($details['tool_name']); ?>
                        </span>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>


    </div>
</div>