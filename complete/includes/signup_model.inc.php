<?php

declare(strict_types=1);

function get_username(object $pdo, string $username) {
    $query = "SELECT username FROM students1 WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $firstname, string $surname, string $username, string $pwd){
    $query = "INSERT INTO students1(firstname, surname, username, pwd) VALUES(:firstname, :surname, :username, :pwd);";
    $stmt = $pdo->prepare($query);

    $options =[
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindparam(":firstname", $firstname);
    $stmt->bindparam(":surname", $surname);
    $stmt->bindparam(":username", $username);
    $stmt->bindparam(":pwd", $hashedPwd);
    $stmt->execute();
}