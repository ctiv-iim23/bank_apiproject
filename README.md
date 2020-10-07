# bank_apiproject (Sujet)

Afin de répondre à la demande d’un client souhaitant ouvrir ses données à différents clients externes, vous allez développer l’api d’une banque.

Cette api doit être REST, sécurisée et documentée afin de permettre à tout développeur de pouvoir l’utiliser facilement.

Pour ce faire vous allez devoir créer des methods qui transfèrent les informations suivantes:

User(id, nom, prenom, email, password)
Compte(id, user_id, fonds(montant sur le compte), type(courant, livret A, etc...), actif)
Transaction(id, date, montant, valide, moyenPaiement, compte_id)
CB(id, uuid, exp, cryptogramme, code, active, user_id, compte_id)

Les clients peuvent avoir 2 rôles:
« Banque » qui a tout pouvoir (get, post)
« Externe » qui ne peut que lire les infos.

La banque peut également update user, CB, compte.
(Attention, un post dans une table peut influer sur les autres tables)

Chaque client a une apikey qu’il transmet pour s’identifier et vérifier son rôle.

Lorsqu’un utilisateur se connecte (et non un client), on lui transmet un token afin qu’il reste connecté sur n’importe quel client pendant 20 minutes maximum.

On attend donc les différentes routes get, post, put ainsi que les systèmes de connexion, d’inscription, les vérifications d’apikey et token. On attend un code clair et commenté permettant à un prochain développeur d’intervenir dessus facilement. Idem pour la documentation.

Sur le projet, précisez les auteurs (vous).

A envoyer avant mercredi 14 cotobre 23h59. github: alexgaill
