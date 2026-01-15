<?php

session_start();
session_unset();
session_destroy();

header("Location: ../../admin-signup/index.php");
die();