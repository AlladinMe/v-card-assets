<?php echo e(Form::open(array('route' => 'faq_store', 'method'=>'post', 'enctype' => "multipart/form-data"))); ?>

    <div class="modal-body">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('question', __('Question'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('faq_questions',null, ['class' => 'form-control ', 'placeholder' => __('Enter Question')])); ?>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('answer', __('Answer'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::textarea('faq_answer', null, ['class' => 'form-control summernote', 'placeholder' => __('Enter Answer'), 'id'=>'mytextarea'])); ?>

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
<?php /**PATH /home/vcard/public_html/Modules/LandingPage/Resources/views/landingpage/faq/create.blade.php ENDPATH**/ ?>