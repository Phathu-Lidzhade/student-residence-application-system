<?php

session_start();
session_unset();
session_destroy();

header("Location: ../../student_view_page/index.php");
die();