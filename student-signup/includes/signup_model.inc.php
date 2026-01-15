<?php

declare(strict_types=1);

function get_username(object $pdo, string $username) {
    $query = "SELECT username FROM students WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $firstname, string $surname, string $username, string $pwd, string $student_number){
    $query = "INSERT INTO students(firstname, surname, username, pwd, student_number) VALUES(:firstname, :surname, :username, :pwd, :student_number);";
    $stmt = $pdo->prepare($query);

    $options =[
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindparam(":firstname", $firstname);
    $stmt->bindparam(":surname", $surname);
    $stmt->bindparam(":username", $username);
    $stmt->bindparam(":pwd", $hashedPwd);
    $stmt->bindparam(":student_number", $student_number);
    $stmt->execute();
}