<?php

// General Helpers
function set_active($path, $active = 'active')
{
    if (is_array($path)) {
        foreach ($path as $p) {
            if (Request::is($p)) {
                return $active;
            }
        }
        return '';
    }
    return Request::is($path) ? $active : '';
}

function admin_asset($file)
{
    return asset("admin" . "/" . $file);
}

// Session Message Helpers
function session_success($text)
{
    Session::flash('success_message', $text);
}

function session_error($text)
{
    Session::flash('error_message', $text);
}

function session_info($text)
{
    Session::flash('info_message', $text);
}
