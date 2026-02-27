### This docs to create the Tables for App

```sql
CREATE TABLE schools(
    int id primary key,
    varchar(255) name,
    varchar(255) address,
    varchar(15) phone,
    varchar(255) email,
    Datetime created_at,
    Datetime updated_at,

    );


CREATE TABLE users(
    int id primary key,
    varchar(255) name,
    varchar(255) address,
    varchar(15) phone,
    varchar(255) email,
    varchar(255) role,
    varchar(255) password,
    Datetime created_at,
    Datetime updated_at,
    foreign school_id
    );
```