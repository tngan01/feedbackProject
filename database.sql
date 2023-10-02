CREATE TABLE feedback(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100)NOT NULL,
    email VARCHAR(100) NOT NULL,
    body TEXT DEFAULT '',
    date DATETIME
);
INSERT INTO feedback(name, email, body, date)VALUES
('Ngan','ngan@gmail.com','I like it', current_timestamp()),
('Han','han@gmail.com','I like it', current_timestamp()),
('Ha','ha@gmail.com','I like it', current_timestamp()),
('Na','na@gmail.com','I like it', current_timestamp());
