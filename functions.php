<?php

function generate_password($pass_length, $use_characters, $similar_characters)
{
    $chars = generate_chars($use_characters);

    $password = '';

    for ($i = 1; $i <= $pass_length; $i++) {
        $char_index = array_rand($chars, 1);
        $password = $password . $chars[$char_index];

        if (!$similar_characters) {
            unset($chars[$char_index]);
        }
    }

    // var_dump($password);
    return $password;
}

function generate_chars($use_characters)
{
    if ($use_characters[0]) {
        // letters included
        if ($use_characters[1]) {
            // letters & numbers included
            if ($use_characters[2]) {
                // all included
                return explode(' ', 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9 ! @ # $ % ^ & *');
            } else {
                // symbols not included
                return explode(' ', 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9');
            }
        } else {
            // numbers not included
            if ($use_characters[2]) {
                // letters & symbols included
                return explode(' ', 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z ! @ # $ % ^ & *');
            } else {
                // only letters included
                return explode(' ', 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z');
            }
        }
    } else {
        // letters not included
        if ($use_characters[1]) {
            // numbers included
            if ($use_characters[2]) {
                // numbers & symbols included
                return explode(' ', '0 1 2 3 4 5 6 7 8 9 ! @ # $ % ^ & *');
            } else {
                // only numbers included
                return explode(' ', '0 1 2 3 4 5 6 7 8 9');
            }
        } else {
            // only symbols included
            return explode(' ', '! @ # $ % ^ & *');
        }
    }
}

function input_check($pass_length, $use_characters, $similar_characters)
{
    if ($pass_length < 5 || $pass_length > 20) {
        $alert_message = [
            'message' => 'La password deve essere lunga dai 5 ai 20 caratteri.',
            'color' => 'danger'
        ];
    } else {
        if (in_array(true, $use_characters)) {
            if (!$use_characters[0] && $use_characters[1] && $use_characters[2] && $pass_length > 18 && !$similar_characters) {
                // only numbers and symbols included (with length < 18)
                $alert_message = [
                    'message' => 'Hai selezionato solo numeri e simboli senza ripetizione. La password può essere lunga massimo 18 caratteri.',
                    'color' => 'danger'
                ];
            } else if (!$use_characters[0] && $use_characters[1] && !$use_characters[2] && $pass_length > 10 && !$similar_characters) {
                // only numbers included (with length < 10)
                $alert_message = [
                    'message' => 'Hai selezionato solo numeri senza ripetizione. La password può essere lunga massimo 10 caratteri.',
                    'color' => 'danger'
                ];
            } else if (!$use_characters[0] && !$use_characters[1] && $use_characters[2] && $pass_length > 8 && !$similar_characters) {
                // only symbols included (with length < 8)
                $alert_message = [
                    'message' => 'Hai selezionato solo simboli senza ripetizione. La password può essere lunga massimo 8 caratteri.',
                    'color' => 'danger'
                ];
            } else {
                $password = generate_password($pass_length, $use_characters, $similar_characters);

                $alert_message = [
                    'message' => "La password generata di $pass_length é: $password.",
                    'color' => 'success'
                ];
            }
        } else {
            $alert_message = [
                'message' => 'La password deve essere composta almeno singolarmente da lettere, numeri o simboli.',
                'color' => 'danger'
            ];
        }
    }

    return $alert_message;
}
