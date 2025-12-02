CREATE DATABASE WebTrgovina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER 'web01'@'localhost' IDENTIFIED BY '12345';

GRANT SELECT, INSERT, UPDATE, DELETE
ON WebTrgovina.*
TO 'web01'@'localhost';

FLUSH PRIVILEGES;

USE WebTrgovina;

CREATE TABLE kategorije (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naziv VARCHAR(100) NOT NULL
);

CREATE TABLE produkti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naziv VARCHAR(100) NOT NULL,
    kolicina INT NOT NULL,
    cijena DECIMAL(10,2) NOT NULL,
    kategorijaid INT NOT NULL,
    FOREIGN KEY (kategorijaid) REFERENCES kategorije(id)
);

INSERT INTO kategorije (naziv) VALUES
('Voće'),
('Povrće'),
('Pića'),
('Slatkiši'),
('Tehnologija');

INSERT INTO produkti (naziv, kolicina, cijena, kategorijaid) VALUES
('Jabuka', 50, 1.20, 1),
('Banana', 40, 1.10, 1),
('Jagoda', 20, 2.50, 1),

('Krumpir', 100, 0.80, 2),
('Luk', 60, 0.60, 2),
('Mrkva', 80, 0.90, 2),

('Coca-Cola', 30, 2.00, 3),
('Fanta', 25, 2.00, 3),
('Prirodni sok', 15, 2.50, 3),

('Čokolada', 35, 1.80, 4),
('Bomboni', 20, 1.20, 4),
('Napolitanke', 25, 1.50, 4),

('USB stick', 50, 10.00, 5),
('Miš', 30, 15.00, 5),
('Tipkovnica', 20, 25.00, 5);



