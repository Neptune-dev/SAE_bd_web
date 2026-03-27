SELECT personnel.nom_personnel, personnel.prenom_personnel, type_personnel.libelle_personnel, personnel.date_entree_personnel, personnel.date_sortie_personnel
FROM personnel JOIN type_personnel
ON personnel.type_personnel=type_personnel.id_type
ORDER BY personnel.nom_personnel, personnel.prenom_personnel;

SELECT
id_boutique_ca,
EXTRACT(YEAR FROM date_ca) AS annee,
SUM(montant) AS ca_annuel
FROM gagner GROUP BY id_boutique_ca, EXTRACT(YEAR FROM date_ca)
ORDER BY id_boutique_ca, annee;

SELECT 
id_boutique_ca,
EXTRACT(YEAR FROM date_ca) AS annee,
EXTRACT(MONTH FROM date_ca) AS mois,
SUM(montant) AS ca_mensuel
FROM gagner GROUP BY id_boutique_ca, EXTRACT(YEAR FROM date_ca), EXTRACT(MONTH FROM date_ca)
ORDER BY id_boutique_ca, annee, mois;

SELECT id_personnel_soin FROM soin
WHERE RFID_soin='RFID0006';

SELECT id_espece FROM espece MINUS (
    SELECT id_espece1 FROM autoriser
    WHERE autorise=1 UNION SELECT id_espece2 FROM autoriser WHERE autorise=1
);

SELECT e1.id_espece FROM espece e1 
WHERE NOT EXISTS (
    SELECT 1 FROM espece e2
    WHERE NOT EXISTS (
        SELECT 1 FROM autoriser a
        WHERE a.id_espece1=e1.id_espece AND a.id_espece2=e2.id_espece AND a.autorise=1
    )
);