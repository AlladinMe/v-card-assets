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
 <style>
    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 400px; /* Înălțime fixă pentru toate cardurile */
    }

    .card-header {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 150px; /* Înălțimea pentru logo */
        background-color: #f0f0f0;
    }

    /* Cardurile fără logo vor folosi această clasă */
    .no-logo .card-header {
        background-color: #f0f0f0;
        border: 1px dashed #ccc;
        height: 150px; /* Dimensiuni consistente pentru carduri */
    }

    .card-header img {
        max-height: 100%;
        width: auto;
    }

    .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Iconițele pentru fiecare secțiune */
    .icon-wrapper i {
        margin-right: 10px;
        color: #007bff;
    }

    /* Iconițele de la secțiuni */
    .icon-wrapper {
        display: flex;
        align-items: center;
    }

    /* Mărirea numelui */
    .card-title {
        font-size: 20px;
        text-align: center;
        font-weight: bold;
    }

    /* Mesaj pentru cele fără logo */
    .no-logo .placeholder-logo {
        max-height: 150px;
        width: 100%;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px dashed #ccc;
        color: #555;
        font-size: 16px;
        font-weight: bold;
    }
</style>
    
    <?php if(auth()->user()->type == 'super admin'): ?>
        <div class="container mt-4">
            <!-- Butonul de adăugare reduceri -->
            <a href="<?php echo e(route('reduceri.create')); ?>" class="btn btn-primary mb-4">Adaugă Reducere</a>
        </div>
    <?php endif; ?>
    <div class="col-xl-12">
        <div class="row">
            <?php $__currentLoopData = $reduceri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reducere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="col-md-4">
    <div class="card <?php echo e($reducere->logo ? '' : 'no-logo'); ?>">
        <!-- Logo sau Placeholder -->
        <div class="card-header text-center">
            <?php if($reducere->logo): ?>
                <!-- Dacă există logo -->
                <img src="<?php echo e(asset('storage/app/public/' . $reducere->logo)); ?>" alt="Logo" class="img-fluid">
            <?php else: ?>
                <!-- Dacă nu există logo -->
                <div class="placeholder-logo">
                    <span>Fără Logo</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Detaliile reducerii -->
        <div class="card-body">
            <h5 class="card-title"><?php echo e($reducere->partener); ?></h5>
            
            <!-- Locație -->
            <p class="icon-wrapper">
                <i class="fa fa-map-marker"></i>
                <span><strong>Locație:</strong> <?php echo e($reducere->locatie); ?></span>
            </p>
            
            <!-- Reducere -->
            <p class="icon-wrapper">
                <i class="fa fa-percentage"></i>
                <span><strong>Reducere:</strong> <?php echo e($reducere->reducere); ?>%</span>
            </p>

            <!-- Perioada reducerii -->
            <p class="icon-wrapper">
                <i class="fa fa-calendar"></i>
                <span><strong>Perioadă:</strong> <?php echo e($reducere->start); ?> - <?php echo e($reducere->end); ?></span>
            </p>

            <!-- Cod reducere -->
            <p class="icon-wrapper">
                <i class="fa fa-barcode"></i>
                <span><strong>Cod Reducere:</strong> <?php echo e($reducere->cod); ?></span>
            </p>

            <!-- Website -->
            <p class="icon-wrapper">
                <i class="fa fa-link"></i>
                <span><strong>Website:</strong> <a href="<?php echo e($reducere->website); ?>" target="_blank"><?php echo e($reducere->website); ?></a></span>
            </p>

            <!-- Observații -->
            <p class="icon-wrapper">
                <i class="fa fa-info-circle"></i>
                <span><strong>Observații:</strong> <?php echo e($reducere->observatii); ?></span>
            </p>
        </div>
    </div>
</div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
         
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/reduceri/index.blade.php ENDPATH**/ ?>