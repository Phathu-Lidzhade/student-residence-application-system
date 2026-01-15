<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Admin page</title>
</head>
<body>

    <header class="header">
        <div class="logo">
            <h1>Admin Page</h1>
        </div>
    </header>

<div class="container">

    <!--<h3>
        <?php
        //output_username();
        ?>
    </h3>-->

    <?php
    if (!isset($_SESSION["user_id"])) { ?>
        
        <h3>Admin Login</h3>

        <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="admidcodec" placeholder="Admin code">
            <br><br>
        <button>Login</button>
        </form>

    <?php } ?>

    <div class="errors">
    <?php
    check_login_errors();
    ?>
    </div>

    <h3>Admin Signup</h3>

    <form action="includes/signup.inc.php" method="post">
        <?php
        signup_inputs();
       ?>
       <br><br>
        <button>Sign up</button>
    </form>

<div class="errors">
    <?php
    check_signup_errors();
    ?>
</div>

<div class="no_errors">
    <?php
    check_no_signup_errors();
    ?>
</div>

<p>To return to student page <a href="../complete/index.php" class="button2">click here</a></p>

<!--<h3>Admin Logout</h3>

<form action="includes/logout.inc.php" method="post">
    <button>Logout</button>
</form>-->

</div>


</body>
</html>