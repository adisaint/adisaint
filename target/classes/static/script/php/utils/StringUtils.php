<?php
function isUsername($string): bool
{
    return (preg_match("/^[a-zA-Z]\w{4,19}$/i", $string));
}

function isEmail($string): bool
{
    return (preg_match("/^\w+((-\w+)|(\.\w+))*@[A-Za-z0-9]+(([.\-])[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/i", $string));
}

function isPassword($string): bool
{
    return (preg_match("/^[a-zA-Z]\w{5,19}$/i", $string));
}

function isUrl($string): bool
{
    return (preg_match("/^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/i", $string));
}

function generateRandomString($length = 10): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) $randomString .= $characters[rand(0, $charactersLength - 1)];
    return $randomString;
}












