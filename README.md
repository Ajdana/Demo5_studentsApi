# 🎓 Student Management API (Laravel 10)

## 📘 Project Description

**Student Management API** — это RESTful API, созданный на **Laravel 10 (PHP 8.1)**.
Он позволяет управлять информацией о студентах: создавать, просматривать, редактировать и удалять данные.
Проект реализует полные CRUD-операции, валидацию входных данных, обработку ошибок и поддержку CORS для интеграции с фронтендом.

---

## ⚙️ Technologies Used

* **PHP 8.1**
* **Laravel 10**
* **MySQL-8.0**
* **Eloquent ORM**
* **Postman** — для тестирования API
* **Git & GitHub** — для контроля версий

---

## 🧩 Installation Steps

1️⃣ **Склонируй репозиторий:**

```bash
git clone https://github.com/Ajdana/Demo5_studentsApi.git
cd Demo5_studentsApi
```

2️⃣ **Установи зависимости:**

```bash
composer install
```

3️⃣ **Создай файл окружения (.env):**

```bash
cp .env.example .env
```

4️⃣ **Сгенерируй ключ приложения:**

```bash
php artisan key:generate
```

5️⃣ **Настрой параметры базы данных в `.env`:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=students_api
DB_USERNAME=root
DB_PASSWORD=
```

6️⃣ **Запусти миграции и посей данные:**

```bash
php artisan migrate --seed
```

7️⃣ **Запусти сервер:**

```bash
php artisan serve
```

После этого API будет доступен по адресу:
👉 `http://127.0.0.1:8000/api/students`

---

## 🌍 How to Run the API

После запуска сервера ты можешь использовать **Postman**, чтобы отправлять HTTP-запросы к API:

| Метод      | Endpoint             | Описание                       | Статус                                   |
| ---------- | -------------------- | ------------------------------ | ---------------------------------------- |
| **GET**    | `/api/students`      | Получить список всех студентов | 200 OK                                   |
| **GET**    | `/api/students/{id}` | Получить студента по ID        | 200 OK / 404 Not Found                   |
| **POST**   | `/api/students`      | Создать нового студента        | 201 Created / 400 Bad Request            |
| **PUT**    | `/api/students/{id}` | Обновить данные студента       | 200 OK / 400 Bad Request / 404 Not Found |
| **DELETE** | `/api/students/{id}` | Удалить студента               | 200 OK / 404 Not Found                   |

---

## 🧠 Example JSON Body (POST / PUT)

```json
{
  "name": "Aidana K.",
  "age": 20,
  "group": "CS101",
  "email": "aidana@example.com",
  "avatar_url": "https://example.com/avatar.jpg"
}
```

---

## 🧾 Input Validation

| Поле           | Правила                           |
| -------------- | --------------------------------- |
| **name**       | required, string, min:2           |
| **age**        | required, integer, between:16,100 |
| **group**      | required, string                  |
| **email**      | required, valid email, unique     |
| **avatar_url** | optional, valid URL               |

---

## ⚠️ Error Handling

API возвращает корректные HTTP коды и сообщения об ошибках:

| Код | Значение                                  |
| --- | ----------------------------------------- |
| 200 | OK — успешный запрос                      |
| 201 | Created — успешно создан ресурс           |
| 400 | Bad Request — ошибка валидации            |
| 404 | Not Found — студент не найден             |
| 500 | Internal Server Error — ошибка на сервере |

Ошибки логируются через `Log::error()` в `storage/logs/laravel.log`.

---

## 🔧 Environment Setup Instructions

В файле `.env` нужно указать:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=MySQL-8.0
DB_PORT=3306
DB_DATABASE=demo_students
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🗃️ Database Schema

| Column       | Type     | Description                 |
|---------------|----------|-----------------------------|
| id            | integer  | Primary key (auto increment)|
| full_name     | string   | Student's full name         |
| course        | string   | Course name (optional)      |
| specialty     | string   | Student's specialty (optional) |
| bio           | text     | Short biography (optional)  |
| created_at    | datetime | Record creation date        |
| updated_at    | datetime | Record update date          |


## 🗃 Database Setup

* 📁 **Migration:** `database/migrations/xxxx_xx_xx_create_students_table.php`
* 🌱 **Seeder:** `database/seeders/StudentSeeder.php`
* 📦 **Model:** `app/Models/Student.php`

Seeder создаёт 5–10 тестовых записей студентов.

---

## 🧪 API Testing (Postman)

* Открой Postman
* Создай коллекцию `Student Management API`
* Добавь запросы:

  * GET → `/api/students`
  * GET → `/api/students/1`
  * POST → `/api/students`
  * PUT → `/api/students/1`
  * DELETE → `/api/students/1`
* Тело запросов — в формате JSON (пример выше)

---

## 🚀 CORS Configuration

Разрешены методы:

```
GET, POST, PUT, DELETE
```

Добавь в `app/Http/Middleware/HandleCors.php` или установи пакет:

```bash
composer require fruitcake/laravel-cors
```

---

## 💻 Author

**Айдана 👩‍💻**
3 курс, IT-специальность, Тараз
Email: [[ajdanaamirtaj@gmail.com](mailto:ajdanaamirtaj@gmail.com)]
GitHub: [@Ajdana](https://github.com/Ajdana)
