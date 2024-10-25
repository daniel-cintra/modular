<?php

if (! function_exists('onlyAlphaNumeric')) {
    function onlyAlphaNumeric($val)
    {
        if ($val) {
            return preg_replace('/[^A-Za-z0-9]/', '', (string) $val);
        }

        return $val;
    }
}
