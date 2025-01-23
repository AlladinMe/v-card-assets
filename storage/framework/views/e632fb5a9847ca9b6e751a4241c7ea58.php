<?php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Coduri QR')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Coduri QR')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Coduri QR')); ?></li>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('content'); ?>
<style>
    /* Asigurăm bordură completă pentru tabel */
    .custom-table {
        border-collapse: collapse; /* Asigură borduri corecte */
        width: 100%;
    }

    .custom-table th, .custom-table td {
        border: 2px solid black !important; /* Borduri pe toate celulele */
        padding: 10px;
        text-align: center;
    }

    .custom-table thead {
        background-color: #343a40; /* Culoare pentru header */
        color: white;
    }
</style>
<div class="container mt-4">
    <h2 class="mb-4 text-center">📊 Statistici pentru Codurile QR</h2>

    <div class="card shadow-sm">
        <div class="card-body">
           <table class="table table-striped custom-table">
                <thead class="table-dark">
                    <tr>
                        <th>📷 Cod QR</th>
        <th>🔗 Link de Redirecționare</th>
        <th>📊 Număr Scanări</th>
        <th>📍 Ultima Locație</th>
        <th>📱 Ultimul Dispozitiv</th>
        <th>⏱ Ultima Scanare</th>
        <th>⚙️ Acțiuni</th>
                    </tr>
                </thead>
               <tbody>
    <?php $__currentLoopData = $qrCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <!-- Afișare imagine QR -->
            <td>
                <img src="<?php echo e(asset('public/coduri_qr/' . $qr->qr_code . '.png')); ?>" alt="QR Code" width="70">
            </td>

            <!-- Link de redirecționare -->
            <td>
                <a href="<?php echo e($qr->target_url); ?>" target="_blank" class="text-primary">
                    <?php echo e(Str::limit($qr->target_url, 50)); ?>

                </a>
            </td>

            <!-- Număr de scanări -->
            <td>
                <span class="badge bg-info"><?php echo e($qr->scanari->count()); ?></span>
            </td>

            <!-- Ultima locație -->
            <td>
                <?php if($qr->scanari->isNotEmpty()): ?>
                    <?php echo e($qr->scanari->last()->location ?? 'Necunoscut'); ?>

                <?php else: ?>
                    <span class="text-muted">Nicio scanare</span>
                <?php endif; ?>
            </td>

            <!-- Ultimul dispozitiv utilizat -->
            <td>
                <?php if($qr->scanari->isNotEmpty()): ?>
                    <?php echo e($qr->scanari->last()->device_type ?? 'N/A'); ?>

                <?php else: ?>
                    <span class="text-muted">Nicio scanare</span>
                <?php endif; ?>
            </td>

            <!-- Ultima scanare -->
            <td>
                <?php if($qr->scanari->isNotEmpty()): ?>
                    <?php echo e(\Carbon\Carbon::parse($qr->scanari->last()->scanned_at)->format('d-m-Y H:i')); ?>

                <?php else: ?>
                    <span class="text-muted">Nicio scanare</span>
                <?php endif; ?>
            </td>

            <!-- Acțiuni -->
            <td>
                <a href="<?php echo e(route('coduri_qr.edit', $qr->id)); ?>" class="btn btn-sm btn-warning">
                    ✏️ Editează
                </a>
                
                 <a href="<?php echo e(route('coduri_qr.scanari', $qr->id)); ?>" class="btn btn-sm btn-info">
        📊 Vezi toate scanările
    </a>
                
               <p></p> <form action="<?php echo e(route('coduri_qr.destroy', $qr->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest QR?')">
                        ❌ Șterge
                    
                    
                    
                    
                    </button>
                    
                    
                    
                    
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center mt-4">
    <button class="btn btn-secondary" onclick="history.back();">
        ⬅️ Înapoi
    </button>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coduri_qr/statistici.blade.php ENDPATH**/ ?>