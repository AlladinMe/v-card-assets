<style>
    .viewqrcode canvas {
        width: 100%;
        height: 100%;
        padding: 12px 25px;
    }

    .viewqrcode img {
        width: 100%;
        height: 100%;
    }
</style>
<?php
    $qr_path = \App\Models\Utility::get_file('qrcode');
?>
<div class="card p-3">
    <div class="row">
        <div class="col-12">
            <div class="viewqrcode"></div>
        </div>
        <img src="<?php echo e(isset($qr_detail->image) ? $qr_path . '/' . $qr_detail->image : ''); ?>" class="d-none image-qr"
            crossorigin="anonymous">
    </div>
</div>
<script src="<?php echo e(asset('custom/js/jquery.qrcode.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        var slug = '<?php echo e($business->slug); ?>';
        var url_link = `<?php echo e(url('/')); ?>/${slug}`;

        var foreground_color =
            `<?php echo e(isset($qr_detail->foreground_color) ? $qr_detail->foreground_color : '#000000'); ?>`;
        var background_color =
            `<?php echo e(isset($qr_detail->background_color) ? $qr_detail->background_color : '#ffffff'); ?>`;
        var radius = `<?php echo e(isset($qr_detail->radius) ? $qr_detail->radius : 26); ?>`;
        var qr_type = `<?php echo e(isset($qr_detail->qr_type) ? $qr_detail->qr_type : 0); ?>`;
        var qr_font = `<?php echo e(isset($qr_detail->qr_text) ? $qr_detail->qr_text : 'vCard'); ?>`;
        var qr_font_color = `<?php echo e(isset($qr_detail->qr_text_color) ? $qr_detail->qr_text_color : '#f50a0a'); ?>`;
        var size = `<?php echo e(isset($qr_detail->size) ? $qr_detail->size : 9); ?>`;

        // Wait for the image to load
        var imageBuffer = document.querySelector('.image-qr');
        imageBuffer.onload = function() {
            generateQRCode();
        };

        // If the image is already cached and loaded
        if (imageBuffer.complete) {
            generateQRCode();
        }

        function generateQRCode() {
            $('.viewqrcode').empty().qrcode({
                render: 'image',
                size: 500,
                ecLevel: 'H',
                minVersion: 3,
                quiet: 1,
                text: url_link,
                fill: foreground_color,
                background: background_color,
                radius: .01 * parseInt(radius, 10),
                mode: parseInt(qr_type, 10),
                label: qr_font,
                fontcolor: qr_font_color,
                image: $(".image-qr")[0],
                mSize: .01 * parseInt(size, 10)
            });
        }
    });
</script>
<?php /**PATH /home/vcard/public_html/resources/views/business/viewqr.blade.php ENDPATH**/ ?>