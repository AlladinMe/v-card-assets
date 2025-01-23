<?php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Branch')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Business')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.marketplace_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
            

            <div class="card">
                <div class="card-header">
                    <h5><?php echo e('Cost Per Day Settings'); ?></h5>
                </div>
                <?php echo e(Form::open(['route' => 'wholesale.cost-setting', 'method' => 'post'])); ?>

                <div class="card-body table-border-style">
                    <div class="row my-2">
                        <div class="repeater">
                            <div class="col-lg-12 text-end">
                                <a data-repeater-create type="button" value="Add" class="submitbtn btn btn-sm btn-primary">
                                    <i class="ti ti-plus text-white"></i>
                                </a>
                            </div>
                            <div data-repeater-list="category_group" class="form-group">
                                <?php if(!empty($costDetail) && count($costDetail) > 0): ?>
                                    <?php $__currentLoopData = $costDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div data-repeater-item class="row align-items-end py-2">
                                            <input type="hidden" name="id" class="cat_id" value="<?php echo e($cost->id); ?>" />
                                            <div class="col-lg-3">
                                                <?php echo e(Form::label('min', __('Min Days'))); ?>

                                                <input class="dtpiker form-control" type="text" name="min" value="<?php echo e($cost->min); ?>" />
                                            </div>
                                            <div class="col-lg-3">
                                                <?php echo e(Form::label('max', __('Max Days'))); ?>

                                                <input class="dtpiker form-control" type="text" name="max" value="<?php echo e($cost->max); ?>" />
                                            </div>
                                            <div class="col-lg-3">
                                                <?php echo e(Form::label('price', __('Per Day Price'))); ?>

                                                <input class="dtpiker form-control" type="text" name="price" value="<?php echo e($cost->price); ?>" />
                                            </div>
                                            <div class="col-lg-3">
                                                <a data-repeater-delete href="javascript:void(0)" class="btn btn-sm btn-danger mb-2">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div data-repeater-item class="row align-items-end py-2">
                                        <div class="col-lg-3">
                                            <?php echo e(Form::label('min', __('Min Days'))); ?>

                                            <input class="dtpiker form-control" type="text" name="min" value="" />
                                        </div>
                                        <div class="col-lg-3">
                                            <?php echo e(Form::label('max', __('Max Days'))); ?>

                                            <input class="dtpiker form-control" type="text" name="max" value="" />
                                        </div>
                                        <div class="col-lg-3">
                                            <?php echo e(Form::label('price', __('Per Day Price'))); ?>

                                            <input class="dtpiker form-control" type="text" name="price" value="" />
                                        </div>
                                        <div class="col-lg-3">
                                            <a data-repeater-delete href="javascript:void(0)" class="btn btn-sm btn-danger mb-2">
                                                <i class="ti ti-trash text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="deleted_ids" id="deleted_ids" value="">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>


            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function () {
            var deletedIds = [];

            $('.repeater').repeater({
                initEmpty: <?php echo e(empty($costDetail) ? 'true' : 'false'); ?>,
                defaultValues: {
                    'min': '',
                    'max': '',
                    'price': ''
                },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    var id = $(this).find('.cat_id').val();
                    if (id) {
                        deletedIds.push(id);
                        $('#deleted_ids').val(deletedIds.join(','));
                    }
                    $(this).slideUp(deleteElement);
                },
                ready: function (setIndexes) {
                    // Optional callback when repeater is ready
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/campaigns/setup.blade.php ENDPATH**/ ?>