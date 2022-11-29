<?php

function generate_password($pass_length)
{
    $chars = explode(' ', 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9 ! @ # $ % ^ & *');
    // var_dump($chars);

    $password = '';

    for ($i = 1; $i <= $pass_length; $i++) {
        $char = array_rand($chars, 1);

        $password = $password . $chars[$char];
    }

    // var_dump($password);
    return $password;
}
