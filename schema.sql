-- Create database
CREATE DATABASE IF NOT EXISTS entry_keeper_db;

-- Use the created database
USE entry_keeper_db;

-- Create users table (for guards/admin)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create visitors table
CREATE TABLE IF NOT EXISTS visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    type ENUM('regular', 'irregular') NOT NULL,
    department VARCHAR(100),  -- Only for regular visitors
    purpose VARCHAR(100),      -- Only for irregular visitors
    checkin_time DATETIME DEFAULT NULL,
    checkout_time DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create settings table to store various application configurations
CREATE TABLE IF NOT EXISTS settings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,             -- Unique setting key (for flexibility in adding new settings)
    setting_value VARCHAR(255) NOT NULL                   -- Value of the setting
);

-- Insert default values into the settings table, ignoring duplicates
INSERT IGNORE INTO settings (setting_key, setting_value) VALUES
('app_name', 'Entry Keeper'),                            -- Application name
('theme', 'light'),                                      -- Theme settings: light or dark
('email_notifications', '0'),                            -- Enable or disable email notifications (0 = off, 1 = on)
('visitor_auto_checkout', '0');                          -- Auto checkout visitors after a certain time (0 = off, 1 = on)
