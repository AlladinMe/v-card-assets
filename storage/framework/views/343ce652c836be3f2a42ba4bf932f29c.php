<?php
    $social_no = 1;
    $appointment_no = 0;
    $service_row_no = 0;
    $product_row_no = 0;
    $testimonials_row_no = 0;
    $gallery_row_no = 0;

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

    if (!is_null($gallery_contents) && !is_null($gallery)) {
        $gallery['is_enabled'] == '1' ? ($is_enable_gallery = true) : ($is_enable_gallery = false);
    }

    if (!is_null($custom_html) && !is_null($customhtml)) {
        $customhtml->is_custom_html_enabled == '1' ? ($is_custom_html_enable = true) : ($is_custom_html_enable = false);
    }
    if (!is_null($business) && !is_null($business)) {
        $business->is_google_map_enabled == '1' ? ($is_google_map_enabled = true) : ($is_google_map_enabled = false);
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
<html lang="en" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="<?php echo e($business->title); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="HandheldFriendly" content="True">

    <title><?php echo e($business->title); ?></title>
    <meta name="author" content="<?php echo e($business->title); ?>">
    <meta name="keywords" content="<?php echo e($business->meta_keyword); ?>">
    <meta name="description" content="<?php echo e($business->meta_description); ?>">
    
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
    <link rel="stylesheet" href="<?php echo e(asset('custom/theme5/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/theme5/fonts/stylesheet.css')); ?>">
    <?php if($SITE_RTL == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme5/css/rtl-main-style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme5/css/rtl-responsive.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme5/css/main-style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('custom/theme5/css/responsive.css')); ?>">
    <?php endif; ?>
    <?php if(isset($is_slug)): ?>
        <link rel='stylesheet' href='<?php echo e(asset('css/cookieconsent.css')); ?>' media="screen" />
        <style type="text/css">
            <?php echo e($business->customcss); ?>

        </style>
    <?php endif; ?>
    <?php if($business->google_fonts != 'Default' && isset($business->google_fonts)): ?>
        <style>
            @import url('<?php echo e(\App\Models\Utility::getvalueoffont($business->google_fonts)['link']); ?>');

            :root {
                --Strawford: '<?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>', <?php echo e(substr(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], strpos(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') + 1)); ?>;
            }
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
    <div class="<?php echo e(\App\Models\Utility::themeOne()['theme5'][$business->theme_color]['theme_name']); ?>"
        id="view_theme15">
        <main id="boxes">
            <div class="card-wrapper <?php if(!isset($is_pdf)): ?> scrollbar <?php endif; ?>">
                <div class="bussiness-card force-overflow">
                    <div class="bussiness-card-body">
                        <section class="profile-section">
                            <div class="profile-cover">
                                <img src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/img/placeholder-image.jpg')); ?>"
                                    id="banner_preview" alt="fs">
                            </div>
                            <div class="profile-content">
                                <div class="user-profile">
                                    <div class="user-name">
                                        <h2 class="text-white" id="<?php echo e($stringid . '_title'); ?>_preview">
                                            <?php echo e($business->title); ?></h2>
                                        <p id="<?php echo e($stringid . '_designation'); ?>_preview"><b>
                                                <?php echo e($business->designation); ?></b></p>
                                        <span id="<?php echo e($stringid . '_subtitle'); ?>_preview"
                                            class="subtitle"><?php echo e($business->sub_title); ?></span>
                                    </div>
                                    <div class="user-avatar">
                                        <img id="business_logo_preview"
                                            src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                            alt="">
                                    </div>

                                </div>
                                <div class="text-left desc-wrapper">
                                    <p class="text-white" id="<?php echo e($stringid . '_desc'); ?>_preview">
                                        <?php echo nl2br(e($business->description)); ?>

                                    </p>
                                </div>
                            </div>
                        </section>
                        <?php $j = 1; ?>
                        <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($j == $order_value): ?>
                                <?php if($order_key == 'social'): ?>
                                    <section class="social" id="social-div">
                                        <ul class="social-list" id="inputrow_socials_preview">
                                            <?php if(!is_null($social_content) && !is_null($sociallinks)): ?>
                                                <?php $__currentLoopData = $social_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key => $social_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $social_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key1 => $social_val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($social_key1 != 'id'): ?>
                                                            <li id="socials_<?php echo e($loop->parent->index + 1); ?>">
                                                                <?php if($social_key1 == 'Whatsapp'): ?>
                                                                <?php
                                                                $social_links = 'https://wa.me/' . $social_val1;
                                                            ?>
                                                                <?php else: ?>
                                                                    <?php
                                                                        $social_links = url($social_val1);
                                                                    ?>
                                                                <?php endif; ?>
                                                                <a href="<?php echo e($social_links); ?>" target="_blank"
                                                                    id="<?php echo e('social_link_' . $social_no . '_href_preview'); ?>">
                                                                    <img src="<?php echo e(asset('custom/theme5/icon/social/' . strtolower($social_key1) . '.svg')); ?>"
                                                                        alt="social" class="img-fluid">
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php
                                                            $social_no++;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'service'): ?>
                                    <section class="service-section" id="services-div">
                                        <div class="section-title text-center">
                                            <h2><?php echo e(__('Services')); ?></h2>
                                        </div>
                                        <div class="row row-gap" id="inputrow_service_preview">
                                            <?php $image_count = 0; ?>
                                            <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-sm-6 col-12 service-card"
                                                    id="services_<?php echo e($service_row_no); ?>">
                                                    <div class="service-card-inner">
                                                        <div class="service-icon">
                                                            <img id="<?php echo e('s_image' . $image_count . '_preview'); ?>"
                                                                src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"class="img-fluid"
                                                                alt="image">
                                                        </div>
                                                        <h5 id="<?php echo e('title_' . $service_row_no . '_preview'); ?>">
                                                            <?php echo e($content->title); ?></h5>
                                                        <p id="<?php echo e('description_' . $service_row_no . '_preview'); ?>">
                                                            <?php echo e($content->description); ?>

                                                        </p>
                                                        <?php if(!empty($content->purchase_link)): ?>
                                                            <a href="<?php echo e(url($content->purchase_link)); ?>"
                                                                class="btn"
                                                                id="<?php echo e('link_title_' . $service_row_no . '_preview'); ?>"><?php echo e($content->link_title); ?>

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                                                    height="22" viewBox="0 0 21 22"
                                                                    fill="none">
                                                                    <path opacity="0.4"
                                                                        d="M10.5 19.5731C15.1833 19.5731 18.9799 15.7765 18.9799 11.0932C18.9799 6.40986 15.1833 2.61328 10.5 2.61328C5.81672 2.61328 2.02014 6.40986 2.02014 11.0932C2.02014 15.7765 5.81672 19.5731 10.5 19.5731Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M14.4787 10.8497C14.4464 10.7717 14.3999 10.7014 14.3414 10.6429L11.7974 8.09894C11.549 7.85048 11.1462 7.85048 10.8977 8.09894C10.6492 8.3474 10.6492 8.75023 10.8977 8.99869L12.3562 10.4572H7.10804C6.75697 10.4572 6.47205 10.7421 6.47205 11.0932C6.47205 11.4443 6.75697 11.7292 7.10804 11.7292H12.3562L10.8977 13.1877C10.6492 13.4362 10.6492 13.839 10.8977 14.0875C11.0215 14.2113 11.1843 14.274 11.3472 14.274C11.51 14.274 11.6728 14.2121 11.7966 14.0875L14.3406 11.5435C14.3991 11.485 14.4456 11.4147 14.4778 11.3367C14.5431 11.1806 14.5431 11.0058 14.4787 10.8497Z"
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


                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'product'): ?>
                                    <section class="product-section" id="product-div">
                                        <div class="section-title text-center">
                                            <h2><?php echo e(__('Product')); ?></h2>
                                        </div>
                                        <div class="row row-gap" id="inputrow_product_preview">
                                            <?php $pr_image_count = 0; ?>
                                            <?php $__currentLoopData = $products_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-sm-6 col-12 service-card"
                                                    id="product_<?php echo e($product_row_no); ?>">
                                                    <div class="service-card-inner">
                                                        <div class="service-icon">
                                                            <img id="<?php echo e('pr_image' . $pr_image_count . '_preview'); ?>"
                                                                src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"class="img-fluid"
                                                                alt="image">
                                                        </div>
                                                        <h5
                                                            id="<?php echo e('product_title_' . $product_row_no . '_preview'); ?>">
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
                                                                class="btn"><?php echo e($content->link_title); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php
                                                    $pr_image_count++;
                                                    $product_row_no++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'bussiness_hour'): ?>
                                    <section class="bussiness-hour" id="business-hours-div">
                                        <div class="section-title">
                                            <h2><?php echo e(__('Business Hours')); ?></h2>
                                        </div>
                                        <ul class="hours-list text-center">
                                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><b><?php echo e(__($day)); ?>:</b>
                                                    <span class="days_<?php echo e($k); ?>">
                                                        <?php if(isset($business_hours->$k) && $business_hours->$k->days == 'on'): ?>
                                                            <span
                                                                class="days_<?php echo e($k); ?>_start"><?php echo e(!empty($business_hours->$k->start_time) && isset($business_hours->$k->start_time) ? date('h:i A', strtotime($business_hours->$k->start_time)) : '00:00'); ?></span>
                                                            - <span
                                                                class="days_<?php echo e($k); ?>_end"><?php echo e(!empty($business_hours->$k->end_time) && isset($business_hours->$k->end_time) ? date('h:i A', strtotime($business_hours->$k->end_time)) : '00:00'); ?></span>
                                                        <?php else: ?>
                                                            <?php echo e(__('Closed')); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'gallery'): ?>
                                    <section class="gallery-section" id="gallery-div">
                                        <div class="section-title text-center">
                                            <h2><?php echo e(__('Gallery')); ?></h2>
                                        </div>
                                        <div id="inputrow_gallery_preview">
                                            <?php $image_count = 0; ?>
                                            <?php if(isset($is_pdf)): ?>
                                                <div class="gallery-cards">
                                                    <div class="row">
                                                        <?php if(!is_null($gallery_contents) && !is_null($gallery)): ?>
                                                            <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(isset($gallery_content->type)): ?>
                                                                    <?php if($gallery_content->type == 'video'): ?>
                                                                    <?php elseif($gallery_content->type == 'image'): ?>
                                                                        <div class="gallery-itm col-12">
                                                                            <div class="gallery-media">
                                                                                <a href="javascript:;" id="imagepopup"
                                                                                    tabindex="0" class="imagepopup">
                                                                                    <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                        alt="images"
                                                                                        class="imageresource">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php
                                                                    $image_count++;
                                                                    $gallery_row_no++;
                                                                ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            <?php else: ?>
                                                <div class="gallery-slider">
                                                    <?php if(!is_null($gallery_contents) && !is_null($gallery)): ?>
                                                        <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="gallery-itm"
                                                                id="gallery_<?php echo e($gallery_row_no); ?>">
                                                                <div class="gallery-media">
                                                                    <?php if(isset($gallery_content->type)): ?>
                                                                        <?php if($gallery_content->type == 'video'): ?>
                                                                            <a href="javascript:;" tabindex="0"
                                                                                class="videopop play-btn">

                                                                                <video loop controls="true">
                                                                                    <source class="videoresource"
                                                                                        src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path . '/' . $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                        type="video/mp4">
                                                                                </video>
                                                                            </a>
                                                                        <?php elseif($gallery_content->type == 'image'): ?>
                                                                            <a href="javascript:;" tabindex="0"
                                                                                class="imagepopup">

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
                                                                                    tabindex="0"
                                                                                    class="videopop1 play-btn">
                                                                                    <video loop controls="true"
                                                                                        poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                        <source class="videoresource1"
                                                                                            src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? 'https://www.youtube.com/embed/' . $video_url : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                            type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                <a href="javascript:;" id=""
                                                                                    tabindex="0"
                                                                                    class="videopop1 play-btn">
                                                                                    <video loop controls="true"
                                                                                        poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                        <source class="videoresource1"
                                                                                            src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                            type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        <?php elseif($gallery_content->type == 'custom_image_link'): ?>
                                                                            <a href="javascript:;" tabindex="0"
                                                                                class="imagepopup1">

                                                                                <img class="imageresource1"
                                                                                    src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                    alt="images" id="upload_image">
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'appointment'): ?>
                                    <section class="make-appointment" id="appointment-div">
                                        <div class="section-title text-center">
                                            <h2 class="text-white"><?php echo e(__('Make')); ?> <br>
                                                <?php echo e(__('an appointment')); ?></h2>
                                        </div>
                                        <div class="appointment-form">
                                            <div class="form-group">
                                                <label><?php echo e(__('Date:')); ?></label>
                                                <input type="text" name="date" class="datepicker_min"
                                                    placeholder="<?php echo e(__('Pick a Date')); ?>">
                                                <span class="text-white text-center h6 span-error-date"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="primary-text"><?php echo e(__('Hour:')); ?></label>
                                                <div class="cust-checkbox">
                                                    <div class="row row-gap" id="inputrow_appointment_preview">
                                                        <?php $radiocount = 1; ?>
                                                        <?php if(!is_null($appoinment_hours)): ?>
                                                            <?php $__currentLoopData = $appoinment_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="col-sm-6 col-12"
                                                                    id="<?php echo e('appointment_' . $appointment_no); ?>">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="app_time"
                                                                            id="radio-<?php echo e($radiocount); ?>"
                                                                            data-id="<?php if(!empty($hour->start)): ?> <?php echo e($hour->start); ?> <?php else: ?> 00:00 <?php endif; ?>-<?php if(!empty($hour->end)): ?> <?php echo e($hour->end); ?> <?php else: ?> 00:00 <?php endif; ?>"
                                                                            name="time">
                                                                        <label for="radio-<?php echo e($radiocount); ?>"><span
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
                                                                </div>
                                                                <?php
                                                                    $radiocount++;
                                                                    $appointment_no++;
                                                                ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <span class="text-white text-center h6 span-error-time"></span>
                                            </div>
                                            <div class="text-center">
                                                <button
                                                    class="btn hover-secondary appointment-modal-toggle"><?php echo e(__('Make an appointment')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'testimonials'): ?>
                                    <section class="testimonial-section text-center" id="testimonials-div">
                                        <div class="section-title">
                                            <h2><?php echo e(__('Testimonials')); ?></h2>
                                        </div>
                                        <?php if(isset($is_pdf)): ?>
                                            <div class="row gap-bottom" id="inputrow_testimonials_preview">
                                                <?php
                                                    $t_image_count = 0;
                                                    $rating = 0;
                                                ?>
                                                <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="testimonial-card col-sm-6"
                                                        id="testimonials_<?php echo e($testimonials_row_no); ?>">
                                                        <div class="testimonial-card-inner">
                                                            <div class="user-pro">
                                                                <div class="user-avatar">
                                                                    <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                                        src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                        alt="image">
                                                                </div>
                                                                <span
                                                                    class="total-rat"><?php echo e($testi_content->rating); ?>/5</span>
                                                                <?php
                                                                    if (!empty($testi_content->rating)) {
                                                                        $rating = (int) $testi_content->rating;
                                                                        $overallrating = $rating;
                                                                    } else {
                                                                        $overallrating = 0;
                                                                    }
                                                                ?>
                                                                <br>
                                                                <span id="<?php echo e('stars' . $testimonials_row_no); ?>_star"
                                                                    class="stars">
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
                                                    <div class="testimonial-card"
                                                        id="testimonials_<?php echo e($testimonials_row_no); ?>">
                                                        <div class="testimonial-card-inner">
                                                            <div class="user-pro">
                                                                <div class="user-avatar">
                                                                    <img id="<?php echo e('t_image' . $t_image_count . '_preview'); ?>"
                                                                        src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                        alt="image">
                                                                </div>
                                                                <span
                                                                    class="total-rat"><?php echo e($testi_content->rating); ?>/5</span>
                                                                <?php
                                                                    if (!empty($testi_content->rating)) {
                                                                        $rating = (int) $testi_content->rating;
                                                                        $overallrating = $rating;
                                                                    } else {
                                                                        $overallrating = 0;
                                                                    }
                                                                ?>
                                                                <br>
                                                                <span id="<?php echo e('stars' . $testimonials_row_no); ?>_star"
                                                                    class="stars">
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
                                                    <?php
                                                        $t_image_count++;
                                                        $testimonials_row_no++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'contact_info'): ?>
                                    <section class="contact-section" id="contact-div">
                                        <h2><?php echo e(__('Contact')); ?></h2>
                                        <ul id="inputrow_contact_preview">
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
                                                            <li id="contact_<?php echo e($loop->parent->index + 1); ?>">
                                                                <?php if($key1 == 'Address'): ?>
                                                                    <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($key2 == 'Address_url'): ?>
                                                                            <?php $href = $val2; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="<?php echo e($href); ?>">
                                                                        <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($key2 == 'Address'): ?>
                                                                                <span
                                                                                    id="<?php echo e($key1 . '_' . $no); ?>_preview">
                                                                                    <?php echo e($val2); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <?php if($key1 == 'Whatsapp'): ?>
                                                                        <a href="<?php echo e(url('https://wa.me/' . $href)); ?>"
                                                                            target="_blank">
                                                                        <?php else: ?>
                                                                            <a href="<?php echo e($href); ?>">
                                                                    <?php endif; ?>
                                                                    <span id="<?php echo e($key1 . '_' . $no); ?>_preview">
                                                                        <?php echo e($val1); ?></span>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php
                                                            $no++;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'more'): ?>
                                    <section class="more-info">
                                        <div class="section-title text-center ">
                                            <h2 class="text-white"><?php echo e(__('More')); ?></h2>
                                        </div>
                                        <ul class="btn-list">
                                            <li>
                                                <a href="<?php echo e(route('bussiness.save', $business->slug)); ?>"
                                                    class="btn"><?php echo e(__('Save Card')); ?> <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="33"
                                                        height="32" viewBox="0 0 33 32" fill="none">
                                                        <path opacity="0.4"
                                                            d="M8.5 13.3333C5.83333 13.3333 4.5 14.6666 4.5 17.3333V23.9999C4.5 26.6666 5.83333 27.9999 8.5 27.9999H24.5C27.1667 27.9999 28.5 26.6666 28.5 23.9999V17.3333C28.5 14.6666 27.1667 13.3333 24.5 13.3333H8.5Z"
                                                            fill="#242424"></path>
                                                        <path
                                                            d="M21.2067 16.6266C20.816 16.236 20.1826 16.236 19.792 16.6266L17.4987 18.92V4C17.4987 3.448 17.0507 3 16.4987 3C15.9467 3 15.4987 3.448 15.4987 4V18.9187L13.2054 16.6253C12.8147 16.2347 12.1813 16.2347 11.7907 16.6253C11.4 17.016 11.4 17.6494 11.7907 18.04L15.7907 22.04C15.8827 22.132 15.9932 22.2054 16.1159 22.256C16.2385 22.3067 16.368 22.3333 16.4987 22.3333C16.6294 22.3333 16.7585 22.3067 16.8812 22.256C17.0038 22.2054 17.1147 22.132 17.2067 22.04L21.2067 18.04C21.5974 17.6507 21.5974 17.016 21.2067 16.6266Z"
                                                            fill="#242424"></path>
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)"
                                                    class="btn share-modal-toggle"><?php echo e(__('Share Card')); ?>

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="33"
                                                        height="32" viewBox="0 0 33 32" fill="none">
                                                        <path opacity="0.4"
                                                            d="M10.972 15.0919C10.6054 15.0919 10.2519 14.8893 10.0759 14.5386C9.82788 14.0439 10.0295 13.444 10.5241 13.1973L21.0508 7.9346C21.5455 7.6866 22.144 7.88929 22.392 8.38129C22.64 8.87596 22.4387 9.47594 21.944 9.7226L11.4173 14.9853C11.2733 15.0573 11.1214 15.0919 10.972 15.0919Z"
                                                            fill="#242424"></path>
                                                        <path opacity="0.4"
                                                            d="M22.2335 24.5413C22.0841 24.5413 21.9308 24.5066 21.7881 24.436L9.78684 18.436C9.29217 18.1893 9.09193 17.588 9.3386 17.0947C9.58793 16.6027 10.1867 16.4 10.6801 16.648L22.6814 22.648C23.176 22.8946 23.376 23.496 23.1293 23.9893C22.9533 24.3373 22.6001 24.5413 22.2335 24.5413Z"
                                                            fill="#242424"></path>
                                                        <path
                                                            d="M8.5 20C10.7091 20 12.5 18.2091 12.5 16C12.5 13.7909 10.7091 12 8.5 12C6.29086 12 4.5 13.7909 4.5 16C4.5 18.2091 6.29086 20 8.5 20Z"
                                                            fill="#242424"></path>
                                                        <path
                                                            d="M24.5 12C26.7091 12 28.5 10.2091 28.5 8C28.5 5.79086 26.7091 4 24.5 4C22.2909 4 20.5 5.79086 20.5 8C20.5 10.2091 22.2909 12 24.5 12Z"
                                                            fill="#242424"></path>
                                                        <path
                                                            d="M24.5 28C26.7091 28 28.5 26.2091 28.5 24C28.5 21.7909 26.7091 20 24.5 20C22.2909 20 20.5 21.7909 20.5 24C20.5 26.2091 22.2909 28 24.5 28Z"
                                                            fill="#242424"></path>
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)"
                                                    class="btn make-contact-modal-toggle"><?php echo e(__('Contact')); ?>

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="33"
                                                        height="32" viewBox="0 0 33 32" fill="none">
                                                        <path opacity="0.4"
                                                            d="M20.3251 19.7253L18.8384 21.9453C15.1051 20.3853 12.1185 17.3867 10.5572 13.644L12.772 12.1706C13.9827 11.3653 14.3519 9.75333 13.6106 8.50133L11.5266 4.98265C11.0932 4.25065 10.2453 3.87332 9.41068 4.03998L9.3879 4.04397C5.97456 4.72664 3.79042 8.15733 4.71309 11.5133C6.89442 19.4493 13.0799 25.616 20.9986 27.7893C24.3546 28.7107 27.7798 26.524 28.4624 23.112C28.6291 22.28 28.2533 21.4347 27.5253 21L24.0012 18.8987C22.7492 18.1533 21.1357 18.516 20.3251 19.7253Z"
                                                            fill="#242424"></path>
                                                        <path
                                                            d="M23.1666 14.3333C22.6146 14.3333 22.1666 13.8853 22.1666 13.3333C22.1666 11.6786 20.82 10.3333 19.1666 10.3333C18.6146 10.3333 18.1666 9.88525 18.1666 9.33325C18.1666 8.78125 18.6146 8.33325 19.1666 8.33325C21.9226 8.33325 24.1666 10.5759 24.1666 13.3333C24.1666 13.8853 23.7186 14.3333 23.1666 14.3333ZM28.1666 13.3333C28.1666 8.37059 24.1293 4.33325 19.1666 4.33325C18.6146 4.33325 18.1666 4.78125 18.1666 5.33325C18.1666 5.88525 18.6146 6.33325 19.1666 6.33325C23.0266 6.33325 26.1666 9.47325 26.1666 13.3333C26.1666 13.8853 26.6146 14.3333 27.1666 14.3333C27.7186 14.3333 28.1666 13.8853 28.1666 13.3333Z"
                                                            fill="#242424"></path>
                                                    </svg></a>
                                            </li>
                                        </ul>
                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'custom_html'): ?>
                                    <section class="card-footer custom_html_text">
                                        <div class="greetings-desk">
                                            <div class="user-text-avatar text-white"
                                                id="<?php echo e($stringid . '_chtml'); ?>_preview">
                                                <?php echo stripslashes($custom_html); ?>

                                            </div>
                                        </div>

                                    </section>
                                <?php endif; ?>
                                <?php if($order_key == 'payment'): ?>
                                    <section class="card-payment-section" id="payment-section">
                                        <div class="section-title text-center">
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
                                                            <a
                                                                href="<?php echo e(route('card.pay.with.stripe', $business->id)); ?>">
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
                                                            <a
                                                                href="<?php echo e(route('card.pay.with.paypal', $business->id)); ?>">
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
                                <?php $j = $j + 1; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($plan->enable_branding == 'on'): ?>
                            <?php if($is_branding_enabled): ?>
                                <div class="copy-right is_branding_enable" id="is_branding_enabled">
                                    <p id="<?php echo e($stringid . '_branding'); ?>_preview"><?php echo e($business->branding_text); ?>

                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <img src="<?php echo e(isset($qr_detail->image) ? $qr_path . '/' . $qr_detail->image : ''); ?>" id="image-buffers" crossorigin="anonymous"
                style="display: none">
        </main>

        <div id="previewImage"> </div>
        <a id="download" href="#" class="font-lg download mr-3 text-white">
            <i class="fas fa-download"></i>
        </a>

        <!-- Share card popup -->
        <div class="theme-modal share-card">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close share-modal-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                viewBox="0 0 45 45" fill="none">
                                <path opacity="0.4"
                                    d="M37.2376 24.5509H7.76834C6.74981 24.5509 5.92651 23.7258 5.92651 22.7091C5.92651 21.6924 6.74981 20.8672 7.76834 20.8672H37.2376C38.2561 20.8672 39.0794 21.6924 39.0794 22.7091C39.0794 23.7258 38.2561 24.5509 37.2376 24.5509Z"
                                    fill="#F9D254" />
                                <path
                                    d="M15.1357 31.9183C14.6642 31.9183 14.1926 31.7378 13.8335 31.3787L6.46614 24.0114C5.74599 23.2912 5.74599 22.1271 6.46614 21.4069L13.8335 14.0396C14.5536 13.3194 15.7178 13.3194 16.4379 14.0396C17.1581 14.7598 17.1581 15.9239 16.4379 16.6441L10.3728 22.7091L16.4379 28.7742C17.1581 29.4944 17.1581 30.6585 16.4379 31.3787C16.0788 31.7378 15.6072 31.9183 15.1357 31.9183Z"
                                    fill="#F9D254" />
                            </svg>
                        </button>
                        <h5 class="modal-title"><?php echo e(__('Share This Card')); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="qrcode-wrapper">
                            <div class="shareqrcode"></div>
                        </div>
                        <p><?php echo e(__('Point your camera at the QR code,')); ?> <br> <span class="qr-link text-wrap"></span>
                        </p>
                        <p><?php echo e(__('Or check my social channels')); ?></p>
                        <ul class="social-list modal-share">
                            <li>
                                <a href="https://www.facebook.com/sharer.php?u=<?php echo e(urlencode($url_link)); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55"
                                        viewBox="0 0 55 55" fill="none">
                                        <g clip-path="url(#clip0_5_272)">
                                            <path
                                                d="M54.9802 27.7657C54.9802 12.7763 42.8289 0.625 27.8395 0.625C12.8501 0.625 0.698853 12.7763 0.698853 27.7657C0.698853 41.3122 10.6238 52.5406 23.5988 54.5767V35.611H16.7076V27.7657H23.5988V21.7863C23.5988 14.9841 27.6508 11.2268 33.8503 11.2268C36.8188 11.2268 39.9256 11.7569 39.9256 11.7569V18.4361H36.5034C33.132 18.4361 32.0803 20.5284 32.0803 22.6768V27.7657H39.6076L38.4043 35.611H32.0803V54.5767C45.0553 52.5406 54.9802 41.3122 54.9802 27.7657Z"
                                                fill="#1877F2" />
                                            <path
                                                d="M38.4043 35.6113L39.6076 27.7659H32.0803V22.677C32.0803 20.5307 33.132 18.4363 36.5034 18.4363H39.9257V11.7571C39.9257 11.7571 36.8198 11.2271 33.8503 11.2271C27.6509 11.2271 23.5988 14.9843 23.5988 21.7865V27.7659H16.7076V35.6113H23.5988V54.5769C26.4089 55.0165 29.2702 55.0165 32.0803 54.5769V35.6113H38.4043Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_5_272">
                                                <rect width="54.2814" height="54.2814" fill="white"
                                                    transform="translate(0.698853 0.625)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?url=<?php echo e(urlencode($url_link)); ?>&text=">
                                    <svg width="682" height="682" viewBox="0 0 682 682" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M308.826 2.95819L308.821 2.95862C202.611 13.978 109.557 71.724 53.0033 161.731L51.9077 161.043L53.0032 161.732C-27.1728 289.296 -12.0346 458.686 89.3705 568.984C145.799 630.325 215.615 666.83 299.545 678.782L299.545 678.782C307.357 679.898 324.32 680.433 341.464 680.4C358.603 680.367 375.708 679.765 383.795 678.647C466.386 667.228 536.201 630.859 592.497 569.783L592.498 569.782C638.809 519.623 668.422 455.377 678.782 383.12L678.782 383.119C679.898 375.374 680.467 358.41 680.467 341.333C680.467 324.256 679.898 307.292 678.782 299.547L678.781 299.544C670.944 244.286 653.42 197.433 624.35 153.629L624.346 153.624C612.139 135.047 599.804 119.924 582.535 102.523L582.533 102.521C529.565 48.8887 463.997 15.837 388.448 4.6839C380.348 3.49878 364.498 2.63287 348.584 2.2829C332.666 1.93292 316.853 2.10278 308.826 2.95819ZM313.502 212.883L313.504 212.885C327.302 233.016 339.934 251.314 349.165 264.594C353.781 271.234 357.545 276.618 360.179 280.349C361.497 282.216 362.529 283.664 363.243 284.648C363.279 284.698 363.315 284.747 363.349 284.795C363.407 284.733 363.466 284.668 363.528 284.601C364.409 283.644 365.691 282.22 367.333 280.372C370.616 276.679 375.321 271.321 381.103 264.697C392.667 251.45 408.532 233.152 425.932 213.019L488.996 139.689L489.431 139.183L490.098 139.167L507.165 138.767L507.172 138.767L507.18 138.767C512.19 138.7 516.428 138.733 519.394 138.885C520.865 138.961 522.08 139.069 522.933 139.221C523.338 139.294 523.779 139.396 524.142 139.564C524.312 139.643 524.614 139.803 524.861 140.105C525.162 140.471 525.351 141.027 525.172 141.624C525.127 141.779 525.07 141.89 525.052 141.926L525.05 141.929C525.013 142.001 524.975 142.065 524.945 142.112C524.923 142.147 524.899 142.183 524.875 142.22C524.832 142.284 524.785 142.35 524.739 142.415C524.589 142.622 524.383 142.892 524.131 143.211C523.624 143.855 522.892 144.754 521.966 145.873C520.112 148.114 517.452 151.27 514.193 155.105C507.673 162.775 498.737 173.178 489.004 184.445C480.079 194.836 468.41 208.421 456.435 222.362C442.287 238.831 427.714 255.796 416.738 268.577L416.736 268.58L380.557 310.505L450.703 412.751C489.647 469.432 525.363 521.408 530.151 528.057L530.16 528.07L530.169 528.083L538.702 540.483L540.32 542.833H537.467H478.933H420.4H419.61L419.163 542.182L366.097 464.849C366.097 464.849 366.096 464.849 366.096 464.849C351.498 443.584 338.134 424.254 328.37 410.258C323.487 403.26 319.507 397.598 316.725 393.696C315.332 391.744 314.244 390.239 313.494 389.229C313.451 389.171 313.41 389.115 313.369 389.061C313.279 389.161 313.182 389.267 313.081 389.379C312.155 390.402 310.808 391.915 309.085 393.869C305.641 397.775 300.707 403.426 294.649 410.4C282.535 424.348 265.937 443.579 247.805 464.71L247.804 464.711L181.671 541.645L181.235 542.151L180.567 542.166L162.967 542.566L145.367 542.966L142.001 543.043L144.196 540.489L220.729 451.422L220.73 451.422L296.505 363.369L292.912 358.205C287.879 351.332 150.084 150.564 146.077 144.419L146.07 144.409L146.064 144.399L143.797 140.799L142.342 138.488L145.073 138.5L203.473 138.767L203.477 138.767L262.01 139.167L262.792 139.172L263.236 139.816L313.502 212.883Z"
                                            fill="white" stroke="black" stroke-width="3" />
                                        <path
                                            d="M315.762 340.74L315.763 340.741L437.723 515.179L463.081 515.567C463.082 515.567 463.084 515.567 463.085 515.567C470.273 515.633 476.82 515.6 481.563 515.484C483.756 515.43 485.548 515.359 486.833 515.274C486.493 514.766 486.084 514.159 485.607 513.455C483.981 511.058 481.581 507.56 478.49 503.079C472.309 494.117 463.368 481.231 452.335 465.373C430.27 433.658 399.837 390.059 366.371 342.193L245.077 168.822L218.918 168.433L218.911 168.433L195.034 168.196L315.762 340.74Z"
                                            fill="black" stroke="black" stroke-width="3" />
                                    </svg>

                                </a>
                            </li>
                            <li>

                                <a href="https://www.linkedin.com/shareArticle?url=<?php echo e(urlencode($url_link)); ?>&title="
                                    class="linkedin-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55"
                                        viewBox="0 0 55 55" fill="none">
                                        <g clip-path="url(#clip0_5_274)">
                                            <path
                                                d="M50.3735 0.625H4.10614C3.04341 0.625 2.02421 1.04717 1.27275 1.79863C0.521289 2.55009 0.0991211 3.56929 0.0991211 4.63202V50.8994C0.0991211 51.9621 0.521289 52.9813 1.27275 53.7328C2.02421 54.4842 3.04341 54.9064 4.10614 54.9064H50.3735C51.4362 54.9064 52.4554 54.4842 53.2069 53.7328C53.9583 52.9813 54.3805 51.9621 54.3805 50.8994V4.63202C54.3805 3.56929 53.9583 2.55009 53.2069 1.79863C52.4554 1.04717 51.4362 0.625 50.3735 0.625ZM16.278 46.866H8.11694V20.9428H16.278V46.866ZM12.1918 17.3505C11.2661 17.3452 10.3626 17.0659 9.5955 16.5477C8.82837 16.0296 8.23192 15.2957 7.88144 14.4389C7.53095 13.5821 7.44214 12.6406 7.62621 11.7334C7.81028 10.8261 8.25897 9.99369 8.91567 9.34119C9.57237 8.68869 10.4076 8.24535 11.3161 8.06711C12.2245 7.88888 13.1654 7.98373 14.0199 8.33971C14.8745 8.69569 15.6045 9.29683 16.1177 10.0673C16.6309 10.8377 16.9045 11.7429 16.9037 12.6687C16.9125 13.2885 16.7963 13.9037 16.5622 14.4776C16.3282 15.0516 15.9809 15.5725 15.5412 16.0094C15.1015 16.4463 14.5783 16.7902 14.0029 17.0206C13.4275 17.251 12.8115 17.3632 12.1918 17.3505ZM46.3589 46.8886H38.2016V32.7264C38.2016 28.5498 36.4262 27.2606 34.1343 27.2606C31.7143 27.2606 29.3394 29.085 29.3394 32.832V46.8886H21.1784V20.9617H29.0266V24.554H29.1321C29.92 22.9595 32.6793 20.2342 36.8898 20.2342C41.4434 20.2342 46.3627 22.9369 46.3627 30.8529L46.3589 46.8886Z"
                                                fill="#0A66C2" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_5_274">
                                                <rect width="54.2814" height="54.2814" fill="white"
                                                    transform="translate(0.0991211 0.625)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>

                                <?php
                                    $whatsapp_link = url('https://wa.me/?text=' . urlencode($url_link));
                                ?>
                                <a href="<?php echo e($whatsapp_link); ?>">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_213_9336)">
                                            <path
                                                d="M15 30C23.2843 30 30 23.2843 30 15C30 6.71573 23.2843 0 15 0C6.71573 0 0 6.71573 0 15C0 23.2843 6.71573 30 15 30Z"
                                                fill="#29A71A" />
                                            <path
                                                d="M21.6137 8.38606C20.0531 6.80986 17.9806 5.84323 15.7701 5.66053C13.5595 5.47782 11.3564 6.09107 9.55818 7.38965C7.75996 8.68824 6.48496 10.5867 5.96319 12.7425C5.44141 14.8984 5.70719 17.1697 6.7126 19.1469L5.72567 23.9383C5.71543 23.986 5.71514 24.0353 5.72481 24.0831C5.73449 24.1309 5.75393 24.1762 5.78192 24.2162C5.82291 24.2768 5.88143 24.3235 5.94965 24.35C6.01788 24.3765 6.09256 24.3815 6.16373 24.3645L10.8598 23.2514C12.8313 24.2314 15.0867 24.48 17.2244 23.9532C19.3621 23.4264 21.2436 22.1583 22.5341 20.3744C23.8246 18.5906 24.4404 16.4067 24.2718 14.2115C24.1033 12.0163 23.1614 9.95202 21.6137 8.38606ZM20.1495 20.0724C19.0697 21.1492 17.6793 21.86 16.1741 22.1046C14.669 22.3492 13.125 22.1154 11.7598 21.4361L11.1052 21.1122L8.22623 21.794L8.23476 21.7582L8.83135 18.8605L8.51089 18.2281C7.81333 16.8581 7.56725 15.3025 7.80792 13.7841C8.04858 12.2657 8.76364 10.8624 9.85067 9.77526C11.2165 8.40983 13.0688 7.64277 15.0001 7.64277C16.9314 7.64277 18.7837 8.40983 20.1495 9.77526C20.1612 9.7886 20.1737 9.80113 20.187 9.81276C21.536 11.1817 22.289 13.0284 22.282 14.9503C22.275 16.8722 21.5084 18.7134 20.1495 20.0724Z"
                                                fill="white" />
                                            <path
                                                d="M19.8939 17.9466C19.5411 18.5023 18.9837 19.1824 18.2831 19.3512C17.0559 19.6478 15.1724 19.3614 12.8286 17.1762L12.7996 17.1506C10.7388 15.2398 10.2036 13.6495 10.3331 12.3881C10.4047 11.6722 11.0013 11.0245 11.5042 10.6018C11.5837 10.5339 11.6779 10.4856 11.7794 10.4607C11.881 10.4358 11.9869 10.435 12.0887 10.4583C12.1906 10.4817 12.2856 10.5286 12.3661 10.5952C12.4467 10.6618 12.5105 10.7464 12.5525 10.8421L13.311 12.5466C13.3603 12.6572 13.3785 12.779 13.3638 12.8991C13.3491 13.0193 13.302 13.1331 13.2275 13.2285L12.8439 13.7262C12.7616 13.829 12.712 13.954 12.7014 14.0852C12.6907 14.2165 12.7196 14.3479 12.7843 14.4626C12.9991 14.8393 13.5138 15.3932 14.0849 15.9063C14.7258 16.4858 15.4366 17.016 15.8866 17.1966C16.007 17.2458 16.1394 17.2578 16.2666 17.2311C16.3939 17.2044 16.5103 17.1401 16.6008 17.0466L17.0456 16.5983C17.1315 16.5137 17.2382 16.4533 17.355 16.4234C17.4718 16.3934 17.5944 16.395 17.7104 16.4279L19.5121 16.9393C19.6115 16.9697 19.7026 17.0226 19.7785 17.0936C19.8543 17.1647 19.9129 17.2522 19.9497 17.3494C19.9866 17.4467 20.0007 17.551 19.991 17.6545C19.9814 17.758 19.9482 17.8579 19.8939 17.9466Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_213_9336">
                                                <rect width="30" height="30" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- appointment popup -->
        <div class="theme-modal appointment-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close close-search1 appointment-modal-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                viewBox="0 0 45 45" fill="none">
                                <path opacity="0.4"
                                    d="M37.2376 24.5509H7.76834C6.74981 24.5509 5.92651 23.7258 5.92651 22.7091C5.92651 21.6924 6.74981 20.8672 7.76834 20.8672H37.2376C38.2561 20.8672 39.0794 21.6924 39.0794 22.7091C39.0794 23.7258 38.2561 24.5509 37.2376 24.5509Z"
                                    fill="#F9D254" />
                                <path
                                    d="M15.1357 31.9183C14.6642 31.9183 14.1926 31.7378 13.8335 31.3787L6.46614 24.0114C5.74599 23.2912 5.74599 22.1271 6.46614 21.4069L13.8335 14.0396C14.5536 13.3194 15.7178 13.3194 16.4379 14.0396C17.1581 14.7598 17.1581 15.9239 16.4379 16.6441L10.3728 22.7091L16.4379 28.7742C17.1581 29.4944 17.1581 30.6585 16.4379 31.3787C16.0788 31.7378 15.6072 31.9183 15.1357 31.9183Z"
                                    fill="#F9D254" />
                            </svg>
                        </button>
                        <h5 class="modal-title"><?php echo e(__('Make Appointment')); ?></h5>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?php echo e(__('Name:')); ?></label>
                                <input type="text" name="name" class="app_name"
                                    placeholder="<?php echo e(__('')); ?>Enter your name">
                                <span class="  text-white h6 span-error-name"></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Email:')); ?></label>
                                <input type="email" name="email" class="app_email"
                                    placeholder="<?php echo e(__('')); ?>Enter your email">
                                <span class="  text-white h6 span-error-email"></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Phone:')); ?></label>
                                <input type="tel" name="phone" class="app_phone"
                                    placeholder="<?php echo e(__('Enter your phone no')); ?>">
                                <span class=" text-white  h6 span-error-phone"></span>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary appointment-modal-toggle"
                                type="button"><?php echo e(__('Close')); ?></button>
                            <button class="btn-secondary" id="makeappointment"
                                type="button"><?php echo e(__('Make Appointment')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Make Contact Popup -->
        <div class="theme-modal contact-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close make-contact-modal-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                viewBox="0 0 45 45" fill="none">
                                <path opacity="0.4"
                                    d="M37.2376 24.5509H7.76834C6.74981 24.5509 5.92651 23.7258 5.92651 22.7091C5.92651 21.6924 6.74981 20.8672 7.76834 20.8672H37.2376C38.2561 20.8672 39.0794 21.6924 39.0794 22.7091C39.0794 23.7258 38.2561 24.5509 37.2376 24.5509Z"
                                    fill="#F9D254" />
                                <path
                                    d="M15.1357 31.9183C14.6642 31.9183 14.1926 31.7378 13.8335 31.3787L6.46614 24.0114C5.74599 23.2912 5.74599 22.1271 6.46614 21.4069L13.8335 14.0396C14.5536 13.3194 15.7178 13.3194 16.4379 14.0396C17.1581 14.7598 17.1581 15.9239 16.4379 16.6441L10.3728 22.7091L16.4379 28.7742C17.1581 29.4944 17.1581 30.6585 16.4379 31.3787C16.0788 31.7378 15.6072 31.9183 15.1357 31.9183Z"
                                    fill="#F9D254" />
                            </svg>
                        </button>
                        <h5 class="modal-title"><?php echo e(__('Make Contact')); ?></h5>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?php echo e(__('Name:')); ?></label>
                                <input type="text" name="name" class="contact_name"
                                    placeholder="<?php echo e(__('Enter your name')); ?>">
                                <span class=" text-white h6 span-error-contactname"></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Email:')); ?></label>
                                <input type="email" name="email" class="contact_email"
                                    placeholder="<?php echo e(__('Enter your email')); ?>">
                                <span class=" text-white h6 span-error-contactemail"></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Phone:')); ?></label>
                                <input type="tel" name="phone" class="contact_phone"
                                    placeholder="<?php echo e(__('Enter your phone no')); ?>">
                                <span class="  text-white h6 span-error-contactphone"></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Message:')); ?></label>
                                <textarea name="message" class="contact_message" cols="30" rows="5"></textarea>
                                <span class="text-white h6 span-error-contactmessage"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary make-contact-modal-toggle"
                                type="button"><?php echo e(__('Close')); ?></button>
                            <button class="btn-secondary" id="makecontact"
                                type="button"><?php echo e(__('Make Contact')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="theme-modal" id="passwordmodel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Password')); ?></h5>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?php echo e(__('Password:')); ?></label>
                                <input type="password" name="Password" class="password_val"
                                    placeholder="<?php echo e(__('Enter password')); ?>">
                                <span class="text-danger text-white h6 span-error-password"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary password-submit"
                                type="button"><?php echo e(__('Submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
        <div class="theme-modal" id="gallerymodel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close close-model">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                viewBox="0 0 45 45" fill="none">
                                <path opacity="0.4"
                                    d="M37.2376 24.5509H7.76834C6.74981 24.5509 5.92651 23.7258 5.92651 22.7091C5.92651 21.6924 6.74981 20.8672 7.76834 20.8672H37.2376C38.2561 20.8672 39.0794 21.6924 39.0794 22.7091C39.0794 23.7258 38.2561 24.5509 37.2376 24.5509Z"
                                    fill="#F9D254" />
                                <path
                                    d="M15.1357 31.9183C14.6642 31.9183 14.1926 31.7378 13.8335 31.3787L6.46614 24.0114C5.74599 23.2912 5.74599 22.1271 6.46614 21.4069L13.8335 14.0396C14.5536 13.3194 15.7178 13.3194 16.4379 14.0396C17.1581 14.7598 17.1581 15.9239 16.4379 16.6441L10.3728 22.7091L16.4379 28.7742C17.1581 29.4944 17.1581 30.6585 16.4379 31.3787C16.0788 31.7378 15.6072 31.9183 15.1357 31.9183Z"
                                    fill="#F9D254" />
                            </svg>
                        </button>
                        <h5 class="modal-title"><?php echo e(__('Gallary')); ?></h5>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?php echo e(__('Image preview:')); ?></label>
                                <img src="" class="imagepreview" style="width: 500px; height: 300px;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary close-model" type="button"><?php echo e(__('Close')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
        <div class="theme-modal" id="videomodel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close close-model1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                viewBox="0 0 45 45" fill="none">
                                <path opacity="0.4"
                                    d="M37.2376 24.5509H7.76834C6.74981 24.5509 5.92651 23.7258 5.92651 22.7091C5.92651 21.6924 6.74981 20.8672 7.76834 20.8672H37.2376C38.2561 20.8672 39.0794 21.6924 39.0794 22.7091C39.0794 23.7258 38.2561 24.5509 37.2376 24.5509Z"
                                    fill="#F9D254" />
                                <path
                                    d="M15.1357 31.9183C14.6642 31.9183 14.1926 31.7378 13.8335 31.3787L6.46614 24.0114C5.74599 23.2912 5.74599 22.1271 6.46614 21.4069L13.8335 14.0396C14.5536 13.3194 15.7178 13.3194 16.4379 14.0396C17.1581 14.7598 17.1581 15.9239 16.4379 16.6441L10.3728 22.7091L16.4379 28.7742C17.1581 29.4944 17.1581 30.6585 16.4379 31.3787C16.0788 31.7378 15.6072 31.9183 15.1357 31.9183Z"
                                    fill="#F9D254" />
                            </svg>
                        </button>
                        <h5 class="modal-title"><?php echo e(__('Gallary')); ?></h5>
                    </div>
                    <form action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?php echo e(__('Video preview:')); ?></label>
                                <iframe width="100%" height="360" class="videopreview" src=""
                                    frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary close-model1" type="button"><?php echo e(__('Close')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        

    </div>
    <script src="<?php echo e(asset('custom/theme5/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/theme5/js/slick.min.js')); ?>" defer="defer"></script>
    <?php if($SITE_RTL == 'on'): ?>
        <script src="<?php echo e(asset('custom/theme5/js/rtl-custom.js')); ?>" defer="defer"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('custom/theme5/js/custom.js')); ?>" defer="defer"></script>
    <?php endif; ?>

    <script src="<?php echo e(asset('custom/js/jquery.qrcode.min.js')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.date.js"></script>
    <script src="<?php echo e(asset('custom/js/emojionearea.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/socialSharing.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/socialSharing.min.js')); ?>"></script>
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


        function downloadURI(uri, name) {
            var link = document.createElement("a");
            link.download = name;
            link.href = uri;
            R
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
        };


        $(document).ready(function() {
            $(".emojiarea").emojioneArea();
            $(`.span-error-date`).text("");
            $(`.span-error-time`).text("");
            $(`.span-error-name`).text("");
            $(`.span-error-email`).text("");
            $(`.span-error-contactname`).text("");
            $(`.span-error-contactemail`).text("");
            $(`.span-error-contactphone`).text("");
            $(`.span-error-contactmessage`).text("");


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
        $(`#makeappointment`).click(function() {
            var name = $(`.app_name`).val();
            var email = $(`.app_email`).val();
            var date = $(`.datepicker_min`).val();
            var phone = $(`.app_phone`).val();
            // var time = $("input[type='radio']:checked").data('id');
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
            $(`.span-error-date`).text("");
            $(`.span-error-time`).text("");
            $(`.span-error-name`).text("");
            $(`.span-error-email`).text("");

            if (date == "") {

                $(`.span-error-date`).text("<?php echo e(__('*Please choose date')); ?>");
                $(".close-search1").trigger({
                    type: "click"
                });
                // } else if (document.querySelectorAll('.app_time').length < 1) {
            } else if (document.querySelectorAll('input[type="radio"][name="time"]:checked').length < 1) {

                $(`.span-error-time`).text("<?php echo e(__('*Please choose time')); ?>");
                $(".close-search1").trigger({
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
                    },
                    success: function(data) {
                        if (data.flag == false) {
                            $(".close-search1").trigger({
                                type: "click"
                            });
                            show_toastr('Error', data.msg, 'error');

                        } else {
                            $(".close-search1").trigger({
                                type: "click"
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
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
                        $(".make-contact-modal-toggle").trigger({
                            type: "click"
                        });
                        show_toastr('Success', "<?php echo e(__('Your contact details has been noted.')); ?>",
                            'success');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    }
                });
            }
        });
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
                    template: '<div class="alert theme-toaster theme-toaster-success alert-{0} alert-icon theme-toaster-danger  theme-toaster-success  alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                 let myVar = <?php echo json_encode($a, 15, 512) ?>;
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
</body>

</html>
<?php /**PATH /home/vcard/public_html/resources/views/card/theme5/index.blade.php ENDPATH**/ ?>