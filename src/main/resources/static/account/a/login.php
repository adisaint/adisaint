<?php
include "../../script/php/query/account/Accounts.php";
include "../../script/php/query/method/MySQL.php";
include "../../script/php/utils/WebUtils.php";
include "../../script/php/config/MySQL.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_accept = "no_accept";
    $user = trim($_POST["username"]);
    $pwd = hash("sha512", trim($_POST["password"]));
    $is_accept = isset($_POST['accept']) ? htmlspecialchars($_POST['accept']) : '';
    if ($user != "" && $pwd != "") {
        $password = getPassword($user);
        if ($password == $pwd) {
            alert("登录成功");
            into("../../../home/");
        } else {
            alertAndBack("账号或密码错误");
        }
    }
} else {
    alertAndBack("请返回上一页");
}
