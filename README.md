# ICAD - Identification des Carnivores Domestiques

Application web de gestion et de consultation du registre d'identification des animaux de compagnie (chiens, chats, furets), developpee avec CodeIgniter 4 et MySQL.

> **Contexte du projet** : Ce projet a ete realise en 2023 dans le cadre d'un cursus scolaire. Il a ete repris et refactorise pour moderniser l'interface utilisateur, ameliorer l'ergonomie des formulaires et nettoyer l'architecture du code.

---

## Fonctionnalites

- **Registre des animaux** : liste globale avec statut (retrouve / signale perdu), photos et informations d'identification.
- **Recherche et filtres** : filtrage instantane par prenom ou numero I-CAD, avec tri rapide par statut.
- **Fiche detaillee (Passeport)** : consultation complete des donnees de l'animal, signes particuliers et proprietaire associe.
- **Gestion des fiches** : ajout d'un nouvel animal avec televersement de photo, mise a jour des informations et suppression.
- **Gestion des proprietaires** : creation de fiches proprietaires avec identifiant unique auto-genere.

---

## Stack technique

- **Langage** : PHP 8.1+
- **Framework** : CodeIgniter 4.5
- **Base de donnees** : MySQL / MariaDB
- **Frontend** : HTML5, CSS3 pur (variables CSS, responsive design), JavaScript Vanilla
- **Serveur local** : WampServer (Apache avec module rewrite)

---

## Prerequis

- PHP >= 8.1 avec extensions : `intl`, `mbstring`, `mysqlnd`, `json`
- Composer
- Serveur MySQL local (ex: via WAMP ou XAMPP)

---

## Installation locale

### 1. Cloner le depot

```bash
git clone https://github.com/Baldyl66/ICAD.git
cd ICAD
```

### 2. Installer les dependances

```bash
composer install
```

### 3. Configurer l'environnement

Creer le fichier `.env` a partir du modele `env` :

```bash
cp env .env
```

Renseigner les parametres de connexion dans `.env` :

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost/icad.local/icad/public/'

database.default.hostname = localhost
database.default.database = icad
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 4. Lancement

**Option A : Via le serveur de developpement CodeIgniter**
```bash
php spark serve
```
L'application est accessible sur `http://localhost:8080`.

**Option B : Via Apache (WampServer)**
Configurer un VirtualHost pointant vers le dossier `public/` :
```apache
<VirtualHost *:80>
    ServerName icad.local
    DocumentRoot "c:/wamp64/www/icad.local/icad/public"
    <Directory "c:/wamp64/www/icad.local/icad/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## Structure du projet

```text
icad/
├── app/
│   ├── Controllers/       # Controleurs HTTP (AnimauxController, etc.)
│   ├── Models/            # Modeles d'acces aux donnees
│   └── Views/             # Gabarit (layouts/layout.php) et vues applicatives
├── public/
│   ├── css/               # Feuilles de style (style.css, accueil.css, etc.)
│   ├── uploads/           # Photos des animaux televersees
│   └── index.php          # Point d'entree de l'application
├── writable/              # Dossier de travail (logs, sessions) - exclus de Git
├── env                    # Fichier d'exemple de configuration
├── .gitignore             # Regles d'exclusion Git
└── composer.json          # Dependances du projet
```

---

## Auteur

Projet scolaire developpe par Dylan Balmigere (2023) - Refonte graphique et organisationnelle (2026).
