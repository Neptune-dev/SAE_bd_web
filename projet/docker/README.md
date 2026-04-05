# Guide d'utilisation Docker

### Quick guide :
* `docker-compose up --build`
* <a href="http://localhost:8081">http://localhost:8081</a> : utiliser <a href='bd.sql'>bd.sql</a> pour initialiser la base de données
* <a href="http://localhost:8081">http://localhost:8080</a>
* `docker-compose down -v --rmi all`

---
---

<br>

**Voici un guide pour installer l'environnement de travail.**

## Prérequis :

* Docker
* Un navigateur

## Mise en place :

Depuis le répertoire <a href=".">projet/</a> exécuter la commande `docker-compose up [OPTIONS]`

| Action | Option |
|---|---|
| Lancer le conteneur en arrière plan | `-d` |
| Compiler les images | `--build` |

## Utilisation :

* Pour initialiser la base de donnée :
    * Se rendre à l'adresse <a href="http://localhost:8081">http://localhost:8081</a>
    * Se connecter avec les paramètres suivants :

    | Paramètre | Valeur |
    |---|---|
    | Système  | `Oracle (beta)` |
    | Serveur | `oracle_db:1521/FREEPDB1` |
    | Utilisateur | `oracle_user` |
    | Mot de passe | `oracle_pwd` |
    | Base de données | *laisser vide* |

    * Ouvrir l'éditeur de requête
    * Copier-coller <a href='bd.sql'>bd.sql</a> dans le champ de requête
    * Executer
* Se rendre à l'adresse <a href="http://localhost:8081">http://localhost:8080</a> pour arriver sur <a href="./public_html/index.php">/public_html/index.php</a>

## Arrêt

Si le conteneur n'est pas lancé en arrière plan, tuez le terminal ou efectuez `CTRL+C` pour arrêter le conteneur.

S'il est lancé en arrière plan, exécutez la commande `docker-compose stop`

## Suppression

Pour arrêter *(si lancé)* et supprimer l'environnement, effectuez la commande `docker-compose down [OPTIONS]`

| Action | Option |
|---|---|
| Supprimer la base de donnée | `-v` |
| Supprimer les images | `--rmi all` |