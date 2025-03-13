# Agent IA - SaaS de Gestion de Contenu Social Media par IA

## À propos

Agent IA est une solution SaaS qui automatise la création et la diffusion de contenu sur les réseaux sociaux grâce à l'intelligence artificielle. Cette plateforme utilise les dernières technologies d'OpenAI pour générer du contenu pertinent et engageant, adapté à chaque réseau social.

### Fonctionnalités principales

- ✨ **Génération automatique de contenu** pour différentes plateformes (Instagram, LinkedIn, Facebook, Twitter, TikTok, YouTube)
- 📊 **Planification intelligente** des publications sur plusieurs semaines
- 🔍 **Recherche de tendances** et actualités dans votre niche
- 📈 **Analyse des performances** et recommandations d'optimisation
- 🧠 **Adaptation du ton et du style** pour chaque plateforme

## Prérequis techniques

- PHP 7.4 ou supérieur
- MySQL/MariaDB 10.5 ou supérieur
- Composer
- Symfony 5.4
- Accès à l'API OpenAI (clé API)

## Installation

1. Clonez le dépôt

```bash
git clone https://github.com/votre-username/agent-ia.git
cd agent-ia
```

2. Installez les dépendances

```bash
composer install
```

3. Configurez votre environnement

Copiez le fichier `.env` en `.env.local` et configurez vos variables d'environnement :

```bash
cp .env .env.local
```

Modifiez `.env.local` avec vos propres informations :

```
# Base de données
DATABASE_URL="mysql://username:password@127.0.0.1:3306/agent_ia?serverVersion=mariadb-10.5.8"

# OpenAI
OPENAI_API_KEY=votre_clé_api_openai

# Réseaux sociaux (exemples)
FACEBOOK_APP_ID=votre_facebook_app_id
FACEBOOK_APP_SECRET=votre_facebook_app_secret
# Ajoutez les autres clés d'API selon les réseaux sociaux que vous souhaitez prendre en charge
```

4. Créez la base de données et exécutez les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Lancez le serveur de développement

```bash
symfony server:start
```

## Architecture du projet

Le projet est structuré selon l'architecture Symfony standard :

- **Controller/** - Gestion des requêtes HTTP et des réponses
- **Entity/** - Modèles de données et relations
- **Repository/** - Requêtes à la base de données
- **Service/** - Logique métier et intégrations externes
- **Form/** - Formulaires et validation
- **Command/** - Commandes CLI pour les tâches automatisées

### Intégrations principales

- **OpenAI API** - Pour la génération de contenu et l'analyse
- **APIs des réseaux sociaux** - Pour la publication automatique et le suivi des performances

## Utilisation

### Interface d'administration

Accédez à l'interface d'administration à l'URL `/admin`. Les principales sections sont :

- **Tableau de bord** - Vue d'ensemble et statistiques
- **Profil d'entreprise** - Configuration de votre profil et préférences
- **Sujets** - Gestion des thèmes de contenu
- **Plan de contenu** - Calendrier de publication
- **Contenu** - Liste et modification des contenus générés
- **Publications** - Suivi des publications programmées
- **Comptes sociaux** - Connexion aux réseaux sociaux
- **Analyse** - Statistiques et recommandations

### Commandes

Plusieurs commandes CLI sont disponibles pour automatiser les tâches :

```bash
# Générer du contenu
php bin/console app:generate-content

# Programmer des publications
php bin/console app:schedule-posts

# Publier le contenu programmé
php bin/console app:publish-scheduled-posts

# Collecter les statistiques
php bin/console app:collect-analytics
```

## Développement

### Ajout de nouvelles fonctionnalités

Pour étendre les fonctionnalités d'Agent IA, vous pouvez :

1. Ajouter de nouveaux types d'agents dans le dossier `Service/`
2. Étendre les entités existantes pour prendre en charge de nouvelles données
3. Créer de nouveaux endpoints d'API dans `Controller/Api/`

### Tests

Exécuter les tests :

```bash
php bin/phpunit
```

## Licence

Ce projet est sous licence propriétaire. Tous droits réservés.

## Support

Pour toute question ou assistance, contactez dev2ls13820@gmail.com