<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Coupon Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('coupons.index')); ?>"><?php echo e(__('Coupons')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Coupon Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
   <?php echo e(__('Coupon Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th> <?php echo e(__('Company')); ?></th>
                                <th> <?php echo e(__('Date')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $userCoupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userCoupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(!empty($userCoupon->userDetail)?$userCoupon->userDetail->name:''); ?></td>
                                    <td><?php echo e($userCoupon->created_at); ?></td>                                   
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coupon/view.blade.php ENDPATH**/ ?>