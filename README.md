Mini site de vente en ligne dévellopé avec le framework Symfony 2.8
===================================================================

Fichiers
--------

A Symfony project created on November 28, 2016, 9:43 am.
Le fichier sil11.sql contient la BDD.

Page d'accueil
--------------

"Le top 3 des articles les plus vendus" s'affiche par un contrôleur imbriqué.
Un répository personnalisé, Order_lineRepository gère une requête sql pour sélectionner les articles en plus vendus 
en fonction des quantités qui ont été vendus.

Page catalogue
--------------

Affiche les catégories disponibles.

Page articlesparCategorie
-------------------------

Affiche les articles par catégorie

* De là l'utilisateur peut soit directement ajouter un article au panier ou accèder à la fiche produit de l'article
* Si le produit n'a pas de stock, le bouton "ajouter au panier" est remplacé par "en cours de réapprovisionnement"

Page article (fiche produit)
----------------------------

Affiche toutes les informations d'un produit avec sa photo

L'utilisateur peut ajouter au panier le produit

Page contenuPanier
------------------

Affiche le panier et calcule le total TTC, dont la TVA.

L'utilisateur peut ajouter ou diminuer la quantité, supprimer un article ou vider tout le panier.

* Si l'utilisateur diminue la quantité en-dessous de 1, l'article est supprimé du panier.

* Si l'utilisateur augmente la quantité au-dessus du stock disponible, un message informe l'utilisateur et le quantité n'augmente plus.

* Le nombre d'articles différents s'affiche en haut à droite du menu haut.

Page Valider panier
-------------------

Quand l'utilisateur valide son panier, s'il n'est pas authentifié, le formulaire de connexion s'affiche, sinon un message informe le client 
du numéro de sa commande.

* Le stock des articles commandés est décompté.

Utilisateurs
------------

Le site compte 3 utilisateurs.

* Anonyme
* USER = les clients authentifiés
* ADMIN = Administrateurs

* Un compte administrateur : 
** email : choucaxa@hotmail.fr
** mdp : alex

* Un compte client :
** email : e.bel@orange.fr
** mdp : bel

Quand un client se connecte, le menu haut évolue :
* A la place de "votre compte", un "bonjour prénom du client" apparait, et il a accès à partir de ce menu à :
** votre compte : ses informations (nom, prénom, email) s'affichent et le client peut les modifier, y compris son mot de passe.
** vos commandes : les commandes du client s'affiche

Quand un administrateur se connecte, le menu haut évolue comme les clients, mais l'onglet "Admin" apparait en plus.

Espace Admin
------------

##Page Admin

La page admin n'est accessible que par les administrateurs. Elle donne accès au back-office du site.

##Menu Catégorie

Permet d'afficher les catégories du site, de les modifier, de les supprimer et d'en créer une nouvelle.

##Menu Article

Permet d'afficher les articles du site, de les modifier, de les supprimer et d'en créer un nouveau.

##Menu Commande

Permet d'afficher les commandes et de les valider ou non.


