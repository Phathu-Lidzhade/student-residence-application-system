<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $admidcodec = $_POST["admidcodec"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($firstname, $surname, $username, $pwd, $admidcodec)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (isadmidcodecinvalid($pdo, $admidcodec)) {
            $errors["invalid_code"] = "Invalid Admin Code!";
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

        create_user($pdo, $firstname, $surname, $username, $pwd, $admidcodec);

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