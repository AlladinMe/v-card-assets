<?php
    $nfcImage = \App\Models\Utility::get_file('nfc/card_image');

    $users = \Auth::user();
?>
<?php echo e(Form::model($nFCCardData, ['route' => ['nfc.update', $nFCCardData->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

<div class="row">

    <div class="col-12 form-group">
        <?php echo e(Form::label('NFC Card Name', __('NFC Card Name'), ['class' => 'form-control-label'])); ?>

        <?php echo e(Form::text('nfc_card_name', $nFCCardData->card_name, ['class' => 'form-control mt-2', 'placeholder' => __('Enter NFC Card Name')])); ?>

        <?php $__errorArgs = ['nfc_card_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="col-12 form-group">
        <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('price', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Price'), 'min' => '1', 'step' => '0.01'])); ?>

        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="col-12 form-group img-validate-class">
        <?php echo e(Form::label('card_images', __('Card Image'), ['class' => 'form-label'])); ?>

        <div class="choose-files">
            <label for="avatar">
                <div class=" bg-primary company_logo_update" style="cursor: pointer;"> <i
                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>

                <input type="file" class="form-control file d-none file-validate" id="avatar" name="nfc_image"
                    data-filename="profiles"
                    onchange="document.getElementById('nfc_image').src = window.URL.createObjectURL(this.files[0])">
            </label>
            <p class="file-error text-danger" style=""></p>
        </div>
        <div class="border col-md-4 mt-2">
            <?php
            $imagePath = $nfcImage . '/' . $nFCCardData->image;
            
            $headers = @get_headers($imagePath);
            
            ?>
            <?php if($headers && strpos($headers[0], '200')): ?>
                <img src="<?php echo e(isset($nFCCardData->image) && !empty($nFCCardData->image) ? $nfcImage . '/' . $nFCCardData->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                    id="nfc_image" width="100%" />
            <?php else: ?>
                <img style="width: 300px;height: 200px;" class="rounded"
                    src="<?php echo e(asset('custom/nfcimg/nfc' . $nFCCardData->id . '.png')); ?>" alt="">
            <?php endif; ?>
        </div>
        
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Update')); ?>">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/vcard/public_html/resources/views/nfc/edit.blade.php ENDPATH**/ ?>