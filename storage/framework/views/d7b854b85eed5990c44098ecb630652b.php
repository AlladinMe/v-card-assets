<?php
    $layout_setting = App\Models\Utility::settings();
    $setting = App\Models\Utility::settings();
    $set_cookie = App\Models\Utility::cookie_settings();
    $langSetting = App\Models\Utility::langSetting();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }

    use App\Models\Utility;
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $allSettings = Utility::settings();
    $logo = Utility::get_file('uploads/landing_page_image');
    $sup_logo = Utility::get_file('uploads/logo');
    $setting = \App\Models\Utility::colorset();
    $SITE_RTL = Utility::getValByName('SITE_RTL');
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }
    $metatitle = isset($allSettings['meta_title']) ? $allSettings['meta_title'] : '';
    $metsdesc = isset($allSettings['meta_desc']) ? $allSettings['meta_desc'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($allSettings['meta_image']) ? $allSettings['meta_image'] : '';
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($layout_setting['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">

<head>
    <style>
        :root {
            --color-customColor: <?=$color ?>;
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style>
        .page-content.overflow-hidden {
            overflow: unset !important;
        }
    </style>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e($sup_logo . '/' . $allSettings['company_favicon']); ?>" type="image/x-icon" />
    <!-- font css -->
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/fonts/feather.css')); ?>" />
    <link rel="stylesheet" href="  <?php echo e(Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Module::asset('LandingPage:Resources/assets/fonts/material.css')); ?>" />
    <!-- vendor css -->
    <link rel="stylesheet" href="  <?php echo e(Module::asset('LandingPage:Resources/assets/css/style.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/css/customizer.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/css/landing-page.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(Module::asset('LandingPage:Resources/assets/css/custom.css')); ?>" />
    <?php echo $__env->make('partials.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        <?php
            $dir = asset(Storage::url('uploads/plan'));
            $dir_payment = asset(Storage::url('uploads/payments'));
        ?>

        <body class="theme-2">
            <header class="main-header">
                <?php if($settings['topbar_status'] == 'on'): ?>
                    <div class="announcement bg-dark text-center p-2">
                        <p class="mb-0"><?php echo $settings['topbar_notification_msg']; ?></p>
                    </div>
                <?php endif; ?>
                <?php if($settings['menubar_status'] == 'on'): ?>
                    <div class="container">
                        <nav class="navbar navbar-expand-md  default top-nav-collapse">
                            <div class="header-left">
                                <a class="navbar-brand bg-transparent" href="#">
                                    <img src="<?php echo e($logo . '/' . $settings['site_logo']); ?>" alt="logo">
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            href="<?php echo e(url('/')); ?>"><?php echo e($settings['home_title']); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="<?php echo e(url('/#features')); ?>"><?php echo e($settings['feature_title']); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="<?php echo e(url('/#plan')); ?>"><?php echo e($settings['plan_title']); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="<?php echo e(url('/#faq')); ?>"><?php echo e($settings['faq_title']); ?></a>
                                    </li>
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

                            <div class="ms-auto d-flex justify-content-end gap-2">
                                <?php if(!Auth::check()): ?>
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-dark rounded"><span
                                            class="hide-mob me-2">Login</span> <i data-feather="log-in"></i></a>
                                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-dark rounded"><span
                                            class="hide-mob me-2">Register</span> <i
                                            data-feather="user-check"></i></a>
                                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </div>
                <?php endif; ?>
            </header>
            <section class="common-banner bg-primary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="title">
                                <h1 class="text-white">Subscribe to a Plan</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <section class="static-content section-gap">
                <div class="container">
                    <div class="mx-2 row" style="align-items: flex-start;">
                        <div class="col-xl-3" style="position: sticky; top: 30px;">
                            <div class="sticky-top">
                                <div class="card ">
                                    <div class="list-group list-group-flush" id="useradd-sidenav">

                                        <?php if($admin_payment_setting['is_manually_enabled'] == 'on'): ?>
                                            <a href="#manual_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Manually')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if($admin_payment_setting['is_bank_enabled'] == 'on'): ?>
                                            <a href="#bank_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Bank Transfer')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(
                                            $admin_payment_setting['is_stripe_enabled'] == 'on' &&
                                                !empty($admin_payment_setting['stripe_key']) &&
                                                !empty($admin_payment_setting['stripe_secret'])): ?>
                                            <a href="#stripe_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Stripe')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(
                                            $admin_payment_setting['is_paypal_enabled'] == 'on' &&
                                                !empty($admin_payment_setting['paypal_client_id']) &&
                                                !empty($admin_payment_setting['paypal_secret_key'])): ?>
                                            <a href="#paypal_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Paypal')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(
                                            $admin_payment_setting['is_paystack_enabled'] == 'on' &&
                                                !empty($admin_payment_setting['paystack_public_key']) &&
                                                !empty($admin_payment_setting['paystack_secret_key'])): ?>
                                            <a href="#paystack_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Paystack')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>


                                        <?php if(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on'): ?>
                                            <a href="#flutterwave_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Flutterwave')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on'): ?>
                                            <a href="#razorpay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Razorpay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on'): ?>
                                            <a href="#mercado_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Mercado Pago')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on'): ?>
                                            <a href="#paytm_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Paytm')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on'): ?>
                                            <a href="#mollie_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Mollie')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on'): ?>
                                            <a href="#skrill_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Skrill')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on'): ?>
                                            <a href="#coingate_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Coingate')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on'): ?>
                                            <a href="#paymentwall_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Paymentwall')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>

                                        <?php if(isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on'): ?>
                                            <a href="#toyyibpay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Toyyibpay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on'): ?>
                                            <a href="#payfast_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Payfast')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_iyzipay_enabled']) && $admin_payment_setting['is_iyzipay_enabled'] == 'on'): ?>
                                            <a href="#iyzipay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Iyzipay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_sspay_enabled']) && $admin_payment_setting['is_sspay_enabled'] == 'on'): ?>
                                            <a href="#sspay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('SSpay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_paytab_enabled']) && $admin_payment_setting['is_paytab_enabled'] == 'on'): ?>
                                            <a href="#paytab_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Paytab')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_benefit_enabled']) && $admin_payment_setting['is_benefit_enabled'] == 'on'): ?>
                                            <a href="#benefit_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Benefit')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_cashfree_enabled']) && $admin_payment_setting['is_cashfree_enabled'] == 'on'): ?>
                                            <a href="#cashfree_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Cashfree')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_aamarpay_enabled']) && $admin_payment_setting['is_aamarpay_enabled'] == 'on'): ?>
                                            <a href="#aamarpay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Aamarpay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_paytr_enabled']) && $admin_payment_setting['is_paytr_enabled'] == 'on'): ?>
                                            <a href="#paytr_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Pay TR')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_midtrans_enabled']) && $admin_payment_setting['is_midtrans_enabled'] == 'on'): ?>
                                            <a href="#midtrans_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Midtrans')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_xendit_enabled']) && $admin_payment_setting['is_xendit_enabled'] == 'on'): ?>
                                            <a href="#xendit_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Xendit')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_yookassa_enabled']) && $admin_payment_setting['is_yookassa_enabled'] == 'on'): ?>
                                            <a href="#yookassa_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('YooKassa')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_nepalste_enabled']) && $admin_payment_setting['is_nepalste_enabled'] == 'on'): ?>
                                            <a href="#nepalste_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Nepalste')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_paiement_enabled']) && $admin_payment_setting['is_paiement_enabled'] == 'on'): ?>
                                            <a href="#paiement_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Paiement Pro')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_cinetpay_enabled']) && $admin_payment_setting['is_cinetpay_enabled'] == 'on'): ?>
                                            <a href="#cinetpay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('CinetPay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_payhere_enabled']) && $admin_payment_setting['is_payhere_enabled'] == 'on'): ?>
                                            <a href="#payhere_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('PayHere')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_fedapay_enabled']) && $admin_payment_setting['is_fedapay_enabled'] == 'on'): ?>
                                            <a href="#fedapay_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('FedaPay')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_tap_enabled']) && $admin_payment_setting['is_tap_enabled'] == 'on'): ?>
                                            <a href="#tap_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Tap')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_authorizenet_enabled']) &&
                                                $admin_payment_setting['is_authorizenet_enabled'] == 'on'): ?>
                                            <a href="#authorizenet_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('AuthorizeNet')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_khalti_enabled']) && $admin_payment_setting['is_khalti_enabled'] == 'on'): ?>
                                            <a href="#khalti_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Khalti')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(isset($admin_payment_setting['is_easybuzz_enabled']) && $admin_payment_setting['is_easybuzz_enabled'] == 'on'): ?>
                                            <a href="#easybuzz_payment"
                                                class="border-0 list-group-item list-group-item-action"><?php echo e(__('Easybuzz')); ?>

                                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="card-body">
                                            <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>
                                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                                <div class="flex-row-reverse p-0 m-0 d-flex ">
                                                    <span class="d-flex align-items-center ">
                                                        <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                                        <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                            <span
                                                class="mb-4 f-w-600 p-price"><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?><?php echo e($plan->price); ?><small
                                                    class="text-sm"><?php echo e(__('/ Duration : ') . __(ucfirst($plan->duration))); ?></small></span>
                                            <p class="mb-0">
                                                <?php echo e('Free Trial Day : '); ?><?php echo e($plan->trial_day); ?>

                                            </p>
                                            <p class="mb-0">
                                                <?php echo e($plan->description); ?>

                                            </p>
                                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                                <?php if($plan->duration !== 'Lifetime'): ?>
                                                    <?php if(
                                                        \Auth::user()->type == 'company' &&
                                                            (empty(\Auth::user()->plan_expire_date) || \Auth::user()->plan_expire_date < date('Y-m-d'))): ?>
                                                        <p class="mb-0">
                                                            <?php echo e(__('Plan Expired')); ?>

                                                        </p>
                                                    <?php else: ?>
                                                        <p class="mb-0">
                                                            <?php echo e(__('Plan Expired : ')); ?>

                                                            <?php echo e(!empty(\Auth::user()->plan_expire_date) ? date('d-m-Y', strtotime(\Auth::user()->plan_expire_date)) : 'Lifetime'); ?>

                                                        </p>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <p class="mb-0">
                                                        <?php echo e(__('Plan Expired : Lifetime')); ?>

                                                    </p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <ul class="my-2 list-unstyled">
                                                <li>
                                                    <span class="theme-avtar">
                                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                                    <?php echo e(count($plan->getThemes())); ?> <?php echo e(__('Themes')); ?>

                                                </li>
                                                <li>
                                                    <span class="theme-avtar">
                                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                                    <?php echo e($plan->business == '-1' ? 'Lifetime' : $plan->business); ?>

                                                    <?php echo e(__('Business')); ?>

                                                </li>
                                                <?php if($plan->enable_custdomain == 'on'): ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e(__('Custom Domain')); ?>

                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i data-feather="x" class="text-danger"></i></span>
                                                        <span class="text-danger"> <?php echo e(__('Custom Domain')); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($plan->enable_custsubdomain == 'on'): ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e(__('Sub Domain')); ?>

                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i data-feather="x" class="text-danger"></i></span>
                                                        <span class="text-danger"><?php echo e(__('Sub Domain')); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($plan->enable_branding == 'on'): ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e(__('Branding')); ?>

                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i data-feather="x" class="text-danger"></i></span>
                                                        <span class="text-danger"><?php echo e(__('Branding')); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($plan->pwa_business == 'on'): ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e(__('Progressive Web App (PWA)')); ?>

                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i data-feather="x" class="text-danger"></i></span>
                                                        <span
                                                            class="text-danger"><?php echo e(__('Progressive Web App (PWA)')); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($plan->enable_chatgpt == 'on'): ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e(__('Chatgpt')); ?>

                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i data-feather="x" class="text-danger"></i></span>
                                                        <span class="text-danger"><?php echo e(__('Chatgpt')); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($plan->module): ?>
                                                    <h6 class="text-muted"><?php echo e(__('Add On')); ?></h6>
                                                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $id = strtolower(
                                                                preg_replace('/\s+/', '_', $module->getName()),
                                                            );
                                                            $path = $module->getPath() . '/module.json';
                                                            $json = json_decode(file_get_contents($path), true);
                                                            $plan_modules = explode(',', $plan->module);
                                                        ?>
                                                        <?php if(!isset($json['display']) || $json['display'] == true): ?>
                                                            <?php if($module->getName() != 'LandingPage'): ?>
                                                                <?php if(in_array($module->getName(), $plan_modules)): ?>
                                                                    <li>
                                                                        <span class="theme-avtar">
                                                                            <i
                                                                                class="text-primary ti ti-circle-plus"></i></span>
                                                                        <?php echo e(\App\Models\Utility::Module_Alias_Name($module)); ?>

                                                                    </li>
                                                                <?php else: ?>
                                                                    <li>
                                                                        <span class="theme-avtar">
                                                                            <i data-feather="x"
                                                                                class="text-danger"></i></span>
                                                                        <?php echo e(\App\Models\Utility::Module_Alias_Name($module)); ?>

                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-xl-9">
                            
                            <?php if($admin_payment_setting['is_manually_enabled'] == 'on'): ?>
                                <div id="manual_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Manually')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="tab-pane <?php echo e($admin_payment_setting['is_manually_enabled'] == 'on' ? 'active' : ''); ?>">
                                            <p class="text-muted">
                                                <?php echo e(__('Requesting manual payment for the planned amount for the subscriptions plan.')); ?>

                                            </p>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="px-2 my-2 col-sm-12">
                                            <div class="text-end">
                                                <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                                    <a href="<?php echo e(route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>"
                                                        class="btn btn-lg btn-primary btn-create"
                                                        data-title="<?php echo e(__('Send Request')); ?>"
                                                        data-bs-placement="top" data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Send Request')); ?>"
                                                        data-toggle="tooltip">
                                                        <?php echo e(__('Send Request')); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('request.cancel', \Auth::user()->id)); ?>"
                                                        class="btn btn-icon btn-danger btn-md" data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Cancel Request')); ?>">
                                                        <?php echo e(__('Cancel Request')); ?>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if($admin_payment_setting['is_bank_enabled'] == 'on'): ?>
                                <div id="bank_payment" class="card">
                                    <form action="<?php echo e(route('plan.pay.with.bank')); ?>" method="post"
                                        enctype="multipart/form-data" class="w3-container w3-display-middle w3-card-4"
                                        id="payment-form1">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-header">
                                            <h5><?php echo e(__('Bank Transfer')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div
                                                class="tab-pane <?php echo e($admin_payment_setting['is_bank_enabled'] == 'on' ? 'active' : ''); ?>">
                                                <div class="p-3 mb-3 border">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="bank_detail"
                                                                    class="form-label text-dark"><?php echo e(__('Bank Detail')); ?></label><br>
                                                                <?php if(isset($admin_payment_setting['bank_detail']) && !empty($admin_payment_setting['bank_detail'])): ?>
                                                                    <?php echo $admin_payment_setting['bank_detail']; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="bankfile"
                                                                    class="form-label text-dark"><?php echo e(__('Payment Receipt')); ?></label>
                                                                <input type="file" name="receipt"
                                                                    class="form-control"
                                                                    enctype="multipart/form-data">
                                                                <?php if($errors->has('receipt')): ?>
                                                                    <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('receipt')); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <div class="form-group">
                                                                    <label for="bank_coupon"
                                                                        class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                                    <input type="text" id="bank_coupon"
                                                                        name="coupon" class="form-control coupon"
                                                                        placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-auto my-auto">
                                                                <a href="#"
                                                                    class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="<?php echo e(__('Apply')); ?>"><i
                                                                        data-feather="save"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <span><b><?php echo e('Plan Price : '); ?></b><?php echo e('$' . $plan->price); ?></span>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <b><?php echo e('Net Amount : '); ?></b><span
                                                                class="bank_amount"><?php echo e('$' . $plan->price); ?></span><br>
                                                            <small><?php echo e(__('(After coupon apply)')); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="px-2 my-2 col-sm-12">
                                                <div class="text-end">
                                                    <input type="hidden" name="plan_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                    <input type="submit" value="<?php echo e(__('Pay Now')); ?>"
                                                        class="btn btn-lg btn-primary btn-create">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(
                                $admin_payment_setting['is_stripe_enabled'] == 'on' &&
                                    !empty($admin_payment_setting['stripe_key']) &&
                                    !empty($admin_payment_setting['stripe_secret'])): ?>
                                <div id="stripe_payment" class="card">
                                    <form role="form" action="<?php echo e(route('stripe.post')); ?>" method="post"
                                        class="require-validation" id="payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-header">
                                            <h5><?php echo e(__('Stripe')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div
                                                class="tab-pane <?php echo e(($admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret'])) == 'on' ? 'active' : ''); ?>">

                                                <div class="p-3 border stripe-payment-div">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="custom-radio">
                                                                <label
                                                                    class="font-16 font-weight-bold"><?php echo e(__('Credit / Debit Card')); ?></label>
                                                            </div>
                                                            <p class="pt-1 mb-0 text-sm">
                                                                <?php echo e(__('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.')); ?>

                                                            </p>
                                                        </div>
                                                        <div class="mt-3 col-sm-4 text-sm-right mt-sm-0">
                                                            <img src="<?php echo e(asset('public/custom/img/payments/master.png')); ?>"
                                                                height="24" class="w-auto" alt="master-card-img">
                                                            <img src="<?php echo e(asset('public/custom/img/payments/discover.png')); ?>"
                                                                height="24" class="w-auto"alt="discover-card-img">
                                                            <img src="<?php echo e(asset('public/custom/img/payments/visa.png')); ?>"
                                                                height="24"class="w-auto" alt="visa-card-img">
                                                            <img src="<?php echo e(asset('public/custom/img/payments/american express.png')); ?>"
                                                                height="24"class="w-auto"
                                                                alt="american-express-card-img">
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="card-name-on"
                                                                    class="form-label text-dark"><?php echo e(__('Name on card')); ?></label>
                                                                <input type="text" name="name"
                                                                    id="card-name-on" class="form-control required"
                                                                    placeholder="<?php echo e(\Auth::user()->name); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div id="card-element">
                                                                <!-- A Stripe Element will be inserted here. -->
                                                            </div>
                                                            <div id="card-errors" role="alert"></div>
                                                        </div>
                                                        <div class="mt-4 col-md-11">
                                                            <div class="form-group">
                                                                <input type="text" id="stripe_coupon"
                                                                    name="coupon" class="form-control coupon"
                                                                    placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-auto my-auto">
                                                            <a href="#"
                                                                class="text-white btn btn-lg btn-primary apply-coupon"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="<?php echo e(__('Apply')); ?>"><i
                                                                    data-feather="save" class=""></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <b><?php echo e('Net Amount : '); ?></b><span
                                                            class="stripe_amount"><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?><?php echo e($plan->price); ?></span><br>
                                                        <small><?php echo e(__('(After coupon apply)')); ?></small>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="error" style="display: none;">
                                                                <div class='alert-danger alert'>
                                                                    <?php echo e(__('Please correct the errors and try again.')); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Credit/Debit Card box-->


                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="px-2 my-2 col-sm-12">
                                                <div class="text-end">
                                                    <input type="hidden" id="stripe" value="stripe"
                                                        name="payment_processor" class="custom-control-input">
                                                    <input type="hidden" name="plan_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                    <input type="submit" value="<?php echo e(__('Pay Now')); ?>"
                                                        class="btn btn-lg btn-primary btn-create">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(
                                $admin_payment_setting['is_paypal_enabled'] == 'on' &&
                                    !empty($admin_payment_setting['paypal_client_id']) &&
                                    !empty($admin_payment_setting['paypal_secret_key'])): ?>
                                <div id="paypal_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Paypal')); ?></h5>
                                    </div>

                                    <form class="w3-container w3-display-middle w3-card-4" method="POST"
                                        id="payment-form" action="<?php echo e(route('plan.pay.with.paypal')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">

                                            <div class="tab-pane <?php echo e(($admin_payment_setting['is_stripe_enabled'] != 'on' && $admin_payment_setting['is_paypal_enabled'] == 'on' && !empty($admin_payment_setting['paypal_client_id']) && !empty($admin_payment_setting['paypal_secret_key'])) == 'on' ? 'active' : ''); ?>"
                                                id="paypal_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="paypal_coupon" name="coupon"
                                                                class="form-control coupon"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn btn-lg btn-primary btn-create">
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(
                                $admin_payment_setting['is_paystack_enabled'] == 'on' &&
                                    !empty($admin_payment_setting['paystack_public_key']) &&
                                    !empty($admin_payment_setting['paystack_secret_key'])): ?>
                                <div id="paystack_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Paystack')); ?></h5>

                                    </div>

                                    <form class="w3-container w3-display-middle w3-card-4" method="POST"
                                        id="paystack-payment-form" action="<?php echo e(route('plan.pay.with.paystack')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="paystack_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="paystack_coupon" name="coupon"
                                                                class="form-control coupon" data-from="paystack"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="button" id="pay_with_paystack"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn btn-lg btn-primary btn-create">
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on'): ?>
                                <div id="flutterwave_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Flutterwave')); ?></h5>

                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.flaterwave')); ?>"
                                        method="post" class="require-validation" id="flaterwave-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane" id="flutterwave_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="flaterwave_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="button" id="pay_with_flaterwave"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on'): ?>
                                <div id="razorpay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Razorpay')); ?> </h5>

                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.razorpay')); ?>"
                                        method="post" class="require-validation" id="razorpay-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="razorpay_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="razorpay_coupon" name="coupon"
                                                                class="form-control coupon" data-from="razorpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="button" id="pay_with_razorpay"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn btn-lg btn-primary btn-create">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on'): ?>
                                <div id="mercado_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Mercado Pago')); ?></h5>

                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.mercado')); ?>"
                                        method="post" class="require-validation" id="mercado-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="mercado_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="mercado_coupon" name="coupon"
                                                                class="form-control coupon" data-from="mercado"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_mercado"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on'): ?>
                                <div id="paytm_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Paytm')); ?></h5>
                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.paytm')); ?>" method="post"
                                        class="require-validation" id="paytm-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">

                                            <div class="tab-pane " id="paytm_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="paytm_coupon" name="coupon"
                                                                class="form-control coupon" data-from="paytm"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="flaterwave_coupon"
                                                                class="form-label text-dark"><?php echo e(__('Mobile Number')); ?></label>
                                                            <input type="text" id="mobile" name="mobile"
                                                                class="form-control mobile" data-from="mobile"
                                                                placeholder="<?php echo e(__('Enter Mobile Number')); ?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_paytm"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class=" btn btn-lg btn-primary btn-create badge-blue">
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on'): ?>
                                <div id="mollie_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Mollie')); ?></h5>

                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.mollie')); ?>"
                                        method="post" class="require-validation" id="mollie-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">

                                            <div class="tab-pane " id="mollie_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="mollie_coupon" name="coupon"
                                                                class="form-control coupon" data-from="mollie"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_mollie"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>

                                    </form>

                                    

                                </div>
                            <?php endif; ?>
                            
                            <?php if(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on'): ?>
                                <div id="skrill_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Skrill')); ?></h5>

                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.skrill')); ?>"
                                        method="post" class="require-validation" id="skrill-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">

                                            <div class="tab-pane " id="skrill_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="skrill_coupon" name="coupon"
                                                                class="form-control coupon" data-from="skrill"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>
                                                <?php
                                                    $skrill_data = [
                                                        'transaction_id' => md5(
                                                            date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id',
                                                        ),
                                                        'user_id' => 'user_id',
                                                        'amount' => 'amount',
                                                        'currency' => 'currency',
                                                    ];
                                                    session()->put('skrill_data', $skrill_data);

                                                ?>

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_skrill"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on'): ?>
                                <div id="coingate_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Coingate')); ?></h5>

                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.coingate')); ?>"
                                        method="post" class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">

                                            <div class="tab-pane " id="coingate_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="coingate_coupon" name="coupon"
                                                                class="form-control coupon" data-from="coingate"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                data-feather="save"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_coingate"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary">
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on'): ?>
                                <div id="paymentwall_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Paymentwall')); ?></h5>
                                    </div>

                                    <form role="form" action="<?php echo e(route('paymentwall')); ?>" method="post"
                                        class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="paymentwall_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="paymentwall_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="paymentwall"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_paymentwall"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on'): ?>
                                <div id="toyyibpay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Toyyibpay')); ?></h5>
                                    </div>

                                    <form role="form" action="<?php echo e(route('plan.pay.with.toyyibpay')); ?>"
                                        method="post" class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="toyyibpay_payment">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="pay_with_toyyibpay"
                                                    value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on'): ?>
                                <div id="payfast_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Payfast')); ?></h5>
                                    </div>

                                    <?php if(
                                        $admin_payment_setting['is_payfast_enabled'] == 'on' &&
                                            !empty($admin_payment_setting['payfast_merchant_id']) &&
                                            !empty($admin_payment_setting['payfast_merchant_key']) &&
                                            !empty($admin_payment_setting['payfast_signature']) &&
                                            !empty($admin_payment_setting['payfast_mode'])): ?>
                                        <div
                                            class="tab-pane <?php echo e(($admin_payment_setting['is_payfast_enabled'] == 'on' && !empty($admin_payment_setting['payfast_merchant_id']) && !empty($admin_payment_setting['payfast_merchant_key'])) == 'on' ? 'active' : ''); ?>">
                                            <?php
                                                $pfHost =
                                                    $admin_payment_setting['payfast_mode'] == 'sandbox'
                                                        ? 'sandbox.payfast.co.za'
                                                        : 'www.payfast.co.za';
                                            ?>
                                            <form role="form" action=<?php echo e('https://' . $pfHost . '/eng/process'); ?>

                                                method="post" class="require-validation" id="payfast-form">
                                                <div class="card-body">
                                                    <div class="tab-pane " id="toyyibpay_payment">
                                                        <input type="hidden" name="plan_id"
                                                            value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-group w-100">
                                                                        <label for="payfast_coupon"
                                                                            class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                                        <input type="text" id="payfast_coupon"
                                                                            name="coupon" class="form-control coupon"
                                                                            placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-auto my-auto">
                                                                <a href="#"
                                                                    class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                                    data-toggle="tooltip"
                                                                    data-title="<?php echo e(__('Apply')); ?>"><i
                                                                        class="fas fa-save"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="get-payfast-inputs"></div>
                                                <div class="card-footer">
                                                    <div class="text-end">
                                                        <input type="hidden" name="plan_id" id="plan_id"
                                                            value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                        <input type="submit" value="<?php echo e(__('Pay Now')); ?>"
                                                            id="payfast-get-status" class="btn btn-xs btn-primary">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_iyzipay_enabled']) && $admin_payment_setting['is_iyzipay_enabled'] == 'on'): ?>
                                <div id="iyzipay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Iyzipay')); ?></h5>
                                    </div>

                                    <?php if(
                                        $admin_payment_setting['is_iyzipay_enabled'] == 'on' &&
                                            !empty($admin_payment_setting['iyzipay_key']) &&
                                            !empty($admin_payment_setting['iyzipay_secret']) &&
                                            !empty($admin_payment_setting['iyzipay_mode'])): ?>
                                        <div
                                            class="tab-pane <?php echo e(($admin_payment_setting['is_iyzipay_enabled'] == 'on' && !empty($admin_payment_setting['iyzipay_key']) && !empty($admin_payment_setting['iyzipay_secret'])) == 'on' ? 'active' : ''); ?>">
                                            <form role="form" action="<?php echo e(route('iyzipay.payment.init')); ?>"
                                                method="post" class="require-validation" id="iyzipay-form">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">
                                                    <div class="tab-pane " id="">
                                                        <input type="hidden" name="plan_id"
                                                            value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-group w-100">
                                                                        <label for="payfast_coupon"
                                                                            class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                                        <input type="text" id="payfast_coupon"
                                                                            name="coupon" class="form-control coupon"
                                                                            placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-auto my-auto">
                                                                <a href="#"
                                                                    class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                                    data-toggle="tooltip"
                                                                    data-title="<?php echo e(__('Apply')); ?>"><i
                                                                        class="fas fa-save"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="get-payfast-inputs"></div>
                                                <div class="card-footer">
                                                    <div class="text-end">
                                                        <input type="hidden" name="plan_id" id="plan_id"
                                                            value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                        <input type="submit" value="<?php echo e(__('Pay Now')); ?>"
                                                            id="" class="btn btn-xs btn-primary">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_sspay_enabled']) && $admin_payment_setting['is_sspay_enabled'] == 'on'): ?>
                                <div id="sspay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Sspay')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('sspay.prepare.plan')); ?>" method="post"
                                        class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_paytab_enabled']) && $admin_payment_setting['is_paytab_enabled'] == 'on'): ?>
                                <div id="paytab_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Paytab')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.paytab')); ?>"
                                        method="post" class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_benefit_enabled']) && $admin_payment_setting['is_benefit_enabled'] == 'on'): ?>
                                <div id="benefit_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Benefit')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('benefit.initiate')); ?>" method="post"
                                        class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_cashfree_enabled']) && $admin_payment_setting['is_cashfree_enabled'] == 'on'): ?>
                                <div id="cashfree_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Cashfree')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('cashfree.payment')); ?>" method="post"
                                        class="require-validation" id="coingate-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_aamarpay_enabled']) && $admin_payment_setting['is_aamarpay_enabled'] == 'on'): ?>
                                <div id="aamarpay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Aamarpay')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('pay.aamarpay.payment')); ?>"
                                        method="post" class="require-validation" id="payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if(isset($admin_payment_setting['is_paytr_enabled']) && $admin_payment_setting['is_paytr_enabled'] == 'on'): ?>
                                <div id="paytr_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Pay TR')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('pay.paytr.payment')); ?>"
                                        method="post" class="require-validation" id="payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="paypal_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="toyyibpay_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="toyyibpay"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_midtrans_enabled']) && $admin_payment_setting['is_midtrans_enabled'] == 'on'): ?>
                                <div id="midtrans_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Midtrans')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.get.midtrans')); ?>"
                                        method="post" class="require-validation" id="midtrans-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="midtrans_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="midtrans_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="midtrans"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            

                            
                            <?php if(isset($admin_payment_setting['is_xendit_enabled']) && $admin_payment_setting['is_xendit_enabled'] == 'on'): ?>
                                <div id="xendit_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Xendit')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.xendit.payment')); ?>"
                                        method="post" class="require-validation" id="xendit-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="xendit_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="xendit_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="xendit"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>


                            
                            <?php if(isset($admin_payment_setting['is_yookassa_enabled']) && $admin_payment_setting['is_yookassa_enabled'] == 'on'): ?>
                                <div id="yookassa_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('YooKassa')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.yookassa')); ?>"
                                        method="post" class="require-validation" id="yookassa-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(isset($admin_payment_setting['is_nepalste_enabled']) && $admin_payment_setting['is_nepalste_enabled'] == 'on'): ?>
                                <div id="nepalste_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Nepalste')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.nepalste')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(isset($admin_payment_setting['is_paiement_enabled']) && $admin_payment_setting['is_paiement_enabled'] == 'on'): ?>
                                <div id="paiement_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Paiement Pro')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.paiementpro')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="flaterwave_coupon"
                                                                    class="form-label text-dark"><?php echo e(__('Mobile Number')); ?></label>
                                                                <input type="text" id="mobile"
                                                                    name="mobile" class="form-control mobile"
                                                                    data-from="mobile"
                                                                    placeholder="<?php echo e(__('Enter Mobile Number')); ?>"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="flaterwave_coupon"
                                                                    class="form-label text-dark"><?php echo e(__('Channel')); ?></label>
                                                                <input type="text" id="channel"
                                                                    name="channel" class="form-control channel"
                                                                    data-from="channel"
                                                                    placeholder="<?php echo e(__('Enter Channel')); ?>"
                                                                    required>
                                                                <small
                                                                    class="text-danger"><?php echo e(__('Example : OMCIV2,MOMO,CARD,FLOOZ ,PAYPAL')); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($admin_payment_setting['is_cinetpay_enabled']) && $admin_payment_setting['is_cinetpay_enabled'] == 'on'): ?>
                                <div id="cinetpay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('CinetPay')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.cinetpay')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($admin_payment_setting['is_payhere_enabled']) && $admin_payment_setting['is_payhere_enabled'] == 'on'): ?>
                                <div id="payhere_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('PayHere')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.payhere')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($admin_payment_setting['is_fedapay_enabled']) && $admin_payment_setting['is_fedapay_enabled'] == 'on'): ?>
                                <div id="fedapay_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('FedaPay')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.fedapay')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($admin_payment_setting['is_tap_enabled']) && $admin_payment_setting['is_tap_enabled'] == 'on'): ?>
                                <div id="tap_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Tap')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.tap')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($admin_payment_setting['is_authorizenet_enabled']) &&
                                    $admin_payment_setting['is_authorizenet_enabled'] == 'on'): ?>
                                <div id="authorizenet_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('AuthorizeNet')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.authorizenet')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($admin_payment_setting['is_khalti_enabled']) && $admin_payment_setting['is_khalti_enabled'] == 'on'): ?>
                                <div id="khalti_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Khalti')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.khalti')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id" id="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue payment-btn">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($admin_payment_setting['is_easybuzz_enabled']) && $admin_payment_setting['is_easybuzz_enabled'] == 'on'): ?>
                                <div id="easybuzz_payment" class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Easybuzz')); ?></h5>
                                    </div>
                                    <form role="form" action="<?php echo e(route('plan.pay.with.easebuzz')); ?>"
                                        method="post" class="require-validation">
                                        <?php echo csrf_field(); ?>
                                        <div class="card-body">
                                            <div class="tab-pane " id="">
                                                <input type="hidden" name="plan_id" id="plan_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label for="yookassa_coupon"
                                                                class="form-label"><?php echo e(__('Coupon')); ?></label>
                                                            <input type="text" id="yookassa_coupon"
                                                                name="coupon" class="form-control coupon"
                                                                data-from="yookassa"
                                                                placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto my-auto">
                                                        <a href="#"
                                                            class="apply-btn btn btn-lg btn-primary apply-coupon"
                                                            data-toggle="tooltip"
                                                            data-title="<?php echo e(__('Apply')); ?>"><i
                                                                class="fas fa-save"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-end">
                                                <input type="submit" id="" value="<?php echo e(__('Pay Now')); ?>"
                                                    class="btn-create btn btn-lg btn-primary badge-blue">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>
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
            </footer>
            <script src="<?php echo e(asset('assets/js/plugins/sweetalert2.all.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/js/pages/ac-alert.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://js.stripe.com/v3/"></script>
            <script src="https://js.paystack.co/v1/inline.js"></script>
            <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script src="<?php echo e(asset('custom/js/jquery.form.js')); ?>"></script>
            <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
            <script src="https://unpkg.com/feather-icons"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
                    $.notify({
                        icon: icon,
                        title: " " + title,
                        message: message,
                        url: ""
                    }, {
                        element: "body",
                        type: cls,
                        allow_dismiss: !0,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 15,
                            y: 15
                        },
                        spacing: 10,
                        z_index: 9999,
                        delay: 2500,
                        timer: 2000,
                        url_target: "_blank",
                        mouse_over: !1,
                        animate: {
                            enter: o,
                            exit: i
                        },
                        // danger
                        template: '<div class="toast text-white bg-' + cls +
                            ' fade show" role="alert" aria-live="assertive" aria-atomic="true">' +
                            '<div class="d-flex">' +
                            '<div class="toast-body"> ' + message + ' </div>' +
                            '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>' +
                            '</div>' +
                            '</div>'
                        // template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    });
                }
            </script>
            <script>
                feather.replace();
            </script>
            <script>
                var config = {
                    "publicKey": "<?php echo e(isset($admin_payment_setting['khalti_public_key']) ? $admin_payment_setting['khalti_public_key'] : ''); ?>",
                    "productIdentity": "1234567890",
                    "productName": "demo",
                    "productUrl": "<?php echo e(env('APP_URL')); ?>",
                    "paymentPreference": [
                        "KHALTI",
                        "EBANKING",
                        "MOBILE_BANKING",
                        "CONNECT_IPS",
                        "SCT",
                    ],
                    "eventHandler": {
                        onSuccess(payload) {
                            if (payload.status == 200) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-Token': '<?php echo e(csrf_token()); ?>'
                                    }
                                });
                                $.ajax({
                                    url: '<?php echo e(route('plan.get.khalti.status')); ?>',
                                    method: 'POST',
                                    data: {
                                        'payload': payload,
                                        'coupon_code': $('.coupon').val(),
                                        'plan_id': $('#plan_id').val(),
                                    },
                                    beforeSend: function() {
                                        $(".loader-wrapper").removeClass('d-none');
                                    },
                                    success: function(data) {
                                        $(".loader-wrapper").addClass('d-none');
                                        if (data.status_code === 200) {
                                            toastrs('<?php echo e(__('Success')); ?>', 'Payment Done Successfully',
                                                'success');
                                            setTimeout(() => {
                                                location.href = '<?php echo e(route('plans.index')); ?>';
                                            }, 2000);
                                        } else {
                                            toastrs('<?php echo e(__('Error')); ?>', 'Payment Failed', 'success');
                                        }
                                    },
                                    error: function(err) {
                                        toastrs('<?php echo e(__('Error')); ?>', err.response, 'success');
                                    },
                                });
                            }
                        },
                        onError(error) {
                            toastrs('<?php echo e(__('Error')); ?>', error, 'success');
                        },
                        onClose() {}
                    }

                };

                var checkout = new KhaltiCheckout(config);
                var btn = document.getElementsByClassName("payment-btn")[0];
            </script>
            <script>
                $(document).on("click", ".payment-btn", function(event) {

                    event.preventDefault()
                    get_khalti_status();
                })

                function get_khalti_status() {
                    var coupon_code = $('.coupon').val();
                    var plan_id = $('#plan_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '<?php echo e(route('plan.pay.with.khalti')); ?>',
                        method: 'POST',
                        data: {
                            'coupon_code': coupon_code,
                            'plan_id': plan_id,
                        },

                        beforeSend: function() {
                            $(".loader-wrapper").removeClass('d-none');
                        },
                        success: function(data) {
                            $(".loader-wrapper").addClass('d-none');
                            if (data == 0) {
                                toastrs('<?php echo e(__('Success')); ?>', 'Payment Done Successfully', 'success');
                                setTimeout(() => {
                                    location.href = '<?php echo e(route('plans.index')); ?>';
                                }, 2000);
                            } else {

                                let price = data * 100;
                                checkout.show({
                                    amount: price
                                });
                            }
                        }
                    });
                }
            </script>
            <?php if(Session::has('success')): ?>
                <script>
                    toastrs('<?php echo e(__('Success')); ?>', '<?php echo session('success'); ?>', 'success');
                </script>
                <?php echo e(Session::forget('success')); ?>

            <?php endif; ?>
            <?php if(Session::has('error')): ?>
                <script>
                    toastrs('<?php echo e(__('Error')); ?>', '<?php echo session('error'); ?>', 'error');
                </script>
                <?php echo e(Session::forget('error')); ?>

            <?php endif; ?>

            <?php if(isset($admin_payment_setting['is_stripe_enabled']) &&
                    $admin_payment_setting['is_stripe_enabled'] == 'on' &&
                    !empty($admin_payment_setting['stripe_key']) &&
                    !empty($admin_payment_setting['stripe_secret'])): ?>
                <?php $stripe_session = Session::get('stripe_session'); ?>
                <?php if(isset($stripe_session) && $stripe_session): ?>
                <script>
                    var stripe = Stripe('<?php echo e($admin_payment_setting['stripe_key']); ?>');
                    stripe.redirectToCheckout({
                        sessionId: '<?php echo e($stripe_session->id); ?>',
                    }).then((result) => {
                        console.log(result);
                    });
                </script>
                <?php endif ?>
            <?php endif; ?>

            <script type="text/javascript">
                var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                    target: '#useradd-sidenav',
                    offset: 300
                })
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $(document).on("click", "#pay_with_paystack", function() {
                    <?php if(isset($admin_payment_setting['paystack_public_key'])): ?>
                        $('#paystack-payment-form').ajaxForm(function(res) {
                            if (res.flag == 1) {
                                var paystack_callback = "<?php echo e(url('/plan/paystack')); ?>";
                                var order_id = '<?php echo e(time()); ?>';
                                var coupon_id = res.coupon;
                                var handler = PaystackPop.setup({
                                    key: '<?php echo e($admin_payment_setting['paystack_public_key']); ?>',
                                    email: res.email,
                                    amount: res.total_price * 100,
                                    currency: res.currency,
                                    ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                                        1
                                    ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                    metadata: {
                                        custom_fields: [{
                                            display_name: "Email",
                                            variable_name: "email",
                                            value: res.email,
                                        }]
                                    },

                                    callback: function(response) {
                                        window.location.href = paystack_callback + '/' + response
                                            .reference + '/' + '<?php echo e(encrypt($plan->id)); ?>' +
                                            '?coupon_id=' + coupon_id
                                    },
                                    onClose: function() {
                                        alert('window closed');
                                    }
                                });
                                handler.openIframe();
                            } else if (res.flag == 2) {
                                setTimeout(() => {
                                    toastrs('<?php echo e(__('Success')); ?>', res.msg, 'success');
                                    window.location.href = "<?php echo e(route('plans.index')); ?>";
                                }, 1000);
                            } else {
                                show_toastr('Error', data.message, 'msg');
                            }

                        }).submit();
                    <?php endif; ?>
                });
                <?php if(isset($admin_payment_setting['flutterwave_public_key'])): ?>
                    $(document).on("click", "#pay_with_flaterwave", function() {
                        $('#flaterwave-payment-form').ajaxForm(function(res) {

                            if (res.flag == 1) {
                                var coupon_id = res.coupon;
                                var API_publicKey = '<?php echo e($admin_payment_setting['flutterwave_public_key']); ?>';
                                var nowTim = "<?php echo e(date('d-m-Y-h-i-a')); ?>";
                                var flutter_callback = "<?php echo e(url('/plan/flaterwave')); ?>";
                                var x = getpaidSetup({
                                    PBFPubKey: API_publicKey,
                                    customer_email: '<?php echo e(Auth::user()->email); ?>',
                                    amount: res.total_price,
                                    currency: '<?php echo e($admin_payment_setting['CURRENCY']); ?>',
                                    txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) +
                                        'fluttpay_online-' + <?php echo e(date('Y-m-d')); ?>,
                                    meta: [{
                                        metaname: "payment_id",
                                        metavalue: "id"
                                    }],
                                    onclose: function() {},
                                    callback: function(response) {
                                        var txref = response.tx.txRef;
                                        if (
                                            response.tx.chargeResponseCode == "00" ||
                                            response.tx.chargeResponseCode == "0"
                                        ) {
                                            window.location.href = flutter_callback + '/' + txref +
                                                '/' +
                                                '<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>?coupon_id=' +
                                                coupon_id;
                                        } else {
                                            // redirect to a failure page.
                                        }
                                        x
                                            .close(); // use this to close the modal immediately after payment.
                                    }
                                });
                            } else if (res.flag == 2) {
                                setTimeout(() => {
                                    toastrs('<?php echo e(__('Success')); ?>', res.msg, 'success');
                                    window.location.href = "<?php echo e(route('plans.index')); ?>";
                                }, 1000);
                            } else {
                                show_toastr('Error', data.message, 'msg');
                            }

                        }).submit();
                    });
                <?php endif; ?>
                <?php if(isset($admin_payment_setting['razorpay_public_key'])): ?>
                    // Razorpay Payment
                    $(document).on("click", "#pay_with_razorpay", function() {
                        $('#razorpay-payment-form').ajaxForm(function(res) {
                            if (res.flag == 1) {

                                var razorPay_callback = '<?php echo e(url('/plan/razorpay')); ?>';
                                var totalAmount = res.total_price * 100;
                                var coupon_id = res.coupon;
                                var options = {
                                    "key": "<?php echo e($admin_payment_setting['razorpay_public_key']); ?>", // your Razorpay Key Id
                                    "amount": totalAmount,
                                    "name": 'Plan',
                                    "currency": '<?php echo e($admin_payment_setting['CURRENCY']); ?>',
                                    "description": "",
                                    "handler": function(response) {
                                        window.location.href = razorPay_callback + '/' + response
                                            .razorpay_payment_id + '/' +
                                            '<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>?coupon_id=' +
                                            coupon_id;
                                    },
                                    "theme": {
                                        "color": "#528FF0"
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                rzp1.open();
                            } else if (res.flag == 2) {
                                setTimeout(() => {
                                    toastrs('<?php echo e(__('Success')); ?>', res.msg, 'success');
                                    window.location.href = "<?php echo e(route('plans.index')); ?>";
                                }, 1000);
                            } else {
                                show_toastr('Error', data.message, 'msg');
                            }

                        }).submit();
                    });
                <?php endif; ?>
                // Payfast
                $(document).ready(function() {

                    $(document).on('click', '.apply-coupon', function() {
                        var ele = $(this);
                        var coupon = ele.closest('.row').find('.coupon').val();

                        $.ajax({
                            url: '<?php echo e(route('apply.coupon')); ?>',
                            type: 'GET',
                            datType: 'json',
                            data: {
                                plan_id: '<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($plan->id)); ?>',
                                coupon: coupon
                            },
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            success: function(data) {
                                $('.final-price').text(data.final_price);
                                $('#final_price_pay').val(data.price);
                                $('#mollie_total_price').val(data.price);
                                $('#skrill_total_price').val(data.price);
                                $('#coingate_total_price').val(data.price);
                                $('.bank_amount').text(data.final_price);
                                $('.stripe_amount').text(data.final_price);
                                $('#stripe_coupon, #paypal_coupon, #skrill_coupon,#coingate_coupon,#bank_coupon')
                                    .val(coupon);

                                if (ele.closest($('#payfast-form')).length == 1) {
                                    get_payfast_status(data.price, coupon);
                                }

                                if (data.is_success == true) {
                                    toastrs('<?php echo e(__('Success')); ?>', data.message, 'success');
                                } else if (data.is_success == false) {
                                    toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                                } else {
                                    toastrs('<?php echo e(__('Error')); ?>', 'Coupon code is required',
                                        'error');
                                }
                            }
                        })
                    });
                });
                <?php if(
                    $admin_payment_setting['is_payfast_enabled'] == 'on' &&
                        !empty($admin_payment_setting['payfast_merchant_id']) &&
                        !empty($admin_payment_setting['payfast_merchant_key'])): ?>
                    $(document).ready(function() {
                        get_payfast_status(amount = 0, coupon = null);
                    })

                    function get_payfast_status(amount, coupon) {
                        var plan_id = $('#plan_id').val();
                        $.ajax({
                            url: '<?php echo e(route('payfast.payment')); ?>',
                            method: 'POST',
                            data: {
                                'plan_id': plan_id,
                                'coupon_amount': amount,
                                'coupon_code': coupon
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    $('#get-payfast-inputs').append(data.inputs);

                                } else {
                                    show_toastr('Error', data.inputs, 'error')
                                }
                            }
                        });
                    }
                <?php endif; ?>
            </script>
        </body>
</html>
<?php /**PATH /home/vcard/public_html/resources/views/auth/plan-view.blade.php ENDPATH**/ ?>