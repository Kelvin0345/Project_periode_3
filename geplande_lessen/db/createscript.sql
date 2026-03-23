-- Step : 01
-- ***********************************************
-- Doel : Maak een nieuwe database aan: Geplande_Lessen
-- ***********************************************
-- Versie      Datum        Auteur                Omschrijving
-- *****       ********     *****************     ******************************
-- 01          04-12-2025   KElvin                Geplande_Lessen
-- ***********************************************

-- Verwijder database Reserverings_Overzicht
DROP DATABASE IF EXISTS Geplande_Lessen;

-- Maak de database Reserverings_Overzicht
CREATE DATABASE Geplande_Lessen;

-- Gebruik de database Reserverings_Overzicht
USE Geplande_Lessen;

-- Step : 02
-- ***********************************************
-- Doel : Maak een nieuwe tabel aan: LesOverzicht
-- ***********************************************
-- Versie      Datum        Auteur                Omschrijving
-- *****       ********     *****************     ******************************
-- 01          04-12-2025   Kelvin                Geplande_Lessen
-- ***********************************************

-- Maak de tabel LesOverzicht

CREATE TABLE LesOverzicht (
     Id                 SMALLINT        UNSIGNED   NOT NULL        AUTO_INCREMENT  COMMENT 'Primary key of the Reservering table'
    ,Naam               VARCHAR(50)       NOT NULL                  COMMENT 'Naam'
    ,Prijs              Decimal(5,2)       NOT   NULL                      COMMENT 'Tussenvoegsel van de naam (optioneel)'
    ,Datum              DATE                NOT NULL            
    ,Tijd               TIME                Not null
    ,MinAantalPersonen  Tinyint             not null            COMMENT 'Minimaal aantal personen per les 3'
    ,MaxAantalPersonen Tinyint              Not null             COMMENT 'Maximaal aantal personen per les 9'
    ,Beschikbaarheid    VARCHAR(50)         NOT null            COMMENT 'Ingepland, Niet gestart, Gestart en en Geannuleerd'
    ,IsActief           BIT                 NOT NULL             DEFAULT 1   COMMENT 'Geeft aan of de persoon actief is (1 = Ja, 0 = Nee)'  
    ,Opmerking          VARCHAR(250)        NULL            
    ,DatumAangemaakt     DATETIME(6)        NOT NULL			DEFAULT NOW(6)  COMMENT 'Datum en tijd van aanmaak'
    ,DatumGewijzigd     DATETIME(6)         NOT NULL			DEFAULT NOW(6)  COMMENT 'Datum en tijd van laatste wijziging'
    ,CONSTRAINT PK_Persoon_Id PRIMARY KEY (Id)                      COMMENT 'Ingepland, Niet gestart, gestart, en geannuleerd'

) ENGINE=InnoDB;

-- Step : 03
-- ***********************************************
-- Doel : Vul de tabel LesOverzicht met data
-- ***********************************************
-- Versie      Datum        Auteur                Omschrijving
-- *****       ********     *****************     ******************************
-- 01          04-12-2025   Kelvin F      Vul tabel hoogste 
--                                                achtbanen van Europa
-- ***********************************************

-- Vul de tabel

INSERT INTO LesOverzicht
(
     Naam
    ,Prijs                                 
    ,Datum                          
    ,Tijd              
    ,MinAantalPersonen  
    ,MaxAantalPersonen 
    ,Beschikbaarheid                   
)
VALUES
    
     ('Gerco', 15.00, '2026-03-10', '18:00:00', 4, 3, 'Ingepland')
    ,('Mark', 17.50, '2026-03-11', '19:00:00', 5, 4, 'Gestart')
    ,('Otto', 12.50, '2026-03-12', '20:00:00', 6, 3, 'Geannuleerd')
    ,('Lesek', 14.00, '2026-03-13', '18:30:00', 7, 4, 'Niet gestard')
    ,('Quenten', 18.00, '2026-03-14', '19:30:00', 4, 4, 'Ingepland')
    ,('Maicah', 16.00, '2026-03-15', '17:30:00', 5, 5, 'Gestart')
    ,('Roan', 20.00, '2026-03-16', '18:00:00', 5, 9, 'Geannuleerd')
    ,('Aysar', 10.00, '2026-03-17', '19:00:00', 4, 9, 'Ingepland');


CREATE TABLE OverzichtAantalLedenPerPeriode 
(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    PeriodeStart DATE NOT NULL,
    PeriodeEind DATE NOT NULL,
    AantalNieuweLeden INT NOT NULL DEFAULT 0,
    AantalVertrokkenLeden INT NOT NULL DEFAULT 0,
    TotaalAantalLeden INT NOT NULL DEFAULT 0,
    IsActief           BIT                 NOT NULL             DEFAULT 1   COMMENT 'Geeft aan of de persoon actief is (1 = Ja, 0 = Nee)', 
    Opmerking VARCHAR(255) NULL
      ,DatumAangemaakt     DATETIME(6)        NOT NULL			DEFAULT NOW(6)  COMMENT 'Datum en tijd van aanmaak'
    ,DatumGewijzigd     DATETIME(6)         NOT NULL			DEFAULT NOW(6)  COMMENT 'Datum en tijd van laatste wijziging'
) ENGINE=InnoDB;

INSERT INTO OverzichtAantalLedenPerPeriode
(    PeriodeStart, 
     PeriodeEind, 
     AantalNieuweLeden, 
     AantalVertrokkenLeden, 
     TotaalAantalLeden)
VALUES
('2026-01-01', '2026-01-31', 12, 2, 100),
('2026-02-01', '2026-02-28', 14, 1, 113),
('2026-03-01', '2026-03-31', 15, 3, 125),
('2026-04-01', '2026-04-30', 10, 5, 130),
('2026-05-01', '2026-05-31', 8, 4, 134),
('2026-06-01', '2026-06-30', 13, 2, 145),
('2026-07-01', '2026-07-31', 9, 3, 151),
('2026-08-01', '2026-08-31', 11, 4, 158),
('2026-09-01', '2026-09-30', 7, 2, 163),
('2026-10-01', '2026-10-31', 14, 5, 172),
('2026-11-01', '2026-11-30', 10, 3, 179),
('2026-12-01', '2026-12-31', 12, 4, 187);