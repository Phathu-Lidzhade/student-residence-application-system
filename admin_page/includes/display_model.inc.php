<?php

try {

    require_once 'dbh.inc.php';

    $data = "SELECT * FROM submissions";
    $stmt = $pdo->query($data);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}