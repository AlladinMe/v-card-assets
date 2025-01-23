<?php echo e(Form::open(array('route' => array('store.language')))); ?>

<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('code', __('Language Code'), array('class' => 'form-label'))); ?>

        <?php echo e(Form::text('code', '', array('class' => 'form-control','required'=>'required','placeholder'=>'Enter Language Code'))); ?>

        <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-code" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="form-group col-md-12">
        <?php echo e(Form::label('fullName', __('Language Name'), array('class' => 'form-label'))); ?>

        <?php echo e(Form::text('fullName', '', array('class' => 'form-control','required'=>'required','placeholder'=>'Enter Language Name'))); ?>

        <?php $__errorArgs = ['fullName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-code" role="alert">
            <strong class="text-danger"><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
    <div class="modal-footer p-0 pt-3">
        <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <input class="btn btn-primary" type="submit" value="<?php echo e(__('Create')); ?>">
    </div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/vcard/public_html/resources/views/lang/create.blade.php ENDPATH**/ ?>