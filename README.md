# I-CAD &mdash; Registre National d'Identification Animale

> [!NOTE]
> **Projet Scolaire (2023) &bull; Refonte & Modernisation**  
> Ce projet est issu d'un travail académique réalisé en 2023, repensé et modernisé visuellement (refonte UI/UX, Design System moderne, accessibilité et ergonomie).

---

Application CodeIgniter 4 de gestion des identifications des carnivores domestiques.

---

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Prerequis](#prerequis)
- [Installation rapide](#installation-rapide)
- [Configuration](#configuration)
- [Architecture applicative](#architecture-applicative)

---

## Fonctionnalités

- **Tableau de bord central** avec indicateurs KPI en temps réel et filtres d'état (*Tous*, *Retrouvés*, *Perdus*).
- **Recherche instantanée** par prénom ou numéro d'identification I-CAD.
- **Ajout d'animaux** avec téléversement et prévisualisation photo.
- **Enregistrement des propriétaires** avec identifiant auto-généré.
- **Fiches passeport d'identification** avec détails complets et boutons d'administration.

---

## Prerequis

- PHP 8.1+ avec extensions `intl`, `mbstring`, `mysqlnd`, `json`.
- [Composer](https://getcomposer.org)
- Base de données MySQL / MariaDB.

---

## Installation rapide

```bash
composer install
copy env .env
```

Lancement du serveur local Spark :

```bash
php spark serve
```

---

## Configuration

Dans votre fichier `.env` :

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = icad
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

---

## Architecture applicative

- `app/Controllers` : Gestion des flux et requêtes HTTP.
- `app/Models` : Accès aux tables MySQL via le Query Builder.
- `app/Views` : Gabarits et composants d'interface.
- `public/css` : Design System Vanilla CSS (zéro framework tiers).
- `public/uploads` : Fichiers images téléversés.
