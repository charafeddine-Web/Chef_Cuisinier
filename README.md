## Projet : Site Web pour un Chef Cuisinier Mondialement Reconnu

Contexte du Projet

Le projet vise à développer un site web offrant une expérience gastronomique unique pour un chef cuisinier de renom. Les utilisateurs peuvent découvrir des menus exclusifs, réserver des expériences culinaires à domicile et interagir avec le chef.

Objectifs du Projet

Site Web avec Multi-Rôles

Utilisateurs (Clients)

Découvrir les menus proposés par le chef.

S’inscrire, se connecter et réserver une expérience culinaire.

Chefs (Administrateurs)

Se connecter et gérer les réservations : accepter, refuser, consulter les statistiques des demandes, et gérer leur profil.

Fonctionnalités Principales

Inscription et Connexion

Authentification pour utilisateurs et chefs.

Redirection vers des pages spécifiques en fonction du rôle (utilisateur ou chef).

Page Utilisateur (Client)

Consultation des menus du chef.

Réservation d'une expérience culinaire (sélection de la date, heure et nombre de personnes).

Gestion des réservations : consulter l’historique, modifier ou annuler des réservations.

Page Chef (Dashboard)

Gestion des réservations : accepter ou refuser les demandes en fonction de la disponibilité.

Affichage des statistiques :

Nombre de demandes en attente.

Nombre de demandes approuvées pour la journée.

Nombre de demandes approuvées pour le jour suivant.

Détails du prochain client et de sa réservation.

Nombre de clients inscrits.

Design

Responsive Design : Compatible avec mobile, tablette et desktop.

Esthétique : Design moderne et élégant représentant le luxe.

UX/UI : Interface intuitive pour une navigation fluide.

Fonctionnalités JavaScript

Validation des Formulaires avec Regex

Validation des entrées utilisateur (email, téléphone, mot de passe, etc.).

Formulaires Dynamiques d’Ajout de Menus

Permettre aux chefs d’ajouter dynamiquement plusieurs plats dans un menu.

Modals Dynamiques

Affichage d’informations sans recharger la page (détails de réservation, confirmation d’action, message d’erreur).

SweetAlerts

Intégration d’alertes visuelles élégantes pour des actions importantes (confirmation de réservation, annulation).

Sécurité des Données

Hashage des Mots de Passe

Techniques sécurisées pour le hashage des mots de passe.

Protection contre les Failles XSS (Cross-Site Scripting)

Nettoyage et échappement des entrées utilisateur pour éviter les attaques XSS.

Prévention des Injections SQL

Utilisation de requêtes préparées pour interagir avec la base de données.

Protection contre les Attaques CSRF (Bonus)

Mise en place d’un token CSRF pour sécuriser les actions sensibles (réservations, inscriptions, modifications de profil).

Fonctionnalités Bonus

Génération de Documents Imprimables (Rapports)

Génération de rapports imprimables sur les réservations et les statistiques sous forme de fichiers PDF.

Envoi d’E-mails

Réinitialisation de mot de passe.

Confirmation de réservation.

Alertes pour modifications ou annulations.

Archivage des Plats pour Rupture de Stock

Possibilité pour les chefs de marquer des plats comme archivés et les réactiver une fois disponibles.

Page 404 Personnalisée

Conception d’une page 404 élégante, proposant des liens utiles.

Installation et Exécution

Cloner le dépôt :

git clone <URL-du-dépôt>

Installer les dépendances :

npm install

Lancer le projet :

npm start

Accéder à l’application :

Ouvrir un navigateur et visiter : http://localhost:3000.

Technologies Utilisées

Frontend : HTML5, CSS3, tailwind, Bootstrap ,JS.

Backend : PHP.

Base de Données : Mysql.

Outils Supplémentaires : SweetAlert, Regex pour validation.

Auteur

Projet développé par :charaf eddine tbibzat
