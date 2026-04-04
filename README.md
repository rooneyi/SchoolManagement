# SchoolManagement

## Gestion des logs Telegram

Ce projet Laravel intègre un système de log Telegram pour notifier en temps réel les actions importantes et les erreurs via un bot Telegram.

### Fonctionnement
- Le service `TelegramLogger` envoie des messages à un canal ou utilisateur Telegram.
- Les logs sont déclenchés lors d'opérations sensibles (création, suppression, erreur) dans les contrôleurs.
- Exemple :

```php
(new TelegramLogger)->log('Classe créée avec succès: '.$school->name);
(new TelegramLogger)->log('Erreur lors de la création de la classe: '.$e->getMessage());
```

### Format des messages
- Les messages sont en français, clairs et adaptés au contexte métier.
- Ils suivent le standard de réponse de l’API (succès, erreur, etc.).

### Avantages
- Suivi en temps réel des opérations critiques.
- Centralisation des notifications pour l’équipe technique.
- Facilité d’intégration avec d’autres outils de monitoring.

### Personnalisation
- Le service peut être enrichi pour filtrer les événements ou personnaliser les messages.
- Ajoutez des logs pour d’autres entités selon vos besoins métier.

---

Pour plus d’exemples et d’intégration, consultez les contrôleurs (ex : ClassroomController) et adaptez selon vos besoins.
