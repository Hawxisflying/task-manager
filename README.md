
````md
# Simple Task Management System

This is a Laravel-based Task Management System developed as part of the Intern Assessment for Techpath Learning Private Ltd.

## Project Description

A single-user web application that allows users to create, view, update, delete, and manage tasks.  
Each task contains a title, optional description, priority level, and completion status.

The application demonstrates Laravel fundamentals, MVC architecture, and clean coding practices.

## Technology Stack

- Framework: Laravel 11  
- Language: PHP 8.2+  
- Database: MySQL  
- Frontend: Blade Templates and Bootstrap (via CDN)

## Core Features

- Task Listing: View all tasks in a clean and organized table.
- Add Task: Create new tasks with title, description, and priority (Low / Medium / High).
- Edit Task: Update existing task details.
- Update Status: Toggle tasks between Pending and Completed using a checkbox.
- Delete Task: Remove tasks with a confirmation modal to prevent accidental deletion.
- Search and Filter: Search tasks by title or description and filter by status.
- Validation: Server-side validation to ensure required fields and valid priority values.

## Setup Instructions

### 1. Navigate to the Project Directory

Clone the project:

git clone https://github.com/Hawxisflying/task-manager.git

```bash
cd task-manager
````

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your MySQL database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

Ensure the database (`task_manager`) exists in MySQL.

### 4. Database Migration

```bash
php artisan migrate
```

### 5. Run the Application

```bash
php artisan serve
```

Open the application in your browser:

```
http://127.0.0.1:8000
```


```

