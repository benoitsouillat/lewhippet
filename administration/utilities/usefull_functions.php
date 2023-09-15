<?php

function replace_blank($str)
{
    return str_replace(' ', '_', $str);
};

function replace_accent($str)
{
    $result = $str;
    if (strpos($result, 'é')) {
        $result = str_replace('é', 'e', $result);
    }
    if (strpos($result, 'è')) {
        $result = str_replace('è', 'e', $result);
    }
    if (strpos($result, 'à')) {
        $result = str_replace('à', 'a', $result);
    }
    if (strpos($result, 'â')) {
        $result = str_replace('â', 'a', $result);
    }
    if (strpos($result, 'ä')) {
        $result = str_replace('ä', 'a', $result);
    }
    if (strpos($result, 'ç')) {
        $result = str_replace('ç', 'c', $result);
    }
    if (strpos($result, 'ù')) {
        $result = str_replace('ù', 'u', $result);
    }
    if (strpos($result, 'ñ')) {
        $result = str_replace('ñ', 'n', $result);
    }
    if (strpos($result, 'ô')) {
        $result = str_replace('ô', 'u', $result);
    }
    if (strpos($result, 'ö')) {
        $result = str_replace('ö', 'u', $result);
    }
    return $result;
}

function check_session_start($session)
{
    if (isset($session) && isset($session['username']) && isset($session['role']) && $session['role'] === 'Admin') {
        return true;
    } else {
        return false;
    }
};