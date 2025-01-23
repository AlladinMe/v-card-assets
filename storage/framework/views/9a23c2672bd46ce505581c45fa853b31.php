<?php
    $chatgpt_setting = App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());
?>
<?php echo e(Form::open(['url' => 'coupons', 'method' => 'post'])); ?>

<?php if(isset($chatgpt_setting['chatgpt_key']) && !empty($chatgpt_setting['chatgpt_key'])): ?>
    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
        data-bs-placement="top">
        <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
            data-url="<?php echo e(route('generate', ['coupon'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

        </a>
    </div>
<?php endif; ?>
<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'required' => 'required', 'placeholder' => 'Enter Coupon Name'])); ?>

    </div>

    <div class="form-group col-md-12">
        <?php echo e(Form::label('type', __('type'), ['class' => 'form-label'])); ?>

        <?php echo Form::select('type', $couponType, null, [
            'class' => 'form-control select2',
            'required' => 'required',
            'onchange' => 'updateLabelDicount()',
        ]); ?>

    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('Minimum spend', __('Minimum spend'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('minimum_spend', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

    </div>

    <div class="form-group col-md-6">
        <?php echo e(Form::label('Maximum spend', __('Maximum spend'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('maximum_spend', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

    </div>

    <div class="form-group col-md-6">
        <?php echo e(Form::label('discount', __('Discount'), ['class' => 'form-label discount-label'])); ?>

        <?php echo e(Form::label('amount', __('Amount'), ['class' => 'form-label amount-label d-none'])); ?>

        <?php echo e(Form::number('discount', null, ['class' => 'form-control discount-input', 'required' => 'required', 'step' => '0.01', 'placeholder' => 'Enter Discount'])); ?>

      </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('limit', __('Usage limit per coupon'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('limit', null, ['class' => 'form-control', 'required' => 'required'])); ?>

    </div>

    <div class="form-group col-md-6">
        <?php echo e(Form::label('coupon_limit_user', __('Usage limit per user'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('per_user_limit', null, ['class' => 'form-control', 'required' => 'required'])); ?>

    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('coupon_expiry_date', __('Expiry Date'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::date('expiry_date', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'coupon_expiry_date'])); ?>

    </div>
    <div class="form-group col-md-12">
        <?php echo e(Form::label('code', __('Code'), ['class' => 'form-label'])); ?>

        <div class="d-flex radio-check">
            <div class="form-check  form-check-inline">
                <input type="radio" id="flexCheckChecked" value="manual" name="icon-input"
                    class="form-check-input code" checked="checked">
                <label class=" form-control-label" for="flexCheckChecked"><?php echo e(__('Manual')); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="flexCheckChecked1" value="auto" name="icon-input"
                    class="form-check-input code">
                <label class=" form-control-label" for="flexCheckChecked1"><?php echo e(__('Auto Generate')); ?></label>
            </div>
        </div>
    </div>
    <div class="form-group col-md-12 d-block" id="manual">
        <input class="form-control font-uppercase" name="manualCode" type="text" placeholder="Coupon Code">
    </div>
    <div class="form-group col-md-12 d-none" id="auto">
        <div class="row">
            <div class="input-group">
                <input class="form-control" name="autoCode" type="text" id="auto-code">
                <button class="btn btn-outline-secondary " id="code-generate" type="button"><i
                        class="fas fa-history"></i></button>
            </div>
        </div>
    </div>
    <div class="form-group col-md-4">
        <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

        <div class="form-check form-switch custom-switch-v1 float-end">
            <input type="checkbox" name="is_active" class="form-check-input input-primary is_active" value="1"
                data-name="plan">
            <label class="form-check-label" for="is_active"></label>
        </div>
    </div>

</div>
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Create')); ?>">
</div>
<?php echo e(Form::close()); ?>

<script>
    function updateLabelDicount() {
        const selectedType = document.getElementById('type').value;
        const discountLabel = document.querySelector('.discount-label');
        const amountLabel = document.querySelector('.amount-label');
        const discountInput = document.querySelector('.discount-input');

        if (selectedType === 'flat') {
            discountLabel.classList.add('d-none');
            amountLabel.classList.remove('d-none');
            discountInput.placeholder = 'Enter Amount';
        } else {
            discountLabel.classList.remove('d-none');
            amountLabel.classList.add('d-none');
            discountInput.placeholder = 'Enter Discount (%)';
        }
    }

    // Call updateLabelDicount on page load
    updateLabelDicount();
</script>
<?php /**PATH /home/vcard/public_html/resources/views/coupon/create.blade.php ENDPATH**/ ?>