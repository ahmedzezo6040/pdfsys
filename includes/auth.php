<?php
session_start();

function isLoggedI()
{
    return isset($_SESSION['user_id']);
}
