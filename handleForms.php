<?php
require_once 'models.php';

if (isset($_POST['insertBtn'])) {
    insertApplication($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone'],
        $_POST['position_applied'], $_POST['years_experience'], $_POST['primary_stack'], $_POST['portfolio_url'], $_POST['expected_salary']);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['updateBtn'])) {
    updateApplication($pdo, $_POST['application_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'],
        $_POST['phone'], $_POST['position_applied'], $_POST['years_experience'], $_POST['primary_stack'], $_POST['portfolio_url'], $_POST['expected_salary']);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['deleteBtn'])) {
    deleteApplication($pdo, $_POST['application_id']);
    header("Location: ../index.php");
    exit;
}
