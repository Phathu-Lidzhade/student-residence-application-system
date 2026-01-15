<?php

declare(strict_types=1);

function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    }
} 

function check_no_signup_errors() {
    if (isset($_GET["register"]) && $_GET["register"] === "success"){
        
        echo '<p class="form_success">Registration Successfill!</p>';
    }
}