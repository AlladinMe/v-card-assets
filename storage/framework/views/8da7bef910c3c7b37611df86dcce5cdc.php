<?php echo e(Form::open(['route' => ['request.amount.store', $user->id], 'method' => 'post'])); ?>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('request_amount', __('Request Amount'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('request_amount', $user->commission_amount-$paidAmount, ['class' => 'form-control', 'placeholder' => __('Enter Request Amount'), 'required' => 'required'])); ?>

        </div>
    </div>
</div>



<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Send')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home/vcard/public_html/resources/views/referral/request_amount.blade.php ENDPATH**/ ?>