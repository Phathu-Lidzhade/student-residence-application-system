<?php
declare(strict_types=1);

function is_already_applied(PDO $pdo, int $student_id, int $residence_id): bool {
    $stmt = $pdo->prepare("SELECT id FROM applications WHERE student_id = ? AND residence_id = ?");
    $stmt->execute([$student_id, $residence_id]);
    return $stmt->fetch() !== false;
}

function create_application(PDO $pdo, int $student_id, int $residence_id): void {
    $stmt = $pdo->prepare("INSERT INTO applications (student_id, residence_id, status) VALUES (?, ?, 'pending')");
    $stmt->execute([$student_id, $residence_id]);
}

function get_student_info(PDO $pdo, string $student_number): ?array {
    $stmt = $pdo->prepare("SELECT id, firstname, surname FROM students WHERE student_number = ?");
    $stmt->execute([$student_number]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

function get_residences(PDO $pdo): array {
    $stmt = $pdo->prepare("SELECT id, name FROM residences WHERE is_active = 1");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
