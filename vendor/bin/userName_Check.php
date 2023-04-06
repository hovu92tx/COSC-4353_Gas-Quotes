<?php
function userName_Check($userName)
{
    $specialChars = preg_match('@[^\w]@', $userName);
    $onlyDigit = preg_match('/^[0-9]+$/', $userName);
    if (strlen($userName) <= 4 || $specialChars || $onlyDigit == 1) {
        return false;
    } else {
        return true;
    }
}
