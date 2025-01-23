<?php
    $nfcImage = \App\Models\Utility::get_file('nfc/order_card_logo');
    $admin_payment_setting = Utility::getAdminPaymentSetting();
?>
<div class="row pb-2">
    <div class="row">
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Order ID')); ?>test</b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->order_id); ?>

            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Company Name')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->company_name); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('NFC Card Name')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->nfc_card_name); ?>

            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Business Name')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->business_name); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Designation')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->designation); ?>

            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Phone No')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->phoneno); ?>

            </p>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Email')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->email); ?>

            </p>
        </div>


        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Shipping Address')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->shipping_address); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Order Status')); ?></b></div>
            <p class="mb-4">
                <?php echo e(ucFirst($orderRequest->status)); ?>

            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Payment Type')); ?></b></div>
            <p class="mb-4">
                <?php echo e(__('Manually')); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Quantity')); ?></b></div>
            <p class="mb-4">
                <?php echo e($orderRequest->quantity); ?>

            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label"><b><?php echo e(__('Total Price')); ?></b></div>
            <p class="mb-4">
                <?php echo e(!empty($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$'); ?><?php echo e($orderRequest->price); ?>

            </p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-control-label"><b><?php echo e(__('Card Logo')); ?></b></div>
        </div>
        <div class="col-12 ">
            <div class="avatar-parent-child mb-3">
                <img class="" style="width: 200px;"
                    src="<?php echo e(isset($orderRequest->card_logo) && !empty($orderRequest->card_logo) ? $nfcImage . '/' . $orderRequest->card_logo : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                    alt="">
            </div>

        </div>
    </div>



</div>

<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>

</div>
<?php /**PATH /home/vcard/public_html/resources/views/nfc/orderview.blade.php ENDPATH**/ ?>