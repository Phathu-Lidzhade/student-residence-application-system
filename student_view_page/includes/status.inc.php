<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentno = intval($_POST["studentno"]);

    try {
        require_once 'dbh.inc.php';
        require_once 'status_model.inc.php';
        require_once 'status_view.inc.php';
        require_once 'status_contr.inc.php';

        //ERROR HANDLERS
        $errors = [];

        if (is_input_empty($studentno)) {
            $errors["empty_input"] = "Fill in Student Number";
        }

        $result = get_user($pdo, $studentno);

        if (is_studentno_right($result)) {
            $errors["table_error"] = "No infomation found";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
                $_SESSION["errors_status"] = $errors;

                header("Location: ../index.php");
                die();
            }

            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];
            session_id($sessionId);

            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_studentno"] = htmlspecialchars($result["studentno"]);

            $_SESSION["last_regeneration"] = time();

            header("Location: ../index.php?login=success");
            $pdo = null;
            $stmt = null;
            die();

        }

    catch (PDOException $e) {
        die("query failed: " . $e->getMessage());
    }

}    else {
    header("Location: student_view_page/index.php");
    die();
}