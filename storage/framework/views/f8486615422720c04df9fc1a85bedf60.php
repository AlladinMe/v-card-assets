<?php echo e(Form::model(null, array('route' => array('features_update', $key), 'method' => 'POST','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Heading', __('Heading'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('other_features_heading',$other_features['other_features_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading')])); ?>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Description', __('Description'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::textarea('other_featured_description', $other_features['other_featured_description'], ['class' => 'summernote form-control', 'placeholder' => __('Enter Description')])); ?>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Buy Now Link', __('Buy Now Link'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('other_feature_buy_now_link', $other_features['other_feature_buy_now_link'], ['class' => 'form-control', 'placeholder' => __('Enter Link')])); ?>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Image', __('Image'), ['class' => 'form-label'])); ?>

                <input type="file" name="other_features_image" class="form-control">
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#commonModal').on('shown.bs.modal', function() {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['list', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'unlink']],
                ],
                height: 250,
                disableDragAndDrop: true,
            });
        });
    });
</script>
<?php /**PATH /home/vcard/public_html/Modules/LandingPage/Resources/views/landingpage/features/features_edit.blade.php ENDPATH**/ ?>