-- sudo mysql -u root
-- CREATE DATABASE realty;
-- use realty
-- CREATE USER 'realty' IDENTIFIED BY 'realty';
-- GRANT ALL PRIVILEGES ON realty.* TO 'realty' WITH GRANT OPTION;
-- FLUSH PRIVILEGES;

-- Linux :
-- mysql -u realty  -p realty  < ./data/table.sql
-- mysql -u realty  -p realty  < ./data/seed.sql

-- Windows :
-- type .\data\table.sql | mysql -u realty -p realty   
-- type .\data\seed.sql | mysql -u realty -p realty

BEGIN;

DROP TABLE IF EXISTS 
`apartment`, 
`user`, 
`user_problem`, 
`user_invoice`, 
`apartment_rental`, 
`apartment_service`, 
`user_favorite`, 
`user_planning`, 
`apartment_check`, 
`employee_report`,
`service`,
`apartment_employee`,
`user_review` 
CASCADE;

CREATE TABLE `apartment` (
  apartment_id INT PRIMARY KEY AUTO_INCREMENT,
  apartment_title VARCHAR(255),
  apartment_description TEXT,
  apartment_main_picture VARCHAR(255),
  apartment_360_picture VARCHAR(255),
  apartment_adress VARCHAR(255),
  apartment_zip_code INT,
  apartment_city VARCHAR(255),
  apartment_price FLOAT,
  apartment_size INT,
  apartment_bedroom INT,
  apartment_capacity INT,
  apartment_is_free INT NOT NULL DEFAULT 1,
  apartment_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  apartment_updated_at timestamp
);

CREATE TABLE `user` (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  user_firstname VARCHAR(255),
  user_lastname VARCHAR(255),
  user_birth date,
  user_password VARCHAR(255),
  user_phone VARCHAR(255),
  user_address VARCHAR(255),
  user_zip_code VARCHAR(255),
  user_city VARCHAR(255),
  user_mail VARCHAR(255),
  user_statut VARCHAR(255) DEFAULT "client",
  user_active INT DEFAULT 1,
  user_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  user_updated_at timestamp
);

CREATE TABLE `user_problem` (
  user_problem_id INT PRIMARY KEY AUTO_INCREMENT,
  user_problem_user_id INT,
  user_problem_apartment_id INT,
  user_problem_description TEXT,
  user_problem_date date,
  user_problem_statut VARCHAR(255) DEFAULT 'In progress',
  FOREIGN KEY (user_problem_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (user_problem_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  user_problem_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  user_problem_updated_at timestamp
);

CREATE TABLE `user_invoice` (
  user_invoice_id INT PRIMARY KEY AUTO_INCREMENT,
  user_invoice_user_id INT,
  user_invoice_apartment_id INT,
  user_invoice_date date,
  user_invoice_amount FLOAT,
  FOREIGN KEY (user_invoice_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (user_invoice_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  user_invoice_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  user_invoice_updated_at timestamp
);

CREATE TABLE `apartment_rental` (
  apartment_rental_id INT PRIMARY KEY AUTO_INCREMENT,
  apartment_rental_user_id INT,
  apartment_rental_apartement_id INT,
  apartment_rental_start date,
  apartment_rental_end date,
  FOREIGN KEY (apartment_rental_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (apartment_rental_apartement_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  apartment_rental_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  apartment_rental_updated_at timestamp
);

CREATE TABLE `service` (
  service_id INT PRIMARY KEY AUTO_INCREMENT,
  service_name VARCHAR(255),
  apartment_service_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  apartment_service_updated_at timestamp
);

CREATE TABLE `apartment_service` (
  apartment_service_id INT PRIMARY KEY AUTO_INCREMENT,
  apartment_service_service_id INT,
  apartment_service_apartment_id INT,
  FOREIGN KEY (apartment_service_service_id) REFERENCES service(service_id) ON DELETE CASCADE,
  FOREIGN KEY (apartment_service_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  apartment_service_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  apartment_service_updated_at timestamp
);

CREATE TABLE `user_planning` (
  user_planning_id INT PRIMARY KEY AUTO_INCREMENT,
  user_planning_user_id INT,
  user_planning_apartment_id INT,
  user_planning_date date,
  FOREIGN KEY (user_planning_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (user_planning_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  user_planning_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  user_planning_updated_at timestamp
);

CREATE TABLE `apartment_employee` (
  apartment_employee_id INT PRIMARY KEY AUTO_INCREMENT,
  apartment_employee_apartment_id INT,
  apartment_employee_user_id INT,
  FOREIGN KEY (apartment_employee_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (apartment_employee_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  apartment_employee_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  apartment_employee_updated_at timestamp
);

CREATE TABLE `apartment_check` (
  apartment_check_id INT PRIMARY KEY AUTO_INCREMENT,
  apartment_check_apartment_id INT,
  apartment_check_task VARCHAR(255),
  apartment_check_statut VARCHAR(255) DEFAULT 'In progress',
  FOREIGN KEY (apartment_check_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  apartment_check_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  apartment_check_updated_at timestamp
);

CREATE TABLE `user_review` (
  user_review_id INT PRIMARY KEY AUTO_INCREMENT,
  user_review_user_id INT,
  user_review_apartment_id INT,
  user_review_comment VARCHAR(255),
  FOREIGN KEY (user_review_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (user_review_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  user_review_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  user_review_updated_at timestamp
);

CREATE TABLE `employee_report` (
  employee_report_id INT PRIMARY KEY AUTO_INCREMENT,
  employee_report_user_id INT,
  employee_report_apartment_id INT,
  employee_report_logistics_user_id INT,
  employee_report_message VARCHAR(255),
  employee_report_date date,
  FOREIGN KEY (employee_report_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (employee_report_logistics_user_id) REFERENCES user(user_id) ON DELETE CASCADE,
  FOREIGN KEY (employee_report_apartment_id) REFERENCES apartment(apartment_id) ON DELETE CASCADE,
  employee_report_created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  employee_report_updated_at timestamp
);

COMMIT;