INSERT INTO individu (RFID) VALUES ('RFID0001');
INSERT INTO individu (RFID) VALUES ('RFID0002');
INSERT INTO individu (RFID) VALUES ('RFID0003');
INSERT INTO individu (RFID) VALUES ('RFID0004');
INSERT INTO individu (RFID) VALUES ('RFID0005');
INSERT INTO individu (RFID) VALUES ('RFID0006');
INSERT INTO individu (RFID) VALUES ('RFID0007');
INSERT INTO individu (RFID) VALUES ('RFID0008');
INSERT INTO individu (RFID) VALUES ('RFID0009');
INSERT INTO individu (RFID) VALUES ('RFID0010');

INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00001', 'Panthera leo', 'Lion');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00002', 'Panthera tigris', 'Tigre');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00003', 'Elephas maximus', 'Éléphant asiatique');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00004', 'Giraffa camelopardalis', 'Girafe');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00005', 'Ursus arctos', 'Ours brun');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00006', 'Canis lupus', 'Loup gris');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00007', 'Equus quagga', 'Zèbre');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00008', 'Gorilla gorilla', 'Gorille');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00009', 'Hippopotamus amphibius', 'Hippopotame');
INSERT INTO espece (id_espece, nom_latin, nom_usuel) VALUES ('ESP00010', 'Crocodylus niloticus', 'Crocodile du Nil');

INSERT INTO animal VALUES ('RFID0001', 'Leo', 'Simba', TO_DATE('2018-05-12','YYYY-MM-DD'), 190, 'ESP00001');
INSERT INTO animal VALUES ('RFID0002', 'Rajah', 'Khan', TO_DATE('2017-03-21','YYYY-MM-DD'), 220, 'ESP00002');
INSERT INTO animal VALUES ('RFID0003', 'Babar', 'Raja', TO_DATE('2015-09-02','YYYY-MM-DD'), 300, 'ESP00003');
INSERT INTO animal VALUES ('RFID0004', 'Longneck', 'Gigi', TO_DATE('2019-11-18','YYYY-MM-DD'), 800, 'ESP00004');
INSERT INTO animal VALUES ('RFID0005', 'Baloo', 'Bruno', TO_DATE('2016-01-30','YYYY-MM-DD'), 350, 'ESP00005');
INSERT INTO animal VALUES ('RFID0006', 'Ghost', 'Luna', TO_DATE('2020-07-14','YYYY-MM-DD'), 70,  'ESP00006');
INSERT INTO animal VALUES ('RFID0007', 'Stripe', 'Zara', TO_DATE('2018-08-08','YYYY-MM-DD'), 280, 'ESP00007');
INSERT INTO animal VALUES ('RFID0008', 'Koko', 'Milo', TO_DATE('2014-04-25','YYYY-MM-DD'), 160, 'ESP00008');
INSERT INTO animal VALUES ('RFID0009', 'Splash', 'Hugo', TO_DATE('2013-12-05','YYYY-MM-DD'), 950, 'ESP00009');
INSERT INTO animal VALUES ('RFID0010', 'Snap', 'Nero', TO_DATE('2021-06-10','YYYY-MM-DD'), 500, 'ESP00010');

INSERT INTO filiation VALUES ('RFID0001','PERE','RFID0002');
INSERT INTO filiation VALUES ('RFID0001','MERE','RFID0003');
INSERT INTO filiation VALUES ('RFID0002','PERE','RFID0004');
INSERT INTO filiation VALUES ('RFID0002','MERE','RFID0005');
INSERT INTO filiation VALUES ('RFID0003','PERE','RFID0006');
INSERT INTO filiation VALUES ('RFID0003','MERE','RFID0007');
INSERT INTO filiation VALUES ('RFID0004','PERE','RFID0008');
INSERT INTO filiation VALUES ('RFID0004','MERE','RFID0009');
INSERT INTO filiation VALUES ('RFID0005','PERE','RFID0010');
INSERT INTO filiation VALUES ('RFID0005','MERE','RFID0001');

INSERT INTO autoriser VALUES ('ESP00001','ESP00002',1);
INSERT INTO autoriser VALUES ('ESP00001','ESP00003',0);
INSERT INTO autoriser VALUES ('ESP00002','ESP00004',1);
INSERT INTO autoriser VALUES ('ESP00003','ESP00005',0);
INSERT INTO autoriser VALUES ('ESP00004','ESP00006',1);
INSERT INTO autoriser VALUES ('ESP00005','ESP00007',0);
INSERT INTO autoriser VALUES ('ESP00006','ESP00008',1);
INSERT INTO autoriser VALUES ('ESP00007','ESP00009',0);
INSERT INTO autoriser VALUES ('ESP00008','ESP00010',1);
INSERT INTO autoriser VALUES ('ESP00009','ESP00001',0);

INSERT INTO regime (id_regime, libelle) VALUES ('REG00001', 'Carnivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00002', 'Herbivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00003', 'Omnivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00004', 'Piscivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00005', 'Insectivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00006', 'Frugivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00007', 'Granivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00008', 'Nectarivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00009', 'Folivore');
INSERT INTO regime (id_regime, libelle) VALUES ('REG00010', 'Charognard');

INSERT INTO alimentation VALUES ('RFID0001','REG00001', TO_DATE('2026-01-01','YYYY-MM-DD'), 5);
INSERT INTO alimentation VALUES ('RFID0002','REG00003', TO_DATE('2026-01-02','YYYY-MM-DD'), 7);
INSERT INTO alimentation VALUES ('RFID0003','REG00002', TO_DATE('2026-01-03','YYYY-MM-DD'), 9);
INSERT INTO alimentation VALUES ('RFID0004','REG00002', TO_DATE('2026-01-04','YYYY-MM-DD'), 6);
INSERT INTO alimentation VALUES ('RFID0005','REG00003', TO_DATE('2026-01-05','YYYY-MM-DD'), 8);
INSERT INTO alimentation VALUES ('RFID0006','REG00001', TO_DATE('2026-01-06','YYYY-MM-DD'), 4);
INSERT INTO alimentation VALUES ('RFID0007','REG00002', TO_DATE('2026-01-07','YYYY-MM-DD'), 3);
INSERT INTO alimentation VALUES ('RFID0008','REG00003', TO_DATE('2026-01-08','YYYY-MM-DD'), 5);
INSERT INTO alimentation VALUES ('RFID0009','REG00004', TO_DATE('2026-01-09','YYYY-MM-DD'), 6);
INSERT INTO alimentation VALUES ('RFID0010','REG00001', TO_DATE('2026-01-10','YYYY-MM-DD'), 7);

INSERT INTO zone (id_zone) VALUES ('ZONE0001');
INSERT INTO zone (id_zone) VALUES ('ZONE0002');
INSERT INTO zone (id_zone) VALUES ('ZONE0003');
INSERT INTO zone (id_zone) VALUES ('ZONE0004');
INSERT INTO zone (id_zone) VALUES ('ZONE0005');
INSERT INTO zone (id_zone) VALUES ('ZONE0006');
INSERT INTO zone (id_zone) VALUES ('ZONE0007');
INSERT INTO zone (id_zone) VALUES ('ZONE0008');
INSERT INTO zone (id_zone) VALUES ('ZONE0009');
INSERT INTO zone (id_zone) VALUES ('ZONE0010');

INSERT INTO enclos VALUES ('ENC00001', 48.856600, 2.352200, 1500.50, 'ZONE0001');
INSERT INTO enclos VALUES ('ENC00002', 48.857100, 2.353000, 1200.00, 'ZONE0002');
INSERT INTO enclos VALUES ('ENC00003', 48.855900, 2.351500, 980.75,  'ZONE0003');
INSERT INTO enclos VALUES ('ENC00004', 48.856300, 2.354200, 2000.00, 'ZONE0004');
INSERT INTO enclos VALUES ('ENC00005', 48.857800, 2.350900, 1750.25, 'ZONE0005');
INSERT INTO enclos VALUES ('ENC00006', 48.858200, 2.352800, 890.00,  'ZONE0006');
INSERT INTO enclos VALUES ('ENC00007', 48.855500, 2.353700, 1340.10, 'ZONE0007');
INSERT INTO enclos VALUES ('ENC00008', 48.856900, 2.351100, 1600.60, 'ZONE0008');
INSERT INTO enclos VALUES ('ENC00009', 48.857400, 2.352500, 1425.80, 'ZONE0009');
INSERT INTO enclos VALUES ('ENC00010', 48.856100, 2.353300, 1100.00, 'ZONE0010');

INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0001', 'Zone aquatique');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0002', 'Espace arboré');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0003', 'Climatisation contrôlée');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0004', 'Sol sablonneux');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0005', 'Rochers artificiels');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0006', 'Système de brumisation');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0007', 'Double clôture de sécurité');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0008', 'Zone ombragée');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0009', 'Espace chauffé');
INSERT INTO particularite (id_particularite, libelle) VALUES ('PART0010', 'Caméras de surveillance');

INSERT INTO posseder VALUES ('ENC00001','PART0001');
INSERT INTO posseder VALUES ('ENC00001','PART0008');
INSERT INTO posseder VALUES ('ENC00002','PART0002');
INSERT INTO posseder VALUES ('ENC00003','PART0004');
INSERT INTO posseder VALUES ('ENC00004','PART0007');
INSERT INTO posseder VALUES ('ENC00005','PART0006');
INSERT INTO posseder VALUES ('ENC00006','PART0003');
INSERT INTO posseder VALUES ('ENC00007','PART0005');
INSERT INTO posseder VALUES ('ENC00008','PART0010');
INSERT INTO posseder VALUES ('ENC00009','PART0009');

INSERT INTO prestataire (id_prestataire) VALUES ('PRES0001');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0002');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0003');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0004');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0005');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0006');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0007');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0008');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0009');
INSERT INTO prestataire (id_prestataire) VALUES ('PRES0010');

INSERT INTO equipe VALUES ('EQUI0001', 'ZONE0001', NULL);
INSERT INTO equipe VALUES ('EQUI0002', 'ZONE0002', NULL);
INSERT INTO equipe VALUES ('EQUI0003', 'ZONE0003', NULL);
INSERT INTO equipe VALUES ('EQUI0004', 'ZONE0004', NULL);
INSERT INTO equipe VALUES ('EQUI0005', 'ZONE0005', NULL);
INSERT INTO equipe VALUES ('EQUI0006', 'ZONE0006', NULL);
INSERT INTO equipe VALUES ('EQUI0007', 'ZONE0007', NULL);
INSERT INTO equipe VALUES ('EQUI0008', 'ZONE0008', NULL);
INSERT INTO equipe VALUES ('EQUI0009', 'ZONE0009', NULL);
INSERT INTO equipe VALUES ('EQUI0010', 'ZONE0010', NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0001','CHEF','Durand','Marc',TO_DATE('2015-03-12','YYYY-MM-DD'),3500.00,'EQUI0001',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0002','SOIGNEUR','Leroy','Sophie',TO_DATE('2018-06-21','YYYY-MM-DD'),2200.00,'EQUI0002',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0003','VETERINAIRE','Martin','Claire',TO_DATE('2016-09-05','YYYY-MM-DD'),4200.00,'EQUI0003',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0004','SOIGNEUR','Bernard','Lucas',TO_DATE('2019-01-17','YYYY-MM-DD'),2100.00,'EQUI0004',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0005','TECHNICIEN','Moreau','Julie',TO_DATE('2020-11-02','YYYY-MM-DD'),2000.00,'EQUI0005',NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0011','SOIGNEUR','Lemoine','Paul',TO_DATE('2018-03-01','YYYY-MM-DD'),2150.00,'EQUI0001',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0006','SOIGNEUR','Petit','Hugo',TO_DATE('2017-04-30','YYYY-MM-DD'),2300.00,'EQUI0006',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0007','VETERINAIRE','Robert','Emma',TO_DATE('2014-08-14','YYYY-MM-DD'),4500.00,'EQUI0007',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0008','SOIGNEUR','Richard','Tom',TO_DATE('2021-02-10','YYYY-MM-DD'),2050.00,'EQUI0008',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0009','TECHNICIEN','Garcia','Anna',TO_DATE('2019-07-19','YYYY-MM-DD'),2100.00,'EQUI0009',NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0010','CHEF','Roux','Nicolas',TO_DATE('2013-05-25','YYYY-MM-DD'),3800.00,'EQUI0010',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0012','SOIGNEUR','Faure','Julie',TO_DATE('2019-05-14','YYYY-MM-DD'),2200.00,'EQUI0002',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0013','VETERINAIRE','Blanc','Laura',TO_DATE('2016-10-20','YYYY-MM-DD'),4300.00,'EQUI0003',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0014','TECHNICIEN','Guerin','Marc',TO_DATE('2020-01-09','YYYY-MM-DD'),2050.00,'EQUI0004',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0015','SOIGNEUR','Renaud','Alice',TO_DATE('2021-07-23','YYYY-MM-DD'),2100.00,'EQUI0005',NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0016','SOIGNEUR','Marchand','Leo',TO_DATE('2017-12-12','YYYY-MM-DD'),2250.00,'EQUI0006',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0017','VETERINAIRE','Colin','Eva',TO_DATE('2015-09-30','YYYY-MM-DD'),4400.00,'EQUI0007',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0018','TECHNICIEN','Perrin','Nina',TO_DATE('2022-02-18','YYYY-MM-DD'),2000.00,'EQUI0008',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0019','SOIGNEUR','Muller','Theo',TO_DATE('2019-08-07','YYYY-MM-DD'),2150.00,'EQUI0009',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0020','SOIGNEUR','Henry','Camille',TO_DATE('2018-11-11','YYYY-MM-DD'),2200.00,'EQUI0010',NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0021','TECHNICIEN','Andre','Julien',TO_DATE('2020-04-05','YYYY-MM-DD'),2100.00,'EQUI0001',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0022','SOIGNEUR','Lefevre','Chloe',TO_DATE('2017-06-22','YYYY-MM-DD'),2300.00,'EQUI0002',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0023','VETERINAIRE','Roche','Maxime',TO_DATE('2013-03-15','YYYY-MM-DD'),4600.00,'EQUI0003',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0024','SOIGNEUR','Boyer','Ines',TO_DATE('2021-09-01','YYYY-MM-DD'),2050.00,'EQUI0004',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0025','TECHNICIEN','Noel','Alex',TO_DATE('2016-12-03','YYYY-MM-DD'),2150.00,'EQUI0005',NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0026','SOIGNEUR','Barbier','Lina',TO_DATE('2018-02-27','YYYY-MM-DD'),2250.00,'EQUI0006',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0027','VETERINAIRE','Paris','Nathan',TO_DATE('2014-07-19','YYYY-MM-DD'),4550.00,'EQUI0007',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0028','SOIGNEUR','Caron','Emma',TO_DATE('2019-10-13','YYYY-MM-DD'),2100.00,'EQUI0008',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0029','TECHNICIEN','Guillot','Victor',TO_DATE('2020-06-06','YYYY-MM-DD'),2000.00,'EQUI0009',NULL);
INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0030','SOIGNEUR','Fontaine','Sarah',TO_DATE('2017-01-17','YYYY-MM-DD'),2350.00,'EQUI0010',NULL);

INSERT INTO personnel (id_personnel,type_personnel,nom,prenom,date_entree,salaire,id_equipe,mot_de_passe) VALUES ('PERS0031','DIRECTEUR','dir_name','dir_name1',TO_DATE('2004-02-07'),'YYYY-MM-DD',46789.00,'root');

UPDATE equipe SET id_chef_equipe = 'PERS0001' WHERE id_equipe = 'EQUI0001';
UPDATE equipe SET id_chef_equipe = 'PERS0002' WHERE id_equipe = 'EQUI0002';
UPDATE equipe SET id_chef_equipe = 'PERS0003' WHERE id_equipe = 'EQUI0003';
UPDATE equipe SET id_chef_equipe = 'PERS0004' WHERE id_equipe = 'EQUI0004';
UPDATE equipe SET id_chef_equipe = 'PERS0005' WHERE id_equipe = 'EQUI0005';
UPDATE equipe SET id_chef_equipe = 'PERS0006' WHERE id_equipe = 'EQUI0006';
UPDATE equipe SET id_chef_equipe = 'PERS0007' WHERE id_equipe = 'EQUI0007';
UPDATE equipe SET id_chef_equipe = 'PERS0008' WHERE id_equipe = 'EQUI0008';
UPDATE equipe SET id_chef_equipe = 'PERS0009' WHERE id_equipe = 'EQUI0009';
UPDATE equipe SET id_chef_equipe = 'PERS0010' WHERE id_equipe = 'EQUI0010';

INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PERS0001','PERSONNEL');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PERS0002','PERSONNEL');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PERS0003','PERSONNEL');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PERS0004','PERSONNEL');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PERS0005','PERSONNEL');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PRES0001','PRESTATAIRE');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PRES0002','PRESTATAIRE');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PRES0003','PRESTATAIRE');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PRES0004','PRESTATAIRE');
INSERT INTO intervenant (id_intervenant, type_intervenant) VALUES ('PRES0005','PRESTATAIRE');

INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0001','PERS0001');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0002','PERS0002');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0003','PERS0003');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0004','PERS0004');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0005','PERS0005');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0006','PERS0006');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0007','PERS0007');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0008','PERS0008');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0009','PERS0009');
INSERT INTO intervenantpersonnel (id_intervenant, id_personnel) VALUES ('PERS0010','PERS0010');

INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0001','PRES0001');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0002','PRES0002');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0003','PRES0003');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0004','PRES0004');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0005','PRES0005');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0006','PRES0006');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0007','PRES0007');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0008','PRES0008');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0009','PRES0009');
INSERT INTO intervenantprestataire (id_intervenant, id_prestataire) VALUES ('PRES0010','PRES0010');

INSERT INTO reparer VALUES ('REP00001','ENC00001',TO_DATE('2026-01-05','YYYY-MM-DD'),'Réparation clôture',350.00,'Clôture endommagée','PERS0001');
INSERT INTO reparer VALUES ('REP00002','ENC00002',TO_DATE('2026-01-10','YYYY-MM-DD'),'Nettoyage bassin',120.00,'Accumulation algues','PRES0001');
INSERT INTO reparer VALUES ('REP00003','ENC00003',TO_DATE('2026-01-12','YYYY-MM-DD'),'Réparation portail',500.00,'Charnière cassée','PERS0002');
INSERT INTO reparer VALUES ('REP00004','ENC00004',TO_DATE('2026-01-15','YYYY-MM-DD'),'Installation caméra',800.00,'Nouvelle surveillance','PRES0002');
INSERT INTO reparer VALUES ('REP00005','ENC00005',TO_DATE('2026-01-18','YYYY-MM-DD'),'Maintenance éclairage',210.00,'Ampoules remplacées','PERS0003');
INSERT INTO reparer VALUES ('REP00006','ENC00006',TO_DATE('2026-01-20','YYYY-MM-DD'),'Réparation système eau',650.00,'Fuite détectée','PRES0003');
INSERT INTO reparer VALUES ('REP00007','ENC00007',TO_DATE('2026-01-22','YYYY-MM-DD'),'Renforcement clôture',430.00,'Sécurité renforcée','PERS0004');
INSERT INTO reparer VALUES ('REP00008','ENC00008',TO_DATE('2026-01-25','YYYY-MM-DD'),'Nettoyage rochers',95.00,'Entretien mensuel','PRES0004');
INSERT INTO reparer VALUES ('REP00009','ENC00009',TO_DATE('2026-01-27','YYYY-MM-DD'),'Réparation abri',720.00,'Toiture abîmée','PERS0005');
INSERT INTO reparer VALUES ('REP00010','ENC00010',TO_DATE('2026-01-30','YYYY-MM-DD'),'Contrôle structure',300.00,'Inspection générale','PRES0005');

INSERT INTO soigneur VALUES ('PERS0002','ESP00001',NULL);
INSERT INTO soigneur VALUES ('PERS0004','ESP00002','PERS0002');
INSERT INTO soigneur VALUES ('PERS0006','ESP00003','PERS0004');
INSERT INTO soigneur VALUES ('PERS0008','ESP00004','PERS0006');
INSERT INTO soigneur VALUES ('PERS0011','ESP00005','PERS0002');
INSERT INTO soigneur VALUES ('PERS0012','ESP00006','PERS0004');
INSERT INTO soigneur VALUES ('PERS0015','ESP00007','PERS0006');
INSERT INTO soigneur VALUES ('PERS0016','ESP00008','PERS0008');
INSERT INTO soigneur VALUES ('PERS0019','ESP00009','PERS0011');
INSERT INTO soigneur VALUES ('PERS0020','ESP00010','PERS0012');

UPDATE soigneur SET id_soigneur_remplacant = 'PERS0016' WHERE id_personnel='PERS0002';

INSERT INTO soin VALUES ('SOIN0001','RFID0001',TO_DATE('2026-02-01','YYYY-MM-DD'),'SIMPLE','PERS0002');
INSERT INTO soin VALUES ('SOIN0002','RFID0002',TO_DATE('2026-02-02','YYYY-MM-DD'),'COMPLEXE','PERS0003');
INSERT INTO soin VALUES ('SOIN0003','RFID0003',TO_DATE('2026-02-03','YYYY-MM-DD'),'SIMPLE','PERS0004');
INSERT INTO soin VALUES ('SOIN0004','RFID0004',TO_DATE('2026-02-04','YYYY-MM-DD'),'COMPLEXE','PERS0007');
INSERT INTO soin VALUES ('SOIN0005','RFID0005',TO_DATE('2026-02-05','YYYY-MM-DD'),'SIMPLE','PERS0006');
INSERT INTO soin VALUES ('SOIN0006','RFID0006',TO_DATE('2026-02-06','YYYY-MM-DD'),'COMPLEXE','PERS0013');
INSERT INTO soin VALUES ('SOIN0007','RFID0007',TO_DATE('2026-02-07','YYYY-MM-DD'),'SIMPLE','PERS0011');
INSERT INTO soin VALUES ('SOIN0008','RFID0008',TO_DATE('2026-02-08','YYYY-MM-DD'),'COMPLEXE','PERS0017');
INSERT INTO soin VALUES ('SOIN0009','RFID0009',TO_DATE('2026-02-09','YYYY-MM-DD'),'SIMPLE','PERS0016');
INSERT INTO soin VALUES ('SOIN0010','RFID0010',TO_DATE('2026-02-10','YYYY-MM-DD'),'COMPLEXE','PERS0023');

INSERT INTO boutique VALUES ('BOUT0001','ZONE0001','SOUVENIR','EQUI0001');
INSERT INTO boutique VALUES ('BOUT0002','ZONE0002','SNACK','EQUI0002');
INSERT INTO boutique VALUES ('BOUT0003','ZONE0003','SOUVENIR','EQUI0003');
INSERT INTO boutique VALUES ('BOUT0004','ZONE0004','SNACK','EQUI0004');
INSERT INTO boutique VALUES ('BOUT0005','ZONE0005','SOUVENIR','EQUI0005');
INSERT INTO boutique VALUES ('BOUT0006','ZONE0006','SNACK','EQUI0006');
INSERT INTO boutique VALUES ('BOUT0007','ZONE0007','SOUVENIR','EQUI0007');
INSERT INTO boutique VALUES ('BOUT0008','ZONE0008','SNACK','EQUI0008');
INSERT INTO boutique VALUES ('BOUT0009','ZONE0009','SOUVENIR','EQUI0009');
INSERT INTO boutique VALUES ('BOUT0010','ZONE0010','SNACK','EQUI0010');

INSERT INTO visiteur VALUES ('VIS00001','Dupont','Lucas');
INSERT INTO visiteur VALUES ('VIS00002','Martin','Emma');
INSERT INTO visiteur VALUES ('VIS00003','Bernard','Hugo');
INSERT INTO visiteur VALUES ('VIS00004','Petit','Chloe');
INSERT INTO visiteur VALUES ('VIS00005','Robert','Nathan');
INSERT INTO visiteur VALUES ('VIS00006','Richard','Lina');
INSERT INTO visiteur VALUES ('VIS00007','Durand','Tom');
INSERT INTO visiteur VALUES ('VIS00008','Leroy','Ines');
INSERT INTO visiteur VALUES ('VIS00009','Moreau','Theo');
INSERT INTO visiteur VALUES ('VIS00010','Simon','Camille');

INSERT INTO parrainer VALUES ('PAR00001','VIS00001','RFID0001','BRONZE');
INSERT INTO parrainer VALUES ('PAR00002','VIS00002','RFID0002','ARGENT');
INSERT INTO parrainer VALUES ('PAR00003','VIS00003','RFID0003','OR');
INSERT INTO parrainer VALUES ('PAR00004','VIS00004','RFID0004','BRONZE');
INSERT INTO parrainer VALUES ('PAR00005','VIS00005','RFID0005','ARGENT');
INSERT INTO parrainer VALUES ('PAR00006','VIS00006','RFID0006','OR');
INSERT INTO parrainer VALUES ('PAR00007','VIS00007','RFID0007','BRONZE');
INSERT INTO parrainer VALUES ('PAR00008','VIS00008','RFID0008','ARGENT');
INSERT INTO parrainer VALUES ('PAR00009','VIS00009','RFID0009','OR');
INSERT INTO parrainer VALUES ('PAR00010','VIS00010','RFID0010','BRONZE');

INSERT INTO prestation VALUES ('PRESTA01','BRONZE','Certificat de parrainage');
INSERT INTO prestation VALUES ('PRESTA02','BRONZE','Newsletter mensuelle');
INSERT INTO prestation VALUES ('PRESTA03','ARGENT','Photo exclusive de l animal');
INSERT INTO prestation VALUES ('PRESTA04','ARGENT','Invitation événement spécial');
INSERT INTO prestation VALUES ('PRESTA05','OR','Visite guidée privée');
INSERT INTO prestation VALUES('PRESTA06','OR','Accès coulisses du zoo');
INSERT INTO prestation VALUES ('PRESTA07','BRONZE','Badge supporter');
INSERT INTO prestation VALUES ('PRESTA08','ARGENT','Rencontre avec un soigneur');
INSERT INTO prestation VALUES ('PRESTA09','OR','Repas VIP au restaurant du zoo');
INSERT INTO prestation VALUES ('PRESTA10','BRONZE','Mention sur le site web');

INSERT INTO gagner VALUES ('BOUT0001', TO_DATE('2026-01-01','YYYY-MM-DD'), 1250.50, 'PERS0001');
INSERT INTO gagner VALUES ('BOUT0002', TO_DATE('2026-01-02','YYYY-MM-DD'), 980.00,  'PERS0002');
INSERT INTO gagner VALUES ('BOUT0003', TO_DATE('2026-01-03','YYYY-MM-DD'), 1435.75, 'PERS0003');
INSERT INTO gagner VALUES ('BOUT0004', TO_DATE('2026-01-04','YYYY-MM-DD'), 760.20,  'PERS0004');
INSERT INTO gagner VALUES ('BOUT0005', TO_DATE('2026-01-05','YYYY-MM-DD'), 1120.00, 'PERS0005');
INSERT INTO gagner VALUES ('BOUT0006', TO_DATE('2026-01-06','YYYY-MM-DD'), 890.90,  'PERS0006');
INSERT INTO gagner VALUES ('BOUT0007', TO_DATE('2026-01-07','YYYY-MM-DD'), 1500.00, 'PERS0007');
INSERT INTO gagner VALUES ('BOUT0008', TO_DATE('2026-01-08','YYYY-MM-DD'), 670.45,  'PERS0008');
INSERT INTO gagner VALUES ('BOUT0009', TO_DATE('2026-01-09','YYYY-MM-DD'), 1340.60, 'PERS0009');
INSERT INTO gagner VALUES ('BOUT0010', TO_DATE('2026-01-10','YYYY-MM-DD'), 1025.30, 'PERS0010');
