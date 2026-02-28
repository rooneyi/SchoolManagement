
# Documentation des tables principales (mise à jour)

## Table : schools

| Colonne    | Type         | Description                |
|------------|--------------|----------------------------|
| id         | bigint       | Identifiant unique         |
| name       | varchar(255) | Nom de l'école             |
| email      | varchar(255) | Email de l'école           |
| phone      | varchar(255) | Téléphone de l'école       |
| address    | varchar(255) | Adresse de l'école         |
| created_at | timestamp    | Date de création           |
| updated_at | timestamp    | Date de modification       |

---

## Table : users

| Colonne                | Type           | Description                        |
|------------------------|----------------|------------------------------------|
| id                     | bigint         | Identifiant unique                 |
| name                   | varchar(255)   | Nom de l'utilisateur               |
| email                  | varchar(255)   | Email (unique)                     |
| email_verified_at      | timestamp      | Date de vérification email         |
| password               | varchar(255)   | Mot de passe (hashé)               |
| school_id              | bigint         | Référence à l'école (foreign key)  |
| role                   | varchar(255)   | Rôle (user, teacher, etc.)         |
| remember_token         | varchar(100)   | Token de session                   |
| created_at             | timestamp      | Date de création                   |
| updated_at             | timestamp      | Date de modification               |

Autres tables liées à l'utilisateur :
- password_reset_tokens (email, token, created_at)
- sessions (id, user_id, ip_address, user_agent, payload, last_activity)

---

## Table : classrooms

| Colonne     | Type         | Description                |
|-------------|--------------|----------------------------|
| id          | bigint       | Identifiant unique         |
| name        | varchar(255) | Nom de la classe           |
| code        | varchar(255) | Code de la classe          |
| capacity    | integer      | Capacité de la classe      |
| section_id  | bigint       | Référence à la section     |
| created_at  | timestamp    | Date de création           |
| updated_at  | timestamp    | Date de modification       |

---

Chaque table est liée par des clés étrangères (school_id, section_id) pour assurer la cohérence des données.
