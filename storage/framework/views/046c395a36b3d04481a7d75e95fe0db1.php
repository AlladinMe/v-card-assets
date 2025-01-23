<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Referral Program')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Referral Program')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Referral Program')); ?>

<?php $__env->stopSection(); ?>
<?php
    $admin_payment_setting = Utility::getAdminPaymentSetting();
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#transaction" data-tab="transaction"
                                class="border-0 list-group-item list-group-item-action active tab-link"><?php echo e(__('Transaction')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#payout_request" data-tab="payout_request"
                                class="border-0 list-group-item list-group-item-action tab-link "><?php echo e(__('Payout Request')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#settings" data-tab="settings"
                                class="border-0 list-group-item list-group-item-action tab-link"><?php echo e(__('Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="transaction" class="card tab-content">
                        <div class="card-header">
                            <h5><?php echo e(__('Transaction')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> <?php echo e(__('Company Name')); ?></th>
                                            <th> <?php echo e(__('Referral Company Name')); ?></th>
                                            <th> <?php echo e(__('Plan Name')); ?></th>
                                            <th> <?php echo e(__('Plan Price')); ?></th>
                                            <th> <?php echo e(__('Comission(%)')); ?></th>
                                            <th> <?php echo e(__('Comission Amount')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $transactionDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <?php echo e(++$key); ?> </td>
                                                <td><?php echo e($transaction->getreferralUser($transaction->referral_code)); ?></td>
                                                <td><?php echo e(!empty($transaction->getUser) ? $transaction->getUser->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(!empty($transaction->getPlan) ? $transaction->getPlan->name : '-'); ?>

                                                </td>
                                                <td><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . $transaction->plan_price); ?>

                                                </td>
                                                <td><?php echo e($transaction->commission ? $transaction->commission : ''); ?>

                                                </td>
                                                <td><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . ($transaction->plan_price * $transaction->commission) / 100); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="payout_request" class="card tab-content d-none">
                        <div class="card-header">
                            <h5><?php echo e(__('Payout Request')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> <?php echo e(__('Company Name')); ?></th>
                                            <th> <?php echo e(__('Requested Date')); ?></th>
                                            <th> <?php echo e(__('Requested Amount')); ?></th>
                                            <th> <?php echo e(__('Status')); ?></th>
                                            <th> <?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $payRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <?php echo e(++$key); ?> </td>
                                                <td><?php echo e(!empty($transaction->getCompany) ? $transaction->getCompany->name : '-'); ?>

                                                </td>
                                                <td><?php echo e($transaction->date); ?></td>
                                                <td><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . $transaction->request_amount); ?>

                                                </td>
                                                <td><?php if($transaction->status == 0): ?>
                                                            <span
                                                                class="p-2 px-3 rounded status_badge badge bg-danger"><?php echo e(__(\App\Models\TransactionOrder::$status[$transaction->status])); ?></span>
                                                        <?php elseif($transaction->status == 1): ?>
                                                            <span
                                                                class="p-2 px-3 rounded status_badge badge bg-warning"><?php echo e(__(\App\Models\TransactionOrder::$status[$transaction->status])); ?></span>
                                                        <?php elseif($transaction->status == 2): ?>
                                                            <span
                                                                class="p-2 px-3 rounded status_badge badge bg-primary"><?php echo e(__(\App\Models\TransactionOrder::$status[$transaction->status])); ?></span>
                                                        <?php endif; ?>
                                                </td>
                                                <?php if($transaction->status == 1): ?>
                                                <td>
                                                    <a href="<?php echo e(route('request.amount.status', [$transaction->id, 1])); ?>"
                                                        class="btn btn-success btn-sm">
                                                        <i class="ti ti-check"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('request.amount.status', [$transaction->id, 0])); ?>"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="ti ti-x"></i>
                                                    </a>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="settings" class="text-white card tab-content d-none">
                        <?php echo e(Form::open(['url' => route('referral.store'), 'enctype' => 'multipart/form-data'])); ?>

                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <h5 class=""><?php echo e(__('Settings')); ?></h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-end" onclick="enableSettings()">
                                    <input type="hidden" name="is_comission_setting" value="off">
                                    <input type="checkbox" name="is_comission_setting" id="is_comission_setting"
                                        data-toggle="switchbutton" data-onstyle="primary" 
                                        <?php echo e(isset($referralSetting->is_enable) && $referralSetting->is_enable == 1 ? 'checked="checked"' : ''); ?>>
                                    <label class="custom-label form-label" for="is_comission_setting"></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body referralDiv <?php if(isset($referralSetting->is_enable) && $referralSetting->is_enable == 0): ?> disabledCookie <?php endif; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label h6"><?php echo e(__('Commission Percentage(%)')); ?></label>
                                        <input type="text" name="commission" class="form-control"
                                            placeholder="Enter Commission Percentage"
                                            value="<?php echo e(isset($referralSetting->commision) ? $referralSetting->commision : null); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label h6"><?php echo e(__('Minimum Threshold Amount')); ?></label>
                                        <input type="text" name="threshold_amount" class="form-control"
                                            placeholder="Enter Minimum Threshold Amount"
                                            value="<?php echo e(isset($referralSetting->threshold_amount) ? $referralSetting->threshold_amount : null); ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label h6"><?php echo e(__('GuideLines')); ?></label>
                                        <textarea class="summernote" row="10" cols="50" id="note" name="guideline"><?php echo isset($referralSetting->guidelines) ? $referralSetting->guidelines : null; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="p-1 border-0 card-footer text-end">
                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-lg btn-primary'])); ?>

                            </div>
                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>


                </div>


            </div>

            <!-- [ sample-page ] end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['list', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'unlink']],
                ],
                height: 250,
            });
        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 200,
        })

        $('.tab-link').on('click', function() {
            var tabId = $(this).data('tab');

            $('.tab-content').addClass('d-none');
            $('#' + tabId).removeClass('d-none');

            $('.tab-link').removeClass('active');
            $(this).addClass('active');
        });
    </script>
    <script type="text/javascript">
        $('.cp_link').on('click', function() {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success');
        });
    </script>
     <script type="text/javascript">
        function enableSettings() {
            const element = $('#is_comission_setting').is(':checked');
            $('.referralDiv').addClass('disabledCookie');
            if (element == true) {
                $('.referralDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.referralDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/referral/index.blade.php ENDPATH**/ ?>