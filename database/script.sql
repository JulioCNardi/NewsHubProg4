CREATE SCHEMA newshub;
USE newshub;

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    auth_key VARCHAR(32),
    access_token VARCHAR(255),
    created_at INT,
    updated_at INT
);
