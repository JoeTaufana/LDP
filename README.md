# Lille du Pacifique

Lille du Pacifique est un site internet d'une association qui souhaite promouvoir ses actions et faciliter les démarches pour pouvoir y adhérer.

## Environnement de développement

### Pré-requis

* PHP 8.2
* Composer
* Symfony CLI
* npm

Pour vérifier les pré-requis, vous pous le faire avec la commande suivante :

```bash
symfony check:requirements
```
### Lancer l'environnement de développement

```bash
composer install
npm install
npm run build
symfony server:start
```
### Lancer des tests

```bash
php bin/phpunit --testdox
