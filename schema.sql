CREATE DATABASE IF NOT EXISTS job_application_db;
USE job_application_db;

DROP TABLE IF EXISTS job_applications;

CREATE TABLE job_applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    position_applied VARCHAR(100) NOT NULL,
    years_experience INT NOT NULL,
    primary_stack VARCHAR(100) NOT NULL,
    portfolio_url VARCHAR(255) NOT NULL,
    expected_salary DECIMAL(10,2) NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
