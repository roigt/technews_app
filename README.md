# TechNews – Forum d’Actualités Tech

TechNews est une plateforme de type **forum / blog** permettant de **publier et consulter des articles sur les nouvelles technologies**.  
Elle est développée avec **Laravel (dernière version)**, utilise **Blade** pour l’interface utilisateur, **Breeze** pour l’authentification, et **Eloquent ORM** pour la gestion de la base de données.

---

## 🚀 Technologies utilisées

- **Laravel** (backend MVC)
- **Composer** (gestionnaire de dépendances PHP)
- **Blade (UI)** pour le frontend
- **Laravel Breeze** pour l’authentification (login, register, reset password…)
- **Eloquent ORM** (modèles & relations)
- **Bootstrap** (interface responsive moderne)
- **Mysql** (Base de données)

---

## 📦 Installation & Lancement

```bash
# Cloner le projet
git clone https://github.com/roigt/task-manager.git

cd technews

# Installer les dépendances PHP
composer install

# Créer le fichier .env
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Configurer la base de données dans le fichier .env

# Appliquer les migrations
php artisan migrate

# Lancer le serveur
php artisan serve
