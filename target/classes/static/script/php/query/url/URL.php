<?php

function addUrl($code, $url, $time)
{
    mkdir("../$code/");
    $filename = "../$code/index.html";
    $file = fopen($filename, "w");
    if ($file == null) {
        echo "Server error";
        exit();
    }
    $text = "<!DOCTYPE html><html><head><script>location.href=\"$url\"</script></head></html>";
    fwrite($file, $text);
    fclose($file);
    return insertData("INSERT INTO urls.url VALUES ('$code', '$url', $time);", "urls");
}


function getCodeExists($code): bool
{
    return query("SELECT code FROM url WHERE code='" . $code . "'", "code") == $code;
}


function getCode($url)
{
    return query("SELECT code FROM url WHERE url='" . $url . "'", "code");
}

function query($sql, $key)
{
    return queryData($sql, $key, "urls");
}
