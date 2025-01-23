<?php
    $category_path = \App\Models\Utility::get_file('category');
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Business Category')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Business Category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Business Category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
        data-bs-placement="top">
        <a href="#" data-size="md" data-url="<?php echo e(route('category.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Business Category')); ?>"
            class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.marketplace_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9 ">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Business Category')); ?></h5>
                </div>
                <div class="card-body row">
                    <?php $__currentLoopData = $categoryData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3">
                            <div class="card ">
                                <div class=" text-end">

                                    <div class="btn-group card-option">
                                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item user-drop"
                                                data-url="<?php echo e(route('category.edit', $category->id)); ?>"
                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit Business Category')); ?>"><i
                                                    class="ti ti-edit"></i><span
                                                    class="ml-2"><?php echo e(__('Edit')); ?></span></a>



                                            <a href="#" class="bs-pass-para dropdown-item user-drop"
                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                data-confirm-yes="delete-form-<?php echo e($category->id); ?>"
                                                title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top"><i class="ti ti-trash"></i><span
                                                    class="ml-2"><?php echo e(__('Delete')); ?></span></a>
                                            <?php echo Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['category.destroy', $category->id],
                                                'id' => 'delete-form-' . $category->id,
                                            ]); ?>

                                            <?php echo Form::close(); ?>



                                        </div>
                                    </div>

                                </div>
                                <div class="card-body text-center pt-0 ">
                                    <div class="category-card-img">
                                        <?php
                                        $imagePath = $category_path . '/' . $category->logo;
                                        $headers = @get_headers($imagePath);
                                        ?>
                                        <?php if($headers && strpos($headers[0], '200')): ?>
                                            <img src="<?php echo e(!empty($category->logo) ? $category_path . '/' . $category->logo : asset('custom/img/placeholder-image21.jpg')); ?>"
                                                class="img_categorys_fix_size">
                                        <?php else: ?>
                                            <img class="rounded img2"
                                                src="<?php echo e(asset('custom/category/category' . $key + 1 . '.png')); ?>"
                                                alt="" width="100px" height="100px">
                                        <?php endif; ?>
                                    </div>
                                    <h4 class="mt-2 "><?php echo e(ucFirst($category->name)); ?></h4>
                                </div>



                            </div>


                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/business_category/index.blade.php ENDPATH**/ ?>