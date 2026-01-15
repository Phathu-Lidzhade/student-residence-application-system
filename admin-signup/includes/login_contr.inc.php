<?php

declare(strict_types=1);

function is_username_wrong(bool|array $result){
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

function is_password_wrong(string $pwd, string $hashedpwd){
    if (!password_verify($pwd, $hashedpwd)) {
        return true;
    } else {
        return false;
    }
}

function is_admincode_wrong(string $admidcodec){
    if (!admincode_verify($admidcodec)) {
        return true;
    } else {
        return false;
    }
}
function is_input_empty(string $username, string $pwd, string $admidcodec){
    if (empty($username) || empty($pwd) || empty($admidcodec)) {
        return true;
    } else {
        return false;
    }
}