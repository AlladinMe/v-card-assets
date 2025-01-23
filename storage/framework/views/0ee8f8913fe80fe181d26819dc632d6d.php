<?php
$redirectTime = 10;
$redirectUrl = "https://v-card.ro/";


header("Refresh: $redirectTime; URL=$redirectUrl");
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonament Expirat</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #28a745; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #000000; 
        }

        .container {
            text-align: center;
            padding: 30px;
            background-color: #ffffff; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            font-size: 2.5em;
            color: #e74c3c; 
            margin-bottom: 20px;
            text-transform: uppercase; 
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
            text-transform: uppercase; 
        }

        .btn {
            padding: 12px 30px;
            background-color: #3498db; 
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            margin-top: 20px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .timer {
            font-size: 1.6em;
            color: #f39c12; 
            text-transform: uppercase; 
        }

        img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .important-text {
            color: #e74c3c; 
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="https://www.v-card.ro/storage/uploads/landing_page_image/site_logo.png" alt="Logo">
    <h1>Abonament suspendat pentru neplata!</h1>
    <p>Ne pare rău pentru neplacere! </p>
    <p>abonamentul utilizatorului nu este plătit.</p>
    <p class="timer">Redirecționare în <span id="countdown"><?= $redirectTime ?></span> secunde...</p>
    
</div>

<script>
    
    var countdownElement = document.getElementById("countdown");
    var countdown = <?= $redirectTime ?>;
    var interval = setInterval(function() {
        countdown--;
        countdownElement.innerText = countdown;
        if (countdown === 0) {
            clearInterval(interval);
        }
    }, 1000);
</script>

</body>
</html>
<?php /**PATH /home/vcard/public_html/resources/views/expiredab.blade.php ENDPATH**/ ?>