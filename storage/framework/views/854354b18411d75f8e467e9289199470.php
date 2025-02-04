<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Add New Modules')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Add New Modules')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('module.index')); ?>"><?php echo e(__('Module')); ?></a>
</li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Add New Modules')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<link rel="stylesheet" href="<?php echo e(asset('custom/libs/dropzonejs/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-xxl-8">
            <div class="card">
                <div class="card-body">
                    <SECTION>
                        <DIV id="dropzone">
                            <FORM class="dropzone needsclick" id="demo-upload">
                                <DIV class="dz-message needsclick">
                                    <?php echo e(__('Drop files here or click to upload and install.')); ?><BR>
                                </DIV>
                            </FORM>
                        </DIV>
                    </SECTION>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>

<script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>

    <script>
        // Dropzone has been added as a global variable.
        Dropzone.autoDiscover = false;
        var dropzone = new Dropzone('#demo-upload', {
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 500,
            acceptedFiles: '.zip',
            url: "<?php echo e(route('module.install')); ?>",
            success: function(file, response) {
                if (response.flag == 1)
                {
                    toastrs('Success', response.msg, 'success');
                    setTimeout(() => {
                        window.location.href = "<?php echo e(route('module.index')); ?>";
                    }, 1000);
                }
            }
        });
        dropzone.on('sending', function(file, xhr, formData) {
            formData.append('_token', "<?php echo e(csrf_token()); ?>");
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/module/add.blade.php ENDPATH**/ ?>