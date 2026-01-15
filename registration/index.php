<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/register_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Registration</title>
  </head>
  <body>

    <header class="header">
        <div class="logo">
            <h1>Registration Page</h1>
        </div>
    </header>

    <div class="container">
    <h2>Registration Page</h2>

    <form action="includes/register.inc.php" method="post">
      <label for="studentno">Student Number</label>
      <br />
      <input
        type="number"
        name="studentno"
        id="studentno"
        placeholder="Student Number"
      />

      <br /><br />
      <label for="firstname">First Name</label>
      <br />
      <input
        type="text"
        id="firstname"
        name="firstname"
        placeholder="First Name"
      />
      <br /><br />
      <label for="surname">Surname</label>
      <br />
      <input type="text" id="surname" name="surname" placeholder="Surname" />

      <br />
      <!--<label for="message">Write anything</label>
      <br />
      <textarea
        name="message"
        id="message"
        placeholder="write something. . ."
        cols="30"
        rows="10"
      ></textarea>-->
      <br />
      <label>Select Gender</label>
      <br />
      <input type="radio" name="gender" id="male" value="male"/>
      <label for="male">Male</label>
      <input type="radio" name="gender" id="female" value="female"/>
      <label for="female">Female</label>
      <input type="radio" name="gender" id="other" value="other"/>
      <label for="other">Other</label>
      <br /><br />

      <label for="residence">Select Residence</label>
      <br />
      <select name="residence" id="residence">
        <option >SELECT RESIDENCE....</option>
        <option value="River Estate">River Estate</option>
        <option value="F3 Male">F3 Male</option>
        <option value="Bernard Ncube Female">Bernard Ncube Female</option>
        <option value="F6 New Female">F6 New Female</option>
        <option value="Lost City Boys">Lost City Boys</option>
        <option value="Mvelaphanda Male">Mvelaphanda Male</option>
        <option value="Carousel Male">Carousel Male</option>
        <option value="F4 Female">F4 Female</option>
        <option value="F6 New Female">F6 New Female</option>
        <option value="Lost City Girls">Lost City Girls</option>
        <option value="Riverside Postgraduate">Riverside Postgraduate</option>
        <option value="Mango grove">Mango grove</option>
        <option value="F5 Female">F5 Female</option>
        <option value="Mvelaphanda Female">Mvelaphanda Female</option>
        <option value="F3 Male">F3 Male</option>
      </select>
      <br /><br />
      <button type="submit">Submit</button>

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

    </form>

    <form action="includes/logout.inc.php" method="post">
    <p> If you're done with the registration click back... <br><br> <button>Back</button></p>
    </form>

    </div>

  </body>
</html>
