## Hypnos Hotel
## Description

Dans le cadre de ma formation « Graduat Développeur mobile Android », il m’est demandé de créer un site internet permettant la réservation de suites d'hôtels. Le site comportera une interface front-office accessible à tous permettant de consulter les différents établissements et suites  ainsi qu’une partie back-office uniquement accessible aux utilisateurs Administrateur qui permettra de gérer la base de données.

## Récupération du projet

Utiliser GIT Clone pour récupérer le dépôt

```bash
git clone https://github.com/theoxav/hypnos_hotel.git
```

## Installation

```bash
# Déplacement dans le dossier
cd hypnos_hotel
```
```bash
# Configurer le fichier .env
 DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7&charset=utf8mb4"
```
```bash
# Installation des dépendances
composer install
```
```bash
# npm
npm install
```

```bash
# Création de la base de données
php bin/console doctrine:database:create

# Création des tables (migrations)
php bin/console doctrine:migrations:migrate

# Insertions des datafixtures
php bin/console doctrine:fixtures:load
```

```bash
# charger les assets
npm run watch
```

# Utilisation

Lancement du serveur Symfony
```bash
symfony server:start
```



