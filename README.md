API REST PHP
Une API REST simple construite avec PHP natif utilisant l'architecture MVC et PDO pour la gestion de base de données MySQL.

Prérequis
PHP 7.4+
MySQL/MariaDB
Composer
Installation
Clonez le dépôt
Installez les dépendances :
Configurez la base de données dans SqlConnect.php
Configuration de la BDD
Modifiez les paramètres dans SqlConnect.php :

Routes disponibles
GET /user/:id - Récupère un utilisateur par ID
POST /user - Crée un nouvel utilisateur
Utilisation
Pour démarrer le serveur de développement :

Fonctionnalités
Architecture MVC
Routage simple avec paramètres dynamiques
Gestion des erreurs HTTP (404, 405)
Réponses au format JSON
Requêtes préparées PDO
Headers CORS
Auteur
Logipek - Email