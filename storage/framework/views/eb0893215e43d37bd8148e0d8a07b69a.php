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
<div class="container">
    <h2>📊 Scanări pentru QR #<?php echo e($qr->id); ?></h2>
    <table class="table">
        <thead>
            <tr>
                <th>📍 Locație</th>
                <th>📱 Dispozitiv</th>
                <th>📅 Data</th>
                <th>🔗 IP</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $qr->scanari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($scan->location ?? 'Necunoscut'); ?></td>
                    <td><?php echo e($scan->device_type ?? 'N/A'); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($scan->scanned_at)->format('d-m-Y H:i')); ?></td>
                    <td><?php echo e($scan->ip_address); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="<?php echo e(route('coduri_qr.statistici')); ?>" class="btn btn-secondary">⬅️ Înapoi la statistici</a>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coduri_qr/scanari.blade.php ENDPATH**/ ?>