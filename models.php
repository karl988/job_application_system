<?php
require_once 'dbConfig.php';

function insertApplication($pdo, $fn, $ln, $email, $phone, $position, $years, $stack, $portfolio, $salary) {
    $sql = "INSERT INTO job_applications
            (first_name, last_name, email, phone, position_applied, years_experience, primary_stack, portfolio_url, expected_salary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return $pdo->prepare($sql)->execute([$fn, $ln, $email, $phone, $position, $years, $stack, $portfolio, $salary]);
}

function getAllApplications($pdo) {
    return $pdo->query("SELECT * FROM job_applications ORDER BY date_added DESC")->fetchAll(PDO::FETCH_ASSOC);
}

function getApplicationByID($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM job_applications WHERE application_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateApplication($pdo, $id, $fn, $ln, $email, $phone, $position, $years, $stack, $portfolio, $salary) {
    $sql = "UPDATE job_applications SET first_name=?, last_name=?, email=?, phone=?,
            position_applied=?, years_experience=?, primary_stack=?, portfolio_url=?, expected_salary=?
            WHERE application_id=?";
    return $pdo->prepare($sql)->execute([$fn, $ln, $email, $phone, $position, $years, $stack, $portfolio, $salary, $id]);
}

function deleteApplication($pdo, $id) {
    return $pdo->prepare("DELETE FROM job_applications WHERE application_id = ?")->execute([$id]);
}
