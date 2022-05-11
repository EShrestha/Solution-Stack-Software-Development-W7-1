USE myDB;
CREATE TABLE Page(
  ID int AUTO_INCREMENT,
  isVisible boolean,
  title varchar(10),
  body varchar(8000),
  footer varchar(1000),
  PRIMARY KEY(ID)
);

CREATE TABLE Sub_Pages
(
    belongsTo int,
    ID int AUTO_INCREMENT,
    isVisible boolean,
    title varchar(10),
    body varchar(8000),
    footer varchar(1000),
     PRIMARY KEY(ID)

);

CREATE TABLE Users
(
    isAdmin boolean,
    username varchar(20),
    pwd varchar(20)
);

CREATE TABLE Website
(
    styleSheet varchar(50)
);