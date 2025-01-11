# README

## 1. Project Overview

This **Laravel** project implements a set of **CRUD (Create, Read, Update, Delete)** operations and additional features for the following entities:

1. **Employees**
2. **Salaries**
3. **Departments**
4. **Folders**
5. **Notes**

### Core Tasks

- **Employees**:
    - Each employee can be assigned to one or multiple departments.
    - CRUD endpoints for managing employees.

- **Salaries**:
    - Each department has an associated salary (one salary can be linked to multiple departments).
    - CRUD endpoints to manage salary amounts.

- **Departments**:
    - Many-to-many relationship with employees.
    - Each department references a salary.
    - CRUD endpoints for departments.

- **Folders & Notes**:
    - A folder can have multiple notes.
    - Notes can be of type **text** or **pdf**, with optional fields like `text_body` or `pdf_path`.
    - Each note can be private or shared.
    - CRUD endpoints for managing folders and notes.

### Additional Features

- **N-th Highest Salary** logic (optional in a specific route):
    - Return employees who have the N-th highest salary among all.
- **User Authentication** (if you enable it):
    - By default, routes can be protected via **auth:sanctum** or **basic-auth** in the code.
- **Basic Testing** with at least 3 test cases (optional, see `tests/` folder).

---

## 2. Installation & Setup

1. **Clone** or **Download** this repository:

   ```bash
   git clone https://github.com/TariqAyman/mazaady-task
   cd mazaady-task
   ```

2. **Install Dependencies** using Composer:

   ```bash
   composer install
   ```

3. **Copy .env** file and generate key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure .env**:
    - Update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` to match your local database setup.
    - Optionally configure `APP_URL`, `APP_NAME`, etc.

5. **(Optional) Configure Sanctum** if you want token-based authentication:
   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```
   Then set `SANCTUM_STATEFUL_DOMAINS` and so forth.

---

## 3. Migrations & Seeding

1. **Run Migrations**:

   ```bash
   php artisan migrate
   ```

   This will create the tables:
    - `employees`, `departments`, `salaries`, pivot table `department_employee`
    - `folders`, `notes`, `users` (if you have basic user model)
    - etc.

2. **Seed the Database** (optional):

   ```bash
   php artisan db:seed
   ```

   This will insert sample data into:
    - `employees` table (10 or so dummy employees)
    - `salaries` table (distinct amounts)
    - `departments` table (random departments referencing salaries)
    - Pivot table linking employees to departments
    - Possibly a test user for authentication

You can customize the seeding logic in `database/seeders/DatabaseSeeder.php` or the dedicated seeders.

---

## 4. Running & Testing the Project

- **Serve the Application**:

  ```bash
  php artisan serve
  ```

  The API will be accessible at `http://127.0.0.1:8000`.

- **Run Tests** (if implemented):

  ```bash
  php artisan test
  ```

  or

  ```bash
  vendor/bin/phpunit
  ```

  or

  ```bash
  vendor/bin/pest
  ```

  (depending on whether you use PHPUnit or Pest).

---

## 5. API Endpoints

Below is a **summary** of the main endpoints. All URLs below assume you are prefixing with `/api`. For example, `http://your-domain.test/api/employees`. Adjust if your route group or domain differs.

### 5.1 Employees

| Method | Endpoint          | Description                           | Body/Params                               |
|--------|-------------------|---------------------------------------|-------------------------------------------|
| **GET**    | `/employees`         | List all employees                    | -                                         |
| **POST**   | `/employees`         | Create a new employee                 | `{"name":"John"}` |
| **GET**    | `/employees/{id}`    | Show a single employee                | -                                         |
| **PUT**    | `/employees/{id}`    | Update an employee                    | `{"name":"..."}` |
| **DELETE** | `/employees/{id}`    | Delete an employee                    | -                                         |

> **Note**: If employees must select departments at creation, include an array like `"departments": [1,2]`.

### 5.2 Salaries

| Method | Endpoint          | Description                 | Body/Params            |
|--------|-------------------|-----------------------------|------------------------|
| **GET**    | `/salaries`         | List all salaries                | -                      |
| **POST**   | `/salaries`         | Create a new salary              | `{"amount": 3000.0}`   |
| **GET**    | `/salaries/{id}`    | Show salary by ID                | -                      |
| **PUT**    | `/salaries/{id}`    | Update an existing salary        | `{"amount": 5000.0}`   |
| **DELETE** | `/salaries/{id}`    | Delete a salary                  | -                      |

### 5.3 Departments

| Method | Endpoint             | Description                    | Body/Params                      |
|--------|----------------------|--------------------------------|----------------------------------|
| **GET**    | `/departments`         | List all departments             | -                                |
| **POST**   | `/departments`         | Create a department              | `{"name": "HR", "salary_id":1}`  |
| **GET**    | `/departments/{id}`    | Show a specific department       | -                                |
| **PUT**    | `/departments/{id}`    | Update department                | `{"name":"Finance","salary_id":2}` |
| **DELETE** | `/departments/{id}`    | Delete department                | -                                |

### 5.4 Folders

| Method | Endpoint       | Description                          | Body/Params           |
|--------|---------------|--------------------------------------|-----------------------|
| **GET**    | `/folders`       | List all folders (for the user)    | -                     |
| **POST**   | `/folders`       | Create a folder                    | `{"name": "My Folder"}` |
| **GET**    | `/folders/{id}`  | Show folder by ID                  | -                     |
| **PUT**    | `/folders/{id}`  | Update a folder                    | `{"name": "New Name"}`|
| **DELETE** | `/folders/{id}`  | Delete a folder                    | -                     |

### 5.5 Notes

| Method | Endpoint       | Description                                | Body/Params                                                   |
|--------|---------------|--------------------------------------------|---------------------------------------------------------------|
| **GET**    | `/notes`         | List all notes (or notes for the user)       | -                                                             |
| **POST**   | `/notes`         | Create a note                                  | `{"folder_id":1,"title":"...","text_body":"...","type":"text"}` |
| **GET**    | `/notes/{id}`    | Show note by ID                                | -                                                             |
| **PUT**    | `/notes/{id}`    | Update a note                                  | `{"title":"...","text_body":"...","type":"pdf","pdf_path":"..."}` |
| **DELETE** | `/notes/{id}`    | Delete a note                                  | -                                                             |

**Optional**: If notes are nested under folders (like `/folders/{folder}/notes`), the endpoints might differ. Adjust accordingly.

### 5.6 Special / Additional Endpoints

- **N-th Highest Salary** (if implemented):
    - Example `GET /salaries?nth=3` => returns employees with the 3rd highest salary.

- **Public/Shared Notes**: If some notes are shared publicly:
    - `GET /notes` => returns the note if `visibility=shared`.

### 5.7 Authentication (if enabled)

If you use **Sanctum** or **Passport**, you might have:

- `POST /login` => returns a token
- Set `Authorization: Bearer <token>` in headers for subsequent calls.

Refer to your project’s **auth** instructions if needed.

---

## Conclusion

This project implements **multiple CRUD** resources:

- Employees, Salaries, Departments (with relationships)
- Folders & Notes (with text/pdf types, visibility)

**Setup** involves standard Laravel steps: install dependencies, configure `.env`, migrate, seed data, then use the **API endpoints** described above. For any advanced usage (e.g., role-based access, advanced file uploads, etc.), consult the extended documentation or code comments.

**Enjoy using the Mazaady Task project!**
