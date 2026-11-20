<?php
session_start();
require '../config/config.php';
require 'functions.php';

$action = $_POST['action'] ?? '';
$error = "Incorrect username or password";

switch ($action) {

    case 'login':
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = login($mysqli, $email, $email, $password, '');

        if ($user) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_type'] = $user['type'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['type'] === 'admin') {
                header('Location: ../frontend/admin.php');
            } else {
                header('Location: ../frontend/dashboard.php');
            }
        } else {
            echo $error;
        }
        exit;

    case 'logout':
        session_destroy();
        header('Location: ../index.php');
        exit;

    default:
        http_response_code(400);
        exit('Unknown action');
}