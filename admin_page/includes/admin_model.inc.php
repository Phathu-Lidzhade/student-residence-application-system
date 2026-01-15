<?php
declare(strict_types=1);

// Fetch all applications with student and residence info
function get_all_applications(PDO $pdo): array {
    $stmt = $pdo->query("
        SELECT a.id AS application_id, s.student_number, s.full_name, r.name AS residence_name, a.status, a.created_at
        FROM applications a
        JOIN students s ON a.student_id = s.id
        JOIN residences r ON a.residence_id = r.id
        ORDER BY a.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Update application status and log history
function update_application_status(PDO $pdo, int $application_id, string $new_status, int $admin_id): void {
    // Get old status
    $stmt = $pdo->prepare("SELECT status FROM applications WHERE id = ?");
    $stmt->execute([$application_id]);
    $old_status = $stmt->fetchColumn();

    if ($old_status === false) return;

    // Update application
    $stmt = $pdo->prepare("UPDATE applications SET status = ?, reviewed_by = ?, reviewed_at = NOW() WHERE id = ?");
    $stmt->execute([$new_status, $admin_id, $application_id]);

    // Insert into history
    $stmt = $pdo->prepare("
        INSERT INTO application_status_history (application_id, old_status, new_status, changed_by, changed_at)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$application_id, $old_status, $new_status, $admin_id]);
}

