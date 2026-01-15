<?php
session_start();
require_once 'dbh.inc.php';
require_once 'register_model.inc.php';
require_once 'register_contr.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_studentno']) || !isset($_SESSION['user_id'])) {
    header("Location: ../../student-signup/index.php");
    exit;
}

// Collect input
$studentno = $_SESSION['user_studentno'];
$student_id = $_SESSION['user_id'];
$gender = $_POST['gender'] ?? '';
$residence_id = intval($_POST['residence'] ?? 0);

$errors = [];

// Validate empty
if (empty($gender) || $residence_id === 0){
    $errors['empty_input'] = 'Please select gender and residence!';
}

// Check if student already applied to this residence
if (!$errors && is_already_applied($pdo, $student_id, $residence_id)){
    $errors['already_applied'] = 'You have already applied to this residence!';
}

if ($errors){
    $_SESSION['errors_signup'] = $errors;
    header("Location: ../index.php");
    exit;
}

// Create application with status 'pending'
create_application($pdo, $student_id, $residence_id);

header("Location: ../index.php?register=success");
exit;
