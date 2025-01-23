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

<?php if(auth()->user()->type == 'super admin'): ?>

    <div class="container mt-4">
        <h2 class="mb-4">Toate Codurile QR ale Utilizatorului</h2>

        <?php if($qrCodes->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $qrCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qrCode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body text-center">
                                <img src="<?php echo e(asset('public/coduri_qr/' . $qrCode->qr_code . '.png')); ?>?v=<?php echo e(time()); ?>" class="img-fluid mb-3" alt="QR Code">
                                <h5 class="card-title"><?php echo e($qrCode->user->name); ?></h5>

                                <p class="card-text">
                                    <strong>Redirecționează către:</strong> 
                                    <a href="<?php echo e($qrCode->target_url); ?>" target="_blank"><?php echo e($qrCode->target_url); ?></a>
                                </p>

                                <p>
                                    <strong>Link QR:</strong> 
                                    <a href="<?php echo e(route('coduri_qr.redirect', ['code' => $qrCode->qr_code])); ?>" target="_blank">
                                        <?php echo e(route('coduri_qr.redirect', ['code' => $qrCode->qr_code])); ?>

                                    </a>
                                </p>

                               
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Nu există coduri QR create pentru acest utilizator. <br>
                <a href="<?php echo e(route('coduri_qr.create')); ?>" class="btn btn-primary mt-2">
                    <i class="ti ti-plus"></i> Crează un cod QR
                </a>
            </div>
        <?php endif; ?>
    </div>
    
     <div class="text-center mt-4">
    <button class="btn btn-secondary" onclick="history.back();">
        ⬅️ Înapoi
    </button>

<?php else: ?>
    <p>Nu aveți permisiunea de a vizualiza codurile QR ale utilizatorilor.</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coduri_qr/user_qrs.blade.php ENDPATH**/ ?>