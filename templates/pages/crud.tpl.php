<section class="mb-5">
    <h2 class="mb-4"><i class="bi bi-sign-stop-fill me-2 text-danger"></i>Traffic Restrictions – CRUD</h2>

    <?php if (isset($crudSuccess)): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($crudSuccess) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($crudError)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($crudError) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <?php if ($editRecord): ?>
                <i class="bi bi-pencil-fill me-1"></i> Edit Restriction #<?= (int)$editRecord['id'] ?>
            <?php else: ?>
                <i class="bi bi-plus-circle-fill me-1"></i> Add New Restriction
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form action="crud" method="post" id="crudForm" novalidate>
                <input type="hidden" name="crud_action" value="<?= $editRecord ? 'update' : 'create' ?>">
                <?php if ($editRecord): ?>
                    <input type="hidden" name="id" value="<?= (int)$editRecord['id'] ?>">
                <?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Road No. <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="roadnumber" min="1"
                               value="<?= htmlspecialchars($editRecord['roadnumber'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">From Point <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="frompoint"
                               placeholder="e.g. 74,820"
                               value="<?= htmlspecialchars($editRecord['frompoint'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">To Point <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="topoint"
                               placeholder="e.g. 75,977"
                               value="<?= htmlspecialchars($editRecord['topoint'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Settlement <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="settlement"
                               placeholder="City / town name"
                               value="<?= htmlspecialchars($editRecord['settlement'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Speed</label>
                        <input type="number" class="form-control" name="speed" min="0" max="200"
                               placeholder="km/h"
                               value="<?= htmlspecialchars($editRecord['speed'] ?? '') ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">From Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="fromwhen"
                               value="<?= htmlspecialchars($editRecord['fromwhen'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">To Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="towhen"
                               value="<?= htmlspecialchars($editRecord['towhen'] ?? '') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Restriction Type <span class="text-danger">*</span></label>
                        <select class="form-select" name="namingid" required>
                            <option value="">-- Select type --</option>
                            <?php foreach ($namingOptions as $opt): ?>
                                <option value="<?= $opt['id'] ?>"
                                    <?= (isset($editRecord['namingid']) && $editRecord['namingid'] == $opt['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($opt['nev']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Closure Extent <span class="text-danger">*</span></label>
                        <select class="form-select" name="extentid" required>
                            <option value="">-- Select extent --</option>
                            <?php foreach ($extentOptions as $opt): ?>
                                <option value="<?= $opt['id'] ?>"
                                    <?= (isset($editRecord['extentid']) && $editRecord['extentid'] == $opt['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($opt['nev']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <button type="submit" class="btn btn-danger">
                        <?php if ($editRecord): ?>
                            <i class="bi bi-save-fill me-1"></i> Update Record
                        <?php else: ?>
                            <i class="bi bi-plus-lg me-1"></i> Add Record
                        <?php endif; ?>
                    </button>
                    <?php if ($editRecord): ?>
                        <a href="crud" class="btn btn-secondary">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-table me-1"></i> All Restrictions</span>
            <span class="badge bg-danger"><?= count($restrictions) ?> record<?= count($restrictions) !== 1 ? 's' : '' ?></span>
        </div>
        <div class="card-body p-0">
            <?php if (empty($restrictions)): ?>
                <div class="p-4 text-muted">No records found.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Road No.</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Settlement</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Type</th>
                                <th>Extent</th>
                                <th>Speed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($restrictions as $r): ?>
                                <tr>
                                    <td><?= (int)$r['id'] ?></td>
                                    <td><strong><?= (int)$r['roadnumber'] ?></strong></td>
                                    <td><?= htmlspecialchars($r['frompoint']) ?></td>
                                    <td><?= htmlspecialchars($r['topoint']) ?></td>
                                    <td><?= htmlspecialchars($r['settlement']) ?></td>
                                    <td class="text-nowrap"><?= htmlspecialchars($r['fromwhen']) ?></td>
                                    <td class="text-nowrap"><?= htmlspecialchars($r['towhen']) ?></td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= htmlspecialchars($r['naming_text']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $extentClass = match($r['extentid']) {
                                            '4' => 'bg-danger',
                                            '3' => 'bg-warning text-dark',
                                            '2' => 'bg-warning text-dark',
                                            '1' => 'bg-info text-dark',
                                            default => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?= $extentClass ?>">
                                            <?= htmlspecialchars($r['extent_text']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($r['speed']): ?>
                                            <span class="badge bg-dark">
                                                <?= (int)$r['speed'] ?> km/h
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="crud?edit=<?= (int)$r['id'] ?>"
                                           class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="crud?delete=<?= (int)$r['id'] ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Delete this record?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
document.getElementById('crudForm').addEventListener('submit', function(e) {
    let valid = true;
    const required = ['roadnumber', 'frompoint', 'topoint', 'settlement', 'fromwhen', 'towhen', 'namingid', 'extentid'];

    required.forEach(function(name) {
        const el = document.querySelector(`[name="${name}"]`);
        if (!el) return;
        if (!el.value.trim()) {
            el.classList.add('is-invalid');
            valid = false;
        } else {
            el.classList.remove('is-invalid');
            el.classList.add('is-valid');
        }
    });

    const fromwhen = document.querySelector('[name="fromwhen"]').value;
    const towhen   = document.querySelector('[name="towhen"]').value;
    if (fromwhen && towhen && fromwhen > towhen) {
        document.querySelector('[name="towhen"]').classList.add('is-invalid');
        valid = false;
    }

    const speed = document.querySelector('[name="speed"]').value;
    if (speed && isNaN(speed)) {
        document.querySelector('[name="speed"]').classList.add('is-invalid');
        valid = false;
    }

    if (!valid) e.preventDefault();
});
</script>