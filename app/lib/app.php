<?php

function redirect($url)
{
    header('Location: '.filter_var($url, FILTER_SANITIZE_URL));
    exit;
}