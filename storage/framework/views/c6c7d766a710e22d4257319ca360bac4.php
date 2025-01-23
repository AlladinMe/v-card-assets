<?php
    $languages = App\Models\Utility::languages();
    $logo = asset(Storage::url('uploads/logo/'));
    $company_logo = Utility::getValByName('company_logo');
    $settings = App\Models\Utility::settings();
    $recaptcha = \App\Models\Utility::setCaptchaConfig();
    $landingpage_settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $route = isset($plan) && $plan->id  ? 'assign-plan-with-registration' : 'register';
    $ref = request()->route('ref_id') ?? 0;
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('language-bar'); ?>
    <div class="lang-dropdown-only-desk">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="drp-text"> <?php echo e($languages[$lang]); ?>

                </span>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($plan)): ?>
                <a href="<?php echo e(route('register.with.plan', [$plan->id, $ref, $code])); ?>" tabindex="0"
                    class="dropdown-item <?php echo e($code == $lang ? 'active' : ''); ?> ">
                    <span><?php echo e(Str::ucFirst($language)); ?></span>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('register', [$ref, $code])); ?>" tabindex="0"
                    class="dropdown-item <?php echo e($code == $lang ? 'active' : ''); ?> ">
                    <span><?php echo e(Str::ucFirst($language)); ?></span>
                </a>
            <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </li>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <?php if($settings['RECAPTCHA_MODULE'] == 'yes'): ?>
        <?php if(isset($settings['RECAPTCHA_VERSION']) && $settings['RECAPTCHA_VERSION'] == 'v2'): ?>
            <?php echo NoCaptcha::renderJs(); ?>

        <?php else: ?>
            <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e($settings['NOCAPTCHA_SITEKEY']); ?>"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    grecaptcha.ready(function() {
                        grecaptcha.execute('<?php echo e($settings['NOCAPTCHA_SITEKEY']); ?>', {
                            action: 'submit'
                        }).then(function(token) {
                            document.getElementById('g-recaptcha-response').value = token;
                        });
                    });
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600"><?php echo e(__('Register')); ?></h2>
        </div>
        <?php echo e(Form::open(['route' => $route, 'method' => 'post', 'id' => 'loginForm'])); ?>

        <div class="custom-login-form">
            <?php if(session('status')): ?>
                <div class="mb-4 text-lg font-medium text-green-600 text-danger">
                    <?php echo e(__('Email SMTP settings does not configured so please contact to your site admin.')); ?>

                </div>
            <?php endif; ?>
            <div class="mb-3 form-group">
                <label class="form-label"><?php echo e(__('Full Name')); ?></label>
                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Name')])); ?>

                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error invalid-name text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <?php if(isset($plan->id)): ?>
            <input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
             <?php endif; ?>
            <div class="mb-3 form-group">
                <label class="form-label"><?php echo e(__('Email')); ?></label>
                <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')])); ?>

                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error invalid-email text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3 form-group">
                <label class="form-label"><?php echo e(__('Password')); ?></label>
                <?php echo e(Form::password('password', ['class' => 'form-control', 'id' => 'input-password', 'placeholder' => __('Enter Your Password')])); ?>


                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error invalid-password text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label class="form-label"><?php echo e(__('Confirm Password')); ?></label>
                <?php echo e(Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'confirm-input-password', 'placeholder' => __('Confirm Your Password')])); ?>


                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error invalid-password_confirmation text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <?php if($settings['RECAPTCHA_MODULE'] == 'yes'): ?>
                <?php if(isset($settings['RECAPTCHA_VERSION']) && $settings['RECAPTCHA_VERSION'] == 'v2'): ?>
                    <div class="mt-3 form-group col-lg-12 col-md-12">
                        <?php echo NoCaptcha::display($settings['cust_darklayout'] == 'on' ? ['data-theme' => 'dark'] : []); ?>

                        <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="small text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                <?php else: ?>
                    <div class="mt-3 form-group col-lg-12 col-md-12">
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" class="form-control">
                        <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error small text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="form-check custom-checkbox">
                <input type="checkbox" class="form-check-input" id="termsCheckbox" name="terms" required="">
                <label class="text-sm form-check-label" for="termsCheckbox"><?php echo e(__('Sunt de acord cu')); ?>

                    <?php if($landingpage_settings['menubar_status'] == 'on'): ?>
                        <?php if(is_array(json_decode($landingpage_settings['menubar_page'])) ||
                                is_object(json_decode($landingpage_settings['menubar_page']))): ?>
                            <?php $__currentLoopData = json_decode($landingpage_settings['menubar_page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value->menubar_page_name == 'Termeni si conditii'): ?>
                                    <?php if(isset($value->login) &&
                                            $value->login == 'on' &&
                                            (isset($value->template_name) && $value->template_name == 'page_content')): ?>
                                        <a class="" target="_blank"
                                            href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo e($value->menubar_page_name); ?></a>
                                    <?php elseif(isset($value->login) &&
                                            $value->login == 'on' &&
                                            (isset($value->template_name) && $value->template_name == 'page_url')): ?>
                                        <a class="" target="_blank"
                                            href="<?php echo e($value->page_url); ?>"><?php echo e($value->menubar_page_name); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo e(__('si cu')); ?>

                    <?php if($landingpage_settings['menubar_status'] == 'on'): ?>
                        <?php if(is_array(json_decode($landingpage_settings['menubar_page'])) ||
                                is_object(json_decode($landingpage_settings['menubar_page']))): ?>
                            <?php $__currentLoopData = json_decode($landingpage_settings['menubar_page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value->menubar_page_name == 'Politica de confidentialitate'): ?>
                                    <?php if(isset($value->login) &&
                                            $value->login == 'on' &&
                                            (isset($value->template_name) && $value->template_name == 'page_content')): ?>
                                        <a class="" target="_blank"
                                            href="<?php echo e(route('custom.page', $value->page_slug)); ?>"><?php echo e($value->menubar_page_name); ?></a>
                                    <?php elseif(isset($value->login) &&
                                            $value->login == 'on' &&
                                            (isset($value->template_name) && $value->template_name == 'page_url')): ?>
                                        <a class="" target="_blank"
                                            href="<?php echo e($value->page_url); ?>"><?php echo e($value->menubar_page_name); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endif; ?>




                </label>
            </div>
            <div class="d-grid">
                <button class="mt-2 btn btn-primary btn-block"><?php echo e(__('Register')); ?></button>
            </div>
            <?php if(Utility::getValByName('signup_button') == 'on'): ?>
                <p class="my-4 text-center"><?php echo e(__('Already have an account?')); ?>

                    <a href="<?php echo e(route('login', $lang)); ?>" tabindex="0"><?php echo e(__('Login')); ?></a>
                </p>
            <?php endif; ?>
            <input type="hidden" name="referral_code" class="referral_code" value="<?php echo e($ref); ?>" />
        </div>
        <?php echo e(Form::close()); ?>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>