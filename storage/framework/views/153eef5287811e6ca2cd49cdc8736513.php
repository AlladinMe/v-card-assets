<?php
    $category_path = \App\Models\Utility::get_file('category');
?>
<?php echo e(Form::model($categoryData, ['route' => ['category.update', $categoryData->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

<div class="row">
    <div class="form-group col-12">
        <?php echo e(Form::label('name', __('Category Name'), ['class' => 'form-label'])); ?>

        <?php echo Form::text('name',null, ['class' => 'form-control ', 'required' => 'required','placeholder'=>'Category Name']); ?>

        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-role" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-12 form-group img-validate-class">
        <?php echo e(Form::label('category_image', __('Category Logo'), ['class' => 'form-label'])); ?>

        <div class="choose-files">
            <label for="cat_logo">
                <div class=" bg-primary company_logo_update" style="cursor: pointer;"> <i
                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>

                <input type="file" class="form-control file d-none file-validate" id="cat_logo" name="category_image"
                    data-filename="profiles"
                    onchange="document.getElementById('category_icon').src = window.URL.createObjectURL(this.files[0])">
            </label>
            <p class="file-error text-danger" style=""></p>
        </div>
        <div class="border col-md-4 mt-2">

            <?php
            $imagePath = $category_path . '/' . $categoryData->logo;
            $headers = @get_headers($imagePath);
            ?>
            <?php if($headers && strpos($headers[0], '200')): ?>
                <img class="img_categorys_fix_size"
                    src="<?php echo e(!empty($categoryData->logo) ? $category_path . '/' . $categoryData->logo : asset('custom/img/placeholder-image21.jpg')); ?>"
                    id="category_icon" width="100%" height="100%" />
            <?php elseif(empty($categoryData->logo) ): ?>
            <img class="img_categorys_fix_size"
            src="<?php echo e(!empty($categoryData->logo) ? $category_path . '/' . $categoryData->logo : asset('custom/img/placeholder-image21.jpg')); ?>"
            id="category_icon" width="100%" height="100%" />
            <?php else: ?>
                <div class="category-card-img">
                    <img src="<?php echo e(asset('custom/category/category' . $categoryData->id . '.png')); ?>"
                        class="rounded img2" id="category_icon" />
                </div>
            <?php endif; ?>

        </div>
        
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Update')); ?>">
</div>
<?php echo e(Form::close()); ?>




<?php /**PATH /home/vcard/public_html/resources/views/business_category/edit.blade.php ENDPATH**/ ?>