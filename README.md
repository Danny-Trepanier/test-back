# Test d'évènementiel

Dans le cadre d'un éventuel recrutement voici le petit test qu'il sera demander de réaliser. On veut surtout se faire une idée sur l'étendu de tes compétences en terme de structure de code, de connaissances de base sur laravel, de requete SQL ainsi que ta rapidité d'exécution. N'hésite pas à commenter ton code, compléter le Readme, corriger le code existant, proposé des solutions, des améliorations...

Temps à prévoir : environ 2h On ne veut pas que tu passes ta journée dessus, simplement faire le maximum possible dans ce temps prévu.

On est conscient que 2h c'est peut être short pour tout faire, donc pas de pression si il manque des choses.

( Ne pas inclure le temps de préparation de ton espace de dev.)

## les prérequis et la base

- php 8.0+
- composer 2
- Mysql

Pour installer le projet:

- cloner le dépôt Git
- installer avec composer (laravel 9 et les dépendances)
- exécuter les migrations et seeds

## Consignes

Le projets contient une liste d'évènements aléatoires en seed. Le client aimerait ajouter un système de réservation de places. Pour le moment, les réservations ce feront par des courriels (non demandé ici) et seront payer sur places. Par la suite, Cashier pourrait être implémenté pour un paiement en ligne ainsi que divers mailer et notification.

Ce qui est demandé est de modifier l'affichage existant afin d'incorporer le système de réservation mais aussi d'ajuster l'Affichage actuel pour qu'il soit plus fonctionnel.

### Plus précisément

Modifie la requete `DB::select()` du controller `EventController` afin d'afficher tous les évènements ordonné date de début (`start_date`) croissante puis retourner uniquement les éléments à venir ou en cours.

Ajouter un objet "Réservation" dans une table `orders` (courriel du contact, le nom et prénom, la quantité de place à réserver, l'évènement à réserver et le prix total)

Pour ajouer une réservation, créer un point API REST avec les paramètres et variables utiles à son enregistrement. Cet ajout peut etre fait via PostMan ou par un formulaire HTML simple sur le détail d'un évènement.

Une fois des réservations enregistrer, ajouter dans la liste des évènements, pour chaque éléments, le nombre de participant total.

Ajouter un systeme d'authentification simple avec inscription (package, custom, à la mano, au choix). Cette authentification sera utiles pour afficher ou cacher des éléments aux visiteurs.

Ajouter au détail d'un évènement pour les utilisateur authentifié, dans un tableau ou une liste (voir bootstrap 5 déjà en place), toutes les réservations actuelle (le participant, le nombre de places vendus pour cet réservation et la somme de la vente)

Améliorer l'affichage et la clareté des évènements à l'aide de mutator, fonction blade, de traitement divers ou votre imaginaire.

Commenter, expliquer, modifier, justifier, coder...
