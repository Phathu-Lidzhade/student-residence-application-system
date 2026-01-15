<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $studentno = isset($_POST["studentno"]) ? intval($_POST["studentno"]) : 0;
    $firstname = $_POST["firstname"] ?? "";
    $surname = $_POST["surname"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $residence = $_POST["residence"] ?? "";

    try {
        
        require_once 'dbh.inc.php';
        require_once 'register_model.inc.php';
        require_once 'register_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($studentno, $firstname, $surname, $gender, $residence)){
            $errors["empty_input"] = "Fill in all fields!";
        }
        
        if (is_studentno_taken($pdo, $studentno)){
            $errors["studentno_taken"] = "Student Number already taken!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "firstname" => $firstname,
                "surname" => $surname,
                "username" => $username,
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }

        create_user($pdo, $studentno, $firstname, $surname, $gender, $residence);

        header("Location: ../index.php?register=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }


} else {
    header("Location: ../index.php");
    die();
}