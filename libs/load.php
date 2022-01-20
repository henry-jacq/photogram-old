<?php

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/login-page/_templates/$name.php";
}

function load_main_page($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/login-page/$name.php";
}