<?php
session_start();
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin_review.php");
    exit;
}

$application_id = intval($_POST['application_id'] ?? 0);
$new_status = $_POST['new_status'] ?? '';
$admin_id = $_SESSION['admin_id'] ?? 0; // Assume admin login session stores admin_id

$valid_statuses = ['pending','accepted','rejected'];
if ($application_id <= 0 || !in_array($new_status, $valid_statuses)) {
    $_SESSION['errors_admin'] = ['Invalid request'];
    header("Location: ../admin_review.php");
    exit;
}

// Update application
update_application_status($pdo, $application_id, $new_status, $admin_id);

header("Location: ../admin_review.php?update=success");
exit;

