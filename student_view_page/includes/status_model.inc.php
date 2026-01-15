<?php

declare(strict_types=1);

function get_user(object $pdo, int $studentnjo){
    $query = "SELECT * FROM submissions WHERE studentno = :studentno;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":studentno", $studentno);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}