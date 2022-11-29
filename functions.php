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
