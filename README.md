# Simple Task Management System

This is a Laravel-based Task Management System developed as part of the Intern Assessment for Techpath Learning Private Ltd.

## Project Description

A single-user web application that allows users to create, view, update, delete, and manage tasks.
Each task contains a title, optional description, priority level, and completion status.

The application demonstrates Laravel fundamentals, MVC architecture, and clean coding practices.

## Technology Stack`

* Framework: Laravel 11
* Language: PHP 8.2+
* Database: SQLite (default for easy local setup)
* Frontend: Blade Templates and Bootstrap (via CDN)

## Core Features

* Task Listing: View all tasks in a clean and organized table.
* Add Task: Create new tasks with title, description, and priority (Low / Medium / High).
* Edit Task: Update existing task details.
* Update Status: Toggle tasks between Pending and Completed using a checkbox.
* Delete Task: Remove tasks with a confirmation modal to prevent accidental deletion.
* Search and Filter: Search tasks by title or description and filter by status.
* Validation: Server-side validation to ensure required fields and valid priority values.

## Setup Instructions

### 1. Extract the Project

Clone the project:

git clone https://github.com/Hawxisflying/task-manager

Extract the ZIP file and navigate to the project directory:

cd task-manager

### 2. Install Dependencies

Install PHP dependencies using Composer:

composer install

### 3. Environment Configuration

Copy the environment file and generate the application key:

cp .env.example .env
php artisan key:generate

### 4. Database Setup

The project uses SQLite by default.

Create the SQLite database file:

**Windows (PowerShell):**

New-Item -Path database/database.sqlite -ItemType File

**Linux / macOS / Git Bash:**

touch database/database.sqlite

Run the migrations:

php artisan migrate

### 5. Run the Application

Start the Laravel development server:

php artisan serve


Open the application in your browser:

http://127.0.0.1:8000

You will be redirected to the Task Management page.


