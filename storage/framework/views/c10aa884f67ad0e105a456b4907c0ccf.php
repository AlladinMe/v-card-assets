<div class="row pb-2">
  
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('User')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($campaigns->users->name); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Category')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
               <?php echo e($campaigns->categories->name); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Business')); ?></b></div>
        </div>
         <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($campaigns->businesses->title); ?>

            </p>
        </div>
      
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Start Date')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($campaigns->start_date); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('End Date')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($campaigns->end_date); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Total Days')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($campaigns->total_days); ?>

            </p>
        </div>
    </div>

    
</div>

<div class="modal-footer p-0 pt-3">
    <a href="<?php echo e(route('change.status.campaigns', [$campaigns->id, 1])); ?>" class="btn btn-success btn-xs">
        <?php echo e(__('Approve')); ?>

    </a>
    <a href="<?php echo e(route('change.status.campaigns', [$campaigns->id, 2])); ?>" class="btn btn-danger btn-xs">
        <?php echo e(__('Decline')); ?>

    </a>

</div>
<?php /**PATH /home/vcard/public_html/resources/views/campaigns/view.blade.php ENDPATH**/ ?>