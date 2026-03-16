DROP TABLE IF EXISTS leden;

CREATE TABLE leden (
    id INT NOT NULL AUTO_INCREMENT,
    voornaam VARCHAR(100) NOT NULL,
    tussenvoegsel VARCHAR(50),
    achternaam VARCHAR(100) NOT NULL,
    geboortedatum DATE NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefoon VARCHAR(20),
    straat VARCHAR(150) NOT NULL,
    huisnummer VARCHAR(10) NOT NULL,
    postcode VARCHAR(10) NOT NULL,
    woonplaats VARCHAR(100) NOT NULL,
    lid_sinds DATE NOT NULL,
    actief TINYINT(1) NOT NULL DEFAULT 1,
    aangemaakt_op DATETIME DEFAULT CURRENT_TIMESTAMP,
    bijgewerkt_op DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE (email)
);

INSERT INTO leden
(voornaam, tussenvoegsel, achternaam, geboortedatum, email, telefoon, straat, huisnummer, postcode, woonplaats, lid_sinds, actief)
VALUES
('Jan', 'van der', 'Berg', '1990-04-12', 'jan.vanderberg@email.nl', '0612345678', 'Hoofdstraat', '12', '1012AB', 'Amsterdam', '2024-01-15', 1),
('Emma', NULL, 'Jansen', '1995-09-23', 'emma.jansen@email.nl', '0623456789', 'Dorpsweg', '45', '3011CD', 'Rotterdam', '2024-02-03', 1),
('Pieter', 'de', 'Vries', '1988-11-05', 'pieter.devries@email.nl', '0634567890', 'Stationslaan', '3', '3511EF', 'Utrecht', '2023-11-22', 0),
('Sophie', NULL, 'Bakker', '1992-06-18', 'sophie.bakker@email.nl', '0645678901', 'Kerkstraat', '78', '5611GH', 'Eindhoven', '2024-03-08', 1),
('Thomas', NULL, 'Visser', '1985-01-30', 'thomas.visser@email.nl', '0656789012', 'Parklaan', '9', '9712IJ', 'Groningen', '2024-04-19', 1),
('Lisa', NULL, 'Smit', '1998-12-14', 'lisa.smit@email.nl', '0667890123', 'Lindelaan', '25', '8011KL', 'Zwolle', '2024-05-12', 1);