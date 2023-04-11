ETAPE 1 :
Tu extrait le dossier magasin-informatique que je t'ai envoyé sous forme zip; et tu place ce dossier dans le dossier dans le répertoire www de ton serveur local.  
ainsi, ton projet sera accessible via ton navigateur à l'adresse : http://localhost/magasin-informatique.
et l'espace admin sera disponible à l'adresse : http://localhost/magasin-informatique/admin.

ETAPE 2 : ouvrir le fichier config.php qui se trouve directement dans le dossier magasin-informatique.
ce fichier permet de configuer les 3 variables globales de l'application que sont :
 - $apiKey :  dans cette variable il faut mettre la clé d'API de dollibar.
 - $apiUrl : cette variable contient l'url de l'API de dollibar : http://localhost/TON-DOSSIER-DOLLIBAR/htdocs/api/index.php/
Nb: TON-DOSSIER-DOLLIBAR c'est le dossier qui contient ton installation de dollibar. chez moi, ce dossier se trouve dans C://wamp/ww/dolibarr-16.0.4. c'est pourquoi tu verra que ma variable $apiUrl vaut http://localhost/dolibarr-16.0.4/htdocs/api/index.php.
 - $app_url : dans cette variable il faut juste mettre l'url de ton application que tu as dézippé au début : http://localhost/magasin-informatique

ETAPE 3 : aller dans dollibar activer les modules suivants : API/Web services, Utilisateurs & Groupes , Tiers, Commandes, Factures et avoirs, Banques et caisses, Taxes et dépenses spéciales, Produits, Variantes de produits, Stock, Taxes et dépenses spéciales.
Nb : pour activer les modules, aller sur le menu de gauche et cliquer sur Configuration, ensuite Modules/applications. la longue liste  des modules va s'afficher et tu actives ceux que j'ai spécifié.

ETAPE 4 : 
Lancer le projet dans ton navigateur à l'adresse http://localhost/magasin-informatique, créer un compte et explorer les fonctionnalités 😉
quant à l'espace admin disponible sur http://localhost/magasin-informatique/admin, le login c'est admin et mot de passe c'est admin
