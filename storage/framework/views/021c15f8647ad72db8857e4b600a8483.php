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
        <h2>Coduri QR ale Utilizatorilor</h2>

        <div class="list-group">
            <?php $__currentLoopData = $qrCodes->groupBy('user_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userQRs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $userQRs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qrCode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Afișează numele utilizatorului doar o singură dată -->
                    <?php if($loop->first): ?>
                        <div class="list-group-item">
                            <h5>
                                <a href="<?php echo e(route('coduri_qr.user_qrs', $qrCode->user->id)); ?>">
                                    <?php echo e($qrCode->user->name); ?>

                                </a>
                            </h5>
                    <?php endif; ?>

                   
                    <?php if($loop->last): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
     <div class="text-center mt-4">
    <button class="btn btn-secondary" onclick="history.back();">
        ⬅️ Înapoi
    </button>
    

<?php else: ?>
    <p>Nu aveți permisiunea de a vizualiza codurile QR ale utilizatorilor.</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coduri_qr/list_per_user.blade.php ENDPATH**/ ?>