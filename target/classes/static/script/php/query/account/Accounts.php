<?php

function getPassword($username): string
{
    return queryAccountData("SELECT password FROM account WHERE username='" . $username . "'", "password");
}


function getEmail($username): string
{
    return queryAccountData("SELECT email FROM account WHERE username='" . $username . "'", "email");
}


function getPhone($username): string
{
    return queryAccountData("SELECT phone FROM account WHERE username='" . $username . "'", "phone");
}


function getUsernameExists($username): bool
{
    $res = queryAccountData("SELECT username FROM account WHERE username='" . $username . "'", "username");
    return $res != null || $res != "";
}

function getMailExists($email): bool
{
    $res = queryAccountData("SELECT email FROM account WHERE email='" . $email . "'", "email");
    return $res != null || $res != "";
}


// ============Main Method============
function queryAccountData($sql, $key): string
{
    return queryData($sql, $key, "adisaint");
}


