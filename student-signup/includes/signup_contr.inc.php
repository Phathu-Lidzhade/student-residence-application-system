<?php

declare(strict_types=1);

function is_input_empty(string $firstname, string $surname, string $username, string $pwd, string $student_number){
    if (empty($firstname) || empty($surname) || empty($username) || empty($pwd) || empty($student_number)) {
        return true;
    }
    else {
        return false;
    }
}

function is_username_taken(object $pdo, string $username){
    if (get_username($pdo, $username)) {
        return true;
    }
    else {
        return false;
    }
}

function create_user(object $pdo, string $firstname, string $surname, string $username, string $pwd, string $student_number){
    set_user($pdo, $firstname, $surname, $username, $pwd, $student_number);
}