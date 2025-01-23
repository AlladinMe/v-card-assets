<?php
    $dir = asset(Storage::url('uploads/plan'));
    $admin_payment_setting = Utility::getAdminPaymentSetting();

?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plans')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create plan')): ?>
        <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
            data-bs-placement="top">
            <?php if(App\Models\Utility::getPaymentIsOn() && \Auth::user()->type == 'super admin'): ?>
                <a href="#" data-size="lg" data-url="<?php echo e(route('plans.create')); ?>" data-ajax-popup="true"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Plan')); ?>"
                    class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Plans')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="plan_card">
                    <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="card-body">
                            <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>
                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                <div class="d-flex flex-row-reverse m-0 p-0 ">
                                    <span class="d-flex align-items-center ">
                                        <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                        <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit plan')): ?>
                                    <div class="row d-flex  ">
                                        <div class="col-6 text-start">
                                            <div class="action-btn  ms-2">
                                                <?php if($plan->id != 1): ?>
                                                    <div class="form-check form-switch custom-switch-v1 float-end">
                                                        <input type="checkbox" name="plan_active"
                                                            class="form-check-input input-primary is_plan_active" value="1"
                                                            data-id="<?php echo e($plan->id); ?>" data-name="plan"
                                                            <?php echo e($plan->is_plan_enable == 'on' ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="plan_active"></label>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="action-btn bg-primary ms-2">
                                                <a data-url="<?php echo e(route('plans.edit', $plan->id)); ?>" data-size="lg"
                                                    data-ajax-popup="true" data-bs-placement="top" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>"
                                                    data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Edit')); ?>"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            </div>

                                            <?php if($plan->id != 1): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="#"
                                                        class="bs-pass-para mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($plan->id); ?>"
                                                        title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"><span class="text-white"><i
                                                                class="ti ti-trash"></i></span></a>
                                                </div>
                                                <?php echo Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['plans.destroy', $plan->id],
                                                    'id' => 'delete-form-' . $plan->id,
                                                ]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span class="mb-4 p-price m"><span
                                    style="font-weight: 600"><?php echo e(!empty($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?><?php echo e($plan->price); ?></span><small
                                    class="text-sm"><?php echo e(__('/ Duration : ') . __(ucfirst($plan->duration))); ?></small></span>
                            <p class="mb-0">
                                <?php echo e('Free Trial Day : '); ?><?php echo e($plan->trial_day); ?>

                            </p>
                            <p class="mb-0">
                                <?php echo e($plan->description); ?>

                            </p>




                            <ul class="list-unstyled my-4">
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    <?php echo e(count($plan->getThemes())); ?> <?php echo e(__('Themes')); ?>

                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    <?php echo e($plan->business == '-1' ? 'Unlimited' : $plan->business); ?> <?php echo e(__('Business')); ?>

                                </li>
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    <?php echo e($plan->max_users == '-1' ? 'Unlimited' : $plan->max_users); ?> <?php echo e(__('Users')); ?>

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
                                        <span class="text-danger"> <?php echo e(__('Sub Domain')); ?></span>

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
                                        <span class="text-danger"><?php echo e(__('Progressive Web App (PWA)')); ?></span>
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
                                
                                <?php if($plan->programari == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Programari')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Programari')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Informatii contact')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Informatii contact')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Testimoniale clienti')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Testimoniale clienti')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Social media')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Social media')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->servicii == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Servicii')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Servicii')); ?></span>
                                    </li>
                                <?php endif; ?>

<?php if($plan->produse == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Produse')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Produse')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->google_map == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Google map')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Google map')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Cookie editor')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Cookie editor')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->setari_plata == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Setari de plata')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Setari de plata')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Coduri QR profil')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Coduri QR profil')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Card NFC personalizabil')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Card NFC personalizabil')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Card recenzii google')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Card recenzii google')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->toate == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Campanii de afiliere')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Campanii de afiliere')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->eliminare_copyright == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Eliminare copyright NFC card')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Eliminare copyright NFC card')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->custom_html == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('HTML customizabil')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('HTML customizabil')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->mobile_app == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Link aplicatii mobile')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Link aplicatii mobile')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->galerie == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Galerie')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Galerie')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->custom_css == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('CSS customizabil')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('CSS customizabil')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->custom_js == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('JS customizabil')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('JS customizabil')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->seo == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('SEO')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('SEO')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->setari_plata == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Setari plata')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Setari plata')); ?></span>
                                    </li>
                                <?php endif; ?>
<?php if($plan->reduceri_parteneri == 'on'): ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Reduceri la parteneri')); ?>

                                    </li>
                                <?php else: ?>
                                    <li>
                                        <span class="theme-avtar">
                                            <i data-feather="x" class="text-danger"></i></span>
                                        <span class="text-danger"><?php echo e(__('Reduceri la parteneri')); ?></span>
                                    </li>
                                <?php endif; ?>
                                
                                
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        <?php echo e(__('Support')); ?> : <?php echo e($plan->support); ?>

                                    </li>
                                
                                
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i>
                                    </span>
                                    <?php echo e($plan->storage_limit); ?> <?php echo e(__('MB Storage Limit')); ?>

                                </li>
                                <?php if($plan->module): ?>
                                    <h6 class="text-muted"><?php echo e(__('Add On')); ?></h6>
                                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $id = strtolower(preg_replace('/\s+/', '_', $module->getName()));
                                            $path = $module->getPath() . '/module.json';
                                            $json = json_decode(file_get_contents($path), true);
                                            $plan_modules = explode(',', $plan->module);
                                        ?>
                                        <?php if(!isset($json['display']) || $json['display'] == true): ?>
                                            <?php if($module->getName() != 'LandingPage'): ?>
                                                <?php if(in_array($module->getName(), $plan_modules)): ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                                        <?php echo e(\App\Models\Utility::Module_Alias_Name($module)); ?>

                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <span class="theme-avtar">
                                                            <i data-feather="x" class="text-danger"></i></span>
                                                        <?php echo e(\App\Models\Utility::Module_Alias_Name($module)); ?>

                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->trial_expire_date): ?>
                                <?php if(
                                    (\Auth::user()->type == 'company' && \Auth::user()->is_trial_plan == $plan->id) ||
                                        \Auth::user()->plan_expire_date > date('Y-m-d')): ?>
                                    <p class="plan-expired text-dark mb-0">
                                        <?php echo e(__('Plan Trial Expired : ')); ?>

                                        <?php echo e(!empty(\Auth::user()->trial_expire_date) ? \Auth::user()->dateFormat(\Auth::user()->trial_expire_date) : 'lifetime'); ?>

                                    </p>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                    <?php if(\Auth::user()->plan_expire_date < date('Y-m-d')): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('buy plan')): ?>
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-8">
                                                    <div class="d-grid text-center">
                                                        <a href="<?php echo e(route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                                            class="btn  btn-primary d-flex justify-content-center align-items-center "><?php echo e(__('Subscribe')); ?>

                                                            <i class="fas fa-arrow-right m-1"></i></a>
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <?php if($plan->id != 1): ?>
                                                    <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                                        <div class="col-4">
                                                            <a href="<?php echo e(route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>"
                                                                class="btn btn-primary btn-icon btn-md"
                                                                data-title="<?php echo e(__('Send Request')); ?>" data-bs-placement="top"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="<?php echo e(__('Send Request')); ?>"
                                                                data-toggle="tooltip">
                                                                <span class="btn-inner--icon"><i
                                                                        class="ti ti-arrow-forward-up"></i></span>
                                                            </a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="col-4">
                                                            <a href="<?php echo e(route('request.cancel', \Auth::user()->id)); ?>"
                                                                class="btn btn-icon  btn-danger btn-md"
                                                                data-bs-placement="top" data-bs-toggle="tooltip"
                                                                data-bs-original-title="<?php echo e(__('Cancel Request')); ?>">
                                                                <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="plan-expired text-dark mb-0">
                                            <?php echo e(__('Plan Expired : ')); ?>

                                            <?php echo e(!empty(\Auth::user()->plan_expire_date) ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date) : 'lifetime'); ?>

                                        </p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="row d-flex justify-content-between">
                                <div class="col-12  pb-1">
                                    <?php if($plan->is_trial == 'on' && \Auth::user()->type != 'super admin'): ?>
                                        <?php if(\Auth::user()->is_trial_plan == 0 && \Auth::user()->trial_expire_date == null && \Auth::user()->plan != $plan->id): ?>
                                            <div class="d-grid text-center">
                                                <a href="<?php echo e(route('trial.period', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                                    class="btn btn-primary btn-md d-flex justify-content-center align-items-center"><?php echo e(__('Start Trial Days')); ?></a>
                                                <p></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-between">
                                <div class="col-8">
                                    <?php if(
                                        \Auth::user()->type == 'company' &&
                                            (empty(\Auth::user()->plan_expire_date) || \Auth::user()->plan_expire_date < date('Y-m-d'))): ?>
                                        <?php if(App\Models\Utility::getPaymentIsOn()): ?>
                                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan != $plan->id): ?>
                                                <?php if($plan->price > 0): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('buy plan')): ?>
                                                        <div class="d-grid text-center">
                                                            <a href="<?php echo e(route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                                                class="btn  btn-primary d-flex justify-content-center align-items-center "><?php echo e(__('Subscribe')); ?>

                                                                <i class="fas fa-arrow-right m-1"></i></a>
                                                            <p></p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(App\Models\Utility::getPaymentIsOn()): ?>
                                            <?php if($plan->id != \Auth::user()->plan && \Auth::user()->type == 'company'): ?>
                                                <?php if($plan->price > 0): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('buy plan')): ?>
                                                        <div class="d-grid text-center">
                                                            <a href="<?php echo e(route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                                                class="btn btn-primary btn-md d-flex justify-content-center align-items-center"><?php echo e(__('Subscribe')); ?>

                                                                <i class="ti ti-arrow-right ms-1"></i></a>
                                                            <p></p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if(\Auth::user()->type != 'super admin' && \Auth::user()->plan != $plan->id): ?>
                                    <?php if($plan->id != 1): ?>
                                        <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                            <div class="col-4">
                                                <a href="<?php echo e(route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>"
                                                    class="btn btn-primary btn-icon btn-md"
                                                    data-title="<?php echo e(__('Send Request')); ?>" data-bs-placement="top"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Send Request')); ?>"
                                                    data-toggle="tooltip">
                                                    <span class="btn-inner--icon"><i
                                                            class="ti ti-arrow-forward-up"></i></span>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-4">
                                                <a href="<?php echo e(route('request.cancel', \Auth::user()->id)); ?>"
                                                    class="btn btn-icon  btn-danger btn-md" data-bs-placement="top"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Cancel Request')); ?>">
                                                    <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script>
        $(document).on("click", ".is_plan_active", function() {
            var id = $(this).attr('data-id');
            var is_disable = ($(this).is(':checked')) ? $(this).val() : 0;

            $.ajax({
                url: '<?php echo e(route('plan.enable')); ?>',
                type: 'POST',
                data: {
                    "is_disable": is_disable,
                    "id": id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    if (data.is_success == true) {
                        toastrs('<?php echo e(__('Success')); ?>', data.msg, 'success');
                    } else if (data.is_success == false) {
                        toastrs('<?php echo e(__('Error')); ?>', data.msg, 'error');
                        $('.is_plan_active[data-id="' + id + '"]').prop('checked', !is_disable);
                    }
                    if (is_disable == 0) {
                        $('#link_' + id).addClass('row-disabled');
                    } else {
                        $('#link_' + id).removeClass('row-disabled');
                    }

                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/plan/index.blade.php ENDPATH**/ ?>