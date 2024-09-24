# Lille du Pacifique

Lille du Pacifique est un site internet d'une association qui souhaite promouvoir ses actions et faciliter les démarches pour pouvoir y adhérer.

## Environnement de développement

### Pré-requis

* PHP 8.2
* Composer
* Symfony CLI
* nodejs et npm
* saas

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

### Ajouter des données de test (fixtures)
```bash
symfony console doctrine:fixtures:load
```

### Lancer des tests
```bash
php bin/phpunit --testdox
```

### Nettoyer le cache
```bash
php bin/console cache:clear
```

## Production

### Envoie des mails de Contacts

Les mails de prise de contact sont stockés en BDD, pour les envoyer au gestionnaire par mail, il faut mettre en place un CRON sur:

```bash
symfony console app:send-contact
```