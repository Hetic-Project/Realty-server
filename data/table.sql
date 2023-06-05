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

DROP TABLE IF EXISTS `apartment`, `user`, `user_problem`, `user_invoice`, `apartment_rental`, `apartment_service`, `user_favorite`, `user_planning`, `apartment_check` CASCADE;

CREATE TABLE `apartment` (
  `apartment_id` integer PRIMARY KEY,
  `apartment_title` varchar(255),
  `apartment_description` text,
  `apartment_main_picture` varchar(255),
  `apartment_360_picture` varchar(255),
  `apartment_adress` varchar(255),
  `apartment_zip_code` integer,
  `apartment_city` varchar(255),
  `apartment_price` float,
  `apartment_size` integer COMMENT 'taille en mettre caré',
  `apartment_bedroom` integer COMMENT 'nombre de chambre',
  `apartment_capacity` integer COMMENT 'nombre de voyageur',
  `apartment_is_free` integer DEFAULT 1 COMMENT '1 = oui, 0 = non',
  `apartment_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `apartment_updated_at` timestamp
);

CREATE TABLE `user` (
  `user_id` integer PRIMARY KEY,
  `user_firstname` varchar(255),
  `user_lastname` varchar(255),
  `user_birth` date,
  `user_password` varchar(255),
  `user_phone` varchar(255),
  `user_address` varchar(255),
  `user_zip_code` varchar(255),
  `user_city` varchar(255),
  `user_mail` varchar(255),
  `user_statut` varchar(255) DEFAULT "client",
  `user_active` integer DEFAULT 1,
  `user_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `user_updated_at` timestamp
);

CREATE TABLE `user_problem` (
  `user_problem_id` integer PRIMARY KEY,
  `user_problem_user_id` integer,
  `user_problem_apartment_id` integer,
  `user_problem_description` text,
  `user_problem_statut` varchar(255),
  `user_problem_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `user_problem_updated_at` timestamp
);

CREATE TABLE `user_invoice` (
  `user_invoice_id` integer PRIMARY KEY,
  `user_invoice_user_id` integer,
  `user_invoice_apartment_id` integer,
  `user_invoice_date` date,
  `user_invoice_amount` float,
  `user_invoice_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `user_invoice_updated_at` timestamp
);

CREATE TABLE `apartment_rental` (
  `apartment_rental_id` integer PRIMARY KEY,
  `apartment_rental_user_id` integer,
  `apartment_rental_appartement_id` integer,
  `apartment_rental_start` date,
  `apartment_rental_end` date,
  `apartment_rental_duration` integer,
  `apartment_rental_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `apartment_rental_updated_at` timestamp
);

CREATE TABLE `apartment_service` (
  `apartment_service_id` integer PRIMARY KEY,
  `apartment_service_name` varchar(255),
  `apartment_service_apartment_id` integer,
  `apartment_service_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `apartment_service_updated_at` timestamp
);

CREATE TABLE `user_favorite` (
  `user_favorite_id` integer PRIMARY KEY,
  `user_favorite_apartment_id` integer,
  `user_favorite_user_id` integer,
  `user_favorite_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `user_favorite_updated_at` timestamp
);

CREATE TABLE `user_planning` (
  `user_planning_id` integer PRIMARY KEY,
  `user_planning_user_id` integer,
  `user_planning_apartment_id` integer,
  `user_planning_date` date,
  `user_planning_work_hour` integer COMMENT 'heure de travail prévue',
  `user_planning_minimum_wage` float COMMENT 'montant du smic horaire',
  `user_planning_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `user_planning_updated_at` timestamp
);

CREATE TABLE `apartment_check` (
  `apartment_check_id` integer PRIMARY KEY,
  `apartment_check_apartment_id` integer,
  `apartment_check_user_id` integer,
  `apartment_check_task` varchar(255),
  `apartment_check_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `apartment_check_updated_at` timestamp
);

ALTER TABLE `user_problem` ADD FOREIGN KEY (`user_problem_user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_problem` ADD FOREIGN KEY (`user_problem_apartment_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `user_invoice` ADD FOREIGN KEY (`user_invoice_user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_invoice` ADD FOREIGN KEY (`user_invoice_apartment_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `apartment_rental` ADD FOREIGN KEY (`apartment_rental_appartement_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `apartment_service` ADD FOREIGN KEY (`apartment_service_apartment_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `user_favorite` ADD FOREIGN KEY (`user_favorite_apartment_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `user_favorite` ADD FOREIGN KEY (`user_favorite_user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_planning` ADD FOREIGN KEY (`user_planning_user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_planning` ADD FOREIGN KEY (`user_planning_apartment_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `apartment_check` ADD FOREIGN KEY (`apartment_check_apartment_id`) REFERENCES `apartment` (`apartment_id`);

ALTER TABLE `apartment_check` ADD FOREIGN KEY (`apartment_check_user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `apartment_rental` ADD FOREIGN KEY (`apartment_rental_user_id`) REFERENCES `user` (`user_id`);

COMMIT;