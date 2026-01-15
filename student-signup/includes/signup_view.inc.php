<?php

declare(strict_types=1);

function signup_inputs(){

    if (isset($_SESSION["signup_data"]["firstname"])) {
        echo '<input type="text" name="firstname" placeholder="Firstname" value="' .$_SESSION["signup_data"]["firstname"] . '">';
    } else {
        echo '<input type="text" name="firstname" placeholder="Firstname">';
    } echo '<br>';

    if (isset($_SESSION["signup_data"]["surname"])) {
        echo '<input type="text" name="surname" placeholder="surname" value="' . $_SESSION["signup_data"]["surname"] . '">';
    } else {
        echo '<input type="text" name="surname" placeholder="surname">';
    } echo '<br>';

    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo '<input type="text" name="username" placeholder="username" value="' . $_SESSION["signup_data"]["username"] . '">';
    } else {
        echo '<input type="text" name="username" placeholder="username">';
    } echo '<br>';

    echo '<input type="password" name="pwd" placeholder="Password">';
    echo '<br>';

    if (isset($_SESSION["signup_data"]["student_number"])) {
        echo '<input type="text" name="student_number" placeholder="Student Number" value="' . $_SESSION["signup_data"]["student_number"] . '">';
    } else {
        echo '<input type="text" name="student_number" placeholder="Student Number">';
    } echo '<br>';
}

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
    if (isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo '<br>';
        echo '<p class="form_success">Signup Successfill!</p>';
    }
}