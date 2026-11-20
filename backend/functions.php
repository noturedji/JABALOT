<?php
require '../config/config.php';

function login($mysqli, $workmail, $adminmail, $password, $role) {

    $emprole = $mysqli->prepare("SELECT role, password FROM employees WHERE workmail = ?");
    $emprole->bind_param("s", $workmail);
    $emprole->execute();
    $emproleresult = $emprole->get_result();
    $empres = $emproleresult->fetch_assoc();

    if ($empres && password_verify($password, $empres['password'])) {
        return ['type' => 'employee', 'role' => $empres['role']];
    }

    $adminrole = $mysqli->prepare("SELECT role, adminpass FROM admin WHERE adminmail = ?");
    $adminrole->bind_param("s", $adminmail);
    $adminrole->execute();
    $adminroleresult = $adminrole->get_result();
    $adminres = $adminroleresult->fetch_assoc();

    if ($adminres && password_verify($password, $adminres['adminpass'])) {
        return ['type' => 'admin', 'role' => $adminres['role']];
    }

    return false;
}