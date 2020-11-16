DEPRECATED MODULE TO INTEGRATE ROUDCUBE EMAILS INTO DOLIBARR

------------------------------------------------------------

Documentation d'utilisation du module Webmail pour Dolibarr

**Sommaire**
------------
Pré-requis et Installation
Gérer les droits d'accès
Utilisation
	Accès sur fiche Tiers
	Accès total
Utiliser plusieurs boîtes mails
Licence - Version


**Pré-requis et Installation** 
------------------------------
Voir le fichier "Installation du module WebMail.txt"


**Gérer les droits d'accès**
Il y a deux niveaux d'accès :
- sur les fiches tiers, dans l'onglet "Emails", on accède au dossier mail du tiers et uniquement celui-ci (il n'y a pas d'arborescence des dossiers du webmail, on ne peut pas sortir du dossier du tiers.
- depuis l'icône "webmail" dans la barre d'icônes de Dolibarr : accès à RoundCube complet et normal.
Vous pouvez donner l'accès au webmail à vos utilisateur Dolibarr pour l'un ou l'autre ou les deux accès.
Par défaut, l'accès est refusé.

Note : pour gérer le plus rapidement possible les accès pour tous vos utilisateurs, préférez activer les accès au niveau des groupes d'utilisateurs plutôt que utilisateur par utilisateur.


**Utilisation**
---------------
*Accès sur fiche Tiers*
-----------------------
Sur la fiche d'un tiers, aller sur l'onglet "Emails" et s'authentifier en utilisant l'adresse mail à consulter + le mot de passe associé.
L'utilisateur arrive directement dans le dossier du tiers renseigné dans le champ "webmail" (cf. ci-dessus).

L'arborescence des dossiers de la boîte mail est cachée, l'utilisateur reste dans ce dossier du tiers.
Si RoundCube est correctement paramétré, l'envoi et la réception de mails sont fonctionnelles et peuvent éventuellement être utilisés.
ATTENTION toutefois : les mails envoyés via RoundCube ne sont pas PAS tracés par Dolibarr (par exemple, vous n'aurez pas d'évènement "Envoi de proposition par mail"). Selon votre usage, il est peut-être préférable de demander aux collaborateurs de ne pas utiliser la fonction d'envoi de mail depuis RoundCube.

*Accès total*
-------------
Cliquer sur l'icône de Webmail dans la barre d'icône de Dolibarr.
S'authentifier avec l'adresse mail à consulter + mot de passe associé
L'accès à RoundCube est total et complet, tout comme s'il était ouvert dans un navigateur web en mode habituel.
Cet accès permet de parcourir l'arborescence des dossiers de la boîte mail.
ATTENTION : tout mail envoyé ici ne sera PAS tracé par Dolibarr. Même remarque que précédemment.


**Utiliser plusieurs boîtes mails**
-----------------------------------
Vous pouvez, au choix :

- utiliser les boîtes mails personnelles de vos collaborateurs (chacun utilise ainsi son arborescence personnelle). Ceci implique toutefois qu'une seule personne peut consulter les mails associés à un tiers (puisque c'est sa boîte mail). Si c'est votre fonctionnement habituel, utilisez cette solution : le collaborateur en charge d'un tiers renseigne, dans le champ "webmail", le chemin qui mène au dossier mail du tiers en question depuis sa boîte de réception.

- utiliser quelques boîtes mails "partagées", accessibles à plusieurs personnes. Par exemple, une pour les clients, une pour les fournisseurs, ou par équipes... 

Cela implique deux choses :
- d'une part, il faut paramétrer ces nouvelles boîtes sur les lecteurs de mails locaux (par exemple vos Outlook, Thunderbird....), et créer dans les lecteurs de mails des règles pour automatiser au maximum le classement des mails entrants et sortants : Règles de déplacement automatique des mails entrants vers le dossier du Tiers adéquat + marquer le mail comme non lu pour être sûr de bien les repérer ; règle de classement des mails sortants dans le dossier du mail d'origine... Ne pas oublier d'abonner la boîte mail en imap aux dossiers requis.
- d'autre part, vérifier et éventuellement corriger sur votre serveur de mail le nombre maximum de connexions imap simultannées afin de garantir un accès à toutes les personnes autorisées. Par exemple, si vous êtes limitées à 2 connexions simultannées et que deux lecteurs de mails locaux sont déjà connectées à la boîte mail, vous ne pourrez pas vous authentifier sur dolibarr.

Compte-tenu de cette limitation de connexions simultannées - bien qu'elle puisse être levée si vous avez la main sur votre serveur de mail et les compétences pour le faire - vous comprendrez l'intérêt d'avoir plusieurs boîtes mails différentes.

En outre, cela permet de gérer au mieux les droits d'accès sur les dossiers imap : quelque soit le chemin renseigné dans le champ "webmail", seuls ceux qui connaissent le login+pass de cette boîte peuvent y accéder.

Astuce : Avoir la même arborescence sur plusieurs boîtes mails différentes ?
Par exemple, sur deux boîtes mails différentes, vous avez Boîte de réception - sous-dossier "Clients" - sous-sous-dossier "MonClient".
Selon que vous vous authentifiez comme adresse1@domaine.com ou adresse2@domaine.com, vous accéderez à chaque fois au dossier "MonClient", lequel dossier, toutefois, pourra contenir des mails différents puisqu'il s'agit de deux boîtes différentes.


**Licence - Version**
---------------------
Documentation sous licence GNU.FDL
Permission vous est donnée de copier, distribuer et/ou modifer ce document selon les termes de la Licence GNU Free Documentation License, Version 1.3 ou ultérieure publiée par la Free Software Foundation : sans section inaltérable, sans texte de première page de couverture et sans texte de dernière page de couverture. La licence complète est visible à cete adresse : htpg//www.gnu.org/licenses/fdl.html

Ce présent document est la version 1.0.1 de la documentation du module Wembail pour l'ERP Dolibarr. Date de révision : 15/03/2013.
Il a été réalisé par Christophe Battarel et Agnès Rambaud, sarl Altairis – htpp//www.altairis.fr


