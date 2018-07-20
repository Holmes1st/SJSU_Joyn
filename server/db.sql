CREATE DATABASE IF NOT EXISTS SJSU_TEAM_COMMA_2018;

USE SJSU_TEAM_COMMA_2018;

CREATE TABLE IF NOT EXISTS user (
    idx     INT(6)  PRIMARY KEY AUTO_INCREMENT,
    fname   VARCHAR(30) NOT NULL,
    lname   VARCHAR(30),
    email   VARCHAR(50) NOT NULL,
    pw      VARCHAR(50) NOT NULL,
    birth   DATE,
    registerdate    DATE
);

-- CREATE TABLE IF NOT EXISTS SPORTS (
--     NUM     INT(6) PRIMARY KEY
--     NAME
-- );
--
-- CREATE TABLE IF NOT EXISTS WHATSPORTUSERWANT (
--     UNUM
--     SNUM
-- );
--
-- CREATE TABLE IF NOT EXISTS MATCH (
--     NUM     INT(6) PRIMARY KEY
--     UNUM_1
--     UNUM_2
--     UNUM_N
--     SNUM
--     TIME
--     RESULT
-- );
--
-- CREATE TABLE IF NOT EXISTS RECORD (
--
-- );
