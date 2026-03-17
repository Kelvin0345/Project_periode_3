SET SQL_SAFE_UPDATES = 0;

DROP DATABASE IF EXISTS accountenoverzicht;
CREATE DATABASE accountenoverzicht;
USE accountenoverzicht;

CREATE TABLE accountenoverzicht
(
    Id               INT NOT NULL AUTO_INCREMENT COMMENT 'Primary key van tabel Persoon',
    Voornaam         VARCHAR(50)  NOT NULL COMMENT 'Voornaam van de persoon',
    Tussenvoegsel    VARCHAR(10)  NULL COMMENT 'Tussenvoegsel van de persoon',
    Achternaam       VARCHAR(50)  NOT NULL COMMENT 'Achternaam van de persoon',
    Relatienummer    MEDIUMINT    NOT NULL COMMENT 'Uniek relatienummer',
    Mobiel           VARCHAR(20)  NOT NULL COMMENT 'Mobiel telefoonnummer',
    Email            VARCHAR(100) UNIQUE NOT NULL COMMENT 'Email adres',
    Wachtwoord       VARCHAR(255) NOT NULL COMMENT 'Wachtwoord van het account',
    Isactief         BIT          NOT NULL DEFAULT 1 COMMENT 'Geeft aan of de persoon actief is (1)',
    Opmerking        VARCHAR(250) NULL DEFAULT NULL COMMENT 'Extra opmerking',
    Datumaangemaakt  DATETIME(6)  NOT NULL DEFAULT NOW(6) COMMENT 'Datum waarop record is aangemaakt',
    Datumgewijzigd   DATETIME(6)  NOT NULL DEFAULT NOW(6) COMMENT 'Datum van laatste wijziging',
    CONSTRAINT PK_Accountenoverzicht_Id PRIMARY KEY (Id)
) ENGINE=InnoDB;

INSERT INTO accountenoverzicht
(
    Voornaam,
    Tussenvoegsel,
    Achternaam,
    Relatienummer,
    Mobiel,
    Email,
    Wachtwoord,
    Isactief,
    Opmerking,
    Datumaangemaakt,
    Datumgewijzigd
)
VALUES
('Jan', NULL, 'van der Berg', 2001, '0612345678', 'jan.vanderberg@email.nl', 'jan123', 1, NULL, '2026-03-05', NOW(6)),
('Emma', NULL, 'Jansen', 2002, '0623456789', 'emma.jansen@email.nl', 'emma123', 1, NULL, '2026-03-05', NOW(6)),
('Pieter', NULL, 'de Vries', 2003, '0634567890', 'pieter.devries@email.nl', 'pieter123', 0, NULL, '2026-03-05', NOW(6)),
('Sophie', NULL, 'Bakker', 2004, '0645678901', 'sophie.bakker@email.nl', 'sophie123', 1, NULL, '2026-03-05', NOW(6)),
('Thomas', NULL, 'Visser', 2005, '0656789012', 'thomas.visser@email.nl', 'thomas123', 1, NULL, '2026-03-05', NOW(6)),
('Lisa', NULL, 'Smit', 2006, '0667890123', 'lisa.smit@email.nl', 'lisa123', 1, NULL, '2026-03-05', NOW(6));