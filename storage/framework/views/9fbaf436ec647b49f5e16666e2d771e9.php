<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($status); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f9fa;
            padding: 50px;
        }
        .error-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #dc3545;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            background: #007bff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1><?php echo e($status); ?></h1>
        <p><?php echo e($message); ?></p>

        <a href="<?php echo e(url('/')); ?>" class="btn">Înapoi la Homepage</a>
    </div>
</body>
</html>
<?php /**PATH /home/vcard/public_html/resources/views/errors/qr.blade.php ENDPATH**/ ?>