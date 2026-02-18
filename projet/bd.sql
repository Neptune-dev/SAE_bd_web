CREATE TABLE TEST (
    id int,
    nom varchar2(50),
    prenom varchar2(50),
    PRIMARY KEY (ID)
);

INSERT INTO TEST (ID, NOM, PRENOM) VALUES
(1,'Pichet', 'Pierre'),
(2, 'Cale', 'Thomas');

------------------------------------------------

--- Création des entités

CREATE TABLE ESPECE (
    id_espece int,
    nom_latin varchar2(50) NOT NULL,
    nom_usuel varchar2(30) NOT NULL,
    menacee int,
    PRIMARY KEY (id_espece)
);

CREATE TABLE ANIMAL (
    rfid int,
    id_espece_animal int NOT NULL,
    nom varchar2(30) NOT NULL,
    prenom varchar2(30),
    date_de_naissance DATE NOT NULL,
    poids int NOT NULL,
    PRIMARY KEY (rfid),
    FOREIGN KEY (id_espece_animal) REFERENCES ESPECE(ID_ESPECE)
);

CREATE TABLE REGIME (
    id_regime int,
    libelle varchar2(500),
    PRIMARY KEY (id_regime)
);

CREATE TABLE NOURRITURE (
    rfid_nourri int,
    date_nourriture DATE NOT NULL,
    description_nourriture varchar2(500) NOT NULL,
    PRIMARY KEY (rfid_nourri),
    FOREIGN KEY (rfid_nourri) REFERENCES ANIMAL(RFID)
);

CREATE TABLE ENCLOS (
    id_enclos int,
    latitude int,
    longitude int,
    surface int,
    PRIMARY KEY (id_enclos)
);

CREATE TABLE PERSONNEL (
    id_personnel int,
    type_personnel varchar2(30),
    nom varchar2(30) NOT NULL,
    prenom varchar2(30),
    pwd varchar2(50) NOT NULL,
    date_entree DATE NOT NULL,
    date_fin DATE,
    salaire int NOT NULL,
    PRIMARY KEY (id_personnel)
);

CREATE TABLE EQUIPE (
    id_equipe int,
    chef int,
    PRIMARY KEY (id_equipe),
    FOREIGN KEY (chef) REFERENCES PERSONNEL(ID_PERSONNEL)
);

--- Création des associations

CREATE TABLE FILIATION (
    rfid_parent1 int,
    rfid_parent2 int,
    type_parent varchar2(30),
    PRIMARY KEY (rfid_parent1, rfid_parent2),
    FOREIGN KEY (rfid_parent1) REFERENCES ANIMAL(RFID),
    FOREIGN KEY (rfid_parent2) REFERENCES ANIMAL(RFID)
);

CREATE TABLE RATTACHEMENT (
    id_rattachement int,
    personnel_rattachement int NOT NULL,
    equipe_rattachement int NOT NULL,
    PRIMARY KEY (id_rattachement)
);