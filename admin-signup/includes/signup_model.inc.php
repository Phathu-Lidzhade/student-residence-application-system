<?php

declare(strict_types=1);

function get_username(object $pdo, string $username) {
    $query = "SELECT username FROM admins WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function is_admidcodec_invalid(object $pdo, string $username) {
    $query = "SELECT admidcodec FROM admins WHERE admidcodec = :admidcodec;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":admidcodec", $admidcodec);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $firstname, string $surname, string $username, string $pwd, string $admidcodec){
    $query = "INSERT INTO admins (firstname, surname, username, pwd, admidcodec) VALUES(:firstname, :surname, :username, :pwd, :admidcodec);";
    $stmt = $pdo->prepare($query);

    $options =[
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindparam(":firstname", $firstname);
    $stmt->bindparam(":surname", $surname);
    $stmt->bindparam(":username", $username);
    $stmt->bindparam(":pwd", $hashedPwd);
    $stmt->bindparam(":admidcodec", $admidcodec);
    $stmt->execute();
}