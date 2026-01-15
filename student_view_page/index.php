<?php
include('includes/dbh.inc.php');
//require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/status_model.inc.php';
require_once 'includes/status_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Status</title>
</head>
<body>

<header class="header">
        <div class="logo">
            <h1>Student Page</h1>
        </div>
    </header>

<div class="container">

    <h2>Status</h2>
    <!--action="includes/status.inc.php"-->
    <form  method="post">
        <label for="studentno">Enter your Student Number</label>
        <br>
        <input type="text" name="studentno" placeholder="Student Number">
        <br><br>
        <button>Submit</button>
    </form>
    
    <div class="errors">
    <?php
    check_errors();
    ?>
    </div>
    
    <br>

    <?php
    // display_table()
    ?>

    <?php
    //table_data()
    ?>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Gender</th>
                <th>Created At</th>
                <th>Residence</th>
            </tr>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selected_studentno = $_POST["studentno"];

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT * FROM submissions WHERE studentno = :studentno";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindparam(":studentno", $studentno);
                    $stmt->execute(['studentno' => $selected_studentno]);

                    //$result = $stmt->get_result();
                    //return $result;

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["studentno"] . "</td>";
                        echo "<td>" . $row["firstname"] . "</td>";
                        echo "<td>" . $row["surname"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>" . $row["residence"] . "</td>";
            }

                } catch (PDOException $e) {
                    die("Connection failed: " . $e->getMessage());
                }

                $pdo = null;

            ?>

        </thead>
        <tbody>
            <?php
            /*$query = "SELECT * FROM submissions";
            $stmt = $pdo->prepare($query);
            //$stmt->bindparam(":studentno", $studentno);
            $stmt->execute();
        
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $result;

            if($result){
                
                foreach($result as $row){
                    ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['studentno']; ?></td>
                    <td><?= $row['firstname']; ?></td>
                    <td><?= $row['surname']; ?></td>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['residence']; ?></td>
                </tr>
                    <?php
                }

            } else {
                ?>
                <tr>
                    <td colspan="7">  No records found</td>
                </tr>
                <?php
            }*/
            }?>

        </tbody>
    </table>
    <br>

    <p> If you have not registered for residence... <br>
    <a href="../registration/index.php" class="button2">click here</a></p>
    <br>

    <form action="includes/logout.inc.php" method="post">
        <button>Logout</button>
    </form>

</div>

</body>
</html>