<?php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Coduri QR')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Coduri QR')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Coduri QR')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h2 class="mb-4">Editează Cod QR</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="<?php echo e(route('coduri_qr.update', $qrCode->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    

                    <!-- Selectare tip QR -->
                    <div class="mb-3">
    <label for="tip_qr" class="form-label">Tip QR:</label>
    <select id="tip_qr" name="tip_qr" class="form-select">
        <option value="link" <?php echo e($qrCode->type == 'url' ? 'selected' : ''); ?>>Link</option>
        <option value="google_maps" <?php echo e($qrCode->type == 'google_maps' ? 'selected' : ''); ?>>Google Maps</option>
    </select>
</div>

                    <div class="mb-3">
                        <label for="target_url" class="form-label">URL de redirecționare:</label>
                        <input type="url" id="target_url" name="target_url" class="form-control" required 
                               value="<?php echo e($qrCode->target_url); ?>" placeholder="Modifică URL-ul">
                    </div>
                    
                    <div class="mb-3">
    <label for="color_foreground" class="form-label">Culoare QR:</label>
    <input type="color" id="color_foreground" name="color_foreground" class="form-control form-control-color" 
           value="<?php echo e(old('color_foreground', $qrCode->color_foreground ?? '#000000')); ?>">
</div>

<div class="mb-3">
    <label for="color_background" class="form-label">Culoare fundal QR:</label>
    <input type="color" id="color_background" name="color_background" class="form-control form-control-color" 
           value="<?php echo e(old('color_background', $qrCode->color_background ?? '#FFFFFF')); ?>">
</div

<div class="form-group">
            <input type="hidden" name="suspended" value="0">
            <label for="suspended">
                <input type="checkbox" id="suspended" name="suspended" value="1" <?php echo e($qrCode->suspended ? 'checked' : ''); ?>>
                Suspendă acest cod QR
            </label>
        </div>





                    <!-- Afișare QR live -->
                    <div class="text-center my-3">
                        <div id="qr-container">
                            <div id="qrcode"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">
                        <i class="ti ti-pencil"></i> Salvează modificările
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script pentru generare QR live -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let colorForeground = document.getElementById("color_foreground");
        let colorBackground = document.getElementById("color_background");
        let targetUrl = document.getElementById("target_url");
        let qrContainer = document.getElementById("qrcode");

        function generateQRCode() {
            qrContainer.innerHTML = ""; // Șterge QR-ul vechi
            new QRCode(qrContainer, {
                text: targetUrl.value,
                width: 200,
                height: 200,
                colorDark: colorForeground.value,
                colorLight: colorBackground.value
            });
        }

        // Inițializăm QR Code-ul cu valorile existente
        setTimeout(generateQRCode, 100);

        // Actualizăm QR live când se schimbă culoarea sau link-ul
        colorForeground.addEventListener("input", generateQRCode);
        colorBackground.addEventListener("input", generateQRCode);
        targetUrl.addEventListener("input", generateQRCode);
    });
</script>
    
    
    <div class="text-center mt-4">
    <button class="btn btn-secondary" onclick="history.back();">
        ⬅️ Înapoi
    </button>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/coduri_qr/edit.blade.php ENDPATH**/ ?>