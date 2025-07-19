# Site d’Association – README

## Description
Site web PHP “maison” pour une association d’anciens étudiants.
Permet aux membres de s’inscrire, se connecter, publier et gérer articles (“posts”) et projets, consulter les informations des autres membres, et personnaliser l’affichage.

## Technologies et versions
- **PHP** 5.5.x (extensions `mysql_*`, sessions, SNMP non utilisée ici)
- **MySQL** 5.6 (base `association1`, tables `asso`, `posts`, `projets`, `dataposts`, `dataprojets`)
- **HTML5** (<!DOCTYPE html>)
- **CSS3** (deux thèmes : `style1.css`, `style2.css`)
- **JavaScript** minimal — shiv HTML5 pour anciennes versions d’IE
- **MD5** pour hachage de mot de passe
- Pas de framework (Laravel évoqué par erreur)

## Fonctionnalités implémentées
1. **Inscription**
   - Formulaire de création de compte (nom, prénom, mail, pays, code postal, date de naissance)
   - Génération d’un mot de passe aléatoire
   - Vérification de validité des champs (regex, date, e-mail)
2. **Connexion / Déconnexion**
   - Authentification via `$_SESSION['id']` + `$_SESSION['motdepasse']` MD5
   - Mise à jour de la date de dernière connexion
3. **Gestion des membres**
   - Liste triable des membres (compétence, identifiant, date d’inscription, etc.)
   - Page de profil détaillée : compétence, projets, posts, ancienneté, statut “connecté”
   - Modification des informations personnelles : nom, prénom, identifiant, e-mail, code postal, pays, date de naissance, mot de passe
   - Suppression de compte (cascade : supprime projets et posts associés)
4. **Articles (“Posts”)**
   - Création, édition, suppression de posts
   - Stockage des modifications dans `dataposts` (auteurs, dates)
   - Affichage des 5 derniers posts sur la page d’accueil
   - Liste complète paginée jusqu’à 199 articles
   - Vue détaillée d’un article unique
   - Liste des auteurs ayant modifié un article
5. **Projets**
   - Création, édition, suppression de projets
   - Stockage des modifications dans `dataprojets`
   - Affichage des 15 derniers projets sur la page “Nouveau Projet”
   - Liste complète des projets pour chaque membre
6. **Navigation & présentation**
   - Menu principal adaptatif selon connexion et rôle
   - Choix de deux thèmes CSS (“Coucher de soleil” / “Rosée du matin”)
   - Pages “À propos” et “Contact” statiques
   - Favicon, logo et images de header
7. **Utilitaires**
   - Fonctions partagées (`ConversionDate`, `detectlId`, `CalcAnciennete`)
   - Générateur de mot de passe aléatoire
   - Inclusiones dynamiques de CSS et scripts de compatibilité HTML5

---
Tous les scripts PHP utilisent l’ancienne extension `mysql_*`. Aucune librairie externe ni gestionnaire de dépendances (Composer) n’est employé.
