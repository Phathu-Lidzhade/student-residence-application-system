<?php

session_start();
session_unset();
session_destroy();

header("Location: ../../complete_admin/index.php");
die();