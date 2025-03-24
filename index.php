<?php
include 'includes/auth.php';

if (isLoggedIn()) {
    header("Location: user/dashboard.php");
} else {
    header("Location: login.php");
}
