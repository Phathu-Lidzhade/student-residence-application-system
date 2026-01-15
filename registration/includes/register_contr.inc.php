<?php

declare(strict_types=1);

function is_input_empty(int $studentno, string $firstname, string $surname, string $gender, string $residence): bool{
    if (empty($studentno) || empty($firstname) || empty($surname) || empty($gender) || empty($residence)) {
        return true;
    }
    else {
        return false;
    }
}

function is_studentno_taken(object $pdo,int $studentno){
    if (get_studentno($pdo, $studentno)) {
        return true;
    }
    else {
        return false;
    }
}

function create_user(object $pdo, int $studentno, string $firstname, string $surname, string $gender, string $residence){
    set_user($pdo, $studentno, $firstname, $surname, $gender, $residence);
}