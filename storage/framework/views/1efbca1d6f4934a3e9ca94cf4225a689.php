<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Add-on Manager')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Add-on Manager')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page">
        <?php echo e(__('Add On')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .system-version h5 {
            position: absolute;
            bottom: -44px;
            right: 27px;
        }

        .center-text {
            display: flex;
            flex-direction: column;
        }

        .center-text .text-primary {
            font-size: 14px;
            margin-top: 5px;
        }

        .theme-main {
            display: flex;
            align-items: center;
        }

        .theme-main .theme-avtar {
            margin-right: 15px;
        }

        @media only screen and (max-width: 575px) {
            .system-version h5 {
                position: unset;
                margin-bottom: 0px;
            }

            .system-version {
                text-align: center;
                margin-bottom: -22px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="text-end">
        <a href="<?php echo e(route('module.add')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title=""
            data-bs-original-title="<?php echo e(__('ModuleSetup')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center px-0">
        <div class=" col-12">
            <div class="card">
                <div class="card-body package-card-inner  d-flex align-items-center">
                    <div class="package-itm theme-avtar">
                        <a href="https://workdo.io/vcardgo-saas-addon/" target="new">
                            <img src="https://workdo.io/wp-content/uploads/2023/03/favicon.jpg" alt="">
                        </a>
                    </div>
                    <div class="package-content flex-grow-1  px-3">
                        <h4><?php echo e(__('Buy More Add-on')); ?></h4>
                        <div class="text-muted"><?php echo e(__('+' . $addOnsCount . ' Premium Add-on')); ?></div>
                    </div>
                    <div class="price text-end">
                        <a class="btn btn-primary" href="https://workdo.io/vcardgo-saas-addon/" target="new">
                            <?php echo e(__('Buy More Add-on')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] start -->
        <div class="event-cards row px-0">
            <?php if(count($modules)-1): ?><h3><?php echo e(__('Installed Add-on')); ?></h3><?php endif; ?>
            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($module->getName() != 'LandingPage'): ?>
                    <?php
                        $module_name = $module->getName();
                        $id = strtolower(preg_replace('/\s+/', '_', $module_name));
                        $path = $module->getPath() . '/module.json';
                        $json = json_decode(file_get_contents($path), true);
                    ?>
                    <?php if(!isset($json['display']) || $json['display'] == true || $module_name == 'GoogleCaptcha'): ?>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 product-card ">
                            <div class="card <?php echo e($module->isEnabled() ? 'enable_module' : 'disable_module'); ?>">
                                <div class="product-img module-add-on-img">
                                    <div class="theme-main">
                                        <div class="theme-avtar">
                                            <img src="<?php echo e(\App\Models\Utility::get_module_img($module->getName())); ?>"
                                                alt="<?php echo e($module->getName()); ?>" class="img-user" style="max-width: 100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-content-wrp">
                                        <div class="center-text">
                                            <div class="text-muted">
                                                <?php if($module->isEnabled()): ?>
                                                    <span class="badge bg-success"><?php echo e(__('Enable')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger"><?php echo e(__('Disable')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            
                                        </div>
                                        <h4 class="text-capitalize">
                                            <?php echo e(\App\Models\Utility::Module_Alias_Name($module->getName())); ?></h4>
                                        <p class="text-muted text-sm mb-0">
                                            <?php echo e(isset($json['description']) ? $json['description'] : ''); ?>

                                        </p>
                                        
                                    </div>
                                    <div class="module-add-on-checkbox">

                                        <div class="checkbox-custom">
                                            <div class="btn-group card-option">
                                                <button type="button" class="btn p-0" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <?php if($module->isEnabled()): ?>
                                                        <a href="#!" class="dropdown-item module_change"
                                                            data-id="<?php echo e($id); ?>">
                                                            <span><?php echo e(__('Disable')); ?></span>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="#!" class="dropdown-item module_change"
                                                            data-id="<?php echo e($id); ?>">
                                                            <span><?php echo e(__('Enable')); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    <form action="<?php echo e(route('module.enable')); ?>" method="POST"
                                                        id="form_<?php echo e($id); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="name"
                                                            value="<?php echo e($module->getName()); ?>">
                                                    </form>
                                                    <a href="#"
                                                            class="bs-pass-para mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                            data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                            data-confirm-yes="delete-form-<?php echo e($id); ?>"
                                                            title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"><span
                                                                class="text-danger"><?php echo e(__('Remove')); ?></span></a>

                                                        <?php echo Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['module.remove', $module->getName()],
                                                            'id' => 'delete-form-' . $id,
                                                        ]); ?>

                                                        <?php echo Form::close(); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <h3><?php echo e(__('Explore Add-on')); ?></h3>

            <div class="col-xl-12">
                <?php $__currentLoopData = $category_wise_add_ons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_wise_add_on): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="tab-<?php echo e($key); ?>" class="card add_on_manager">
                        <div class="card-body">
                            <div class="row">
                                <?php $__currentLoopData = $category_wise_add_on; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $add_on): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 product-card mb-2">
                                        <a href="<?php echo e($add_on['url']); ?>" target="_new" class="module-link">
                                            <div class=" enable_module manager-card">
                                                <div class="product-img module-add-on-img">
                                                    <div class="theme-main">
                                                        <div class="theme-avtar">
                                                            <a href="<?php echo e($add_on['url']); ?>" target="_new"> <img
                                                                    src="<?php echo e($add_on['image']); ?>" alt=""
                                                                    class="img-user" style="max-width: 100%">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="text-capitalize"> <?php echo e($add_on['aliasname']); ?></h5>
                                                        <?php if($add_on['buynow_status']==1): ?>
                                                            <a href="javascript:;" class="module-preview"
                                                                data-bs-toggle="tooltip" title="Preview"
                                                                data-name="<?php echo e($add_on['name']); ?>"><span
                                                                    class="preview-icon"> <i
                                                                        class="ti ti-eye "></i></span></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <a href="<?php echo e($add_on['url']); ?>" target="_new"
                                                        class="module-link btn btn-outline-secondary w-100 ">
                                                        <?php if($add_on['buynow_status']==1): ?>
                                                            <?php echo e(__('Buy Now')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('Coming Soon')); ?>

                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="hover-img-addon btn-primary">
            <button class="close-addon-btn">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <div class="swiper">
                <div class="module-swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Swiper slides will be dynamically appended here -->
                    </div>
                </div>
                <span class="swiper-button-prev"></span>
                <span class="swiper-button-next"></span>
            </div>
        </div>
    </div>

    <div class="system-version">
        <?php
            $version = config('verification.system_version');
        ?>
        
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <script>
        $(document).on('click', '.module_change', function() {
            var id = $(this).attr('data-id');
            $('#form_' + id).submit();
        });
    </script>

    <script>
        $(".module-preview").click(function() {
            $(".hover-img-addon").toggleClass("open");
            $("body").toggleClass("no-scroll");
        });
        $(".close-addon-btn").click(function() {
            $(".hover-img-addon").removeClass("open");
            $("body").removeClass("no-scroll");
        });
        $(".module-preview").click(function() {
            // Retrieve the add-on name from the data-name attribute
            var addOnName = $(this).data('name');
            var jsonData = <?php echo json_encode($category_wise_add_ons); ?>;


            // Find the corresponding add-on object from your JSON data
            var addOn = jsonData.add_ons.find(function(item) {
                return item.name === addOnName;
            });

            // Populate the swiper container with preview images
            var swiperWrapper = $(".swiper-wrapper");
            swiperWrapper.empty(); // Clear previous images

            addOn.preview.forEach(function(imageUrl) {
                swiperWrapper.append('<div class="swiper-slide"><img src="' + imageUrl + '"></div>');
            });

            // Initialize Swiper
            var swiper = new Swiper('.module-swiper-container', {
                // Optional parameters
                slidesPerView: 1,
                loop: true,
                mousewheel: false,
                keyboard: {
                    enabled: true
                },

                // If you need pagination

                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
            });

            // Open the swiper modal or container
            // Example: $("#myModal").modal("show");
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/module/module.blade.php ENDPATH**/ ?>