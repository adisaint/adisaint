<?php
include "../../script/php/query/account/Accounts.php";
include "../../script/php/query/method/MySQL.php";
include "../../script/php/utils/WebUtils.php";
include "../../script/php/config/MySQL.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["user"]);
    $pwd = hash("sha512", trim($_POST["pwd"]));
    $userPwd = getPassword($user);
    if ($userPwd == $pwd) {
        alert("登录成功");
        into("../../../home/");
    } else {
        echo("账号或密码错误");
    }
} else back();