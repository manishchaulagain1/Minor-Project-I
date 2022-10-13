CREATE DATABASE eventmenu_db;
USE eventmenu_db;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    phone CHAR(10),
    email VARCHAR(100),
    password CHAR(32),
    address VARCHAR(100),
    role_id TINYINT(4),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pic (
	pic_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    image VARCHAR(50),
    FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE feedback (
	feedback_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    message VARCHAR(250),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE events (
	event_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    event_type VARCHAR(50),
    event_date DATE,
    start_time TIME,
    end_time TIME,
    guest INT,
    event_status VARCHAR(50),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users
VALUES (1, "Anish", "Kayastha", '9818385164', "anish.kayastha@gmail.com", MD5("Admin123"), "Sanepa", 1, '2021-04-11 21:21:55');
INSERT INTO users
VALUES (2, "Manish", "Chaulagain", '1234567890', "manish.chaulagain@gmail.com", MD5("Admin123"), "Sinamangal", 0, '2021-04-12 11:36:22');
INSERT INTO users
VALUES (3, "Ajai", "Shakya", '1111111111', "ajai.shakya@gmail.com", MD5("Admin123"), "Boudha", 0, '2021-04-12 11:55:35');
INSERT INTO users
VALUES (4, "Ishwor", "Shrestha", '2222222222', "ishwor.shrestha@gmail.com", MD5("Admin123"), "Pulchowk", 1, '2021-04-13 03:55:00');

INSERT INTO feedback
VALUES (1, 2, "Hello Admin", '2021-04-25 21:21:55');
INSERT INTO feedback
VALUES (2, 2, "Good experience", '2021-04-26 21:21:55');

INSERT INTO events
VALUES (1, 2, "Meeting", '2021-05-24', '18:00:00', '12:00:00', 100, 'Accepted');
INSERT INTO events
VALUES (2, 3, "Birthday", '2021-05-26', '18:00:00', '12:00:00', 200, 'Pending');
INSERT INTO events
VALUES (3, 2, "Conference", '2021-05-27', '18:00:00', '12:00:00', 300, 'Pending');