<?php

include './functions.php';

// var_dump($pass_length);
if (isset($_GET['pass_length'])) {
    $pass_length = trim($_GET['pass_length']);

    if ($pass_length < 5 || $pass_length > 20) {
        $alert_message = 'La password deve essere lunga dai 5 ai 20 caratteri.';
        $alert_color = 'danger';
    } else {
        $use_characters = [];

        /* check if letters are included */
        if (isset($_GET['use_letters']) && $_GET['use_letters'] == 'on') {
            array_push($use_characters, true);
        } else {
            array_push($use_characters, false);
        }

        /* check if numbers are included */
        if (isset($_GET['use_numbers']) && $_GET['use_numbers'] == 'on') {
            array_push($use_characters, true);
        } else {
            array_push($use_characters, false);
        }

        /* check if symbols are included */
        if (isset($_GET['use_symbols']) && $_GET['use_symbols'] == 'on') {
            array_push($use_characters, true);
        } else {
            array_push($use_characters, false);
        }

        /* check if characters could be repeated */
        if (isset($_GET['similar_characters']) && $_GET['similar_characters'] == '1') {
            $similar_characters = true;
        } else {
            $similar_characters = false;
        }

        if (in_array(true, $use_characters)) {
            // no characters repetition allowed
            if (!$use_characters[0] && $use_characters[1] && $use_characters[2] && $pass_length > 18 && !$similar_characters) {
                // only numbers and symbols included (with length < 18)
                $alert_message = 'Hai selezionato solo numeri e simboli senza ripetizione. La password può essere lunga massimo 18 caratteri.';
                $alert_color = 'danger';
            } else if (!$use_characters[0] && $use_characters[1] && !$use_characters[2] && $pass_length > 10 && !$similar_characters) {
                // only numbers included (with length < 10)
                $alert_message = 'Hai selezionato solo numeri senza ripetizione. La password può essere lunga massimo 10 caratteri.';
                $alert_color = 'danger';
            } else if (!$use_characters[0] && !$use_characters[1] && $use_characters[2] && $pass_length > 8 && !$similar_characters) {
                // only symbols included (with length < 8)
                $alert_message = 'Hai selezionato solo simboli senza ripetizione. La password può essere lunga massimo 8 caratteri.';
                $alert_color = 'danger';
            } else {
                $password = generate_password($pass_length, $use_characters, $similar_characters);
                $alert_message = "La password generata é: $password.";
                $alert_color = 'success';
            }
        } else {
            $alert_message = 'La password deve essere composta almeno singolarmente da lettere, numeri o simboli.';
            $alert_color = 'danger';
        }
    }
    // var_dump($pass_length);
} else {
    $alert_message = 'Nessun parametro valido inserito.';
    $alert_color = 'info';
}

// var_dump($use_characters, $similar_characters);

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


                <div class="d-flex p-3 fs-5">
                    <label for="similar_characters" class="w-50">Consenti ripetizioni di uno o più caratteri:</label>

                    <div>
                        <!-- radio -->
                        <div class="mb-3">
                            <!-- radio true -->
                            <div class="form-radio">
                                <input class="form-check-input" type="radio" name="similar_characters" id="similar_characters" checked value="1">
                                <span>Sì</span>
                            </div>

                            <!-- radio false -->
                            <div class="form-radio">
                                <input class="form-check-input" type="radio" name="similar_characters" id="similar_characters" value="0">
                                <span>No</span>
                                <!--
                                    Notare che i numeri possibili sono 10 mentre i simboli sono 8.
                                    Se la lunghezza è 15 ma si seleziona solo numeri, la password generata sarà un ordine randomico di 10 numeri.
                                    Stessa cosa per i simboli.
                                -->
                            </div>
                        </div>

                        <!-- checkboxes -->
                        <div>
                            <!-- letters -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="use_letters" name="use_letters" checked>
                                <label class="form-check-label" for="use_letters">Lettere</label>
                            </div>

                            <!-- numbers -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="use_numbers" name="use_numbers">
                                <label class="form-check-label" for="use_numbers">Numeri</label>
                            </div>

                            <!-- symbols -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="use_symbols" name="use_symbols">
                                <label class="form-check-label" for="use_symbols">Simboli</label>
                            </div>
                        </div>

                    </div>

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