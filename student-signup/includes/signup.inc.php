<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $student_number = $_POST["student_number"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($firstname, $surname, $username, $pwd, $student_number)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "username already taken!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "firstname" => $firstname,
                "surname" => $surname,
                "username" => $username,
                "student_number" => $student_number,
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }

        create_user($pdo, $firstname, $surname, $username, $pwd, $student_number);

        header("Location: ../index.php?signup=success");

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