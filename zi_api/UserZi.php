<?php

class UserZi
{
    function validateUser($email, $password)
    {
        if (!$email || !$password)
            return 'данные не заполнены';

        if (strlen($password) < 7)
            return 'не достаточная длинна пароля';

        if (!(preg_match("/[0-9a-z]+@[a-z]/", $email))) {
            return 'некорректно введена почта';
        }
        return '';
    }
}
