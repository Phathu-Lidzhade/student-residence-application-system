<?php
declare(strict_types=1);

// Get student by student number
function get_student_by_number(PDO $pdo, int $studentno): ?array {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE student_number = ?");
    $stmt->execute([$studentno]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

// Get student by ID
function get_student_by_id(PDO $pdo, int $student_id): ?array {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$student_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

// Get all applications of a student with residence names and status
function get_student_applications(PDO $pdo, int $student_id): array {
    $stmt = $pdo->prepare("
        SELECT a.id AS application_id, r.name AS residence_name, a.status, a.applied_at
        FROM applications a
        JOIN residences r ON a.residence_id = r.id
        WHERE a.student_id = ?
        ORDER BY a.applied_at DESC
    ");
    $stmt->execute([$student_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
