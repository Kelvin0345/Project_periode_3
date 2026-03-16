CREATE DATABASE unhappyscenario
DROP DATABASE IF EXISTS unhappyscenario
USE unhappyscenario

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
('Test', NULL, 'test', 1005, 'Beheerder', 1, NULL, NOW(6), NOW(6));