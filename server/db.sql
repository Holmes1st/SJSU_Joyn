CREATE DATABASE IF NOT EXISTS SJSU_TEAM_COMMA_2018;

USE SJSU_TEAM_COMMA_2018;

CREATE TABLE IF NOT EXISTS user (
    idx     INT(6)  PRIMARY KEY AUTO_INCREMENT,
    fname   VARCHAR(30) NOT NULL,
    lname   VARCHAR(30),
    email   VARCHAR(50) NOT NULL,
    pw      VARCHAR(50) NOT NULL,
    birth   DATE,
    imgUrl  VARCHAR(150),
    registerdate    DATE
);

CREATE TABLE IF NOT EXISTS sport (
    idx     INT(6) PRIMARY KEY AUTO_INCREMENT,
    name    VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS whatsportuserwant (
    uidx    INT(6) NOT NULL,
    sidx    INT(6),
    FOREIGN KEY (uidx) REFERENCES user (idx) ON DELETE CASCADE ON UPDATE RESTRICT,
    FOREIGN KEY (sidx) REFERENCES sport (idx) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS matchList (
    idx     INT(6) PRIMARY KEY AUTO_INCREMENT,
    sidx    INT(6),
    time    TIMESTAMP,
    -- invite  JSON,
    players JSON,
    -- CHECK (invite IS NULL OR JSON_VALID(invite)),
    CHECK (players IS NULL OR JSON_VALID(players)),
    FOREIGN KEY (sidx) REFERENCES sport (idx) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS friends (
    user1   INT(6) NOT NULL,
    user2   INT(6) NOT NULL,
    FOREIGN KEY (user1) REFERENCES user (idx) ON DELETE CASCADE ON UPDATE RESTRICT,
    FOREIGN KEY (user2) REFERENCES user (idx) ON DELETE CASCADE ON UPDATE RESTRICT,
    CHECK (user1 != user2)
);

-- CREATE TABLE IF NOT EXISTS RECORD (
--
-- );x

INSERT INTO sport (name) VALUES('Soccer');
INSERT INTO sport (name) VALUES('Basketball');
INSERT INTO sport (name) VALUES('Baseball');
INSERT INTO sport (name) VALUES('Tennis');
