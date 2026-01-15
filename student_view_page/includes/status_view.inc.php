<?php

declare(strict_types=1);

//require_once 'includes/dbh.inc.php';

function check_errors(){
    if(isset($_SESSION["errors_status"])){
        $errors = $_SESSION["errors_status"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION["errors_status"]);
    } elseif (isset($_GET['login']) && $_GET['login'] === "success") {
        
    }
}

//$products = get_user($pdo, $studentno);
/*$result = get_user($pdo, $studentno);

function display_table($result) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Student Number</th>';
    echo '<th>First Name</th>';
    echo '<th>Surname</th>';
    echo '<th>Gender</th>';
    echo '<th>Created At</th>';
    echo '<th>Residence</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    foreach ($result as $results) {
        echo '<tr>';
        echo '<td>' . $results['id'] . '</td>';
        echo '<td>' . $results['studentno'] . '</td>';
        echo '<td>' . $results['firstname'] . '</td>';
        echo '<td>' . $results['surname'] . '</td>';
        echo '<td>' . $results['gender'] . '</td>';
        echo '<td>' . $results['created_at'] . '</td>';
        echo '<td>' . $results['residence'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}*/