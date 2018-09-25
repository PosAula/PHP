<?php

session_start();

session_unset();
//$_SESSION['status'] = FALSE;
session_destroy();
header('Location: login.php');
