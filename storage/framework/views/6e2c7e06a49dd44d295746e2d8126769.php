<?php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Reduceri')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Reduceri')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Reduceri la parteneri')); ?></li>
<?php $__env->stopSection(); ?>
<?php
    $admin_payment_setting = Utility::getAdminPaymentSetting();
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Reduceri la parteneri')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <!-- Verificăm dacă utilizatorul este super admin înainte de a arăta butonul de adăugare reduceri -->
    <?php if(auth()->user()->type == 'super admin'): ?>
        <div class="container">
    <h2>Adaugă Reducere</h2>
    <form action="<?php echo e(route('reduceri.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
      <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    
    
    <div class="form-group">
        <label for="partener">Partener</label>
        <input type="text" name="partener" id="partener" class="form-control" value="<?php echo e(old('partener')); ?>" required>
    </div>
    <div class="form-group">
        <label for="locatie">Locație</label>
        <input type="text" name="locatie" id="locatie" class="form-control" value="<?php echo e(old('locatie')); ?>" required>
    </div>
    <div class="form-group">
        <label for="reducere">Reducere (%)</label>
        <input type="number" name="reducere" id="reducere" class="form-control" value="<?php echo e(old('reducere')); ?>" required>
    </div>
    <div class="form-group">
        <label for="start">Începe la</label>
        <input type="date" name="start" id="start" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="end">Se termină la</label>
        <input type="date" name="end" id="end" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="cod">Cod Reducere</label>
        <input type="text" name="cod" id="cod" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="website">Website</label>
        <input type="url" name="website" id="website" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="observatii">Observații</label>
        <textarea name="observatii" id="observatii" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" name="logo" id="logo" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Adaugă Reducere</button>
</form>
</div>

 <div class="text-center mt-4">
    <button class="btn btn-secondary" onclick="history.back();">
        ⬅️ Înapoi
    </button>

    <?php else: ?>
        <p>Nu aveți permisiunea de a adăuga reduceri.</p>
    <?php endif; ?>

    
    







<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/reduceri/create.blade.php ENDPATH**/ ?>