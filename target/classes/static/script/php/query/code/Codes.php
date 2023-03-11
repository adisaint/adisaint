<?php


function getIdExists($id): bool
{
    return query("SELECT codes.code.id FROM codes.code WHERE codes.code.id='" . $id . "'", "id") == $id;
}


function getIdRegisterCode($id): string
{
    return query("SELECT verification_code FROM codes.code WHERE codes.code.id='" . $id . "' AND codes.code.type='register'", "verification_code");
}


function getIdLoginCode($id): string
{
    return query("SELECT verification_code FROM codes.code WHERE codes.code.id='" . $id . " ' AND codes.code.type='login'", "verification_code");
}


function getIdEmail($id): string
{
    return query("SELECT email FROM codes.code WHERE codes.code.id='" . $id . "'", "email");
}


function getIdType($id): string
{
    return query("SELECT type FROM codes.code WHERE codes.code.id='" . $id . "'", "type");
}


function getIdGenerationTime($id)
{
    return query("SELECT generation_time FROM codes.code WHERE codes.code.id='" . $id . "'", "generation_time");
}


function getIdExpirationTime($id)
{
    return query("SELECT expiration_time FROM codes.code WHERE codes.code.id='" . $id . "'", "expiration_time");
}


// ===========Some About The Email Methods


// Get Email Is Existing

function getEmailExists($email, $type): bool
{
    return query("SELECT codes.code.email FROM codes.code WHERE codes.code.email='" . $email . "' AND codes.code.type='$type'", "email") == $email;
}


function getEmailRegisterExists($email): bool
{
    return getEmailExists($email, 'register');
}


function getEmailLoginExists($email): bool
{
    return getEmailExists($email, 'login');
}


// Get Verification Code

function getEmailCode($email, $type): string
{
    return query("SELECT verification_code FROM codes.code WHERE codes.code.email='" . $email . "' AND codes.code.type='$type'", "verification_code");
}


function getEmailRegisterCode($email): string
{
    return getEmailCode($email, 'register');
}


function getEmailLoginCode($email): string
{
    return getEmailCode($email, 'login');
}


// Get ID

function getEmailId($email, $type): string
{
    return query("SELECT codes.code.id FROM codes.code WHERE codes.code.email='" . $email . "' AND codes.code.type='$type'", "id");
}


function getEmailRegisterId($email): string
{
    return getEmailId($email, "register");
}


function getEmailLoginId($email): string
{
    return getEmailId($email, "login");
}


// Get Creation Time

function getEmailCreationTime($email, $type): string
{
    return getIdExpirationTime(getEmailId($email, $type));
}


function getEmailRegisterCreationTime($email): string
{
    return getEmailCreationTime($email, "register");
}

function getEmailLoginCreationTime($email): string
{
    return getEmailCreationTime($email, "login");
}


// Get Expiration Time
function getEmailExpirationTime($email, $type): string
{
    return getIdExpirationTime(getEmailId($email, $type));
}


function getEmailRegisterExpirationTime($email): string
{
    return getEmailExpirationTime($email, "register");
}

function getEmailLoginExpirationTime($email): string
{
    return getEmailExpirationTime($email, "login");
}

// Get Verification Code Is Valid

function getEmailCodeIsValid($email, $type): bool
{
    $validTime = getEmailExpirationTime($email, $type);
    $currentTime = (string)date("Y-m-d G:i:s");
    if (strtotime($validTime) > strtotime($currentTime))
        return true;
    else
        return false;
}

function getEmailRegisterCodeIsValid($email): bool
{
    return getEmailCodeIsValid($email, 'register');
}


// Three Deletion Methods

function deleteEmailData($email, $type): bool
{
    return insertData("DELETE FROM codes.code WHERE codes.code.email='$email' AND codes.code.type='$type'", "codes");
}

function deleteEmailRegisterData($email): bool
{
    return deleteEmailData($email, 'register');
}


function deleteEmailLoginData($email): bool
{
    return deleteEmailData($email, 'login');
}


// Three Insertion Methods

function insertRegisterData($id, $email, $type, $code, $generationTime, $expirationTime): bool
{
    if (getEmailExists($email, $type)) {
        $db_id = getEmailId($email, $type);
        $sql = "UPDATE IGNORE codes.code SET codes.code.verification_code='$code' WHERE codes.code.email='$email' AND codes.code.id='$db_id'";
    } else
        $sql = "INSERT INTO codes.code VALUES ('$id', '$email', '$type', '$code', '$generationTime', '$expirationTime');";
    return insert($sql);
}


// =========================Two Main Methods=========================

function insert($sql): bool
{
    return insertData($sql, "codes");
}


function query($sql, $key): string
{
    return queryData($sql, $key, "codes");
}
