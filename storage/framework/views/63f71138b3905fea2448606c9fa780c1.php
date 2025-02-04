<?php
    $social_no = 1;
    $appointment_no = 0;
    $service_row_no = 0;
    $product_row_no = 0;
    $testimonials_row_no = 0;
    $gallery_row_no = 0;
    $path =
        isset($business->banner) && !empty($business->banner)
            ? asset(Storage::url('card_banner/' . $business->banner))
            : asset('custom/img/placeholder-image.jpg');
    $no = 1;
    $stringid = $business->id;
    $is_enable = false;
    $is_contact_enable = false;
    $is_enable_appoinment = false;
    $is_enable_service = false;
    $is_enable_product = false;
    $is_enable_testimonials = false;
    $is_enable_sociallinks = false;
    $is_custom_html_enable = false;
    $is_google_map_enabled = false;
    $is_enable_gallery = false;
    $is_payment = false;
    $is_appinfo = false;
    $custom_html = $business->custom_html_text;
    $is_branding_enabled = false;
    $branding = $business->branding_text;
    $is_gdpr_enabled = false;
    $gdpr_text = $business->gdpr_text;
    $card_theme = json_decode($business->card_theme);
    $banner = \App\Models\Utility::get_file('card_banner');
    $logo = \App\Models\Utility::get_file('card_logo');
    $image = \App\Models\Utility::get_file('testimonials_images');
    $s_image = \App\Models\Utility::get_file('service_images');
    $pr_image = \App\Models\Utility::get_file('product_images');
    $company_favicon = Utility::getsettingsbyid($business->created_by);
    $company_favicon = $company_favicon['company_favicon'];
    $logo1 = \App\Models\Utility::get_file('uploads/logo/');
    $meta_image = \App\Models\Utility::get_file('meta_image');
    $gallery_path = \App\Models\Utility::get_file('gallery');
    $qr_path = \App\Models\Utility::get_file('qrcode');

    if (!is_null($contactinfo) && !is_null($contactinfo)) {
        $contactinfo['is_enabled'] == '1' ? ($is_contact_enable = true) : ($is_contact_enable = false);
    }
    if (!is_null($business_hours) && !is_null($businesshours)) {
        $businesshours['is_enabled'] == '1' ? ($is_enable = true) : ($is_enable = false);
    }

    if (!is_null($appoinment_hours) && !is_null($appoinment)) {
        $appoinment['is_enabled'] == '1' ? ($is_enable_appoinment = true) : ($is_enable_appoinment = false);
    }

    if (!is_null($services_content) && !is_null($services)) {
        $services['is_enabled'] == '1' ? ($is_enable_service = true) : ($is_enable_service = false);
    }
    if (!is_null($products_content) && !is_null($products)) {
        $products['is_enabled'] == '1' ? ($is_enable_product = true) : ($is_enable_product = false);
    }
    if (!is_null($testimonials_content) && !is_null($testimonials)) {
        $testimonials['is_enabled'] == '1' ? ($is_enable_testimonials = true) : ($is_enable_testimonials = false);
    }

    if (!is_null($social_content) && !is_null($sociallinks)) {
        $sociallinks['is_enabled'] == '1' ? ($is_enable_sociallinks = true) : ($is_enable_sociallinks = false);
    }

    if (!is_null($custom_html) && !is_null($customhtml)) {
        $customhtml->is_custom_html_enabled == '1' ? ($is_custom_html_enable = true) : ($is_custom_html_enable = false);
    }
    if (!is_null($business) && !is_null($business)) {
        $business->is_google_map_enabled == '1' ? ($is_google_map_enabled = true) : ($is_google_map_enabled = false);
    }

    if (!is_null($gallery_contents) && !is_null($gallery)) {
        $gallery['is_enabled'] == '1' ? ($is_enable_gallery = true) : ($is_enable_gallery = false);
    }

    if (!is_null($cardPayment_content) && !is_null($cardPayment)) {
        $cardPayment['is_enabled'] == '1' ? ($is_payment = true) : ($is_payment = false);
    }
    if (!is_null($appInfo)) {
        $appInfo['is_enabled'] == '1' ? ($is_appinfo = true) : ($is_appinfo = false);
    }
    if (!is_null($business->is_branding_enabled) && !is_null($business->is_branding_enabled)) {
        !empty($business->is_branding_enabled) && $business->is_branding_enabled == 'on'
            ? ($is_branding_enabled = true)
            : ($is_branding_enabled = false);
    } else {
        $is_branding_enabled = false;
    }
    if (!is_null($business->is_gdpr_enabled) && !is_null($business->is_gdpr_enabled)) {
        !empty($business->is_gdpr_enabled) && $business->is_gdpr_enabled == 'on'
            ? ($is_gdpr_enabled = true)
            : ($is_gdpr_enabled = false);
    }

    $color = substr($business->theme_color, 0, 6);
    $SITE_RTL = Cookie::get('SITE_RTL');
    if ($SITE_RTL == '') {
        $SITE_RTL = 'off';
    }
    $SITE_RTL = Utility::settings()['SITE_RTL'];

    $url_link = env('APP_URL') . '/' . $business->slug;
    $meta_tag_image = $meta_image . '/' . $business->meta_image;

    // Cookie
    $cookie_data = App\Models\Business::card_cookie($business->slug);
    $a = $cookie_data;

?>
<!DOCTYPE html>
<html dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="<?php echo e($business->title); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title><?php echo e($business->title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="HandheldFriendly" content="True">

    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($url_link); ?>">
    <meta property="og:title" content="<?php echo e($business->title); ?>">
    <meta property="og:description" content="<?php echo e($business->meta_description); ?>">
    <meta property="og:image"
        content="<?php echo e(!empty($business->meta_image) ? $meta_tag_image : asset('custom/img/placeholder-image.jpg')); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e($url_link); ?>">
    <meta property="twitter:title" content="<?php echo e($business->title); ?>">
    <meta property="twitter:description" content="<?php echo e($business->meta_description); ?>">
    <meta property="twitter:image"
        content="<?php echo e(!empty($business->meta_image) ? $meta_tag_image : asset('custom/img/placeholder-image.jpg')); ?>">

    


    <link rel="icon"
        href="<?php echo e($logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
        type="image" sizes="16x16">
    <link rel="stylesheet" href="<?php echo e(asset('custom/theme13/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/theme13/fonts/stylesheet.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/emojionearea.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>" />
    <?php if(isset($is_slug)): ?>
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme13/modal/bootstrap.min.css')); ?>">
    <?php endif; ?>

    <?php if($SITE_RTL == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme13/css/rtl-main-style.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme13/css/main-style.css')); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/theme13/css/responsive.css')); ?>">


    <?php if($business->google_fonts != 'Default' && isset($business->google_fonts)): ?>
        <style>
            @import url('<?php echo e(\App\Models\Utility::getvalueoffont($business->google_fonts)['link']); ?>');

            :root .theme13-v1 {
                --Strawford: '<?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>', <?php echo e(substr(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], strpos(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') + 1)); ?>;
            }

            :root .theme13-v2 {
                --Strawford: '<?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>', <?php echo e(substr(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], strpos(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') + 1)); ?>;
            }

            :root .theme13-v3 {
                --Strawford: '<?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>', <?php echo e(substr(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], strpos(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') + 1)); ?>;
            }

            :root .theme13-v4 {
                --Strawford: '<?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>', <?php echo e(substr(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], strpos(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') + 1)); ?>;
            }

            :root .theme13-v5 {
                --Strawford: '<?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>', <?php echo e(substr(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], strpos(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') + 1)); ?>;
            }
        </style>
    <?php endif; ?>

    <?php if(isset($is_slug)): ?>
        <link rel='stylesheet' href='<?php echo e(asset('css/cookieconsent.css')); ?>' media="screen" />
        <style type="text/css">
            <?php echo e($business->customcss); ?>

        </style>
    <?php endif; ?>


    
    <meta name="mobile-wep-app-capable" content="yes">
    <meta name="apple-mobile-wep-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <link rel="apple-touch-icon"
        href="<?php echo e(asset(Storage::url('uploads/logo/') . (!empty($setting->value) ? $setting->value : 'favicon.png'))); ?>" />

    <?php if($business->enable_pwa_business == 'on' && $plan->pwa_business == 'on'): ?>
        <link rel="manifest"
            href="<?php echo e(asset('storage/uploads/theme_app/business_' . $business->id . '/manifest.json')); ?>" />
    <?php endif; ?>
    <?php if(!empty($business->pwa_business($business->slug)->theme_color)): ?>
        <meta name="theme-color" content="<?php echo e($business->pwa_business($business->slug)->theme_color); ?>" />
    <?php endif; ?>
    <?php if(!empty($business->pwa_business($business->slug)->background_color)): ?>
        <meta name="apple-mobile-web-app-status-bar"
            content="<?php echo e($business->pwa_business($business->slug)->background_color); ?>" />
    <?php endif; ?>

    <?php $__currentLoopData = $pixelScript; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $script): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?= $script ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</head>

<body class="tech-card-body">
    <!--wrapper start here-->

    <div id="view_css" class="<?php echo e(\App\Models\Utility::themeOne()['theme13'][$business->theme_color]['theme_name']); ?>">
        <div id="boxes" class="<?php if(!isset($is_pdf)): ?> scrollbar <?php endif; ?>">
            <div class="home-wrapper force-overflow">
                <section class="home-banner-section">
                    <img src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/img/placeholder-image.jpg')); ?>"
                        id="banner_preview" class="home-banner" alt="image">
                </section>
                <section class="client-info-section">
                    <div class="container">
                        <div class="client-intro">
                            <div class="client-image">
                                <img src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                    id="business_logo_preview" alt="image">
                            </div>
                            <div class="client-brief-intro">
                                <h3 id="<?php echo e($stringid . '_title'); ?>_preview"><?php echo e($business->title); ?></h3>
                                <h6 id="<?php echo e($stringid . '_designation'); ?>_preview"><?php echo e($business->designation); ?></h6>
                                <span id="<?php echo e($stringid . '_subtitle'); ?>_preview"><?php echo e($business->sub_title); ?></span>

                            </div>
                        </div>
                    </div>
                </section>
                <?php $j = 1; ?>
                <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($j == $order_value): ?>

                        <?php if($order_key == 'description'): ?>
                            <div class="container">
                                <div class="client-intro">
                                    <div class="client-brief-intro">
                                        <p id="<?php echo e($stringid . '_desc'); ?>_preview">
                                            <?php echo nl2br(e($business->description)); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($order_key == 'contact_info'): ?>
                            <div class="container" id="contact-div">
                                <div class="client-contact" id="inputrow_contact_preview">

                                    <?php if(!is_null($contactinfo_content) && !is_null($contactinfo)): ?>
                                        <?php $__currentLoopData = $contactinfo_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key1 == 'Phone'): ?>
                                                    <?php $href = 'tel:'.$val1; ?>
                                                <?php elseif($key1 == 'Email'): ?>
                                                    <?php $href = 'mailto:'.$val1; ?>
                                                <?php elseif($key1 == 'Address'): ?>
                                                    <?php $href = ''; ?>
                                                <?php else: ?>
                                                    <?php $href = $val1 ?>
                                                <?php endif; ?>
                                                <?php if($key1 != 'id'): ?>
                                                    <div class="calllink contactlink "
                                                        id="contact_<?php echo e($loop->parent->index + 1); ?>">
                                                        <?php if($key1 == 'Address'): ?>
                                                            <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($key2 == 'Address_url'): ?>
                                                                    <?php $href = $val2; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e($href); ?>" target="_blank">
                                                                <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/contact/' . strtolower($key1) . '.svg')); ?>"
                                                                    alt="<?php echo e($key1); ?>" class="img-fluid">
                                                                <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($key2 == 'Address'): ?>
                                                                        <span
                                                                            id="<?php echo e($key1 . '_' . $no); ?>_preview"><?php echo e($val2); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </a>
                                                        <?php else: ?>
                                                            <?php if($key1 == 'Whatsapp'): ?>
                                                                <a href="<?php echo e(url('https://wa.me/' . $href)); ?>"
                                                                    target="_blank">
                                                                    <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/contact/' . strtolower($key1) . '.svg')); ?>"
                                                                        alt="<?php echo e($key1); ?>" class="img-fluid">
                                                                <?php else: ?>
                                                                    <a href="<?php echo e($href); ?>">
                                                                        <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/contact/' . strtolower($key1) . '.svg')); ?>"
                                                                            alt="<?php echo e($key1); ?>"
                                                                            class="img-fluid">
                                                            <?php endif; ?>
                                                            <span
                                                                id="<?php echo e($key1 . '_' . $no); ?>_preview"><?php echo e($val1); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                    $no++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($order_key == 'bussiness_hour'): ?>
                            <section id="business-hours-div" class="business-hour-section common-border padding-top">
                                <div class="container">
                                    <div class="section-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 30 30" fill="none">
                                            <circle class="theme-svg" cx="15" cy="15" r="15"
                                                fill="url(#paint0_linear)" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M14.804 6.17676C15.6703 6.17676 16.3726 6.84209 16.3726 7.66283V14.4776L19.8347 17.7575C20.4473 18.3379 20.4473 19.2788 19.8347 19.8591C19.2221 20.4395 18.2289 20.4395 17.6164 19.8591L13.6948 16.144C13.4006 15.8653 13.2354 15.4873 13.2354 15.0932V7.66283C13.2354 6.84209 13.9376 6.17676 14.804 6.17676Z"
                                                fill="white" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="15" y1="0"
                                                    x2="15" y2="30" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <h2><?php echo e(__('Business Hours')); ?></h2>
                                    </div>
                                    <div class="daily-hours-content">
                                        <div class="daily-hours-inner">
                                            <ul class="pl-1">
                                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <p><?php echo e(__($day)); ?>:<span
                                                                class="days_<?php echo e($k); ?>">
                                                                <?php if(isset($business_hours->$k) && $business_hours->$k->days == 'on'): ?>
                                                                    <span
                                                                        class="days_<?php echo e($k); ?>_start"><?php echo e(!empty($business_hours->$k->start_time) && isset($business_hours->$k->start_time) ? date('h:i A', strtotime($business_hours->$k->start_time)) : '00:00'); ?></span>
                                                                    - <span
                                                                        class="days_<?php echo e($k); ?>_end"><?php echo e(!empty($business_hours->$k->end_time) && isset($business_hours->$k->end_time) ? date('h:i A', strtotime($business_hours->$k->end_time)) : '00:00'); ?></span>
                                                                <?php else: ?>
                                                                    <?php echo e(__('Closed')); ?>

                                                                <?php endif; ?>
                                                            </span></p>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'appointment'): ?>
                            <section id="appointment-div" class="appointment-section common-border padding-top">
                                <div class="container">
                                    <div class="section-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            viewBox="0 0 28 28" fill="none">
                                            <path class="theme-svg" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.6 1.4C5.6 0.626802 6.2268 0 7 0C7.7732 0 8.4 0.626801 8.4 1.4V2.8H19.6V1.4C19.6 0.626802 20.2268 0 21 0C21.7732 0 22.4 0.626801 22.4 1.4V2.8H23.8C26.1196 2.8 28 4.6804 28 7V23.8C28 26.1196 26.1196 28 23.8 28H4.2C1.8804 28 0 26.1196 0 23.8V7C0 4.6804 1.8804 2.8 4.2 2.8H5.6V1.4Z"
                                                fill="url(#paint0_linear)" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.3333 14C10.597 14 10 14.597 10 15.3333C10 16.0697 10.597 16.6667 11.3333 16.6667H20.6667C21.403 16.6667 22 16.0697 22 15.3333C22 14.597 21.403 14 20.6667 14H11.3333ZM7.33333 19.3333C6.59695 19.3333 6 19.9303 6 20.6667C6 21.403 6.59695 22 7.33333 22H15.3333C16.0697 22 16.6667 21.403 16.6667 20.6667C16.6667 19.9303 16.0697 19.3333 15.3333 19.3333H7.33333Z"
                                                fill="white" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="14" y1="0"
                                                    x2="14" y2="28" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <h2><b><?php echo e(__('Make an')); ?></b> <?php echo e(__('appointment')); ?></h2>
                                    </div>
                                    <div class="appointment-date">
                                        <div class="date-label">
                                            <?php echo e(__('Date')); ?>

                                        </div>
                                        <input type="text" name="date" class="text-center datepicker_min"
                                            placeholder="<?php echo e(__('Pick a Date')); ?>">
                                    </div>
                                    <div class="text-center pl-3 mt-0 mb-3">
                                        <span class="text-danger text-center span-error-date"
                                            style="margin-left: 78px;"></span>
                                    </div>
                                    <div class="appointment-hour">
                                        <div class="hour-label">
                                            <?php echo e(__('Hour')); ?>

                                        </div>
                                        <div class="text-radio" id="inputrow_appointment_preview">
                                            <?php $radiocount = 1; ?>
                                            <?php if(!is_null($appoinment_hours)): ?>
                                                <?php $__currentLoopData = $appoinment_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="radio <?php echo e($radiocount % 2 == 0 ? 'radio-left' : ''); ?>"
                                                        id="<?php echo e('appointment_' . $appointment_no); ?>">
                                                        <input id="radio-<?php echo e($radiocount); ?>" name="time"
                                                            type="radio"
                                                            data-id="<?php if(!empty($hour->start)): ?> <?php echo e($hour->start); ?> <?php else: ?> 00:00 <?php endif; ?>-<?php if(!empty($hour->end)): ?> <?php echo e($hour->end); ?> <?php else: ?> 00:00 <?php endif; ?>"
                                                            class="app_time">
                                                        <label for="radio-<?php echo e($radiocount); ?>"
                                                            class="radio-label"><span
                                                                id="appoinment_start_<?php echo e($appointment_no); ?>_preview">
                                                                <?php if(!empty($hour->start)): ?>
                                                                    <?php echo e($hour->start); ?>

                                                                <?php else: ?>
                                                                    00:00
                                                                <?php endif; ?>
                                                            </span> - <span
                                                                id="appoinment_end_<?php echo e($appointment_no); ?>_preview">
                                                                <?php if(!empty($hour->end)): ?>
                                                                    <?php echo e($hour->end); ?>

                                                                <?php else: ?>
                                                                    00:00
                                                                <?php endif; ?>
                                                            </span></label>
                                                    </div>
                                                    <?php
                                                        $radiocount++;
                                                        $appointment_no++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-center mt-0 mb-3 col-12">
                                            <span class="text-danger text-center span-error-time"></span>
                                        </div>
                                        <div class="appointment-btn">
                                            <a href="javascript:;" data-toggle="modal"
                                                data-target="#appointment-modal" class="btn" tabindex="0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4 1C4 0.447715 4.44772 0 5 0C5.55228 0 6 0.447715 6 1V2H14V1C14 0.447715 14.4477 0 15 0C15.5523 0 16 0.447715 16 1V2H17C18.6569 2 20 3.34315 20 5V17C20 18.6569 18.6569 20 17 20H3C1.34315 20 0 18.6569 0 17V5C0 3.34315 1.34315 2 3 2H4V1Z"
                                                        fill="#252429" />
                                                    <path class="theme-svg" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8 10C7.44772 10 7 10.4477 7 11C7 11.5523 7.44772 12 8 12H15C15.5523 12 16 11.5523 16 11C16 10.4477 15.5523 10 15 10H8ZM5 14C4.44772 14 4 14.4477 4 15C4 15.5523 4.44772 16 5 16H11C11.5523 16 12 15.5523 12 15C12 14.4477 11.5523 14 11 14H5Z"
                                                        fill="#ADE8F4" />
                                                </svg>
                                                <?php echo e(__('Make an appointment')); ?>

                                            </a>
                                        </div>
                                    </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'service'): ?>
                            <section id="services-div" class="service-section common-border padding-top">
                                <div class="container">
                                    <div class="section-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                            viewBox="0 0 27 27" fill="none">
                                            <path class="theme-svg"
                                                d="M25.7076 23.371L23.1825 25.8961C23.1825 25.8961 16.6212 28.7081 7.24793 19.3348C-2.12534 9.96157 0.686638 3.40028 0.686638 3.40028L3.21178 0.875134C4.3526 -0.265686 6.23935 -0.131596 7.20737 1.15909L9.61764 4.37279C10.4092 5.42827 10.3043 6.90522 9.37136 7.83814L7.24793 9.96157C7.24793 9.96157 7.24793 11.8362 10.9972 15.5855C14.7466 19.3348 16.6212 19.3348 16.6212 19.3348L18.7446 17.2114C19.6776 16.2785 21.1545 16.1735 22.21 16.9651L25.4237 19.3754C26.7144 20.3434 26.8485 22.2302 25.7076 23.371Z"
                                                fill="url(#paint0_linear)" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="0.543393" y1="3.54352"
                                                    x2="23.0393" y2="26.0394" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <h2><?php echo e(__('Services')); ?></h2>
                                    </div>
                                    <div class="service-card-wrapper" id="inputrow_service_preview">
                                        <?php $image_count = 0; ?>
                                        <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="service-card" id="services_<?php echo e($service_row_no); ?>">
                                                <div class="service-card-inner">
                                                    <div class="service-icon testimonials_image">
                                                        <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                            src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                            alt="image">
                                                    </div>
                                                    <h5 id="<?php echo e('title_' . $service_row_no . '_preview'); ?>">
                                                        <?php echo e($content->title); ?></h5>
                                                    <p id="<?php echo e('description_' . $service_row_no . '_preview'); ?>">
                                                        <?php echo e($content->description); ?>

                                                    </p>
                                                    <?php if(!empty($content->purchase_link)): ?>
                                                        <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                            class="read-more-btn"
                                                            id="<?php echo e('link_title_' . $service_row_no . '_preview'); ?>">
                                                            <?php echo e($content->link_title); ?>

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="4"
                                                                height="6" viewBox="0 0 4 6" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M0.65976 0.662719C0.446746 0.879677 0.446746 1.23143 0.65976 1.44839L2.18316 3L0.65976 4.55161C0.446747 4.76856 0.446747 5.12032 0.65976 5.33728C0.872773 5.55424 1.21814 5.55424 1.43115 5.33728L3.34024 3.39284C3.55325 3.17588 3.55325 2.82412 3.34024 2.60716L1.43115 0.662719C1.21814 0.445761 0.872773 0.445761 0.65976 0.662719Z"
                                                                    fill="white"></path>
                                                            </svg>
                                                        </a>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <?php
                                                $image_count++;
                                                $service_row_no++;
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'product'): ?>
                            <section class="product-section common-border padding-top" id="product-div">
                                <div class="container">

                                    <div class="section-title text-center">
                                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="512.000000pt"
                                            height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                                            preserveAspectRatio="xMidYMid meet">

                                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                                fill="#000000" stroke="none">
                                                <path class="theme-svg" d="M3251 4833 c-44 -18 -1090 -628 -1111 -649 l-25 -24 0 -655 0 -655
                                            25 -24 c14 -13 268 -164 565 -336 494 -285 543 -311 580 -308 31 2 159 72 575
                                            312 294 169 545 319 558 333 l22 24 0 654 0 654 -22 25 c-25 27 -364 226 -387
                                            226 -7 0 -271 -149 -587 -331 l-574 -332 0 -218 c0 -120 -4 -229 -9 -242 -19
                                            -49 -43 -44 -189 40 l-137 79 0 269 0 269 115 66 c592 341 1026 593 1032 598
                                            7 7 -301 190 -365 217 -39 16 -44 17 -66 8z" fill="white" />
                                                <path class="theme-svg" d="M1715 2247 c-38 -13 -92 -35 -120 -49 -60 -31 -657 -377 -667 -386
                                            -6 -6 434 -797 455 -818 3 -4 22 3 42 15 20 11 50 21 66 21 17 0 306 -74 642
                                            -164 337 -90 636 -169 665 -175 104 -22 205 -9 318 40 80 35 1756 1068 1791
                                            1104 96 100 56 282 -73 331 -82 31 -228 3 -383 -75 -35 -18 -279 -158 -543
                                            -312 -537 -313 -550 -320 -633 -345 -73 -22 -250 -23 -370 -1 -140 25 -699
                                            177 -717 195 -46 47 -12 132 52 132 16 0 116 -25 222 -55 407 -115 495 -127
                                            567 -76 67 48 89 148 50 229 -31 62 -76 87 -209 117 -153 34 -304 79 -550 166
                                            -312 109 -356 121 -450 125 -70 4 -98 0 -155 -19z" fill="white" />
                                                <path class="theme-svg" d="M510 2000 c-14 -4 -88 -43 -165 -87 -161 -92 -190 -122 -182 -189 6
                                            -58 756 -1385 800 -1416 57 -41 97 -31 263 63 160 90 194 123 194 186 0 19 -9
                                            51 -19 72 -57 112 -746 1319 -764 1339 -11 12 -37 26 -56 32 -40 11 -37 11
                                            -71 0z m55 -285 c50 -49 24 -133 -46 -150 -62 -15 -123 57 -100 118 22 58 103
                                            76 146 32z" fill="white" />
                                            </g>
                                        </svg>
                                        <h2><?php echo e(__('Product')); ?></h2>
                                    </div>
                                    <div class="service-card-wrapper" id="inputrow_product_preview">
                                        <?php $pr_image_count = 0; ?>
                                        <?php $__currentLoopData = $products_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class=" service-card" id="product_<?php echo e($product_row_no); ?>">
                                                <div class="service-card-inner">
                                                    <div class="service-icon">
                                                        <img id="<?php echo e('pr_image' . $pr_image_count . '_preview'); ?>"
                                                            src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"class="img-fluid"
                                                            alt="image">
                                                    </div>
                                                    <h5 id="<?php echo e('product_title_' . $product_row_no . '_preview'); ?>">
                                                        <?php echo e($content->title); ?></h5>
                                                    <p
                                                        id="<?php echo e('product_description_' . $product_row_no . '_preview'); ?>">
                                                        <?php echo e($content->description); ?>

                                                    </p>
                                                    <div class="product-currency">
                                                        <span
                                                            id="<?php echo e('product_currency_select' . $product_row_no . '_preview'); ?>"><?php echo e($content->currency); ?></span>
                                                        <span
                                                            id="<?php echo e('product_price_' . $product_row_no . '_preview'); ?>"><?php echo e($content->price); ?></span>
                                                    </div>

                                                    <?php if(!empty($content->purchase_link)): ?>
                                                        <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                            id="<?php echo e('product_link_title_' . $product_row_no . '_preview'); ?>"
                                                            class="read-more-btn"><?php echo e($content->link_title); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php
                                                $pr_image_count++;
                                                $product_row_no++;
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'gallery'): ?>
                            <section class="gallery-section common-border padding-top" id="gallery-div">
                                <div class="container">
                                    <div class="section-title">
                                        <div class="title-svg">
                                            <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/gallery.svg')); ?>"
                                                alt="phone" class="img-fluid">
                                        </div>
                                        <h2><?php echo e(__('Gallery')); ?></h2>
                                    </div>
                                    <div class="gallery-card-wrapper" id="inputrow_gallery_preview">
                                        <?php $image_count = 0; ?>
                                        <?php if(isset($is_pdf)): ?>
                                            <div class="row gallery-cards">
                                                <?php if(!is_null($gallery_contents) && !is_null($gallery)): ?>
                                                    <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-6 col-12 p-0 gallery-card-pdf"
                                                            id="gallery_<?php echo e($gallery_row_no); ?>">
                                                            <div class="gallery-card-inner-pdf">
                                                                <div class="gallery-icon-pdf">
                                                                    <?php if(isset($gallery_content->type)): ?>
                                                                        <?php if($gallery_content->type == 'video'): ?>
                                                                            <a href="javascript:;" id=""
                                                                                tabindex="0" class="videopop">
                                                                                <video height="" controls>
                                                                                    <source class="videoresource"
                                                                                        src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                        type="video/mp4">
                                                                                </video>
                                                                            </a>
                                                                        <?php elseif($gallery_content->type == 'image'): ?>
                                                                            <a href="javascript:;" id="imagepopup"
                                                                                tabindex="0" class="imagepopup">
                                                                                <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                    alt="images"
                                                                                    class="imageresource">
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $image_count++;
                                                            $gallery_row_no++;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="gallery-slider">
                                                <?php if(!is_null($gallery_contents) && !is_null($gallery)): ?>
                                                    <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="gallery-card"
                                                            id="gallery_<?php echo e($gallery_row_no); ?>">
                                                            <div class="gallery-card-inner">
                                                                <div class="gallery-icon">
                                                                    <?php if(isset($gallery_content->type)): ?>
                                                                        <?php if($gallery_content->type == 'video'): ?>
                                                                            <a href="javascript:;" id=""
                                                                                tabindex="0" class="videopop">
                                                                                <video loop controls="true">
                                                                                    <source class="videoresource"
                                                                                        src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                        type="video/mp4">
                                                                                </video>
                                                                            </a>
                                                                        <?php elseif($gallery_content->type == 'image'): ?>
                                                                            <a href="javascript:;" id="imagepopup"
                                                                                tabindex="0" class="imagepopup">
                                                                                <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                    alt="images"
                                                                                    class="imageresource">
                                                                            </a>
                                                                        <?php elseif($gallery_content->type == 'custom_video_link'): ?>
                                                                            <?php if(str_contains($gallery_content->value, 'youtube') || str_contains($gallery_content->value, 'youtu.be')): ?>
                                                                                <?php
                                                                                    if (
                                                                                        strpos(
                                                                                            $gallery_content->value,
                                                                                            'src',
                                                                                        ) !== false
                                                                                    ) {
                                                                                        preg_match(
                                                                                            '/src="([^"]+)"/',
                                                                                            $gallery_content->value,
                                                                                            $match,
                                                                                        );
                                                                                        $url = $match[1];
                                                                                        $video_url = str_replace(
                                                                                            'https://www.youtube.com/embed/',
                                                                                            '',
                                                                                            $url,
                                                                                        );
                                                                                    } elseif (
                                                                                        strpos(
                                                                                            $gallery_content->value,
                                                                                            'src',
                                                                                        ) == false &&
                                                                                        strpos(
                                                                                            $gallery_content->value,
                                                                                            'embed',
                                                                                        ) !== false
                                                                                    ) {
                                                                                        $video_url = str_replace(
                                                                                            'https://www.youtube.com/embed/',
                                                                                            '',
                                                                                            $gallery_content->value,
                                                                                        );
                                                                                    } else {
                                                                                        $video_url = str_replace(
                                                                                            'https://youtu.be/',
                                                                                            '',
                                                                                            str_replace(
                                                                                                'https://www.youtube.com/watch?v=',
                                                                                                '',
                                                                                                $gallery_content->value,
                                                                                            ),
                                                                                        );
                                                                                        preg_match(
                                                                                            '/[\\?\\&]v=([^\\?\\&]+)/',
                                                                                            $gallery_content->value,
                                                                                            $matches,
                                                                                        );
                                                                                        if (count($matches) > 0) {
                                                                                            $videoId = $matches[1];
                                                                                            $video_url = strtok(
                                                                                                $videoId,
                                                                                                '&',
                                                                                            );
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <a href="javascript:;" id=""
                                                                                    tabindex="0" class="videopop1">
                                                                                    <video loop controls="true"
                                                                                        poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                        <source class="videoresource1"
                                                                                            src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? 'https://www.youtube.com/embed/' . $video_url : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                            type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                <a href="javascript:;" id=""
                                                                                    tabindex="0" class="videopop1">
                                                                                    <video loop controls="true"
                                                                                        poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                        <source class="videoresource1"
                                                                                            src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                            type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        <?php elseif($gallery_content->type == 'custom_image_link'): ?>
                                                                            <a href="javascript:;" id=""
                                                                                target="" tabindex="0"
                                                                                class="imagepopup1">
                                                                                <img class="imageresource1"
                                                                                    src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                    alt="images" id="upload_image">
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $image_count++;
                                                            $gallery_row_no++;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'more'): ?>
                            <section class="more-card-section common-border padding-top">
                                <div class="container">
                                    <div class="section-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                            viewBox="0 0 18 23" fill="none">
                                            <path class="theme-svg" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.81113 0.149214C1.7967 0.278601 0.297397 1.8001 0.177942 3.81514C0.0810958 5.44881 2.0758e-05 7.77846 3.98409e-09 11C-3.23723e-05 16.0256 0.197269 19.4726 0.343988 21.3412C0.403096 22.0939 1.24523 22.4739 1.8621 22.0385L8.42326 17.4071C8.76899 17.163 9.2309 17.163 9.57662 17.4071L16.1378 22.0385C16.7547 22.4739 17.5968 22.0939 17.6559 21.3412C17.8026 19.4726 17.9999 16.0256 17.9999 11C17.9999 7.77836 17.9189 5.44867 17.822 3.81499C17.7025 1.80002 16.2033 0.278611 14.1889 0.149223C12.8866 0.0655718 11.1728 0 8.99994 0C6.8272 0 5.11343 0.0655667 3.81113 0.149214Z"
                                                fill="url(#paint0_linear)" />
                                            <path class="theme-svg" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.64391 0.149214C1.62948 0.278601 0.130174 1.8001 0.010719 3.81514C0.007123 3.8758 0.003549 3.93741 0 4C1.83277 4 15.8328 4 17.6655 4C17.6619 3.93736 17.6584 3.8757 17.6548 3.81499C17.5353 1.80002 16.036 0.278611 14.0217 0.149223C12.7194 0.0655718 11.0055 0 8.83272 0C6.65998 0 4.94621 0.0655667 3.64391 0.149214Z"
                                                fill="#ADE8F4" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="8.99997" y1="0"
                                                    x2="8.99997" y2="22.2224" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <h2><?php echo e(__('More')); ?></h2>
                                    </div>
                                    <div class="more-btn">
                                        <a href="javascript:;" class="btn" tabindex="0"
                                            onclick="location.href = '<?php echo e(route('bussiness.save', $business->slug)); ?>'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.25"
                                                    d="M13 6L12.4104 5.01732C11.8306 4.05094 10.8702 3.36835 9.75227 3.22585C8.83875 3.10939 7.66937 3 6.5 3C5.68392 3 4.86784 3.05328 4.13873 3.12505C2.53169 3.28325 1.31947 4.53621 1.19597 6.14628C1.09136 7.51009 1 9.43529 1 12C1 13.8205 1.06629 15.4422 1.15059 16.7685C1.29156 18.9862 3.01613 20.6935 5.23467 20.8214C6.91963 20.9185 9.17474 21 12 21C14.8253 21 17.0804 20.9185 18.7653 20.8214C20.9839 20.6935 22.7084 18.9862 22.8494 16.7685C22.9337 15.4422 23 13.8205 23 12C23 10.9589 22.9398 9.97795 22.8611 9.14085C22.7101 7.53313 21.4669 6.2899 19.8591 6.13886C19.0221 6.06022 18.0411 6 17 6H13Z"
                                                    fill="#12131A" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13 6H1.21033C1.39381 4.46081 2.58074 3.27842 4.13877 3.12505C4.86788 3.05328 5.68396 3 6.50004 3C7.66941 3 8.83879 3.10939 9.75231 3.22585C10.8702 3.36835 11.8306 4.05094 12.4104 5.01732L13 6Z"
                                                    fill="#12131A" />
                                            </svg>
                                            <?php echo e(__('Save Card')); ?>

                                        </a>
                                        <a href="javascript:;" class="btn our-card" tabindex="0">
                                            <svg class="rtl-svg" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.25"
                                                    d="M10.8591 2.1389C12.4669 2.2899 13.6733 3.5372 13.7908 5.1477C13.9008 6.6568 14 8.882 14 12C14 15.118 13.9008 17.3432 13.7908 18.8523C13.6733 20.4628 12.4669 21.7101 10.8592 21.8611C10.0221 21.9398 9.0411 22 8 22C6.9589 22 5.9779 21.9398 5.1408 21.8611C3.5331 21.7101 2.3267 20.4628 2.2092 18.8523C2.0992 17.3432 2 15.118 2 12C2 8.882 2.0992 6.6568 2.2092 5.1477C2.3267 3.5372 3.5331 2.2899 5.1409 2.1389C5.9779 2.0602 6.9589 2 8 2C9.0411 2 10.0221 2.0602 10.8591 2.1389Z"
                                                    fill="#12131A" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16.7929 9.2071C16.4024 8.8166 16.4024 8.1834 16.7929 7.7929C17.1834 7.4024 17.8166 7.4024 18.2071 7.7929L21.7071 11.2929C22.0976 11.6834 22.0976 12.3166 21.7071 12.7071L18.2071 16.2071C17.8166 16.5976 17.1834 16.5976 16.7929 16.2071C16.4024 15.8166 16.4024 15.1834 16.7929 14.7929L18.5858 13L9 13C8.4477 13 8 12.5523 8 12C8 11.4477 8.4477 11 9 11L18.5858 11L16.7929 9.2071Z"
                                                    fill="#12131A" />
                                            </svg>
                                            <?php echo e(__('Share Card')); ?>

                                        </a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#mycontactModal"
                                            class="btn our-contact" tabindex="0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.25"
                                                    d="M22.411 18.3856L20.5061 20.2905C20.5061 20.2905 15.5564 22.4118 8.48528 15.3408C1.41421 8.26968 3.53553 3.31993 3.53553 3.31993L5.44047 1.415C6.30108 0.554384 7.72442 0.65554 8.45468 1.62922L10.273 4.05358C10.8701 4.84982 10.791 5.96401 10.0872 6.6678L8.48528 8.26968C8.48528 8.26968 8.48528 9.6839 11.3137 12.5123C14.1421 15.3408 15.5563 15.3407 15.5563 15.3407L17.1582 13.7389C17.862 13.0351 18.9762 12.9559 19.7725 13.5531L22.1968 15.3714C23.1705 16.1016 23.2716 17.5249 22.411 18.3856Z"
                                                    fill="#12131A" />
                                                <path
                                                    d="M5.44046 1.41493L4.94974 1.90565L9.19238 7.5625L10.0872 6.66772C10.7909 5.96394 10.8701 4.84975 10.2729 4.05351L8.45467 1.62914C7.72441 0.655462 6.30108 0.554309 5.44046 1.41493Z"
                                                    fill="#12131A" />
                                                <path
                                                    d="M22.4112 18.3847L21.9205 18.8755L16.2637 14.6328L17.1585 13.738C17.8622 13.0342 18.9764 12.9551 19.7727 13.5522L22.197 15.3705C23.1707 16.1008 23.2719 17.5241 22.4112 18.3847Z"
                                                    fill="#12131A" />
                                            </svg>
                                            <?php echo e(__('Contact')); ?>

                                        </a>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'testimonials'): ?>
                            <section id="testimonials-div" class="testimonials-section common-border padding-top">
                                <div class="container">
                                    <div class="section-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="23"
                                            viewBox="0 0 18 23" fill="none">
                                            <path class="theme-svg" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.81113 0.149214C1.7967 0.278601 0.297397 1.8001 0.177942 3.81514C0.0810958 5.44881 2.0758e-05 7.77846 3.98409e-09 11C-3.23723e-05 16.0256 0.197269 19.4726 0.343988 21.3412C0.403096 22.0939 1.24523 22.4739 1.8621 22.0385L8.42326 17.4071C8.76899 17.163 9.2309 17.163 9.57662 17.4071L16.1378 22.0385C16.7547 22.4739 17.5968 22.0939 17.6559 21.3412C17.8026 19.4726 17.9999 16.0256 17.9999 11C17.9999 7.77836 17.9189 5.44867 17.822 3.81499C17.7025 1.80002 16.2033 0.278611 14.1889 0.149223C12.8866 0.0655718 11.1728 0 8.99994 0C6.8272 0 5.11343 0.0655667 3.81113 0.149214Z"
                                                fill="url(#paint0_linear)" />
                                            <path class="theme-svg" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.64391 0.149214C1.62948 0.278601 0.130174 1.8001 0.010719 3.81514C0.007123 3.8758 0.003549 3.93741 0 4C1.83277 4 15.8328 4 17.6655 4C17.6619 3.93736 17.6584 3.8757 17.6548 3.81499C17.5353 1.80002 16.036 0.278611 14.0217 0.149223C12.7194 0.0655718 11.0055 0 8.83272 0C6.65998 0 4.94621 0.0655667 3.64391 0.149214Z"
                                                fill="#ADE8F4" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="8.99997" y1="0"
                                                    x2="8.99997" y2="22.2224" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <h2><?php echo e(__('Testimonials')); ?></h2>
                                    </div>
                                    <?php if(isset($is_pdf)): ?>
                                        <div class="row testimonial-pdf-row" id="inputrow_testimonials_preview">
                                            <?php
                                                $t_image_count = 0;
                                                $rating = 0;
                                            ?>
                                            <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class=" col-md-6 col-12 testimonial-itm-pdf"
                                                    id="testimonials_<?php echo e($testimonials_row_no); ?>">
                                                    <div class="testimonial-itm-inner-pdf">
                                                        <div class="testi-client-img-pdf">
                                                            <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                                src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                alt="image">
                                                        </div>
                                                        <div class="testimonial-pdf-bdy">
                                                            <h5 class="rating-number"><?php echo e($testi_content->rating); ?>/5
                                                            </h5>

                                                            <div class="rating-star">
                                                                <?php
                                                                    if (!empty($testi_content->rating)) {
                                                                        $rating = (int) $testi_content->rating;
                                                                        $overallrating = $rating;
                                                                    } else {
                                                                        $overallrating = 0;
                                                                    }
                                                                ?>
                                                                <span id="<?php echo e('stars' . $testimonials_row_no); ?>_star"
                                                                    class="star-section d-flex align-items-center justify-content-center">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <?php if($overallrating < $i): ?>
                                                                            <?php if(is_float($overallrating) && round($overallrating) == $i): ?>
                                                                                <i
                                                                                    class="star-color fas fa-star-half-alt"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa fa-star"></i>
                                                                            <?php endif; ?>
                                                                        <?php else: ?>
                                                                            <i class="star-color fas fa-star"></i>
                                                                        <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                </span>
                                                            </div>
                                                            <h6
                                                                id="<?php echo e('testimonial_name_' . $testimonials_row_no . '_preview'); ?>">
                                                                <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                            </h6>
                                                            <p
                                                                id="<?php echo e('testimonial_description_' . $testimonials_row_no . '_preview'); ?>">
                                                                <?php echo e($testi_content->description); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    $t_image_count++;
                                                    $testimonials_row_no++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="testimonial-slider" id="inputrow_testimonials_preview">
                                            <?php
                                                $t_image_count = 0;
                                                $rating = 0;
                                            ?>
                                            <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="testimonial-itm"
                                                    id="testimonials_<?php echo e($testimonials_row_no); ?>">
                                                    <div class="testimonial-itm-inner">
                                                        <div class="testi-client-img">
                                                            <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                                src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                class="img-fluid" alt="image">
                                                        </div>
                                                        <h5 class="rating-number"><span
                                                                class="<?php echo e('stars' . $testimonials_row_no); ?>"><?php echo e($testi_content->rating); ?></span>/5
                                                        </h5>
                                                        <?php
                                                            if (!empty($testi_content->rating)) {
                                                                $rating = (int) $testi_content->rating;
                                                                $overallrating = $rating;
                                                            } else {
                                                                $overallrating = 0;
                                                            }
                                                        ?>
                                                        <div id="<?php echo e('stars' . $testimonials_row_no); ?>_star"
                                                            class="rating-star star-section">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <?php if($overallrating < $i): ?>
                                                                    <?php if(is_float($overallrating) && round($overallrating) == $i): ?>
                                                                        <i class="star-color fas fa-star-half-alt"></i>
                                                                    <?php else: ?>
                                                                        <i class=" fa fa-star"></i>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <i class="star-color fas fa-star"></i>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <h6
                                                            id="<?php echo e('testimonial_name_' . $testimonials_row_no . '_preview'); ?>">
                                                            <?php echo e(isset($testi_content->name) ? $testi_content->name : ''); ?>

                                                        </h6>
                                                        <p
                                                            id="<?php echo e('testimonial_description_' . $testimonials_row_no . '_preview'); ?>">
                                                            <?php echo e($testi_content->description); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                                <?php
                                                    $t_image_count++;
                                                    $testimonials_row_no++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'social'): ?>
                            <section id="social-div" class="social-icons-section common-border padding-top">
                                <div class="container">
                                    <div class="section-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="20"
                                            viewBox="0 0 28 20" fill="none">
                                            <path class="theme-svg"
                                                d="M0 2.5C0 1.11929 1.13964 0 2.54545 0H5.09091C6.49672 0 7.63636 1.11929 7.63636 2.5V5C7.63636 6.38071 6.49672 7.5 5.09091 7.5H2.54545C1.13964 7.5 0 6.38071 0 5V2.5Z"
                                                fill="url(#paint0_linear)" />
                                            <path class="theme-svg"
                                                d="M0 15C0 13.6193 1.13964 12.5 2.54545 12.5H5.09091C6.49672 12.5 7.63636 13.6193 7.63636 15V17.5C7.63636 18.8807 6.49672 20 5.09091 20H2.54545C1.13964 20 0 18.8807 0 17.5V15Z"
                                                fill="url(#paint1_linear)" />
                                            <path class="theme-svg"
                                                d="M22.9091 6.25C21.5033 6.25 20.3636 7.36929 20.3636 8.75V11.25C20.3636 12.6307 21.5033 13.75 22.9091 13.75H25.4545C26.8604 13.75 28 12.6307 28 11.25V8.75C28 7.36929 26.8604 6.25 25.4545 6.25H22.9091Z"
                                                fill="url(#paint2_linear)" />
                                            <path class="theme-svg"
                                                d="M8 4.5H11.6C12.2627 4.5 12.8 5.05964 12.8 5.75V13.25C12.8 13.9404 12.2627 14.5 11.6 14.5H8V17H11.6C13.5882 17 15.2 15.3211 15.2 13.25V10.75H20V8.25H15.2V5.75C15.2 3.67893 13.5882 2 11.6 2H8V4.5Z"
                                                fill="url(#paint3_linear)" />
                                            <defs>
                                                <linearGradient id="paint0_linear" x1="14" y1="0"
                                                    x2="14" y2="20" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                                <linearGradient id="paint1_linear" x1="14" y1="0"
                                                    x2="14" y2="20" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                                <linearGradient id="paint2_linear" x1="14" y1="0"
                                                    x2="14" y2="20" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                                <linearGradient id="paint3_linear" x1="14" y1="2"
                                                    x2="14" y2="17" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#ADE8F4" />
                                                    <stop offset="1" stop-color="#46B7CE" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <h2><?php echo e(__('Social')); ?></h2>
                                    </div>
                                    <ul class="social-icon-wrapper" id="inputrow_socials_preview">
                                        <?php if(!is_null($social_content) && !is_null($sociallinks)): ?>
                                            <?php $__currentLoopData = $social_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key => $social_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $social_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key1 => $social_val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($social_key1 != 'id'): ?>
                                                        <li class="socials_<?php echo e($loop->parent->index + 1); ?> social-image-icon"
                                                            id="socials_<?php echo e($loop->parent->index + 1); ?>">
                                                            <?php if($social_key1 == 'Whatsapp'): ?>
                                                            <?php
                                                            $social_links = 'https://wa.me/' . $social_val1;
                                                        ?>
                                                            <?php else: ?>
                                                                <?php
                                                                    $social_links = url($social_val1);
                                                                ?>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e($social_links); ?>"
                                                                class="social_link_<?php echo e($loop->parent->index + 1); ?>_href_preview"
                                                                id="social_link_<?php echo e($loop->parent->index + 1); ?>_href_preview'}}"
                                                                target="_blank">

                                                                <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/social/' . strtolower($social_key1) . '.svg')); ?>"
                                                                    alt="<?php echo e($social_key1); ?>"
                                                                    class="img-fluid hover-hide">
                                                                <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/social_white/' . strtolower($social_key1) . '.svg')); ?>"
                                                                    alt="<?php echo e($social_key1); ?>"
                                                                    class="img-fluid hover-show">
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>



                                    </ul>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($order_key == 'custom_html'): ?>
                            <div id="<?php echo e($stringid . '_chtml'); ?>_preview" class="custom_html_text">
                                <?php echo stripslashes($custom_html); ?>

                            </div>
                        <?php endif; ?>
                        <?php if($order_key == 'payment'): ?>
                            <section class="card-payment-section" id="payment-section">
                                <div class="section-title text-center">
                                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="512.000000pt"
                                        height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                                        preserveAspectRatio="xMidYMid meet">

                                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                            class="theme-svg" stroke="none">
                                            <path d="M445 4308 c-27 -5 -86 -27 -131 -48 -111 -54 -200 -142 -253 -253
                                                        -51 -106 -61 -165 -61 -368 0 -139 3 -170 16 -183 14 -14 259 -16 2544 -16
                                                            2285 0 2530 2 2544 16 13 13 16 44 16 183 0 203 -10 262 -61 368 -73 152 -230
                                            273 -393 302 -77 14 -4147 13 -4221 -1z" />
                                            <path d="M16 3104 c-14 -14 -16 -109 -16 -903 0 -586 4 -907 11 -947 18 -99
                                                79 -213 156 -289 76 -76 190 -137 287 -154 83 -15 4129 -15 4212 0 99 18 213
                                                79 289 156 76 76 137 190 154 287 7 40 11 361 11 947 0 794 -2 889 -16 903
                                                -14 14 -259 16 -2544 16 -2285 0 -2530 -2 -2544 -16z m1190 -1050 c64 -47 69
                                                -63 69 -214 0 -124 -2 -141 -21 -166 -47 -64 -63 -69 -214 -69 -124 0 -141 2
                                                -166 21 -60 44 -69 66 -72 186 -5 135 1 168 35 209 44 52 73 59 215 57 110 -3
                                                130 -6 154 -24z" class="theme-svg" opacity="0.4" />
                                        </g>
                                    </svg>
                                    <h2 class=""><?php echo e(__('Payment')); ?></h2>
                                </div>
                                <?php if(!is_null($cardPayment_content) && !is_null($cardPayment) && !empty($cardPayment_content)): ?>
                                    <div
                                        class="payment-list <?php echo e($cardPayment->payment_status == 'Paid' ? 'disablePayment' : ''); ?>">
                                        <?php if(!is_null($cardPayment_content) && !is_null($cardPayment)): ?>
                                            <?php if(is_object($cardPayment_content) &&
                                                    isset($cardPayment_content->stripe) &&
                                                    $cardPayment_content->stripe->status == 'on'): ?>
                                                <div class="payment-div">
                                                    <a href="<?php echo e(route('card.pay.with.stripe', $business->id)); ?>">
                                                        <img src="<?php echo e(asset('custom/img/payments/stripe.png')); ?>"
                                                            alt="social" class="img-fluid">
                                                        <?php echo e(__('Stripe')); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(is_object($cardPayment_content) &&
                                                    isset($cardPayment_content->paypal) &&
                                                    $cardPayment_content->paypal->status == 'on'): ?>
                                                <div class="payment-div">
                                                    <a href="<?php echo e(route('card.pay.with.paypal', $business->id)); ?>">
                                                        <img src="<?php echo e(asset('custom/img/payments/paypal.png')); ?>"
                                                            alt="social" class="img-fluid">
                                                        <?php echo e(__('Paypal')); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </section>
                        <?php endif; ?>
                        <?php if(!isset($is_pdf)): ?>
                            <?php if($order_key == 'google_map'): ?>
                                <section class="google-map-section" id="google-map-div">
                                    <div class="google-map">
                                        <input type="hidden" id="mapLink"
                                            value="<?php echo e($business->google_map_link); ?>">
                                        <div id="mapContainer">
                                        </div>
                                    </div>
                                </section>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($order_key == 'appinfo'): ?>
                            <section class="card-payment-section" id="app-section">
                                <div class="section-title text-center">
                                    <img src="<?php echo e(asset('custom/theme13/icon/' . $color . '/mobile-app.svg')); ?>"
                                        alt="user" class="img-fluid">
                                    <h2 class=""><?php echo e(__('Download Here')); ?></h2>
                                </div>
                                <?php if(!is_null($appInfo)): ?>
                                    <div class="app-list">
                                        <div class="app-info-div">
                                            <a href="<?php echo e($appInfo->playstore_id); ?>" target="_blank">
                                                <img src="<?php echo e(asset('custom/icon/apps/playstore' . $appInfo->variant . '.png')); ?>"
                                                    alt="social" class="img-fluid">
                                            </a>
                                            <a href="<?php echo e($appInfo->appstore_id); ?>"  target="_blank">
                                                <img src="<?php echo e(asset('custom/icon/apps/appstore' . $appInfo->variant . '.png')); ?>"
                                                    alt="social" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </section>
                        <?php endif; ?>
                        <?php

                            $j = $j + 1;
                        ?>
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($plan->enable_branding == 'on'): ?>
                    <?php if($is_branding_enabled): ?>
                        <div id="is_branding_enabled" class="is_branding_enable copyright mt-3 pb-2">
                            <p id="<?php echo e($stringid . '_branding'); ?>_preview" class="branding_text">
                                <?php echo e($business->branding_text); ?></p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <!--appointment popup start here-->
            <div class="appointment-popup">
                <div class="container">
                    <form class="appointment-form-wrapper">
                        <div class="section-title">
                            <h5><?php echo e(__('Make Appointment')); ?></h5>
                            <div class="close-search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M14.6 17.4L0.600001 3.4C-0.2 2.6 -0.2 1.4 0.600001 0.600001C1.4 -0.2 2.6 -0.2 3.4 0.600001L17.4 14.6C18.2 15.4 18.2 16.6 17.4 17.4C16.6 18.2 15.4 18.2 14.6 17.4V17.4Z"
                                        fill="#000" />
                                    <path
                                        d="M0.600001 14.6L14.6 0.600001C15.4 -0.2 16.6 -0.2 17.4 0.600001C18.2 1.4 18.2 2.6 17.4 3.4L3.4 17.4C2.6 18.2 1.4 18.2 0.600001 17.4C-0.2 16.6 -0.2 15.4 0.600001 14.6V14.6Z"
                                        fill="#000" />
                                </svg>
                            </div>
                        </div>
                        <div class="row appo-form-details">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Name:')); ?> </label>
                                    <input type="text" class="form-control app_name"
                                        placeholder="<?php echo e(__('Enter your name')); ?>">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-name"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Email:')); ?> </label>
                                    <input type="email" class="form-control app_email"
                                        placeholder="<?php echo e(__('Enter your email')); ?>">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-email"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Phone:')); ?> </label>
                                    <input type="number" class="form-control app_phone"
                                        placeholder="<?php echo e(__('Enter your phone no.')); ?>">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-phone"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn-group">
                            <button type="button" name="CLOSE" class="close-btn btn">
                                <?php echo e(__('Close')); ?>

                            </button>
                            <button type="button" name="SUBMIT" class="btn btn-secondary" id="makeappointment">
                                <?php echo e(__('Make Appointment')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--appointment popup end here-->
            <!--card popup start here-->
            <div class="card-popup">
                <div class="container">
                    <div class="share-card-wrapper">
                        <div class="section-title">
                            <div class="close-search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="9"
                                    viewBox="0 0 7 9" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.84542 0.409757C6.21819 0.789434 6.21819 1.40501 5.84542 1.78469L3.17948 4.5L5.84542 7.21531C6.21819 7.59499 6.21819 8.21057 5.84542 8.59024C5.47265 8.96992 4.86826 8.96992 4.49549 8.59024L1.15458 5.18746C0.781807 4.80779 0.781807 4.19221 1.15458 3.81254L4.49549 0.409757C4.86826 0.0300809 5.47265 0.0300809 5.84542 0.409757Z"
                                        fill="#12131A" />
                                </svg>
                            </div>
                            <div class="section-title-center">
                                <h5><?php echo e(__('Share This Card')); ?></h5>
                            </div>
                            <button type="button" name="LOGOUT" class="logout-btn">

                            </button>
                        </div>
                        <div class="qr-scaner-wrapper">
                            <div class="qr-image shareqrcode">
                            </div>
                            <div class="qr-code-text">
                                <p> <?php echo e(__('Point your camera at the QR code, or visit')); ?> <span
                                        class="qr-link text-center mr-2 text-wrap"></span><br><?php echo e(__('
                                                                                                                                                                                                                                                                                                                                                                                                                                        Or check my social channels')); ?>

                                </p>
                            </div>
                            <ul class="card-social-icons">
                                <li>
                                    <a href="https://twitter.com/share?url=<?php echo e(urlencode($url_link)); ?>&text=">
                                        <svg width="24" height="24" viewBox="0 0 682 682" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.25"
                                                d="M308.826 2.95819L308.821 2.95862C202.611 13.978 109.557 71.724 53.0033 161.731L51.9077 161.043L53.0032 161.732C-27.1728 289.296 -12.0346 458.686 89.3705 568.984C145.799 630.325 215.615 666.83 299.545 678.782L299.545 678.782C307.357 679.898 324.32 680.433 341.464 680.4C358.603 680.367 375.708 679.765 383.795 678.647C466.386 667.228 536.201 630.859 592.497 569.783L592.498 569.782C638.809 519.623 668.422 455.377 678.782 383.12L678.782 383.119C679.898 375.374 680.467 358.41 680.467 341.333C680.467 324.256 679.898 307.292 678.782 299.547L678.781 299.544C670.944 244.286 653.42 197.433 624.35 153.629L624.346 153.624C612.139 135.047 599.804 119.924 582.535 102.523L582.533 102.521C529.565 48.8887 463.997 15.837 388.448 4.6839C380.348 3.49878 364.498 2.63287 348.584 2.2829C332.666 1.93292 316.853 2.10278 308.826 2.95819ZM313.502 212.883L313.504 212.885C327.302 233.016 339.934 251.314 349.165 264.594C353.781 271.234 357.545 276.618 360.179 280.349C361.497 282.216 362.529 283.664 363.243 284.648C363.279 284.698 363.315 284.747 363.349 284.795C363.407 284.733 363.466 284.668 363.528 284.601C364.409 283.644 365.691 282.22 367.333 280.372C370.616 276.679 375.321 271.321 381.103 264.697C392.667 251.45 408.532 233.152 425.932 213.019L488.996 139.689L489.431 139.183L490.098 139.167L507.165 138.767L507.172 138.767L507.18 138.767C512.19 138.7 516.428 138.733 519.394 138.885C520.865 138.961 522.08 139.069 522.933 139.221C523.338 139.294 523.779 139.396 524.142 139.564C524.312 139.643 524.614 139.803 524.861 140.105C525.162 140.471 525.351 141.027 525.172 141.624C525.127 141.779 525.07 141.89 525.052 141.926L525.05 141.929C525.013 142.001 524.975 142.065 524.945 142.112C524.923 142.147 524.899 142.183 524.875 142.22C524.832 142.284 524.785 142.35 524.739 142.415C524.589 142.622 524.383 142.892 524.131 143.211C523.624 143.855 522.892 144.754 521.966 145.873C520.112 148.114 517.452 151.27 514.193 155.105C507.673 162.775 498.737 173.178 489.004 184.445C480.079 194.836 468.41 208.421 456.435 222.362C442.287 238.831 427.714 255.796 416.738 268.577L416.736 268.58L380.557 310.505L450.703 412.751C489.647 469.432 525.363 521.408 530.151 528.057L530.16 528.07L530.169 528.083L538.702 540.483L540.32 542.833H537.467H478.933H420.4H419.61L419.163 542.182L366.097 464.849C366.097 464.849 366.096 464.849 366.096 464.849C351.498 443.584 338.134 424.254 328.37 410.258C323.487 403.26 319.507 397.598 316.725 393.696C315.332 391.744 314.244 390.239 313.494 389.229C313.451 389.171 313.41 389.115 313.369 389.061C313.279 389.161 313.182 389.267 313.081 389.379C312.155 390.402 310.808 391.915 309.085 393.869C305.641 397.775 300.707 403.426 294.649 410.4C282.535 424.348 265.937 443.579 247.805 464.71L247.804 464.711L181.671 541.645L181.235 542.151L180.567 542.166L162.967 542.566L145.367 542.966L142.001 543.043L144.196 540.489L220.729 451.422L220.73 451.422L296.505 363.369L292.912 358.205C287.879 351.332 150.084 150.564 146.077 144.419L146.07 144.409L146.064 144.399L143.797 140.799L142.342 138.488L145.073 138.5L203.473 138.767L203.477 138.767L262.01 139.167L262.792 139.172L263.236 139.816L313.502 212.883Z"
                                                fill="black" stroke="white" stroke-width="3" />
                                            <path
                                                d="M315.762 340.74L315.763 340.741L437.723 515.179L463.081 515.567C463.082 515.567 463.084 515.567 463.085 515.567C470.273 515.633 476.82 515.6 481.563 515.484C483.756 515.43 485.548 515.359 486.833 515.274C486.493 514.766 486.084 514.159 485.607 513.455C483.981 511.058 481.581 507.56 478.49 503.079C472.309 494.117 463.368 481.231 452.335 465.373C430.27 433.658 399.837 390.059 366.371 342.193L245.077 168.822L218.918 168.433L218.911 168.433L195.034 168.196L315.762 340.74Z"
                                                fill="black" stroke="black" stroke-width="3" />
                                        </svg>
                                    </a>
                                </li>
                                <li>

                                    <?php
                                        $whatsapp_link = url('https://wa.me/?text=' . urlencode($url_link));
                                    ?>
                                    <a href="<?php echo e($whatsapp_link); ?>">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 0C4.5 0 0 4.5 0 10C0 11.8 0.500781 13.5 1.30078 15L0 20L5.19922 18.8008C6.69922 19.6008 8.3 20 10 20C15.5 20 20 15.5 20 10C20 7.3 18.9996 4.80039 17.0996 2.90039C15.1996 1.00039 12.7 0 10 0ZM10 2C12.1 2 14.0992 2.80078 15.6992 4.30078C17.1992 5.90078 18 7.9 18 10C18 14.4 14.4 18 10 18C8.7 18 7.29922 17.7 6.19922 17L5.5 16.5996L4.80078 16.8008L2.80078 17.3008L3.30078 15.5L3.5 14.6992L3.09961 14C2.39961 12.8 2 11.4 2 10C2 5.6 5.6 2 10 2ZM6.5 5.40039C6.3 5.40039 6.00078 5.39922 5.80078 5.69922C5.50078 5.99922 4.90039 6.60078 4.90039 7.80078C4.90039 9.00078 5.80039 10.2004 5.90039 10.4004C6.10039 10.6004 7.69922 13.1992 10.1992 14.1992C12.2992 14.9992 12.6992 14.8008 13.1992 14.8008C13.6992 14.7008 14.7004 14.1996 14.9004 13.5996C15.1004 12.9996 15.0992 12.4992 15.1992 12.1992C15.0992 12.0992 14.9992 12.0004 14.6992 11.9004C14.4992 11.8004 13.3 11.1996 13 11.0996C12.7 10.9996 12.6004 10.8992 12.4004 11.1992C12.2004 11.4992 11.6996 11.9992 11.5996 12.1992C11.4996 12.3992 11.3996 12.4008 11.0996 12.3008C10.8996 12.2008 10.0996 11.9996 9.09961 11.0996C8.29961 10.4996 7.79922 9.70039 7.69922 9.40039C7.49922 9.20039 7.70078 9.00039 7.80078 8.90039L8.19922 8.5C8.29922 8.4 8.30039 8.19961 8.40039 8.09961C8.50039 7.99961 8.50039 7.89922 8.40039 7.69922C8.30039 7.49922 7.79961 6.30078 7.59961 5.80078C7.39961 5.40078 7.2 5.40039 7 5.40039H6.5Z"
                                                fill="black" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/sharer.php?u=<?php echo e(urlencode($url_link)); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <circle opacity="0.25" cx="12" cy="12" r="10"
                                                fill="#12131A"></circle>
                                            <path
                                                d="M11.5002 21.9877C11.776 22.0013 12 21.7761 12 21.5V14H14C14.5523 14 15 13.5523 15 13C15 12.4477 14.5523 12 14 12H12V10C12 9.44772 12.4477 9 13 9H14C14.5523 9 15 8.55229 15 8C15 7.44772 14.5523 7 14 7H13C11.3431 7 10 8.34315 10 10V12H9C8.44772 12 8 12.4477 8 13C8 13.5523 8.44771 14 9 14H10V21.3913C10 21.6291 10.1673 21.8353 10.4021 21.873C10.7621 21.9308 11.1285 21.9694 11.5002 21.9877Z"
                                                fill="#12131A"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="https://www.linkedin.com/shareArticle?url=<?php echo e(urlencode($url_link)); ?>&title=">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.25"
                                                d="M0 3C0 1.34315 1.34315 0 3 0H17C18.6569 0 20 1.34315 20 3V17C20 18.6569 18.6569 20 17 20H3C1.34315 20 0 18.6569 0 17V3Z"
                                                fill="#12131A" />
                                            <path
                                                d="M5 6C5.55228 6 6 5.55228 6 5C6 4.44772 5.55228 4 5 4C4.44772 4 4 4.44772 4 5C4 5.55228 4.44772 6 5 6Z"
                                                fill="#12131A" />
                                            <path
                                                d="M5 8C4.44772 8 4 8.44772 4 9V15C4 15.5523 4.44772 16 5 16C5.55228 16 6 15.5523 6 15V9C6 8.44772 5.55228 8 5 8Z"
                                                fill="#12131A" />
                                            <path
                                                d="M12 10C10.8954 10 10 10.8954 10 12V15C10 15.5523 9.55229 16 9 16C8.44771 16 8 15.5523 8 15V9C8 8.44772 8.44772 8 9 8C9.40537 8 9.7544 8.2412 9.91141 8.58791C10.5193 8.215 11.2346 8 12 8C14.2091 8 16 9.79086 16 12V15C16 15.5523 15.5523 16 15 16C14.4477 16 14 15.5523 14 15V12C14 10.8954 13.1046 10 12 10Z"
                                                fill="#12131A" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
            <!--contact popup start here-->
            <div class="contact-popup">
                <div class="container">
                    <form class="appointment-form-wrapper contact-form-wrapper">
                        <div class="section-title">
                            <h5><?php echo e(__('Make Contact')); ?></h5>
                            <div class="close-search" data-dismiss="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M14.6 17.4L0.600001 3.4C-0.2 2.6 -0.2 1.4 0.600001 0.600001C1.4 -0.2 2.6 -0.2 3.4 0.600001L17.4 14.6C18.2 15.4 18.2 16.6 17.4 17.4C16.6 18.2 15.4 18.2 14.6 17.4V17.4Z"
                                        fill="#000" />
                                    <path
                                        d="M0.600001 14.6L14.6 0.600001C15.4 -0.2 16.6 -0.2 17.4 0.600001C18.2 1.4 18.2 2.6 17.4 3.4L3.4 17.4C2.6 18.2 1.4 18.2 0.600001 17.4C-0.2 16.6 -0.2 15.4 0.600001 14.6V14.6Z"
                                        fill="#000" />
                                </svg>
                            </div>
                        </div>
                        <div class="row appo-form-details">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Name')); ?>:</label>
                                    <input type="text" name="name" placeholder="<?php echo e(__('Enter your name')); ?>"
                                        class="form-control contact_name">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-contactname"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Email')); ?>:</label>
                                    <input type="email" name="email" placeholder="<?php echo e(__('Enter your email')); ?>"
                                        class="form-control contact_email">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-contactemail"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Phone')); ?>:</label>
                                    <input type="text" name="phone"
                                        placeholder="<?php echo e(__('Enter your phone no.')); ?>"
                                        class="form-control contact_phone">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-contactphone"></span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="business_id" value="<?php echo e($business->id); ?>">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Message')); ?>:</label>
                                    <textarea name="message" placeholder="<?php echo e(__('Enter your Message.')); ?>"
                                        class="custom_size contact_message  emojiarea" row="3"></textarea>
                                    <div class="">
                                        <span class="text-danger h5 span-error-contactmessage"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn-group">
                            <button type="button" class="close-btn btn "
                                data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="button" class="btn btn-secondary"
                                id="makecontact"><?php echo e(__('Make Contact')); ?></button>


                        </div>
                    </form>
                </div>
            </div>
            <!--contact popup end here-->
            <!--card popup end here-->
            <div class="password-popup" id="passwordmodel" role="dialog" data-backdrop="static"
                data-keyboard="false">
                <div class="container">
                    <form class="appointment-form-wrapper contact-form-wrapper">
                        <div class="section-title">
                            <h5><?php echo e(__('Enter Password')); ?></h5>
                        </div>
                        <div class="row appo-form-details">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Password')); ?>:</label>
                                    <input type="password" name="Password" placeholder="<?php echo e(__('Enter password')); ?>"
                                        class="form-control password_val" placeholder="Password">
                                    <div class="">
                                        <span class="text-danger  h5 span-error-password"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn-group">
                            <button type="button"
                                class="btn form-btn--submit password-submit"><?php echo e(__('Submit')); ?></button>


                        </div>
                    </form>
                </div>
            </div>

            
            <div class="password-popup" id="gallerymodel" role="dialog" data-backdrop="static"
                data-keyboard="false">
                <div class="container">
                    <form class="appointment-form-wrapper contact-form-wrapper">
                        <div class="section-title">
                            <h5><?php echo e(__('')); ?></h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Image preview')); ?>:</label>
                                    <img src="" class="imagepreview" style="width: 500px; height: 300px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-btn-group">
                            <button type="button" class="btn btn-default close-btn close-model"
                                data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="password-popup" id="videomodel" role="dialog" data-backdrop="static"
                data-keyboard="false">
                <div class="container">
                    <form class="appointment-form-wrapper contact-form-wrapper">
                        <div class="section-title">
                            <h5><?php echo e(__('')); ?></h5>
                        </div>
                        <div class="row ">
                            <div class="col-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Video preview')); ?>:</label>

                                    <iframe width="100%" height="360" class="videopreview" src=""
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn-group">
                            <button type="button" class="btn btn-default close-btn close-model1"
                                data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overlay"></div>
            <img src="<?php echo e(isset($qr_detail->image) ? $qr_path . '/' . $qr_detail->image : ''); ?>" id="image-buffers" crossorigin="anonymous"
                style="display: none">
        </div>
    </div>
    <div id="previewImage"> </div>
    <a id="download" href="#" class="font-lg download mr-3 text-white">
        <i class="fas fa-download"></i>
    </a>

    <!---wrapper end here-->
    <!--scripts start here-->


    <script src="<?php echo e(asset('custom/theme13/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/theme13/js/slick.min.js')); ?>" defer="defer"></script>
    <?php if($SITE_RTL == 'on'): ?>
        <script src="<?php echo e(asset('custom/theme13/js/rtl-custom.js')); ?>" defer="defer"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('custom/theme13/js/custom.js')); ?>" defer="defer"></script>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.date.js"></script>


    <script src="<?php echo e(asset('custom/js/emojionearea.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/socialSharing.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/socialSharing.min.js')); ?>"></script>

    <script src="<?php echo e(asset('custom/js/jquery.qrcode.min.js')); ?>"></script>

    <?php if($business->enable_pwa_business == 'on' && $plan->pwa_business == 'on'): ?>
        <script type="text/javascript">
            const container = document.querySelector("body")

            const coffees = [];

            if ("serviceWorker" in navigator) {
                window.addEventListener("load", function() {
                    navigator.serviceWorker
                        .register("<?php echo e(asset('serviceWorker.js')); ?>")
                        .then(res => console.log("service worker registered"))
                        .catch(err => console.log("service worker not registered", err))

                })
            }
        </script>
    <?php endif; ?>


    <script type="text/javascript">
        $('#Demo').socialSharingPlugin({
            urlShare: window.location.href,
            description: $('meta[name=description]').attr('content'),
            title: $('title').text()
        })


        $(document).ready(function() {
            $(".emojiarea").emojioneArea();
            $(`.span-error-date`).text("");
            $(`.span-error-time`).text("");
            $(`.span-error-name`).text("");
            $(`.span-error-email`).text("");
            var slug = '<?php echo e($business->slug); ?>';
            var url_link = `<?php echo e(url('/')); ?>/${slug}`;
            $(`.qr-link`).text(url_link);


            var foreground_color =
                `<?php echo e(isset($qr_detail->foreground_color) ? $qr_detail->foreground_color : '#000000'); ?>`;
            var background_color =
                `<?php echo e(isset($qr_detail->background_color) ? $qr_detail->background_color : '#ffffff'); ?>`;
            var radius = `<?php echo e(isset($qr_detail->radius) ? $qr_detail->radius : 26); ?>`;
            var qr_type = `<?php echo e(isset($qr_detail->qr_type) ? $qr_detail->qr_type : 0); ?>`;
            var qr_font = `<?php echo e(isset($qr_detail->qr_text) ? $qr_detail->qr_text : 'vCard'); ?>`;
            var qr_font_color =
                `<?php echo e(isset($qr_detail->qr_text_color) ? $qr_detail->qr_text_color : '#f50a0a'); ?>`;
            var size = `<?php echo e(isset($qr_detail->size) ? $qr_detail->size : 9); ?>`;

            $('.shareqrcode').empty().qrcode({
                render: 'image',
                size: 500,
                ecLevel: 'H',
                minVersion: 3,
                quiet: 1,
                text: url_link,
                fill: foreground_color,
                background: background_color,
                radius: .01 * parseInt(radius, 10),
                mode: parseInt(qr_type, 10),
                label: qr_font,
                fontcolor: qr_font_color,
                image: $("#image-buffers")[0],
                mSize: .01 * parseInt(size, 10)
            });
        });
    </script>
    <script>
        $(".imagepopup").on("click", function(e) {
            var imgsrc = $(this).children(".imageresource").attr("src");
            $('.imagepreview').attr('src',
                imgsrc); // here asign the image to the modal when the user click the enlarge link
            $("#gallerymodel").addClass("active");
            $("body").toggleClass("no-scroll");
            $('html').addClass('modal-open');
            $('#gallerymodel').css("background", 'rgb(0 0 0 / 50%)')
        });

        $(".imagepopup1").on("click", function() {
            var imgsrc1 = $(this).children(".imageresource1").attr("src");
            $('.imagepreview').attr('src',
                imgsrc1); // here asign the image to the modal when the user click the enlarge link
            $("#gallerymodel").addClass("active");
            $("body").toggleClass("no-scroll");
            $('html').addClass('modal-open');
            $('#gallerymodel').css("background", 'rgb(0 0 0 / 50%)')
        });

        $(".videopop").on("click", function() {
            var videosrc = $(this).children('video').children(".videoresource").attr("src");
            $('.videopreview').attr('src',
                videosrc); // here asign the image to the modal when the user click the enlarge link
            $("#videomodel").addClass("active");
            $("body").toggleClass("no-scroll");
            $('html').addClass('modal-open');
            $('#videomodel').css("background",
                'rgb(0 0 0 / 50%)'
            ) // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });

        $(".videopop1").on("click", function() {
            var videosrc1 = $(this).children('video').children(".videoresource1").attr("src");
            $('.videopreview').attr('src',
                videosrc1); // here asign the image to the modal when the user click the enlarge link
            $("#videomodel").addClass("active");
            $("body").toggleClass("no-scroll");
            $('html').addClass('modal-open');
            $('#videomodel').css("background",
                'rgb(0 0 0 / 50%)'
            ) // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });

        $(".close-model").on("click", function() {
            $("#gallerymodel").removeClass("active");
            $("body").removeClass("no-scroll");
            $('html').removeClass('modal-open');
            $('#gallerymodel').css("background", '')
        });

        $(".close-model1").on("click", function() {
            $("#videomodel").removeClass("active");
            $("body").removeClass("no-scroll");
            $('html').removeClass('modal-open');
            $('#videomodel').css("background", '')
        });

        $(document).ready(function() {
            var date = new Date();
            $('.datepicker_min').pickadate({
                min: date,
            })
        });

        //Password Check
        <?php if(!Auth::check()): ?>
            let ispassword;
            var ispassenable = '<?php echo e($business->enable_password); ?>';
            var business_password = '<?php echo e($business->password); ?>';

            if (ispassenable == 'on') {
                $('.password-submit').click(function() {

                    ispassword = 'true';
                    passwordpopup('true');
                });

                function passwordpopup(type) {
                    if (type == 'false') {

                        $("#passwordmodel").addClass("active");
                        $("body").toggleClass("no-scroll");
                        $('html').addClass('modal-open');
                        $('#passwordmodel').css("background", 'rgb(0 0 0 / 50%)')
                    } else {

                        var password_val = $('.password_val').val();

                        if (password_val == business_password) {
                            $("#passwordmodel").removeClass("active");
                            $("body").removeClass("no-scroll");
                            $('html').removeClass('modal-open');
                            $('#passwordmodel').css("background", '')
                        } else {

                            $(`.span-error-password`).text("<?php echo e(__('*Please enter correct password')); ?>");
                            passwordpopup('false');

                        }
                    }
                }
                if (ispassword == undefined) {

                    passwordpopup('false');
                }
            }
        <?php endif; ?>


        $(`.rating_preview`).attr('id');
        var from_$input = $('#input_from').pickadate(),
            from_picker = from_$input.pickadate('picker')

        var to_$input = $('#input_to').pickadate(),
            to_picker = to_$input.pickadate('picker')

        var is_enabled = "<?php echo e($is_enable); ?>";
        if (is_enabled) {
            $('#business-hours-div').show();
        } else {
            $('#business-hours-div').hide();
        }

        var is_contact_enable = "<?php echo e($is_contact_enable); ?>";
        if (is_contact_enable) {
            $('#contact-div').show();
        } else {
            $('#contact-div').hide();
        }
        var is_enable_appoinment = "<?php echo e($is_enable_appoinment); ?>";
        if (is_enable_appoinment) {
            $('#appointment-div').show();
        } else {
            $('#appointment-div').hide();
        }

        var is_enable_service = "<?php echo e($is_enable_service); ?>";
        if (is_enable_service) {
            $('#services-div').show();
        } else {
            $('#services-div').hide();
        }
        var is_enable_product = "<?php echo e($is_enable_product); ?>";
        if (is_enable_product) {
            $('#product-div').show();
        } else {
            $('#product-div').hide();
        }
        var is_enable_testimonials = "<?php echo e($is_enable_testimonials); ?>";
        if (is_enable_testimonials) {
            $('#testimonials-div').show();
        } else {
            $('#testimonials-div').hide();
        }

        var is_enable_sociallinks = "<?php echo e($is_enable_sociallinks); ?>";
        if (is_enable_sociallinks) {
            $('#social-div').show();
        } else {
            $('#social-div').hide();
        }

        var is_custom_html_enable = "<?php echo e($is_custom_html_enable); ?>";
        if (is_custom_html_enable) {
            $('.custom_html_text').show();
        } else {
            $('.custom_html_text').hide();
        }

        var is_branding_enable = "<?php echo e($is_branding_enabled); ?>";
        if (is_branding_enable) {
            $('.branding_text').show();
        } else {
            $('.branding_text').hide();
        }

        var is_enable_gallery = "<?php echo e($is_enable_gallery); ?>";
        if (is_enable_gallery) {
            $('#gallery-div').show();
        } else {
            $('#gallery-div').hide();
        }
        var is_payment = "<?php echo e($is_payment); ?>";
        if (is_payment) {
            $('#payment-section').show();
        } else {
            $('#payment-section').hide();
        }
        var is_appinfo = "<?php echo e($is_appinfo); ?>";
        if (is_appinfo) {
            $('#app-section').show();
        } else {
            $('#app-section').hide();
        }
        var is_google_map_enabled = "<?php echo e($is_google_map_enabled); ?>";
        if (is_google_map_enabled) {
            $('#google-map-div').show();
        } else {
            $('#google-map-div').hide();
        }

        $(`#makeappointment`).click(function() {
            $(`.span-error-date`).text("");
            $(`.span-error-time`).text("");
            $(`.span-error-name`).text("");
            $(`.span-error-email`).text("");

            var name = $(`.app_name`).val();
            var email = $(`.app_email`).val();
            var date = $(`.datepicker_min`).val();
            var phone = $(`.app_phone`).val();
            var time = $(".app_time").data('id');
            var business_id = '<?php echo e($business->id); ?>';
            var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneFormat = /^([0-9\s\-\+\(\)]*)$/;

            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }
            if (date == "") {
                $(`.span-error-date`).text("<?php echo e(__('*Please choose date')); ?>");
                $("[data-dismiss=modal]").trigger({
                    type: "click"
                });
            } else if (document.querySelectorAll('input[type="radio"][name="time"]:checked').length < 1) {
                $(`.span-error-time`).text("<?php echo e(__('*Please choose time')); ?>");
                $("[data-dismiss=modal]").trigger({
                    type: "click"
                });
            } else if (name == "") {
                $(`.span-error-name`).text("<?php echo e(__('*Please enter your name')); ?>");
            } else if (email == "") {
                $(`.span-error-email`).text("<?php echo e(__('*Please enter your email')); ?>");
            } else if (email == "" || !emailFormat.test(email)) {

                $(`.span-error-email`).text("<?php echo e(__('*Please enter a valid email address')); ?>");
            } else if (phone == "") {

                $(`.span-error-phone`).text("<?php echo e(__('*Please enter your phone no')); ?>");
            } else if (phone == "" || !phoneFormat.test(phone)) {

                $(`.span-error-phone`).text("<?php echo e(__('*Please enter a valid phone no')); ?>");
            } else {
                $(`.span-error-date`).text("");
                $(`.span-error-time`).text("");
                $(`.span-error-name`).text("");
                $(`.span-error-email`).text("");
                date = formatDate(date);
                $.ajax({
                    url: '<?php echo e(route('appoinment.store')); ?>',
                    type: 'POST',
                    data: {
                        "name": name,
                        "email": email,
                        "phone": phone,
                        "date": date,
                        "time": time,
                        "business_id": business_id,
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "name": name,
                        "email": email,
                        "date": date,
                        "time": time,
                        "business_id": business_id,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(data) {
                        if (data.flag == false) {
                            $(".close-search").trigger({
                                type: "click"
                            });
                            show_toastr('Error', data.msg, 'error');

                        } else {
                            $(".close-search").trigger({
                                type: "click"
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                            show_toastr('Success',
                                "<?php echo e(__('Thank you for booking an appointment.')); ?>", 'success');
                        }
                    }
                });
            }
        });

        $(`#makecontact`).click(function() {
            var name = $(`.contact_name`).val();
            var email = $(`.contact_email`).val();
            var phone = $(`.contact_phone`).val();
            var message = $(`.contact_message`).val();
            var business_id = '<?php echo e($business->id); ?>';
            var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneFormat = /^([0-9\s\-\+\(\)]*)$/;

            $(`.span-error-contactname`).text("");
            $(`.span-error-contactemail`).text("");
            $(`.span-error-contactphone`).text("");
            $(`.span-error-contactmessage`).text("");

            if (name == "") {
                $(`.span-error-contactname`).text("<?php echo e(__('*Please enter your name')); ?>");
            } else if (email == "") {

                $(`.span-error-contactemail`).text("<?php echo e(__('*Please enter your email')); ?>");
            } else if (email == "" || !emailFormat.test(email)) {
                $(`.span-error-contactemail`).text("<?php echo e(__('*Please enter a valid email address')); ?>");
            } else if (phone == "") {

                $(`.span-error-contactphone`).text("<?php echo e(__('*Please enter your phone no.')); ?>");
            } else if (phone == "" || !phoneFormat.test(phone)) {

                $(`.span-error-contactphone`).text("<?php echo e(__('*Please enter a valid phone no')); ?>");
            } else if (message == "") {
                $(`.span-error-contactmessage`).text("<?php echo e(__('*Please enter your message.')); ?>");
            } else {

                $(`.span-error-contactname`).text("");
                $(`.span-error-contactemail`).text("");
                $(`.span-error-contactphone`).text("");
                $(`.span-error-contactmessage`).text("");

                $.ajax({
                    url: '<?php echo e(route('contacts.store')); ?>',
                    type: 'POST',
                    data: {
                        "name": name,
                        "email": email,
                        "phone": phone,
                        "message": message,
                        "business_id": business_id,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(data) {

                        // location.reload();
                        $(".close-search").trigger({
                            type: "click"
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                        show_toastr('Success', "<?php echo e(__('Your contact details has been noted.')); ?>",
                            'success');

                    }
                });
            }
        });
    </script>
    <!-- Google Analytic Code -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($business->google_analytic); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?php echo e($business->google_analytic); ?>');
    </script>
    <?php if(isset($is_slug)): ?>
        <script>
            function show_toastr(title, message, type) {
                var o, i;
                var icon = '';
                var cls = '';

                if (type == 'success') {
                    icon = 'ti ti-check-circle';
                    cls = 'success';
                } else {
                    icon = 'ti ti-times-circle';
                    cls = 'danger';
                }

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
                    spacing: 80,
                    z_index: 1080,
                    delay: 2500,
                    timer: 2000,
                    url_target: "_blank",
                    mouse_over: !1,
                    animate: {
                        enter: o,
                        exit: i
                    },
                    template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                });
            }
            if ($(".datepicker").length) {
                $('.datepicker').daterangepicker({
                    singleDatePicker: true,
                    format: 'yyyy-mm-dd',
                });
            }
        </script>

        <?php if($message = Session::get('success')): ?>
            <script>
                show_toastr('Success', '<?php echo $message; ?>', 'success');
            </script>
        <?php endif; ?>
        <?php if($message = Session::get('error')): ?>
            <script>
                show_toastr('Error', '<?php echo $message; ?>', 'error');
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo e($business->fbpixel_code); ?>');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=0000&ev=PageView&noscript=<?php echo e($business->fbpixel_code); ?>" /></noscript>

    <!-- Custom Code -->
    <script type="text/javascript">
        <?php echo $business->customjs; ?>

    </script>
    <?php if(isset($is_pdf)): ?>
        <?php echo $__env->make('business.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
    <?php if(!isset($is_pdf)): ?>
        <script>
            $(document).ready(function() {
                var mapLink = document.getElementById('mapLink').value;
                document.getElementById('mapContainer').innerHTML = mapLink;
            });
        </script>
    <?php endif; ?>
    <?php if(isset($is_slug)): ?>
        <?php if($is_gdpr_enabled): ?>
            <script src="<?php echo e(asset('js/cookieconsent.js')); ?>"></script>
            <script>
                let myVar = <?php echo json_encode($a); ?>;
                let data = JSON.parse(myVar);
                let language_code = document.documentElement.getAttribute('lang');
                let languages = {};
                languages[language_code] = {
                    consent_modal: {
                        title: 'hello',
                        description: 'description',
                        primary_btn: {
                            text: 'primary_btn text',
                            role: 'accept_all'
                        },
                        secondary_btn: {
                            text: 'secondary_btn text',
                            role: 'accept_necessary'
                        }
                    },
                    settings_modal: {
                        title: 'settings_modal',
                        save_settings_btn: 'save_settings_btn',
                        accept_all_btn: 'accept_all_btn',
                        reject_all_btn: 'reject_all_btn',
                        close_btn_label: 'close_btn_label',
                        blocks: [{
                                title: 'block title',
                                description: 'block description'
                            },

                            {
                                title: 'title',
                                description: 'description',
                                toggle: {
                                    value: 'necessary',
                                    enabled: true,
                                    readonly: false
                                }
                            },
                        ]
                    }
                };
            </script>
            <script>
                function setCookie(cname, cvalue, exdays) {
                    const d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    let expires = "expires=" + d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                function getCookie(cname) {
                    let name = cname + "=";
                    let decodedCookie = decodeURIComponent(document.cookie);
                    let ca = decodedCookie.split(';');
                    for (let i = 0; i < ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }


                // obtain plugin
                var cc = initCookieConsent();
                // run plugin with your configuration
                cc.run({
                    current_lang: 'en',
                    autoclear_cookies: true, // default: false
                    page_scripts: true,
                    // ...
                    gui_options: {
                        consent_modal: {
                            layout: 'cloud', // box/cloud/bar
                            position: 'bottom center', // bottom/middle/top + left/right/center
                            transition: 'slide', // zoom/slide
                            swap_buttons: false // enable to invert buttons
                        },
                        settings_modal: {
                            layout: 'box', // box/bar
                            // position: 'left',           // left/right
                            transition: 'slide' // zoom/slide
                        }
                    },

                    onChange: function(cookie, changed_preferences) {},
                    onAccept: function(cookie) {
                        if (!getCookie('cookie_consent_logged')) {
                            var cookie = cookie.level;
                            var slug = '<?php echo e($business->slug); ?>';
                            $.ajax({
                                url: '<?php echo e(route('card-cookie-consent')); ?>',
                                datType: 'json',
                                data: {
                                    cookie: cookie,
                                    slug: slug,
                                },
                            })
                            setCookie('cookie_consent_logged', '1', 182, '/');
                        }
                    },
                    languages: {
                        'en': {
                            consent_modal: {
                                title: data.cookie_title,
                                description: data.cookie_description + ' ' +
                                    '<button type="button" data-cc="c-settings" class="cc-link">Let me choose</button>',
                                primary_btn: {
                                    text: "<?php echo e(__('Accept all')); ?>",
                                    role: 'accept_all' // 'accept_selected' or 'accept_all'
                                },
                                secondary_btn: {
                                    text: "<?php echo e(__('Reject all')); ?>",
                                    role: 'accept_necessary' // 'settings' or 'accept_necessary'
                                },
                            },
                            settings_modal: {
                                title: "<?php echo e(__('Cookie preferences')); ?>",
                                save_settings_btn: "<?php echo e(__('Save settings')); ?>",
                                accept_all_btn: "<?php echo e(__('Accept all')); ?>",
                                reject_all_btn: "<?php echo e(__('Reject all')); ?>",
                                close_btn_label: "<?php echo e(__('Close')); ?>",
                                cookie_table_headers: [{
                                        col1: 'Name'
                                    },
                                    {
                                        col2: 'Domain'
                                    },
                                    {
                                        col3: 'Expiration'
                                    },
                                    {
                                        col4: 'Description'
                                    }
                                ],
                                blocks: [{
                                    title: data.cookie_title + ' ' + '📢',
                                    description: data.cookie_description,
                                }, {
                                    title: data.strictly_cookie_title,
                                    description: data.strictly_cookie_description,
                                    toggle: {
                                        value: 'necessary',
                                        enabled: true,
                                        readonly: true // cookie categories with readonly=true are all treated as "necessary cookies"
                                    }
                                }, {
                                    title: "<?php echo e(__('More information')); ?>",
                                    description: data.more_information_description + ' ' +
                                        '<a class="cc-link" href="' + data.contactus_url + '">Contact Us</a>.',
                                }]
                            }
                        }
                    }

                });
            </script>
        <?php endif; ?>
    <?php endif; ?>
    <!--scripts end here-->
</body>

</html>
<?php /**PATH /home/vcard/public_html/resources/views/card/theme13/index.blade.php ENDPATH**/ ?>