CREATE TABLE individu(
	RFID CHAR(8) PRIMARY KEY
);

CREATE TABLE espece(
	id_espece CHAR(8) PRIMARY KEY, 
	nom_latin VARCHAR(255), 
	nom_usuel VARCHAR(255),
	menacee NUMBER(1) NOT NULL
);

CREATE TABLE regime(
	id_regime CHAR(8) PRIMARY KEY, 
	libelle_regime VARCHAR(255)
);

CREATE TABLE animal(
	RFID CHAR(8) PRIMARY KEY, 
	nom_animal VARCHAR(255), 
	prenom_animal VARCHAR(255), 
	date_de_naissance_animal DATE, 
	poids_animal NUMBER(3), 
	espece_animal CHAR(8), 
	regime_animal CHAR(8),
	FOREIGN KEY (RFID) REFERENCES individu(RFID), 
	FOREIGN KEY (espece_animal) REFERENCES espece(id_espece),
	FOREIGN KEY (regime_animal) REFERENCES regime(id_regime)
);

CREATE TABLE filiation(
	id_enfant CHAR(8), 
	type_parent VARCHAR(10), 
	id_parent CHAR(8), 
	PRIMARY KEY (id_enfant,type_parent),
	FOREIGN KEY (id_enfant) REFERENCES animal(RFID), 
	FOREIGN KEY (id_parent) REFERENCES individu(RFID), 
	CHECK (type_parent IN ('PERE', 'MERE'))
);

CREATE TABLE autoriser(
	id_espece1 CHAR(8), 
	id_espece2 CHAR(8), 
	autorise NUMBER(1), 
	FOREIGN KEY (id_espece1) REFERENCES espece(id_espece), 
	FOREIGN KEY (id_espece2) REFERENCES espece(id_espece), 
	PRIMARY KEY (id_espece1,id_espece2), 
	CHECK (autorise IN (0,1))
);

CREATE TABLE alimentation(
	RFID CHAR(8), 
	id_regime CHAR(8), 
	date_de_nour DATE, 
	quantite NUMBER(2), 
	PRIMARY KEY (RFID,date_de_nour), 
	FOREIGN KEY (RFID) REFERENCES animal(RFID),
	FOREIGN KEY (id_regime) REFERENCES regime(id_regime)
);

CREATE TABLE zone(
	id_zone CHAR(8) PRIMARY KEY
);

-- Précision à 10 cm près pour les coordonnées GPS et jusqu'à 99 999 999,99 m carré pour la surface
CREATE TABLE enclos(
	id_enclos CHAR(8) PRIMARY KEY, 
	latitude_enclos NUMBER(9,6), 
	longitude_enclos NUMBER(9,6), 
	surface_enclos NUMBER(10,2), 
	zone_enclos CHAR(8), 
	FOREIGN KEY (zone_enclos) REFERENCES zone(id_zone), 
	CHECK (surface_enclos >= 0)
);

CREATE TABLE particularite(
	id_particularite CHAR(8) PRIMARY KEY, 
	libelle_particularite VARCHAR(255)
);

CREATE TABLE posseder(
	id_enclos CHAR(8), 
	id_particularite CHAR(8), 
	PRIMARY KEY (id_enclos,id_particularite), 
	FOREIGN KEY (id_enclos) REFERENCES enclos(id_enclos), 
	FOREIGN KEY (id_particularite) REFERENCES particularite(id_particularite)
);

CREATE TABLE prestataire(
	id_prestataire CHAR(8) PRIMARY KEY,
	nom_prestataire VARCHAR(255)
);

-- Relation equipe <--> personnel est réciproque (equipe faite mais pas personnel)
CREATE TABLE equipe(
	id_equipe CHAR(8) PRIMARY KEY, 
	zone_equipe CHAR(8), 
	id_chef_equipe CHAR(8),
	FOREIGN KEY (zone_equipe) REFERENCES zone(id_zone)
);

CREATE TABLE type_personnel(
	id_type CHAR(8) PRIMARY KEY,
	libelle_personnel VARCHAR(255)
);

CREATE TABLE personnel(
	id_personnel CHAR(8) PRIMARY KEY, 
	type_personnel CHAR(8), 
	nom_personnel VARCHAR(255), 
	prenom_personnel VARCHAR(255), 
	date_entree_personnel DATE, 
	salaire_personnel NUMBER(7,2), 
	id_equipe CHAR(8),
	pwd VARCHAR(255),
	actif NUMBER(1) DEFAULT 0,
	FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe),
	FOREIGN KEY (type_personnel) REFERENCES type_personnel(id_type)
);

ALTER TABLE equipe 
	ADD (
		FOREIGN KEY (id_chef_equipe) REFERENCES personnel(id_personnel)
		);

CREATE TABLE intervenant(
	id_intervenant CHAR(8) PRIMARY KEY, 
	type_intervenant VARCHAR(255), 
	CHECK (type_intervenant IN ('PERSONNEL','PRESTATAIRE'))
);

CREATE TABLE intervenantpersonnel(
	id_intervenant CHAR(8) PRIMARY KEY,
	id_personnel CHAR(8),
	FOREIGN KEY (id_intervenant) REFERENCES intervenant(id_intervenant),
	FOREIGN KEY (id_personnel) REFERENCES personnel(id_personnel)
);

CREATE TABLE intervenantprestataire(
	id_intervenant CHAR(8) PRIMARY KEY,
	id_prestataire CHAR(8),
	FOREIGN KEY (id_intervenant) REFERENCES intervenant(id_intervenant),
	FOREIGN KEY (id_prestataire) REFERENCES prestataire(id_prestataire)
);

CREATE TABLE reparer(
	id_reparation CHAR(8) PRIMARY KEY, 
	id_enclos CHAR(8), 
	date_reparation DATE, 
	nature_reparation VARCHAR(255), 
	cout_reparation NUMBER(9,2), 
	commentaire_reparation VARCHAR(255), 
	id_intervenant CHAR(8),
	FOREIGN KEY (id_enclos) REFERENCES enclos(id_enclos),
	FOREIGN KEY (id_intervenant) REFERENCES intervenant(id_intervenant)
);

CREATE TABLE soigneur(
	id_personnel CHAR(8) PRIMARY KEY,
	specialite_espece CHAR(8),
	id_soigneur_remplacant CHAR(8),
	FOREIGN KEY (specialite_espece) REFERENCES espece(id_espece),
	FOREIGN KEY (id_soigneur_remplacant) REFERENCES personnel(id_personnel),
	FOREIGN KEY (id_personnel) REFERENCES personnel(id_personnel)
);

CREATE TABLE soin(
	id_soin CHAR(8) PRIMARY KEY,
	RFID CHAR(8),
	date_de_soin DATE,
	type_soin VARCHAR(255),
	id_personnel CHAR(8),
	FOREIGN KEY (RFID) REFERENCES animal(RFID),
	FOREIGN KEY (id_personnel) REFERENCES personnel(id_personnel),
	CHECK (type_soin IN ('SIMPLE','COMPLEXE'))
);

CREATE TABLE boutique(
	id_boutique CHAR(8) PRIMARY KEY,
	id_zone CHAR(8),
	type_boutique VARCHAR(255),
	id_equipe CHAR(8),
	FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe),
	FOREIGN KEY (id_zone) REFERENCES zone(id_zone),
	CHECK (type_boutique IN ('SOUVENIR','SNACK'))
);

CREATE TABLE visiteur(
	id_visiteur CHAR(8) PRIMARY KEY,
	nom_visiteur VARCHAR(255),
	prenom_visiteur VARCHAR(255)
);

CREATE TABLE parrainage(
	id_parrainage CHAR(8) PRIMARY KEY,
	id_visiteur CHAR(8),
	RFID CHAR(8),
	niveau_parrainage VARCHAR(255),
	FOREIGN KEY (id_visiteur) REFERENCES visiteur(id_visiteur),
	FOREIGN KEY (RFID) REFERENCES animal(RFID),
	CHECK (niveau_parrainage IN ('BRONZE','ARGENT','OR'))
);

CREATE TABLE prestation(
	id_prestation CHAR(8) PRIMARY KEY,
	niveau_min_prestation VARCHAR(255),
	libelle_prestation VARCHAR(255)
);
	
CREATE TABLE gagner(
	id_boutique CHAR(8),
	date_ca DATE,
	montant NUMBER(9,2) NOT NULL,
	id_personnel CHAR(8),
	PRIMARY KEY (id_boutique,date_ca),
	FOREIGN KEY (id_boutique) REFERENCES boutique(id_boutique),
	FOREIGN KEY (id_personnel) REFERENCES personnel(id_personnel)
);