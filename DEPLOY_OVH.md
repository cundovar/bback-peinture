# Deploiement OVH par Git

## Pre-requis OVH

- PHP 8.3 ou plus recent active.
- Composer disponible en SSH.
- Domaine/API pointe vers le dossier `public/` du projet Symfony.
- Base MySQL OVH creee.
- Dossiers images presents :
  - `public/images/oeuvre`
  - `public/images/Accueil`

## Fichiers a ne pas committer

Ne jamais committer les secrets de production. Sur OVH, creer un fichier `.env.local` a la racine du projet avec les vraies valeurs :

```dotenv
APP_ENV=prod
APP_DEBUG=0
APP_SECRET=remplacer_par_un_secret_long
APP_SHARE_DIR=var/share
DEFAULT_URI=https://bac.varascundo.com
DATABASE_URL="mysql://USER:PASSWORD@HOST:3306/DB_NAME?serverVersion=8.0&charset=utf8mb4"
CORS_ALLOW_ORIGIN='^https://nat\.varascundo\.com$'
```

Le fichier `.env.prod.example` sert seulement de modele.

## Premier deploiement

Sur OVH, dans le dossier cible :

```bash
git clone URL_DU_REPO .
composer install --no-dev --optimize-autoloader
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod
```

Configurer le document root OVH sur :

```text
public/
```

Si OVH ne lit pas `.ovhconfig` depuis la racine du repo, copier aussi ce fichier au niveau attendu par l'hebergement.

## Mise a jour

Depuis le dossier du projet sur OVH :

```bash
git pull
composer install --no-dev --optimize-autoloader
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod
```

## Verification rapide

Tester ces URLs :

```text
https://bac.varascundo.com/api/oeuvres
https://bac.varascundo.com/api/page_accueils
https://bac.varascundo.com/api/categories/1
https://bac.varascundo.com/api/categories/2
https://bac.varascundo.com/api/oeuvres/popular
```

Les collections standard doivent contenir `hydra:member`.

## Points sensibles

- Les categories doivent garder les IDs `1` et `2`.
- Le front autorise uniquement `https://nat.varascundo.com` en production via CORS.
- Les images ne sont pas gerees par Git si elles sont volumineuses ou deja sur l'ancien serveur ; les copier manuellement dans `public/images`.
- Verifier que `var/` est inscriptible par PHP sur OVH.
