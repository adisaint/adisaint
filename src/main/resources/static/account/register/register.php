<?php

include("../../../script/php/query/account/Accounts.php");
include("../../../script/php/query/method/MySQL.php");
include("../../../script/php/config/MySQL.php");
include("../../../script/php/utils/StringUtils.php");
include("../../../script/php/utils/WebUtils.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = trim($_POST["username"]);
    $input_email = trim($_POST["email"]);
    $input_password = trim($_POST["password"]);
    $input_code = trim($_POST["code"]);
    $is_accept = isset($_GET['input_accept']) ? htmlspecialchars($_GET['input_accept']) : '';
    $is_exists = getPassword($input_username) != "";

    backAndAlert("注册成功");
} else {
    alert("请返回上一页重试");
}