<?php

declare(strict_types=1);

function get_studentno(object $pdo, int $studentno) {
    $query = "SELECT studentno FROM submissions WHERE studentno = :studentno;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":studentno", $studentno);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, int $studentno, string $firstname, string $surname, string $gender, string $residence){
    $query = "INSERT INTO submissions(studentno, firstname, surname, gender, residence) VALUES(:studentno, :firstname, :surname, :gender, :residence);";
    $stmt = $pdo->prepare($query);

    $stmt->bindparam(":studentno", $studentno);
    $stmt->bindparam(":firstname", $firstname);
    $stmt->bindparam(":surname", $surname);
    $stmt->bindparam(":gender", $gender);
    $stmt->bindparam(":residence", $residence);
    $stmt->execute();
}