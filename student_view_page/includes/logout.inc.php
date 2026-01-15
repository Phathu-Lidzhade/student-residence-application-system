<?php

session_start();
session_unset();
session_destroy();

header("Location: ../../complete/index.php");
die();