<?php
include './script/php/utils/WebUtils.php';
include './script/php/utils/StringUtils.php';

/**
 * @param mixed $query
 * @param mixed $engine
 * @return void
 */
function search(mixed $query, mixed $engine): void
{
    if (isUrl($query)) {
        Header("Location: $query");
    } else if ($engine === "baidu") {
        Header("Location: https://www.baidu.com/s?wd=" . urlencode($query));
    } elseif ($engine === "bing") {
        Header("Location: https://cn.bing.com/search?q=" . urlencode($query));
    } elseif ($engine === "sogou") {
        Header("Location: https://www.sogou.com/web?query=" . urlencode($query));
    } elseif ($engine === "s360") {
        Header("Location: https://www.so.com/s?q=" . urlencode($query));
    } elseif ($engine === "google") {
        Header("Location: https://www.google.com/search?q=" . urlencode($query));
    } else {
        Header("Location: https://www.baidu.com/s?wd=" . urlencode($query));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST["q"];
    $engine = $_COOKIE['e'];
    if ($query === "") {
        back();
    } else {
        search($query, $engine);
    }
} else {
    $query = $_GET["q"];
    $engine = $_GET["e"];
    if ($query === "") {
        back();
    }
    search($query, $engine);
}