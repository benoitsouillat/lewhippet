<?php

function replace_blank($str)
{
    return str_replace(' ', '_', $str);
};

function check_session_start($session)
{
    if (isset($session) && isset($session['username']) && isset($session['role']) && $session['role'] === 'Admin') {
        return true;
    } else {
        return false;
    }
};