<?php

include '../../script/php/mail/Mailer.php';
include '../../script/php/config/MySQL.php';
include '../../script/plugins/mail/SMTP.php';
include '../../script/php/query/code/Codes.php';
include '../../script/php/utils/StringUtils.php';
include '../../script/php/query/method/MySQL.php';
include '../../script/plugins/mail/Exception.php';
include '../../script/plugins/mail/PHPMailer.php';
include("../../script/php/query/account/Accounts.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $event = isset($_POST['event']) ? htmlspecialchars($_POST['event']) : '';
    switch ($event) {
        case "send_verification_code":
        {
            if ($email !== "") {
                $code = rand(100000, 999999);
                if (sendRegisterCode($email, $code)) {
                    $id = generateRandomString(8);
                    $sendTime = date('Y-m-d H:i:s');
                    insertRegisterData($id, $email, "register", $code, $sendTime, date("Y-m-d H:i:s", strtotime("+5 minutes")));
                    echo "ok";
                } else {
                    echo "bad";
                }
            } else {
                echo "bad: email is null";
            }
            break;
        }
        case "verify_verification_code" :
        {
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $code = isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '';
            if ($email !== "" && $code !== "") {
                $realCode = getEmailRegisterCode($email);
                if ($realCode == $code) {
                    if (getEmailRegisterCodeIsValid($email)) {
                        echo "ok";
                        deleteEmailRegisterData($email);
                    } else {
                        echo 'bad';
                    }
                } else {
                    echo 'bad';
                }
            } else {
                echo "bad: email or code is null";
            }
            break;
        }
        case "get_username_exists" :
        {
            $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
            if ($username !== "") {
                if (getUsernameExists($username)) {
                    echo "true";
                } else {
                    echo 'false';
                }
            } else {
                echo 'bad';
            }
            break;
        }
        case "get_email_exists" :
        {
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            if ($email !== "") {
                if (getMailExists($email)) {
                    echo "true";
                } else {
                    echo 'false';
                }
            } else {
                echo 'bad';
            }
            break;
        }
        default :
            echo "bad";
    }
} else {
    echo "bad";
}
