## Table : registrations

| Colonne          | Type           | Description                                 |
|------------------|----------------|---------------------------------------------|
| id               | bigint         | Identifiant unique                          |
| student_id       | bigint         | Référence à l'étudiant                      |
| parent_id        | bigint         | Référence au parent                         |
| year_id          | bigint         | Référence à l'année scolaire                |
| school_id        | bigint         | Référence à l'école                         |
| classroom_id     | bigint         | Référence à la classe                       |
| section_id       | bigint         | Référence à la section                      |
| registration_date| date           | Date de l'inscription                       |
| status           | varchar(50)    | Statut de l'inscription (active, réinscrit, etc.) |
| created_at       | timestamp      | Date de création                            |
| updated_at       | timestamp      | Date de modification                        |

---
## Table : parents

| Colonne     | Type           | Description                        |
|-------------|----------------|------------------------------------|
| id          | bigint         | Identifiant unique                 |
| name        | varchar(255)   | Nom complet du parent              |
| email       | varchar(255)   | Email (optionnel)                  |
| phone       | varchar(20)    | Téléphone (obligatoire)            |
| password    | varchar(255)   | Mot de passe généré automatiquement|
| school_id   | bigint         | Référence à l'école                |
| created_at  | timestamp      | Date de création                   |
| updated_at  | timestamp      | Date de modification               |

---

## Table : years

| Colonne     | Type           | Description                        |
|-------------|----------------|------------------------------------|
| id          | bigint         | Identifiant unique                 |
| name        | varchar(255)   | Nom de l'année scolaire            |
| school_id   | bigint         | Référence à l'école                |
| is_active   | boolean        | Année activée pour l'école         |
| start_date  | date           | Date de début                      |
| end_date    | date           | Date de fin                        |
| created_at  | timestamp      | Date de création                   |
| updated_at  | timestamp      | Date de modification               |

---
## Table : students

| Colonne        | Type           | Description                                                        |
|----------------|----------------|--------------------------------------------------------------------|
| id             | bigint         | Identifiant unique                                                 |
| matricule      | varchar(50)    | Matricule généré automatiquement (initiales année, nom, post-nom, numéro unique) |
| name           | varchar(255)   | Nom complet de l'étudiant                                          |
| post_name      | varchar(255)   | Post-nom de l'étudiant                                             |
| email          | varchar(255)   | Email généré automatiquement (initiales + nom école + @gmail.com)  |
| phone          | varchar(20)    | Téléphone                                                          |
| birth_date     | date           | Date de naissance                                                  |
| address        | varchar(255)   | Adresse                                                            |
| photo          | string         | Chemin du fichier photo                                            |
| bulletin_file  | string         | Chemin du fichier bulletin                                         |
| school_id      | bigint         | Référence à l'école                                                |
| parent_id      | bigint         | Référence au parent                                                |
| created_at     | timestamp      | Date de création                                                   |
| updated_at     | timestamp      | Date de modification                                               |

Précisions :
- À l'inscription, le matricule et l'email sont générés automatiquement.
- La réinscription d'un élève déjà inscrit ne crée pas un nouvel élève, mais lie à une nouvelle année.
- Les parents doivent fournir : nom complet, email (optionnel), téléphone (obligatoire), mot de passe généré automatiquement.
- L'inscription appartient à une année scolaire (table year).
- Les fichiers photo et bulletin sont stockés et liés à l'élève.

---

# Documentation des tables principales 

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

## Table : sections

| Colonne     | Type         | Description                |
|-------------|--------------|----------------------------|
| id          | bigint       | Identifiant unique         |
| name        | varchar(255) | Nom de la section          |
| code        | varchar(255) | Code de la section         |
| school_id   | bigint       | Référence à l'école        |
| created_at  | timestamp    | Date de création           |
| updated_at  | timestamp    | Date de modification       |

---

Chaque table est liée par des clés étrangères (school_id, section_id) pour assurer la cohérence des données.
