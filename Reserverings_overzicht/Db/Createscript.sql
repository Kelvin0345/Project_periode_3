-- Step : 01
-- ***********************************************
-- Doel : Maak een nieuwe database aan: Reserverings_Overzicht
-- ***********************************************
-- Versie      Datum        Auteur                Omschrijving
-- *****       ********     *****************     ******************************
-- 01          04-12-2025   KElvin                Reserverings overzicht
-- ***********************************************

-- Verwijder database Reserverings_Overzicht
DROP DATABASE IF EXISTS Reserverings_Overzicht;

-- Maak de database Reserverings_Overzicht
CREATE DATABASE Reserverings_Overzicht;

-- Gebruik de database Reserverings_Overzicht
USE Reserverings_Overzicht;

-- Step : 02
-- ***********************************************
-- Doel : Maak een nieuwe tabel aan: Reservering
-- ***********************************************
-- Versie      Datum        Auteur                Omschrijving
-- *****       ********     *****************     ******************************
-- 01          04-12-2025   Kelvin                Reserverings overzicht
-- ***********************************************

-- Maak de tabel Reservering

CREATE TABLE Reservering (
     Id                         SMALLINT        UNSIGNED   NOT NULL        AUTO_INCREMENT  COMMENT 'Primary key of the Reservering table'
    ,Voornaam           VARCHAR(50)       NOT NULL                  COMMENT 'Voornaam van de persoon'
    ,Tussenvoegsel      VARCHAR(10)       NULL                      COMMENT 'Tussenvoegsel van de naam (optioneel)'
    ,Achternaam         VARCHAR(50)       NOT NULL                  COMMENT 'Achternaam van de persoon'
    ,Nummer             MEDIUMINT         NOT NULL                  COMMENT 'Persoonlijk nummer'
    ,Datum              DATE              NOT NULL                  COMMENT 'Geboortedatum'
    ,Tijd               TIME              NOT NULL                  COMMENT 'Tijdstip'
    ,Reserveringstatus  VARCHAR(20)       NOT NULL                  COMMENT 'Status van reservering: Vrij, Bezet, Gereserveerd, Geannuleerd'
    ,IsActief           BIT               NOT NULL DEFAULT 1        COMMENT 'Geeft aan of de persoon actief is (1 = Ja, 0 = Nee)'
    ,Opmerking          VARCHAR(250)      NULL                      COMMENT 'Eventuele opmerkingen'
    ,DatumAangemaakt    DATETIME(6)       NOT NULL DEFAULT NOW(6)  COMMENT 'Datum en tijd van aanmaak'
    ,DatumGewijzigd     DATETIME(6)       NOT NULL DEFAULT NOW(6)  COMMENT 'Datum en tijd van laatste wijziging'
    ,CONSTRAINT PK_Persoon_Id PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Step : 03
-- ***********************************************
-- Doel : Vul de tabel Rollercoaster met data
-- ***********************************************
-- Versie      Datum        Auteur                Omschrijving
-- *****       ********     *****************     ******************************
-- 01          04-12-2025   Kelvin F      Vul tabel hoogste 
--                                                achtbanen van Europa
-- ***********************************************

-- Vul de tabel

INSERT INTO Reservering
(
     Voornaam
    ,Tussenvoegsel      
    ,Achternaam        
    ,Nummer             
    ,Datum             
    ,Tijd                      
    ,Reserveringstatus                   
)
VALUES
	('Jan', '', 'Jansen', 101, '2026-03-01', '09:00', 'Bevestigd')
   ,('Marie', '', 'Klaassen', 102, '2026-03-01', '10:30', 'Bevestigd')
   ,('Peter', 'van', 'Dijk', 103, '2026-03-01', '12:00', 'Geannuleerd')
   ,('Sanne', '', 'de Vries', 104, '2026-03-02', '09:00', 'Bevestigd')
   ,('Tom', '', 'Bakker', 105, '2026-03-02', '10:30', 'Bevestigd')
   ,('Linda', '', 'Smits', 106, '2026-03-02', '12:00', 'Bevestigd')
   ,('Kees', '', 'Janssen', 107, '2026-03-03', '09:00', 'Bevestigd');

















