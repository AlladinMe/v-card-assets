<?php
    $settings = \App\Models\Utility::settings();
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Language')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Language')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Language')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
        <?php if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en')): ?>
            <div class="action-btn bg-danger ms-2">
                <form method="POST" action="<?php echo e(route('lang.destroy', $currantLang)); ?>">
                    <?php echo csrf_field(); ?>
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger btn-icon m-1 show_confirm" data-toggle="tooltip"
                        title='Delete'>
                        <span class="text-white"> <i class="ti ti-trash"></i></span>
                    </button>
                </form>
            </div>
        <?php endif; ?>
        <?php if($currantLang != (!empty($settings['default_language']) ? $settings['default_language'] : 'en')): ?>
            <div class="form-check form-switch custom-switch-v1 m-2">
                <input type="hidden" name="disable_lang" value="off">
                <input type="checkbox" class="form-check-input input-primary" name="disable_lang" data-bs-placement="top"
                    title="<?php echo e(__('Enable/Disable')); ?>" id="disable_lang" data-bs-toggle="tooltip"
                    <?php echo e(!in_array($currantLang, $disabledLang) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="disable_lang"></label>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-2">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush" id="useradd-sidenav">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('manage.language', $code)); ?>"
                            class="list-group-item list-group-item-action border-0 <?php echo e($currantLang == $code ? 'active' : ''); ?>">
                            <?php echo e(ucFirst($lang)); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="p-3 card">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill" data-bs-target="#labels"
                            type="button"><?php echo e(__('Labels')); ?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill" data-bs-target="#messages"
                            type="button"><?php echo e(__('Messages')); ?></button>
                    </li>

                </ul>
            </div>
            <div class="card">
                <div class="card-body p-3">
                    <form method="post" action="<?php echo e(route('store.language.data', [$currantLang])); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="tab-content">
                            <div class="tab-pane active" id="labels">
                                <div class="row">
                                    <?php $__currentLoopData = $arrLabel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label text-dark"><?php echo e($label); ?></label>
                                                <input type="text" class="form-control"
                                                    name="label[<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages">
                                <?php $__currentLoopData = $arrMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileName => $fileValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6><?php echo e(ucfirst($fileName)); ?></h6>
                                        </div>
                                        <?php $__currentLoopData = $fileValue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(is_array($value)): ?>
                                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_array($value2)): ?>
                                                        <?php $__currentLoopData = $value2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label3 => $value3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(is_array($value3)): ?>
                                                                <?php $__currentLoopData = $value3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label4 => $value4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(is_array($value4)): ?>
                                                                        <?php $__currentLoopData = $value4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label5 => $value5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group mb-3">
                                                                                    <label
                                                                                        class="form-label text-dark"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?>.<?php echo e($label5); ?></label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>][<?php echo e($label5); ?>]"
                                                                                        value="<?php echo e($value5); ?>">
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group mb-3">
                                                                                <label
                                                                                    class="form-label text-dark"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?></label>
                                                                                <input type="text" class="form-control"
                                                                                    name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>]"
                                                                                    value="<?php echo e($value4); ?>">
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label
                                                                            class="form-label text-dark"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?></label>
                                                                        <input type="text" class="form-control"
                                                                            name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>]"
                                                                            value="<?php echo e($value3); ?>">
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label
                                                                    class="form-label text-dark"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?></label>
                                                                <input type="text" class="form-control"
                                                                    name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>]"
                                                                    value="<?php echo e($value2); ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label
                                                            class="form-label text-dark"><?php echo e($fileName); ?>.<?php echo e($label); ?></label>
                                                        <input type="text" class="form-control"
                                                            name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>]"
                                                            value="<?php echo e($value); ?>">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="text-end">
                            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script>
        $(document).on('change', '#disable_lang', function() {
            var val = $(this).prop("checked");
            if (val == true) {
                var langMode = 'on';
            } else {
                var langMode = 'off';
            }
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('disablelanguage')); ?>",
                datType: 'json',
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "mode": langMode,
                    "lang": "<?php echo e($currantLang); ?>"
                },
                success: function(data) {
                    toastrs('<?php echo e(__('Success')); ?>', data.message, 'success');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/lang/index.blade.php ENDPATH**/ ?>