<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : '';
    header("Content-Type:text/json;charset=UTF-8");
    $result = file_get_contents("http://adisaint.com/url/generate?link=" . $url);
    echo $result;
}else {
    echo "Error";
}


