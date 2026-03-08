-- Step : 01
-- *************************************************************
-- Doel : Maak een nieuwe database aan: Rollercoaster_2509b
-- *************************************************************
-- Versie   Datum        Auteur                Omschrijving
-- ******   **********   *************         *****************************
-- 01       04-12-2025   Arjan de Ruijter      Database met de hoogste 
--                                              achtbanen van Europa
-- *************************************************************

-- Verwijder database Rollercoaster_2509b
DROP DATABASE IF EXISTS Project3;

-- Maak de database Rollercoaster_2509b
CREATE DATABASE Project3;

-- Gebruik de database Rollercoaster_2509b
USE Project3;

-- Step : 02
-- *************************************************************
-- Doel : Maak een nieuwe tabel aan: Rollercoaster
-- *************************************************************
-- Versie   Datum        Auteur                Omschrijving
-- ******   **********   *************         *********************************
-- 01       04-12-2025   Arjan de Ruijter      Tabel met de hoogste 
--                                              achtbanen van Europa
-- *************************************************************

-- Maak de tabel Rollercoaster

CREATE TABLE Medewerkers 
(
 Id 				INT 		UNSIGNED	AUTO_INCREMENT PRIMARY KEY   NOT NULL
,Voornaam           VARCHAR(50)	 										 NOT NULL    
,Tussenvoegsel		VARCHAR(10)										 	     NULL	
,Achternaam			VARCHAR(50) 									     NOT NULL
,Nummer			    INT                                                  NOT NULL
,Medewerkersoort    VARCHAR(20)                                          NOT NULL
,IsActief           BIT                                                  NOT NULL
,Opmerking          VARCHAR(250)                                             NULL     
,DatumAangemaakt    DATETIME(6)                                          NOT NULL
,DatumGewijzigd     DATETIME(6)                                          NOT NULL
) ENGINE=InnoDB;

-- Step : 03
-- *******************************************************
-- Doel : Vul de tabel Rollercoaster met data
-- *******************************************************
-- Versie   Datum        Auteur              Omschrijving
-- ******   **********   *************       *****************************
-- 01       04-12-2025   Arjan de Ruijter    Vul tabel hoogste 
--                                           achtbanen van Europa
-- *******************************************************

-- Vul de tabel

INSERT INTO Medewerkers
(
     Voornaam
    ,Tussenvoegsel
    ,Achternaam
    ,Nummer
    ,Medewerkersoort
    ,IsActief
    ,Opmerking
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
('Jan', 'de', 'Ruijter', 1001, 'Manager', 1, 'Hoofd verantwoordelijke', NOW(6), NOW(6)),
('Sanne', NULL, 'Jansen', 1002, 'Beheerder', 1, 'Technisch beheer systeem', NOW(6), NOW(6)),
('Mohammed', NULL, 'El Amrani', 1003, 'Diskmedewerker', 1, NULL, NOW(6), NOW(6)),
('Lisa', 'van', 'Dijk', 1004, 'Diskmedewerker', 0, 'Tijdelijk uit dienst', NOW(6), NOW(6)),
('Kevin', NULL, 'Bakker', 1005, 'Beheerder', 1, NULL, NOW(6), NOW(6));
