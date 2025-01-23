<?php echo e(Form::open(array('route' => 'testimonials_store', 'method'=>'post', 'enctype' => "multipart/form-data"))); ?>

    <div class="modal-body">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('Title', __('Title'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('testimonials_title',null, ['class' => 'form-control ', 'placeholder' => __('Enter Title')])); ?>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('Star', __('Star'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::number('testimonials_star',null, ['class' => 'form-control ', 'min'=>'1', 'max'=>'5','required'=>'required', 'placeholder' => __('Enter Star')])); ?>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('Description', __('Description'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::textarea('testimonials_description', null, ['class' => 'form-control summernote', 'placeholder' => __('Enter Description')])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('User', __('User'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('testimonials_user',null, ['class' => 'form-control ', 'placeholder' => __('Enter User Name')])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('Designation', __('Designation'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('testimonials_designation',null, ['class' => 'form-control ', 'placeholder' => __('Enter Designation')])); ?>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('User Avtar', __('User Avtar'), ['class' => 'form-label'])); ?>

                    <input type="file" name="testimonials_user_avtar" class="form-control" required="required">
                </div>
            </div>


        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
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
<?php /**PATH /home/vcard/public_html/Modules/LandingPage/Resources/views/landingpage/testimonials/create.blade.php ENDPATH**/ ?>