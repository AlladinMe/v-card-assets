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

    <div class="container mt-4">
        <h2 class="mb-4">Codurile tale QR</h2>

        <a href="<?php echo e(route('coduri_qr.create')); ?>" class="btn btn-primary mb-3">
            <i class="ti ti-plus"></i> Generează un nou cod QR
        </a>
        <?php if(auth()->user()->type == 'super admin'): ?>
        
            <!-- Butonul de adăugare reduceri -->
            <a href="<?php echo e(route('coduri_qr.list_per_user')); ?>" class="btn btn-primary mb-3">Vizualizeaza utilizatori cu QR</a>
        
    <?php endif; ?>

        <?php if($qrCodes->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $qrCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body text-center">
                                <img src="<?php echo e(asset("public/coduri_qr/{$qr->qr_code}.png")); ?>?v=<?php echo e(time()); ?>" class="img-fluid mb-3" alt="QR Code">
                                <h5 class="card-title">Cod QR</h5>
                                <p class="card-text">
                                    <strong>Redirecționează către:</strong> 
                                    <a href="<?php echo e($qr->target_url); ?>" target="_blank"><?php echo e($qr->target_url); ?></a>
                                </p>
                                <p>
                                    <strong>Link QR:</strong> 
                                    <a href="<?php echo e(route('coduri_qr.redirect', ['code' => $qr->qr_code])); ?>" target="_blank">
                                        <?php echo e(route('coduri_qr.redirect', ['code' => $qr->qr_code])); ?>

                                    </a>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="<?php echo e(route('coduri_qr.edit', $qr->id)); ?>" class="btn btn-warning btn-sm">
                                        <i class="ti ti-pencil"></i> Editează
                                    </a>
                                    <form action="<?php echo e(route('coduri_qr.destroy', $qr->id)); ?>" method="POST" 
                                          onsubmit="return confirm('Sigur vrei să ștergi acest cod QR?');">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i> Șterge
                                        </button>
                                    </form>
                                    <a href="<?php echo e(route('coduri_qr.statistici')); ?>" class="btn btn-info btn-sm">
                                        <i class="ti ti-bar-chart"></i> Vezi Statistici
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Nu ai creat încă niciun cod QR. <br>
                <a href="<?php echo e(route('coduri_qr.create')); ?>" class="btn btn-primary mt-2">
                    <i class="ti ti-plus"></i> Crează un cod QR
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coduri_qr/index.blade.php ENDPATH**/ ?>