<?php
    use App\Models\Utility;
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
$allSettings = Utility::settings();
$admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
    $allSettings = Utility::settings();
    $logo = Utility::get_file('uploads/landing_page_image');
$sup_logo = Utility::get_file('uploads/logo');
$setting = Utility::colorset();
$SITE_RTL = $setting['SITE_RTL'] ?? '';
$metatitle = $allSettings['meta_title'] ?? '';
$metsdesc = $allSettings['meta_desc'] ?? '';
$meta_image = Utility::get_file('uploads/meta/');
$meta_logo = $allSettings['meta_image'] ?? '';
$themeColor = ($setting['color_flag'] ?? false) == 'true' ? 'custom-color' : ($setting['color'] ?? 'theme-3');
$eon =  DB::table('settings')->where('name', 'marketplaceon')->value('value');
    $sup_logo = Utility::get_file('uploads/logo');
    $setting = \App\Models\Utility::colorset();
    $SITE_RTL = Utility::getValByName('SITE_RTL');
$toate = 1;
    $metatitle = isset($allSettings['meta_title']) ? $allSettings['meta_title'] : '';
    $metsdesc = isset($allSettings['meta_desc']) ? $allSettings['meta_desc'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($allSettings['meta_image']) ? $allSettings['meta_image'] : '';
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }
    $banner = \App\Models\Utility::get_file('card_banner');
    $cardlogo = \App\Models\Utility::get_file('card_logo');
?>
<!DOCTYPE html>

<html lang="en" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : 'ltr'); ?>">

<head>
    <style>
        :root {
            --color-customColor: <?php echo e($themeColor); ?>;
            --color-customColor: <?=$color ?>;
        }
        
         /* Ascundem secțiunea inițial */
        #details {
            display: none;
            margin-top: 10px;
            transition: all 0.3s ease-in-out; /* Spațiere între buton și secțiune */
        }

        /* Asigurăm ca elementele să fie aliniate vertical */
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Spațiu între elemente */
        }
        
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('css/custom-color.css')); ?>">
    <title><?php echo e(env('APP_NAME')); ?></title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />

    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metsdesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metsdesc); ?>">
    <meta property="og:image" content="<?php echo e($meta_image . $meta_logo); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metsdesc); ?>">
    <meta property="twitter:image" content="<?php echo e($meta_image . $meta_logo); ?>">

    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e($sup_logo . '/' . $allSettings['company_favicon']); ?>" type="image/x-icon" />

    


    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/fonts/feather.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/fonts/material.css')); ?>" />



    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/customizer.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/landing-page.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/marketplace.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/custom.css')); ?>" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <?php if($SITE_RTL == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>

    <?php if($setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/css/style.css')); ?>"
            id="main-style-link">
    <?php endif; ?>
    <?php if($setting['cust_darklayout'] == 'on'): ?>

<body class="<?php echo e($themeColor); ?> landing-dark">
<?php else: ?>

    <body class="<?php echo e($themeColor); ?>">
        <?php endif; ?>
        </head>

        <body class="theme-2">
            <!-- [ Header ] start -->
            <header class="main-header">
                <?php if($settings['topbar_status'] == 'on'): ?>
                    <div class="p-2 text-center announcement bg-dark">
                        <p class="mb-0"><?php echo $settings['topbar_notification_msg']; ?></p>
                    </div>
                <?php endif; ?>
                <?php if($settings['menubar_status'] == 'on'): ?>
                    <div class="container">
                        <nav class="navbar navbar-expand-md default top-nav-collapse">
                            <div class="header-left">
                                <a class="bg-transparent navbar-brand" href="#">
                                    <img src="<?php echo e($logo . '/' . $settings['site_logo']); ?>" alt="logo">
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#home"><?php echo e($settings['home_title']); ?></a>
                                    </li>
                                    <?php if($eon == 'on'): ?>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="<?php echo e(route('marketplace.home')); ?>"><?php echo e(__('Marketplace')); ?></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if($settings['business_campaign'] == 'on'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="#campaign"><?php echo e($settings['business_campaign_title']); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($settings['feature_status'] == 'on'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#features"><?php echo e($settings['feature_title']); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($settings['plan_status'] == 'on'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#plan"><?php echo e($settings['plan_title']); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($settings['faq_status'] == 'on'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#faq"><?php echo e($settings['faq_title']); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page']))): ?>
                                        <?php $__currentLoopData = json_decode($settings['menubar_page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->page_url != null && $value->header == 'on'): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo e(url($value->page_url)); ?>"
                                                        target="_blank"><?php echo e($value->menubar_page_name); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($value->header == 'on' && $value->page_url == null): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                        href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo e($value->menubar_page_name); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </ul>
                                <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="gap-2 ms-auto d-flex justify-content-end">
                                <a href="<?php echo e(route('login')); ?>" class="rounded btn btn-outline-dark"><span
                                        class="hide-mob me-2"><?php echo e(__('Login')); ?></span> <i
                                        data-feather="log-in"></i></a>
                                <a href="<?php echo e(route('register')); ?>" class="rounded btn btn-outline-dark"><span
                                        class="hide-mob me-2"><?php echo e(__('Register')); ?></span> <i
                                        data-feather="user-check"></i></a>
                                <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                        </nav>
                    </div>
                <?php endif; ?>

            </header>
            <!-- [ Header ] End -->
            <!-- [ Banner ] start -->
            <?php if($settings['home_status'] == 'on'): ?>
                <section class="main-banner bg-primary" id="home">
                    <div class="container-offset">
                        <div class="row gy-3 g-0 align-items-center">
                            <div class="col-xxl-4 col-md-6">
                                <span class="px-3 py-2 mb-3 bg-white badge text-dark rounded-pill fw-bold">
                                    <?php echo e($settings['home_offer_text']); ?></span>
                                <h1 class="mb-3">
                                    
                                    <?php echo e($settings['home_heading']); ?>

                                </h1>
                                <h6 class="mb-0"><?php echo e($settings['home_description']); ?></h6>
                                <div class="gap-3 mt-4 d-flex banner-btn">
                                    <?php if($settings['home_live_demo_link']): ?>
                                        <a href="<?php echo e($settings['home_live_demo_link']); ?>"
                                            class="btn btn-outline-dark"><?php echo e(__('Demo')); ?> <i
                                                data-feather="play-circle" class="ms-2"></i></a>
                                    <?php endif; ?>
                                    <?php if($settings['home_buy_now_link']): ?>
                                        <a href="<?php echo e($settings['home_buy_now_link']); ?>"
                                            class="btn btn-outline-dark"><?php echo e(__('Incearca ACUM')); ?> <i
                                                data-feather="lock" class="ms-2"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xxl-8 col-md-6">
                                <div class="dash-preview">
                                    <img class="img-fluid preview-img" rel="preload"
                                        src="<?php echo e($logo . '/' . $settings['home_banner']); ?>" srcset="<?php echo e($logo . '/' . $settings['home_banner']); ?> 1x,
             <?php echo e($logo . '/' . $settings['home_banner']); ?> 2x"
     sizes="(max-width: 600px) 100vw, 50vw"alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="mt-4 row g-0 gy-2 align-items-center">
                            <div class="col-xxl-3">
                                <p class="mb-0"><?php echo e(__('Recomandati de')); ?> <b
                                        class="fw-bold"><?php echo e($settings['home_trusted_by']); ?></b></p>
                            </div>
                            <div class="col-xxl-9">
                                <div class="row gy-3 row-cols-9">

                                    <?php $__currentLoopData = explode(',', $settings['home_logo']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $home_logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-auto">
                                            <img src="<?php echo e($logo . '/' . $home_logo); ?>" alt=""
                                                class="img-fluid" style="width: 130px;">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ Banner ] start -->
            <!-- [ features ] start -->
            <?php if($settings['feature_status'] == 'on'): ?>
                <section class="features-section section-gap bg-dark" id="features">
                    <div class="container">
                        <div class="row gy-3">
                            <div class="col-xxl-4">
                                <span class="mb-2 d-block text-uppercase"><?php echo e($settings['feature_title']); ?></span>
                                <div class="mb-4 title">
                                    <h2><b class="fw-bold"><?php echo $settings['feature_heading']; ?></b></h2>
                                </div>
                                <p class="mb-3"><?php echo $settings['feature_description']; ?></p>
                                <?php if($settings['feature_buy_now_link']): ?>
                                    <a href="<?php echo e($settings['feature_buy_now_link']); ?>"
                                        class="btn btn-primary rounded-pill d-inline-flex align-items-center">Incearca
                                        ACUM
                                        <i data-feather="lock" class="ms-2"></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="col-xxl-8">
                                <div class="row">
                                    <?php if(is_array(json_decode($settings['feature_of_features'], true)) ||
                                            is_object(json_decode($settings['feature_of_features'], true))): ?>
                                        <?php $__currentLoopData = json_decode($settings['feature_of_features'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-4 col-sm-6 d-flex">
                                                <div class="card <?php echo e($key == 0 ? 'bg-primary' : ''); ?>">
                                                    <div class="card-body featurs-body">
                                                        <span class="mb-4 theme-avtar avtar avtar-xl">
                                                            <img src="<?php echo e($logo . '/' . $value['feature_logo']); ?>"
                                                                alt="">
                                                        </span>
                                                        <h3 class="mb-3 <?php echo e($key == 0 ? '' : 'text-white'); ?>">
                                                            <?php echo $value['feature_heading']; ?></h3>
                                                        <p class=" f-w-600 mb-0 <?php echo e($key == 0 ? 'text-body' : ''); ?>">
                                                            <?php echo $value['feature_description']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="mb-4 text-center title">
                                    <span class="mb-2 d-block text-uppercase"><?php echo e($settings['feature_title']); ?></span>
                                    <h2 class="mb-4"><?php echo $settings['highlight_feature_heading']; ?></h2>
                                    <p><?php echo $settings['highlight_feature_description']; ?></p>
                                </div>
                                <div class="features-preview">
                                    <img class="m-auto img-fluid d-block"
                                        src="<?php echo e($logo . '/' . $settings['highlight_feature_image']); ?>"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ features ] start -->
            <!-- [ element ] start -->
            <?php if($settings['feature_status'] == 'on'): ?>
                <section class="element-section section-gap ">
                    <div class="container">
                        <?php if(is_array(json_decode($settings['other_features'], true)) ||
                                is_object(json_decode($settings['other_features'], true))): ?>
                            <?php $__currentLoopData = json_decode($settings['other_features'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key % 2 == 0): ?>
                                    <div class="mb-4 row align-items-center justify-content-center">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-4 title">
                                                <span class="mb-2 d-block fw-bold text-uppercase">Features</span>
                                                <h2>
                                                    <?php echo $value['other_features_heading']; ?>

                                                </h2>
                                            </div>
                                            <p class="mb-3"><?php echo $value['other_featured_description']; ?></p>
                                            <a href="<?php echo e($value['other_feature_buy_now_link']); ?>"
                                                class="btn btn-primary rounded-pill d-inline-flex align-items-center"><?php echo e(__('Buy Now')); ?>

                                                <i data-feather="lock" class="ms-2"></i></a>
                                        </div>
                                        <div class="col-lg-7 col-md-6 res-img">
                                            <?php if(Storage::exists('/uploads/landing_page_image/' . $value['other_features_image'])): ?>
                                                <div class="img-wrapper">
                                                    <img src="<?php echo e($logo . '/' . $value['other_features_image']); ?>"
                                                        alt="" class="img-fluid header-img">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="mb-4 row align-items-center justify-content-center">
                                        <div class="col-lg-7 col-md-6">
                                            <?php if(Storage::exists('/uploads/landing_page_image/' . $value['other_features_image'])): ?>
                                                <div class="img-wrapper">
                                                    <img src="<?php echo e($logo . '/' . $value['other_features_image']); ?>"
                                                        alt="" class="img-fluid header-img">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-4 title">
                                                <span
                                                    class="mb-2 d-block fw-bold text-uppercase"><?php echo e(__('Features')); ?></span>
                                                <h2>
                                                    <?php echo $value['other_features_heading']; ?>

                                                </h2>
                                            </div>
                                            <p class="mb-3"><?php echo $value['other_featured_description']; ?></p>
                                            <a href="<?php echo e($value['other_feature_buy_now_link']); ?>"
                                                class="btn btn-primary rounded-pill d-inline-flex align-items-center"><?php echo e(__('Buy Now')); ?>

                                                <i data-feather="lock" class="ms-2"></i></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>
                </section>
            <?php endif; ?>
            <!-- [ element ] end -->
            <!-- [ Business ] start -->
            <?php if($settings['business_campaign'] == 'on'): ?>
                <section class=" bg-primary section-gap business-section" id="campaign">
                    <div class="container">
                        <div class="mb-2 row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-4 title">
                                    <span
                                        class="mb-2 d-block fw-bold text-uppercase"><?php echo e($settings['business_campaign_title']); ?></span>
                                    <h2 class="mb-4"><?php echo $settings['business_campaign_heading']; ?></h2>
                                    <p><?php echo $settings['business_campaign_description']; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <form id="sortForm" method="GET" action="<?php echo e(url('/')); ?>">
                                    <select name="orderby" id="sort_by" class="form-control category-option"
                                        onchange="document.getElementById('sortForm').submit();">
                                        <option value="">Sort By</option>
                                        <option value="latest" <?php echo e(request('orderby') == 'latest' ? 'selected' : ''); ?>>
                                            Latest</option>
                                        <option value="popularity"
                                            <?php echo e(request('orderby') == 'popularity' ? 'selected' : ''); ?>>Popularity
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="campaign-card swiper campaign-slider">
                            <div class="swiper-wrapper">
                                <?php $__currentLoopData = $businessDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide">
                                        <div class="border card">
                                            <div class="text-center card-body featurs-body">
                                                <div class="card-top">
                                                    <div class="gap-4 mb-4 avatar-wrp d-flex align-items-center">
                                                        <span class="theme-avtar avtar avtar-xl landing-business-logo">
                                                            <img src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $cardlogo . '/' . $business->logo : asset('custom/img/placeholder-image1.jpg')); ?>"
                                                                alt="">
                                                        </span>
                                                        <h3>
                                                            <?php echo e(ucFirst($business->title)); ?>

                                                        </h3>

                                                    </div>
                                                    <div class="d-flex justify-content-between text">
                                                        <h6><?php echo e(__('Sub Title')); ?></h6>
                                                        <label>
                                                            <?php echo e(ucFirst($business->sub_title)); ?>

                                                        </label>
                                                    </div>
                                                    <div class="d-flex justify-content-between text">
                                                        <h6><?php echo e(__('Campaign Name')); ?></h6>
                                                        <label>
                                                            <?php echo e(ucFirst($business->name)); ?>

                                                        </label>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <h5><?php echo e(__('Designation')); ?></h5>
                                                        <label>
                                                            <?php echo e(ucFirst($business->designation)); ?>

                                                        </label>
                                                    </div>
                                                    <p class="<?php echo e($key == 1 ? 'text-body' : ''); ?>">
                                                        <?php echo e(!empty($business->description) ? ucFirst($business->description) : '--'); ?>

                                                    </p>
                                                </div>
                                                <div class="product-content-bottom">
                                                    <!-- Your rating content here -->
                                                    <div
                                                        class="card-bottom d-flex align-items-center justify-content-between">
                                                        <div class="gap-2 card-btn-left d-flex align-items-center">
                                                            <a href="<?php echo e(url('/' . $business->slug)); ?>"
                                                                page-name="Listing Page" target="_blank"
                                                                class=" btn-preview btn">
                                                                Open Business
                                                            </a>
                                                        </div>
                                                        <div class="gap-2 card-btn-right d-flex align-items-center">
                                                            <a class="" data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom" data-size="xl"
                                                                data-title="<?php echo e(__('Preview')); ?>"
                                                                title="<?php echo e(__('Preview')); ?>"
                                                                data-bs-original-title="<?php echo e(__('Preview')); ?>"
                                                                data-url="<?php echo e(route('bussiness.view', $business->slug)); ?>"
                                                                data-ajax-popup="true"><span><i
                                                                        class="ti ti-eye"></i></span></a>
                                                            <a class="" data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom" data-size="md"
                                                                data-title="<?php echo e(__('Contact Detail')); ?>"
                                                                title="<?php echo e(__('Contact Detail')); ?>"
                                                                data-bs-original-title="<?php echo e(__('Contact')); ?>"
                                                                data-url="<?php echo e(route('bussiness.contact', $business->id)); ?>"
                                                                data-ajax-popup="true"><span><i
                                                                        class="ti ti-social"></i></span></a>
                                                            <a data-size="md"
                                                                data-url="<?php echo e(route('bussiness.share', $business->slug)); ?>"
                                                                data-bs-toggle="tooltip" data-size="md"
                                                                data-ajax-popup="true" title="<?php echo e(__('Share')); ?>"
                                                                data-title="<?php echo e(__('Share')); ?>"
                                                                title="<?php echo e(__('Share')); ?>" class=""><i
                                                                    class="ti ti-share"></i></a>
                                                            </a>
                                                            <a href="<?php echo e(route('bussiness.save', $business->slug)); ?>"
                                                                page-name="Listing Page" class=" tooltip-btn">
                                                                <span class="text-white"><i
                                                                        class="ti ti-download"></i></span></a>
                                                            </a>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ Business ] end -->
            <!-- [ element ] start -->
            <?php if($settings['discover_status'] == 'on'): ?>
                <section class="bg-dark section-gap">
                    <div class="container">
                        <div class="mb-2 row justify-content-center">
                            <div class="col-xxl-6">
                                <div class="mb-4 text-center title">
                                    <span class="mb-2 d-block text-uppercase"><?php echo e(__('Descopera')); ?></span>
                                    <h2 class="mb-4"><?php echo $settings['discover_heading']; ?></h2>
                                    <p><?php echo $settings['discover_description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if(is_array(json_decode($settings['discover_of_features'], true)) ||
                                    is_object(json_decode($settings['discover_of_features'], true))): ?>
                                <?php $__currentLoopData = json_decode($settings['discover_of_features'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xxl-3 col-sm-6 col-lg-4 ">
                                        <div class="card   border <?php echo e($key == 1 ? 'bg-primary' : 'bg-transparent'); ?>">
                                            <div class="text-center card-body featurs-body">
                                                <span class="mx-auto mb-4 theme-avtar avtar avtar-xl">
                                                    <img src="<?php echo e($logo . '/' . $value['discover_logo']); ?>"
                                                        alt="">
                                                </span>
                                                <h3 class="mb-3 <?php echo e($key == 1 ? '' : 'text-white'); ?> ">
                                                    <?php echo $value['discover_heading']; ?>

                                                </h3>
                                                <p class="<?php echo e($key == 1 ? 'text-body' : ''); ?>">
                                                    <?php echo $value['discover_description']; ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                        </div>
                        <div class="gap-3 mt-3 d-flex flex-column justify-content-center flex-sm-row">
                            <?php if($settings['discover_live_demo_link']): ?>
                                <a href="<?php echo e($settings['discover_live_demo_link']); ?>"
                                    class="btn btn-outline-light rounded-pill"><?php echo e(__('Demo')); ?>

                                    <i data-feather="play-circle" class="ms-2"></i> </a>
                            <?php endif; ?>

                            <?php if($settings['discover_buy_now_link']): ?>
                                <a href="<?php echo e($settings['discover_buy_now_link']); ?>"
                                    class="btn btn-primary rounded-pill"><?php echo e(__('Incearca ACUM')); ?> <i
                                        data-feather="lock" class="ms-2"></i> </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ element ] end -->
            <!-- [ Screenshots ] start -->
            <?php if($settings['screenshots_status'] == 'on'): ?>
                <section class="screenshots section-gap">
                    <div class="container">
                        <div class="mb-2 row justify-content-center">
                            <div class="col-xxl-6">
                                <div class="mb-4 text-center title">
                                    <span class="mb-2 d-block fw-bold text-uppercase"><?php echo e(__('Imagini')); ?></span>
                                    <h2 class="mb-4"><?php echo $settings['screenshots_heading']; ?></h2>
                                    <p><?php echo $settings['screenshots_description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 gx-4">
                            <?php if(is_array(json_decode($settings['screenshots'], true)) || is_object(json_decode($settings['screenshots'], true))): ?>
                                <?php $__currentLoopData = json_decode($settings['screenshots'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="screenshot-card">
                                            <?php if(Storage::exists('/uploads/landing_page_image/' . $value['screenshots'])): ?>
                                                <div class="img-wrapper">
                                                    <img src="<?php echo e($logo . '/' . $value['screenshots']); ?>"
                                                        class="mb-4 shadow-sm img-fluid header-img" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <h5 class="mb-0"><?php echo $value['screenshots_heading']; ?></h5>
                                            
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ Screenshots ] start -->
            <!-- [ subscription ] start -->
            <?php if($settings['plan_status'] == 'on'): ?>
                <section class="subscription bg-primary section-gap" id="plan">
                    <div class="container">
                        <div class="mb-2 row justify-content-center">
                            <div class="col-xxl-6">
                                <div class="mb-4 text-center title">
                                    <span class="mb-2 d-block fw-bold text-uppercase"><?php echo e(__('Preturi')); ?></span>
                                    <h2 class="mb-4"><?php echo $settings['plan_heading']; ?></h2>
                                    <p><?php echo $settings['plan_description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">

                            <?php
                                $collection = \App\Models\Plan::orderBy('price', 'ASC')->get();
                            ?>
                            <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value['is_plan_enable'] == 'on'): ?>
                                    <div class="col-xxl-3 col-lg-4 col-md-6">
                                        <div class="card price-card shadow-none  <?php echo e($key == 2 ? 'bg-dark' : ''); ?>">
                                            <div class="card-body">
                                                <span class="price-badge bg-dark"><?php echo e($value->name); ?></span>
                                                <span class="mb-4 f-w-600 p-price">
                                                    <?php echo e($value->price); ?>



                                                    <?php echo e(isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?><small
                                                        class="text-sm">/
                                                        <?php echo e($value->duration == 'Month' ? 'Luna' : ($value->duration == 'Year' ? 'An' : ($value->duration == 'Lifetime' ? 'Pe viata' : 'Valoare necunoscută'))); ?>

                                                    </small></span>
                                                <p>
                                                    <?php echo $value->description; ?>

                                                </p>
                                                <ul class="my-3 list-unstyled">
                                                    <li>
                                                        <div class="form-check text-start">


                                                            <label class="form-check-label" for="customCheckc1">
                                                                <?php if($value->max_users == '-1'): ?>
                                                                    Utilizatori nelimitati
                                                                <?php else: ?>
                                                                    <span
                                                                        style="color: green; font-weight: bold;"><?php echo e($value->max_users); ?></span>
                                                                    Utilizatori
                                                                <?php endif; ?>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check text-start">
                                                            
                                                            <label class="form-check-label" for="customCheckc1">
                                                                <?php if($value->business == '-1'): ?>
                                                                    Afaceri <span
                                                                        style="color: black; ">nelimitate</span>
                                                                <?php else: ?>
                                                                    <span
                                                                        style="color: green; font-weight: bold;"><?php echo e($value->business); ?></span>
                                                                    Afaceri
                                                                <?php endif; ?>
                                                            </label>
                                                        </div>
                                                    </li>


                                                    <li>
                                                        <div class="form-check text-start">
                                                            
                                                            <label class="form-check-label" for="customCheckc1">
                                                                <?php if($value->themes == '-1'): ?>
                                                                    Teme nelimitate
                                                                <?php else: ?>
                                                                    <span
                                                                        style="color: green; font-weight: bold;"><?php echo e(substr_count($value->themes, 'theme')); ?></span>
                                                                    Teme
                                                                <?php endif; ?>
                                                            </label>
                                                        </div>
                                                    </li>






                                                    <li>
                                                        <div class="form-check text-start">
                                                            
                                                            <label class="form-check-label" for="customCheckc1">
                                                                <?php if($value->storage_limit == '-1'): ?>
                                                                    Stocare <span
                                                                        style="color: green; font-weight: bold;">nelimitata</span>
                                                                <?php else: ?>
                                                                    <span
                                                                        style="color: green; font-weight: bold;"><?php echo e($value->storage_limit); ?>

                                                                        MB</span> Stocare
                                                                <?php endif; ?>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>

                                                        <div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc1" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->enable_chatgpt == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Chat GPT')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Chat GPT')); ?></span>
        <?php endif; ?>
    </label>
</div>
                                                    </li>


                                                    <li>

                                                        <div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc1" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->enable_custsubdomain == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Subdomeniu')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Subdomeniu')); ?></span>
        <?php endif; ?>
    </label>
</div>
                                                    </li>

                                                    <li>

                                                       <div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc1" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->enable_branding == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Adaugare copyright personal')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Adaugare copyright personal')); ?></span>
        <?php endif; ?>
    </label>
</div>
                                                    </li>

                                                    <li>

                                                        <div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc1" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->pwa_business == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Aplicatie mobila')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Aplicatie mobila')); ?></span>
        <?php endif; ?>
    </label>
</div>
                                                    </li>
<li>
    
</li>

<li>
    <!-- Secțiunea ascunsă inițial -->
    <div class="details" style="display: none;">
        <div class="form-check text-start" style="margin-bottom: 10px;>
             <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->programari == 'on'): ?>
            <i class="fas fa-check-circle text-success" ></i>
            <span><?php echo e(__('Programari')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger" ></i>
            <span class="text-danger"><?php echo e(__('Programari')); ?></span>
        <?php endif; ?>
    </label>
        </div>
        <div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Informatii contact')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Informatii contact')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Testimoniale clienti')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Testimoniale clienti')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Social media')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Social media')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->servicii == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Servicii')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Servicii')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->produse == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Produse')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Produse')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->google_map == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Google Map')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Google Map')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Cookie editor')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Cookie editor')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Setari de plata')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Setari de plata')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Coduri QR profil')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Coduri QR profil')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Card NFC personalizabil')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Card NFC personalizabil')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Card recenzii google')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Card recenzii google')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($toate == '1'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Campanii de afiliere')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Campanii de afiliere')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->support): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Support')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Support')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->eliminare_copyright == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Eliminare copyright NFC card')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Eliminare copyright NFC card')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->custom_html == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('HTML customizabil')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('HTML customizabil')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->mobile_app == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Link aplicatii mobile')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Link aplicatii mobile')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->galerie == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Galerie')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Galerie')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->custom_css == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('CSS customizabil')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('CSS customizabil')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->custom_js == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('JS customizabil')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('JS customizabil')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->seo == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('SEO')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('SEO')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->setari_plata == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Setari plata')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Setari plata')); ?></span>
        <?php endif; ?>
    </label>
</div>

<div class="form-check text-start" style="margin-bottom: 10px;">
    <label class="form-check-label" for="customCheckc2" style="display: flex; align-items: center; gap: 8px;">
        <?php if($value->reduceri_parteneri == 'on'): ?>
            <i class="fas fa-check-circle text-success"></i>
            <span><?php echo e(__('Reduceri la parteneri*')); ?></span>
        <?php else: ?>
            <i class="fas fa-times-circle text-danger"></i>
            <span class="text-danger"><?php echo e(__('Reduceri la parteneri*')); ?></span>
        <?php endif; ?>
    </label>
</div>

        
        
        
    </div>
</li>




<!-- Butonul pentru afișare/ascundere -->
    <button class="btn btn-primary toggleDetails" style="width: 200px;">
        Mai mult
    </button>


                                                </ul>
                                                
                                                
                                                
                                                <div class="d-grid">
                                                    <?php if($value->price == 0): ?>
                                                        <a href="<?php echo e(route('register')); ?>"
                                                            class="btn btn-primary rounded-pill">Start with Starter <i
                                                                data-feather="log-in" class="ms-2"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('register.with.plan', ['plan_id' => $value->id, 'ref_id' => request()->query('id')])); ?>"
                                                            class="btn btn-primary rounded-pill">Start with Starter <i
                                                                data-feather="log-in" class="ms-2"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </section>
            <?php endif; ?>



            <!-- [ subscription ] end -->
            <!-- [ FAqs ] start -->

            <?php if($settings['faq_status'] == 'on'): ?>
                <section class="bg-gray-100 faqs section-gap" id="faq">
                    <div class="container">
                        <div class="mb-2 row">
                            <div class="col-xxl-6">
                                <div class="mb-4 title">
                                    <span
                                        class="mb-2 d-block fw-bold text-uppercase"><?php echo e($settings['faq_title']); ?></span>
                                    <h2 class="mb-4"><?php echo $settings['faq_heading']; ?></h2>
                                    <p><?php echo $settings['faq_description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <?php if(is_array(json_decode($settings['faqs'], true)) || is_object(json_decode($settings['faqs'], true))): ?>
                                        <?php $__currentLoopData = json_decode($settings['faqs'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key % 2 == 0): ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="<?php echo e('flush-heading' . $key); ?>">
                                                        <button class="accordion-button collapsed fw-bold"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="<?php echo e('#flush-' . $key); ?>"
                                                            aria-expanded="false"
                                                            aria-controls="<?php echo e('flush-collapse' . $key); ?>">
                                                            <?php echo $value['faq_questions']; ?>

                                                        </button>
                                                    </h2>
                                                    <div id="<?php echo e('flush-' . $key); ?>"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="<?php echo e('flush-heading' . $key); ?>"
                                                        data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body answer-body">
                                                            <?php echo $value['faq_answer']; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="accordion accordion-flush" id="accordionFlushExample2">
                                    <?php if(is_array(json_decode($settings['faqs'], true)) || is_object(json_decode($settings['faqs'], true))): ?>
                                        <?php $__currentLoopData = json_decode($settings['faqs'], true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key % 2 != 0): ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="<?php echo e('flush-heading' . $key); ?>">
                                                        <button class="accordion-button collapsed fw-bold"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="<?php echo e('#flush-' . $key); ?>"
                                                            aria-expanded="false"
                                                            aria-controls="<?php echo e('flush-collapse' . $key); ?>">
                                                            <?php echo $value['faq_questions']; ?>

                                                        </button>
                                                    </h2>
                                                    <div id="<?php echo e('flush-' . $key); ?>"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="<?php echo e('flush-heading' . $key); ?>"
                                                        data-bs-parent="#accordionFlushExample2">
                                                        <div class="accordion-body">
                                                            <?php echo $value['faq_answer']; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ FAqs ] end -->
            <!-- [ testimonial ] start -->
            <?php if($settings['testimonials_status'] == 'on'): ?>
                <section class="testimonial section-gap">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-4">
                                <div class="mb-4 title">
                                    <span class="mb-2 d-block fw-bold text-uppercase">TESTImoniale</span>
                                    <h2 class="mb-2"><?php echo $settings['testimonials_heading']; ?></h2>
                                    <p><?php echo $settings['testimonials_description']; ?></p>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row justify-content-center gy-3">


                                    <?php if(is_array(json_decode($settings['testimonials'])) || is_object(json_decode($settings['testimonials']))): ?>
                                        <?php $__currentLoopData = json_decode($settings['testimonials']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-xxl-4 col-sm-6 col-lg-6 col-md-4">
                                                <div class="mb-0 shadow-none card bg-dark">
                                                    <div class="p-3 card-body featurs-body">
                                                        <div
                                                            class="mb-3 d-flex align-items-center justify-content-between">
                                                            <span
                                                                class="theme-avtar avtar avtar-sm bg-light-dark rounded-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="36"
                                                                    height="23" viewBox="0 0 36 23"
                                                                    fill="none">
                                                                    <path
                                                                        d="M12.4728 22.6171H0.770508L10.6797 0.15625H18.2296L12.4728 22.6171ZM29.46 22.6171H17.7577L27.6669 0.15625H35.2168L29.46 22.6171Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </span>
                                                            <span>
                                                                <?php for($i = 1; $i <= (int) $value->testimonials_star; $i++): ?>
                                                                    <i data-feather="star"></i>
                                                                <?php endfor; ?>
                                                            </span>
                                                        </div>
                                                        <h3 class="text-white"><?php echo e($value->testimonials_title); ?></h3>
                                                        <p class="hljs-comment">
                                                            <?php echo $value->testimonials_description; ?>

                                                        </p>
                                                        <div class="d-flex align-items-center ">
                                                            <img src="<?php echo e($logo . '/' . $value->testimonials_user_avtar); ?>"
                                                                class="wid-40 rounded-circle me-3" alt="">
                                                            <span>
                                                                <b
                                                                    class="fw-bold d-block"><?php echo e($value->testimonials_user); ?></b>
                                                                <?php echo e($value->testimonials_designation); ?>

                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="mb-0 f-w-600">
                                    <?php echo $settings['testimonials_long_description']; ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <!-- [ testimonial ] end -->
            <!-- [ Footer ] start -->
            <footer class="bg-gray-100 site-footer">
                <div class="container">
                    <div class="footer-row">
                        <div class="ftr-col cmp-detail">
                            <div class="mb-3 footer-logo">
                                <a href="#">
                                    <img src="<?php echo e($logo . '/' . $settings['site_logo']); ?>" alt="logo"
                                        style="filter: drop-shadow(2px 3px 7px #011C4B);">
                                </a>
                            </div>
                            <p>
                                <?php echo $settings['site_description']; ?>

                            </p>

                        </div>
                        <div class="ftr-col">
                            <ul class="list-unstyled">

                                <?php if(is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page']))): ?>
                                    <?php $__currentLoopData = json_decode($settings['menubar_page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($value->page_url != null && $value->footer == 'on' && $value->header == 'off'): ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo e(url($value->page_url)); ?>"
                                                    target="_blank"><?php echo e($value->menubar_page_name); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($value->footer == 'on' && $value->header == 'off' && $value->page_url == null): ?>
                                            <li><a
                                                    href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo $value->menubar_page_name; ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($value->page_url != null && $value->footer == 'on' && $value->header == 'on'): ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo e(url($value->page_url)); ?>"
                                                    target="_blank"><?php echo e($value->menubar_page_name); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($value->footer == 'on' && $value->header == 'on' && $value->page_url == null): ?>
                                            <li><a
                                                    href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo $value->menubar_page_name; ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="ftr-col">
                            <ul class="list-unstyled">
                                <?php if(is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page']))): ?>
                                    <?php $__currentLoopData = json_decode($settings['menubar_page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($value->page_url != null && $value->header == 'on' && $value->footer == 'off'): ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo e(url($value->page_url)); ?>"
                                                    target="_blank"><?php echo e($value->menubar_page_name); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($value->header == 'on' && $value->footer == 'off' && $value->page_url == null): ?>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo e($value->menubar_page_name); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>


                            </ul>
                        </div>
                        <?php if($settings['joinus_status'] == 'on'): ?>
                            <div class="ftr-col ftr-subscribe">
                                <h2><?php echo $settings['joinus_heading']; ?></h2>
                                <p><?php echo $settings['joinus_description']; ?></p>
                                <form method="post" action="<?php echo e(route('join_us_store')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="border input-wrapper border-dark">
                                        <input type="text" name="email"
                                            placeholder="Type your email address...">
                                        <button type="submit"
                                            class="btn btn-dark rounded-pill"><?php echo e(__('Join Us!')); ?></button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="p-2 text-center border-top border-dark">
                    <p class="mb-0"> &copy;
                        <?php echo e(date('Y')); ?>

                        <?php echo e(App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'Salesy Saas')); ?>

                    </p>


                </div>
                <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modelCommanModelLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>

                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- [ Footer ] end -->
            <!-- Required Js -->

            <script src="<?php echo e(asset('custom/js/jquery.min.js')); ?>"></script>
            <script src="<?php echo e(Module::asset('LandingPage:Resources/assets/js/plugins/popper.min.js')); ?>"></script>
            <script src="<?php echo e(Module::asset('LandingPage:Resources/assets/js/plugins/bootstrap.min.js')); ?>"></script>
            <script src="<?php echo e(Module::asset('LandingPage:Resources/assets/js/plugins/feather.min.js')); ?>"></script>
            <script src="<?php echo e(asset('custom/js/custom.js')); ?>"></script>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

            <script>
                // Start [ Menu hide/show on scroll ]
                let ost = 0;
                document.addEventListener("scroll", function() {
                    let cOst = document.documentElement.scrollTop;
                    if (cOst == 0) {
                        document.querySelector(".navbar").classList.add("top-nav-collapse");
                    } else if (cOst > ost) {
                        document.querySelector(".navbar").classList.add("top-nav-collapse");
                        document.querySelector(".navbar").classList.remove("default");
                    } else {
                        document.querySelector(".navbar").classList.add("default");
                        document
                            .querySelector(".navbar")
                            .classList.remove("top-nav-collapse");
                    }
                    ost = cOst;
                });
                // End [ Menu hide/show on scroll ]

                var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                    target: "#navbar-example",
                });
                feather.replace();
            </script>
            <?php if($allSettings['enable_cookie'] == 'on'): ?>
                <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <script>
                var swiper = new Swiper('.campaign-slider', {
                    spaceBetween: 15,
                    mousewheel: false,
                    keyboard: {
                        enabled: true
                    },
                    breakpoints: {
                        1199: {
                            slidesPerView: 4,
                        },
                        991: {
                            slidesPerView: 3,
                        },
                        768: {
                            slidesPerView: 2,
                        },
                        0: {
                            slidesPerView: 1,
                        }
                    },

                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev"
                    },
                });
                feather.replace();
            </script>
                <script src="<?php echo e(asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
            <script>

                function toastrs(title, message, type) {
                var o, i;
                var icon = '';
                var cls = '';
                if (type == 'success') {
                    icon = 'fas fa-check-circle';
                    // cls = 'success';
                    cls = 'primary';
                } else {
                    icon = 'fas fa-times-circle';
                    cls = 'danger';
                }

                // console.log(type,cls);
                $.notify({ icon: icon, title: " " + title, message: message, url: "" }, {
                    element: "body",
                    type: cls,
                    allow_dismiss: !0,
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    offset: { x: 15, y: 15 },
                    spacing: 10,
                    z_index: 9999,
                    delay: 2500,
                    timer: 2000,
                    url_target: "_blank",
                    mouse_over: !1,
                    animate: { enter: o, exit: i },
                    // danger
                    template: '<div class="toast text-white bg-'+cls+' fade show" role="alert" aria-live="assertive" aria-atomic="true" >'
                            +'<div class="d-flex">'
                                +'<div class="toast-body"> '+message+' </div>'
                                +'<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>'
                            +'</div>'
                        +'</div>'
                    // template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                });
            }
            </script>
            <?php if(Session::has('error')): ?>
                <script>
                    toastrs('<?php echo e(__('Error')); ?>', '<?php echo session('error'); ?>', 'error');
                </script>
                <?php echo e(Session::forget('error')); ?>

            <?php endif; ?>
            
            
            <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Selectăm toate butoanele și secțiunile corespunzătoare
        const toggleButtons = document.querySelectorAll('.toggleDetails');
        const detailsSections = document.querySelectorAll('.details');

        toggleButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                const details = detailsSections[index]; // Găsim secțiunea asociată
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'block'; // Afișăm secțiunea
                    button.textContent = 'Mai puțin'; // Schimbăm textul butonului
                } else {
                    details.style.display = 'none'; // Ascundem secțiunea
                    button.textContent = 'Mai mult'; // Schimbăm textul butonului
                }
            });
        });
    });
</script>

            
            
            
        </body>

</html>
<?php /**PATH /home/vcard/public_html/Modules/LandingPage/Resources/views/layouts/landingpage.blade.php ENDPATH**/ ?>