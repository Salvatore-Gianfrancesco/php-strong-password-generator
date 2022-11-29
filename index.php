<?php

include './functions.php';

// var_dump($pass_length);
if (isset($_GET['pass_length'])) {
    $pass_length = trim($_GET['pass_length']);

    if ($pass_length < 5 || $pass_length > 20) {
        $alert_message = 'La password deve essere lunga dai 5 ai 20 caratteri.';
        $alert_color = 'danger';
    } else {
        $password = generate_password($pass_length);
        $alert_message = "La password generata di $pass_length caratteri é: $password.";
        $alert_color = 'success';
    }
    // var_dump($pass_length);
} else {
    $alert_message = 'Nessun parametro valido inserito.';
    $alert_color = 'info';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
</head>

<body class="p-4">
    <div class="container bg-dark py-5">
        <h1 class="text-secondary text-center">Strong Password Generator</h1>
        <h2 class="text-center text-light py-3">Genera una password sicura</h2>

        <div class="alert alert-<?= $alert_color; ?> fs-5" role="alert">
            <?= $alert_message; ?>
        </div>

        <form action="index.php" method="GET">
            <div class="bg-light rounded-2">
                <div class="d-flex p-3 fs-5">
                    <label for="pass_length" class="w-50">Lunghezza password:</label>
                    <input type="number" name="pass_length" id="pass_length" class="w-25 rounded-2">
                </div>

                <div class="p-3">
                    <button type="submit" class="btn btn-primary fs-5">Invia</button>
                    <button type="reset" class="btn btn-secondary fs-5">Annulla</button>
                </div>
            </div>
        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8' crossorigin='anonymous'></script>
</body>

</html>