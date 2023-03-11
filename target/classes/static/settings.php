<?php
include './script/php/utils/WebUtils.php';
include './script/php/utils/StringUtils.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e = $_POST["e"];
    setcookie("e", $e, time() + 60 * 60 * 24 * 30);
    echo "保存成功<br>";
    echo "<button onclick='window.history.go(-2)'>返回</button>";
} else {
    back();
}
