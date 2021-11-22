# Générateur d'API

Ce projet permet de générer automatiquement une API adaptée à une base de données.

- [Installation rapide](#installation-rapide)
- [Installation détailléé](#installation-detaillee)
- [Utilisation](#utilisation)
  - [Gestion des utilisateurs](#gestion-des-utilisateurs)
  - [Nomenclature](#nomenclature)
  - [Logs](#logs)
  - [Scripts](#scripts)
- [Options](#presentation-des-differentes-options)
- [Présentations des routes](#presentation-des-differentes-routes)
  - [CRUD](#crud)
  - [Aide](#aide-routes)
- [Ressources](#ressources)
- [Contact](#contact)


## **INSTALLATION RAPIDE**

Entrez dans votre terminal (au niveau du dossier /API):
```
composer install
php script/env.php
php install.php
```

## **INSTALLATION DETAILLEE**

Pour pouvoir utiliser l'API, vous devez au préalable avoir installé sur votre machine :

- _composer_
- _php_

1. Après avoir récupérer le code, ouvrez le projet dans un terminal (placez-vous dans au niveau du dossier /API).

2. Utilisez la commande suivante pour télécharger les dépendances nécessaires à l'API :
```
composer install
```

3.1. Utiliser la commande code suivante pour définir les variables d'environnement nécessaires à la connexion à votre base de données (Toujours au niveau de /API):
```
php script/env.php
```
3.2. Vous serez invité à remplir les champs suivants :

-   _**DB username**_ :       Votre nom d'utilisateur

-   _**DB password**_ :       Votre mot de passe

-   _**DB host address : port**_ :  Ne pas oublier de renseigner le port à la suite si besoin ! (quelques exemples : _localhost_, _localhost:8888_, _127.0.0.1_ ...)

-   _**DB charset**_ :       Type d'encodage, par défaut 'utf8'

-   _**DB driver**_ :    Type de driver, par défault 'pdo_mysql' ( Selon votre environnement de travail, il sera peut être nécessaire de l'installer sur votre                             machine afin de faire fonctionner l'API )

-   _**database name**_ : Le nom de votre base de données. Ici, si vous renseignez une base de données inconnue, l'API vous demandera de recommencer.

-   _**API base path**_ :     Le chemin de la racine du serveur jusqu'au fichier index.php ( par défaut 'EYEMANAGER/API/' si vous avez télécharger le projet dans                               votre dossier htdocs)

> Remarque : Afin de pouvoir rentrer directement les informations dans la console, vous aurez besoin d'une version récente de _bash_. Vous pouvez voir votre version de _bash_ en tapant la commande `bash --version`. Sur Mac, il s'agit généralement de la version 3.2.xx, qui n'est pas suffisante pour faire fonctionner ce script. (Sur Mac, vous pouvez la mettre en jour en installant _Homebrew_ puis en utilisant la commande `brew install bash`).

    
4. Utilisez la commande suivante pour procéder à l'automatisation de la suite de l'installation (Toujours au niveau de /API):
```
php install.php
```

5. Vous pouvez maintenant utiliser l'API ! La première clé API a été générée dans la table adminAPI dans votre base de données.

_*OPTIONNEL*_: Cette partie présente en détails les différentes étapes de la commande d'installation :

- Création du dossier _logs_ s'il n'existe pas ou a été supprimé.
- Création du fichier caché _.env_ contenant les variables d'environnement, nécessaire à la connexion à la base de données ou pour spécifier certaines options présentées plus bas dans la documentation.
- Modification de certains fichiers de _Doctrine_.
- Suppression des anciens fichiers _Entities_ si nécessaire.
- Création de la table adminAPI dans votre base de données si inexistante. Cette table permet de gérer les droits des utilisateurs.
- Génération des fichiers _Entities_ à partir de votre base de données.
- Génération des annotations dans les fichiers _Entities_ (principalement les getters et setters).
- Création de la première clé API dans la table adminAPI si la table est vide.
- Suppression des doublons de fichiers _Entities_.

## **UTILISATION**

### Gestion des utilisateurs

L'entité nommée _adminAPI_ est utilisée pour gérer les droits des utilisateurs. Votre base de données doit donc contenir une table nommée _adminAPI_. Elle est composée des colonnes suivantes :

```
id ( clé primaire )
password (il s'agit de la clée API délivrée à l'utilisateur)
dayLimit ( nombre maximum de requêtes par jour )
nbRequestToday
lastRequestDate
microTime
modulo
isBlockedModeActivated
```

### Nomenclature

Par défaut, lors de la génération des entités gérée par Doctrine, les noms de vos colonnes dans votre base de données et les noms générés dans les entités par Doctrine ne seront pas identiques. La règle est la suivante :

```
Nom dans la BDD -> Nom dans les entités DOCTRINE
idUser -> iduser
id_user -> idUser
```

### Logs

Toutes les requêtes vers votre API sont enregistrées sous forme de logs dans un répertoire _logs_ situé à la racine des fichiers de votre API.

### Autorisation

Afin de pouvoir utiliser cette API, vous devez disposer d'une clée API valide. Vous devrez la renseigner dans l'URL pour chaque requête effectuée.

### Scripts

Vous pouvez utilisez les commandes suivantes dans votre terminal (toujours à partir de /API):

**Définition des variables d'environnement nécessaires à la connexion à la base de données**
```
php script/env.php
```

**Installation**
```
php install.php
```

**Créer une nouvelle clé API**
```
php script/createNewKey.php
```

**Mettre à jour les fichiers Entités php en fonction de votre base de données**
> ATTENTION : Ici, ce sont vos fichiers php qui seront mis à jour pour correspondre avec votre base de données !
```
php script/updateEntities.php
```

**Mettre à jour la base de données en fonction de vos fichier Entités php**
> ATTENTION : Ici, c'est votre base de donnée qui sera mise à jour pour correspondre avec votre fichiers php !
```
php script/updateDB.php
```

## **PRESENTATION DES DIFFERENTES OPTIONS**

Ces options sont définies dans votre fichier **.env** (anciennement **.env.example** avant que vous le renommiez !).

### LOG

Renseigner ici le nombre de jour à partir duquel vous souhaitez que les logs s'effacent automatiquement. Attention : Les logs ne s'effacent pas si l'API n'est pas solicitée ! Example :

```
NUMBER_OF_DAY_TO_DELETE=30
Ici, les logs s'effaceront au bout de 30 jours.
```

### SECURITY

**NUMBER_OF_REQUESTS_WATCHED** &&
**DELAY_MAX_FOR_REQUEST_WATCHED**

Renseigner ici le nombre de requête que vous souhaitez surveiller pendant la durée que vous souhaitez. Example :

```
NUMBER_OF_REQUESTS_WATCHED=10
DELAY_MAX_FOR_REQUEST_WATCHED=10 (en secondes)
Ici, s'il y a plus de 10 requêtes (venant d'une même clée API) en moins de 10 secondes, l'API enverra un message d'erreur disant qu'elle a détecté trop de requêtes.

```

**TOGGLE_BLOCK_MODE**

Renseigner ici si vous souhaitez que la clé API soit bloquée si elle détecte trop de requêtes. Example :

```
TOGGLE_BLOCK_MODE=true (booléen)
Ici, la clée API utilisée lors de la détection des trop nombreuses requêtes sera bloquée. Il faudra accéder à la base de données pour la débloquer manuellement.
```

**DETAILED RELATIONS**

Renseigner ici si vous souhaitez avoir les relations détaillées lors de vos requêtes GET. Example :

```
TOGGLE_DETAILED_RELATIONS=false (booléen)
Ici l'utilisateur recevra des réponses JSON avec seulement l'id des relations renseigné. Une réponse non détaillée ressemble à ce que vous trouver dans votre table de données:
"id" : 1,
"relation" : 1
```

```
TOGGLE_DETAILED_RELATIONS=true (booléen)
Ici l'utilisateur recevra des réponses JSON avec le détail des relations. Une réponse détaillée ressemble à :
"id" : 1,
"relation" : {
  "id" : 1,
  "relation1" : {
    "relation1" : 1,
    "cle1": "valeur1"
  }
  "relation2" : {
    "relation2" : 1,
    "cle2": "valeur2"
  }
}
Note : Dans le cas où une relation de relation contient d'autres relations, ces dernières ne seront pas à leur tour détaillées, pour un soucis de lisibilité ! (3 niveaux d'héritage).
```

## **PRESENTATION DES DIFFERENTES ROUTES**

```
Vous trouverez dans ces encadrés des exemples pour chaque route.
```

### CRUD

**READ**

- Obtenir l'ensemble des informations contenues dans la table indiquée.

  Verbe Http : _**GET**_

  **_.../[votre clé API]/[nom de la table]_**

```
.../myAPIkey123/utilisateurs
Récupère toutes les informations de la table nommée utilisateurs
```

- Obtenir les informations de l'id souhaité dans la table indiquée.

  Verbe Http: _**GET**_

  **_.../[votre clé API]/[nom de la table]/[numéro id]_**

```
.../myAPIkey123/utilisateurs/12
Récupère les informations de l'id numéro 12 de la table nommée utilisateurs
```

- Obtenir l'ensemble des informations contenues dans la table indiquée selon les critères définis en JSON par l'utilisateur.

  Verbe Http: _**POST**_

  **_.../[votre clé API]/[nom de la table]/findby_**

  Note : lors de relations ManytoMany, si vous renseignez un champ entre [], l'API vous retourne les champs qui correspondent EXACTEMENT à ce que vous indiquez. Si vous ne mettez pas de [] et indiquez une seule valeur, l'API vous retourne tout les items qui COMPRENNENT la valeur indiquée. Un petit exemple pour mettre en lumière cette fonctionnalité plus bas.

```php
.../myAPIkey123/utilisateurs/findby

{
    "age" : "30",
    "prenom": "Julien"
}
// Récupère toutes les informations de la table nommée utilisateurs dont l'age est égal à 30 et dont le prénom est "Julien".

// Ci dessous "idManyToMany" fait référence à une relation vers une table de jointure.
{
    "idManyToMany" : [1,2,3]
}
// Recupère toutes les informations de la table ou idManyToMany correspond EXACTEMENT aux valeurs 1 ET 2 ET 3.

{
    "idManyToMany" : 1
}
// Recupère toutes les informations de la table ou idManyToMany comprend la valeur 1 (même s'il en contient plusieurs autres).
```

**CREATE**

- Enregistre une nouvelle entrée dans la table indiquée avec les informations fournies en JSON par l'utilisateur.

  Verbe Http : _**POST**_

  **_.../[votre clé API]/[nom de la table]_**

```php
.../myAPIkey123/utilisateurs
{
    "nom" : "Doe",
    "prenom" : "John"
}
// Crée une nouvelle entrée dans la table nommée utilisateurs avec les informations nom = "Doe" et prenom = "John"
```

**UPDATE**

- Modifie les informations de l'id souhaité dans la table indiquée avec les informations fournies en JSON par l'utilisateur.

  Verbe Http : _**PUT**_

  **_.../[votre clé API]/[nom de la table]/[numéro id]_**

```php
.../myAPIkey123/utilisateurs/8
{
    "nom" : "update"
}
// Met à jour l'information "nom"="update" de l'id numéro 8 de la table nommée utilisateurs
```

**DELETE**

- Supprime les informations de l'id souhaité dans la table indiquée.

  Verbe Http: _**DELETE**_

  **_.../[votre clé API]/[nom de la table]/[numéro id]_**

```php
.../myAPIkey123/utilisateurs/8
// Supprime les informations de l'id numéro 8 de la table nommée utilisateurs
```

**BATCH**

- Permet de créer, modifier ou supprimer plusieurs items à la fois (10 maximum). Vous devez renseigner les verbes suivants : "delete" / "create" / "update".

Verbe Http : _**POST**_

**_.../[votre clé API]/[nom de la table]/batch_**

```php
.../myAPIkey123/utilisateurs/batch
{
    "delete" : [1,2,3]
}
// Supprime les items 1,2,3 de la table nommée utilisateurs
```

```php
.../myAPIkey123/utilisateurs/batch
{
    "create" :
    [
        {
            "prenom": "John",
            "nom":"Doe"
        },
        {
            "prenom": "Jean",
            "nom":"Dort"
        }
    ]
}
// Crée dans la table nommée utilisateurs 2 nouvelles lignes avec les informations renseignées
```

```php
.../myAPIkey123/utilisateurs/batch
{
    "update" :
    [
        {
            "id": 1
            "prenom": "John",
            "nom":"Doe"
        },
        {
            "id": 2
            "prenom": "Jean",
            "nom":"Dort"
        }
    ]
}
// Modifie les items 1,2 de la table nommée utilisateurs avec les informations renseignées
```

### AIDE ROUTES

Les routes suivantes sont des outils pour vous aider à naviguer / vous repérer dans votre base de données.

- Renvoie la liste de toutes les tables présentes dans votre base de données.

  Verbe Http : _**GET**_

  **_.../[votre clé API]/tables_**

```
.../myAPIkey123/tables
```

- Renvoie la liste des noms de l'ensemble des champs (ainsi que leurs types) présents dans la table indiquée.

  Verbe Http: _**GET**_

  **_.../[votre clé API]/tables/[nom de la table]_**

```
.../myAPIkey123/tables/utilisateurs

```

- Afficher l'aide (résumant les différentes routes disponibles)

  Verbe Http: _**GET**_

  **_.../[votre clé API]_**

```
.../myAPIkey123
```

## BUGS A METTRE A JOUR



## RESSOURCES

Lien vers la documentation DOCTRINE : https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/index.html

Lien vers COMPOSER : https://getcomposer.org/

## CONTACT

yann_cariou@hotmail.com
