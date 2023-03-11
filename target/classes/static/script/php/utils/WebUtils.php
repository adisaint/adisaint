<?php

function alertAndBack($message): void
{
    echo "<script>alert('$message')</script>";
    echo "<script>window.history.go(-1)</script>";
}

function alert($message): void
{
    echo "<script>alert('$message')</script>";
}

function into($url): void
{
    echo "<script>window.location.href='$url'</script>";
}

function back(): void
{
    echo "<script>window.history.go(-1)</script>";
}

function backAndAlert($message): void
{
    echo "<script>window.history.go(-1)</script>";
    echo "<script>alert('$message')</script>";
}