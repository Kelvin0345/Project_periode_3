SET SQL_SAFE_UPDATES = 0;

-- step : 01 
-- /************************************************************
-- Doel Maak een nieuwe Database aan: lessenoverzicht
-- ************************************************************/
DROP DATABASE IF EXISTS lessenoverzicht;

CREATE DATABASE lessenoverzicht;
USE lessenoverzicht;

-- step : 02
-- /************************************************************
-- Doel Maak een nieuwe tabel aan: lessenoverzicht
-- ************************************************************/
CREATE TABLE lessenoverzicht
(
    Id              INT             NOT NULL AUTO_INCREMENT             COMMENT 'Primary key van tabel Les'
,Naam            VARCHAR(100)      NOT NULL                            COMMENT 'Naam van de les'
,Feature1        VARCHAR(100)      NULL                                COMMENT 'Eerste kenmerk van de les'
,Feature2        VARCHAR(100)      NULL                                COMMENT 'Tweede kenmerk van de les'
,Beschrijving    VARCHAR(250)      NULL                                COMMENT 'Beschrijving van de les'
,Prijs           DECIMAL(10,2)     NOT NULL                            COMMENT 'Prijs van de les'
,DatumAangemaakt DATETIME(6)       NOT NULL DEFAULT NOW(6)           COMMENT 'Datum waarop record is aangemaakt'
,DatumGewijzigd  DATETIME(6)       NOT NULL DEFAULT NOW(6)           COMMENT 'Datum van laatste wijziging'
,CONSTRAINT PK_Lessenoverzicht_Id PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- step : 03
-- /************************************************************
-- Doel vul de tabel lessenoverzicht met jouw lessen
-- ************************************************************/
INSERT INTO lessenoverzicht
(
    Naam,
    Feature1,
    Feature2,
    Beschrijving,
    Prijs,
    DatumAangemaakt,
    DatumGewijzigd
)
VALUES
('PT Starter pakket','Fitness Trainer A (NL-Actief / Level 3 EREPS)','Fitness Trainer B (NL-actief / Level 4 EREPS)','Voor een goede start als toekomstig personal trainer volg je Fitness Trainer A en B.',135.00,'2026-03-23',NOW(6)),
('PT Pro Pakket','Fitness Trainer A (NL-Actief / Level 3 EREPS)','Personal Trainer opleiding ACE (Level 4 EREPS)','Wil je als Personal Trainer een wereldwijd erkend diploma dan kies je dit pakket.',166.58,'2026-03-23',NOW(6)),
('PT Master Pakket','Fitness Trainer A (NL-Actief / Level 3 EREPS)','Personal Trainer Medical Exercise (Level 5 EREPS)','Onderscheid jezelf in de fitnessmarkt met dit complete pakket.',301.25,'2026-03-23',NOW(6)),
('PT Pro Package English','Fitness Trainer A English (Level 3)','Personal Trainer Course English ACE (Level 4 EREPS)','International recognized Personal Trainer Package.',126.60,'2026-03-23',NOW(6));