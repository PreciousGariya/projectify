**Introduction**

The Task Management System with Notifications is a web-based application designed to streamline task management and enhance communication efficiency by providing users with timely notifications for significant task-related events. This document serves as an overview of the project's objectives, scope, functional requirements, and implementation details.

**2. Project Overview**

**2.1 Objective**

The primary goal of this project is to develop a robust task management system enabling users to perform CRUD (Create, Read, Update, Delete) operations on tasks while receiving notifications for pivotal task-related events like assignment, completion, or impending deadlines. The system architecture will leverage Laravel for the backend API and optionally Vue.js for the frontend interface.

**2.2 Scope**

The project's scope encompasses the following key aspects:
- Establishing a Laravel project to serve as the backend API infrastructure.
- Defining a Task model with comprehensive CRUD functionalities.
- Implementing a notification mechanism utilizing Laravel queues, events, and listeners.
- Providing an optional frontend interface to facilitate user interaction with the system.

**3. Functional Requirements**

**3.1 Backend (Laravel)**

1. **Task Management**
   - Develop CRUD operations for tasks including creation, retrieval, updating, and deletion.
   - Define a Task model with essential attributes such as ID, title, description, status, and deadline.
   - Create RESTful API endpoints to facilitate seamless task management operations.
   - Utilize Laravel's Eloquent ORM for efficient database interactions.
   - Implement robust validation mechanisms to ensure data integrity during task creation and updates.

2. **Notification System**
   - Define distinct events corresponding to various task-related occurrences (e.g., assignment, completion, impending deadlines).
   - Implement event listeners to trigger notifications promptly upon the occurrence of specific events.
   - Integrate Laravel queues for asynchronous delivery of notifications to enhance system responsiveness.
   - Configure notification channels (e.g., email) using Laravel's built-in notification system.
   - Ensure comprehensive error handling and adhere to standardized JSON response formats for API endpoints.

**3.2 Frontend (Vue JS)**

1. **User Interface**
   - Design an intuitive and user-friendly interface facilitating seamless interaction with the task management system.
   - Implement CRUD functionality for tasks using Vue.js or any preferred frontend framework.
   - Integrate the frontend interface with the backend API to enable smooth data retrieval and manipulation operations.

**3.3 General**

1. **Security**
   - Implement robust user authentication and authorization mechanisms to regulate access to CRUD operations based on user roles and permissions.
   - Enhance system security by safeguarding API endpoints against common vulnerabilities such as Cross-Site Request Forgery (CSRF) and Cross-Site Scripting (XSS).

**4. Implementation Details**

- **Backend Framework:** Laravel (Latest Version)
- **Frontend Framework:** Vue.js (Latest Version) [Optional]
- **Database:** MySQL
- **Notification Channels:** Email
- **Queue Driver:** Redis or Database

These implementation details outline the technological stack and infrastructure required to realize the project's objectives effectively.

By adhering to these specifications, the Task Management System with Notifications aims to streamline task management processes and foster enhanced collaboration within organizational settings.



## Projectify

Welcome to Projectify! This repository contains the code for a project management application built with Laravel (backend) and Nuxt.js (frontend).

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/PreciousGariya/projectify.git
cd projectify
```

### 2. Backend (Laravel API with Passport)

#### Prerequisites:
- PHP >= 8.1
- Composer

#### Setup:

1. Navigate to the `backend` directory:

```bash
cd backend
```

2. Install PHP dependencies:

```bash
composer install
```

3. Create a copy of the `.env.example` file and rename it to `.env`:

```bash
cp .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Set up your database in the `.env` file:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

6. Set up SMTP details for email configuration in the `.env` file:

```plaintext
QUEUE_CONNECTION=log

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=your_smtp_port
MAIL_USERNAME=your_smtp_username
MAIL_PASSWORD=your_smtp_password
MAIL_ENCRYPTION=your_smtp_encryption
MAIL_FROM_ADDRESS=your_from_address
MAIL_FROM_NAME="${APP_NAME}"
```

Replace `your_smtp_host`, `your_smtp_port`, `your_smtp_username`, `your_smtp_password`, `your_smtp_encryption`, and `your_from_address` with your SMTP server details.

Replace `QUEUE_CONNECTION=log` to `QUEUE_CONNECTION=database`

7. Run migrations and seeders to set up the database:

```bash
php artisan migrate
```

8. Install Passport (for API authentication):

```bash
php artisan passport:install
```

9. Start the Laravel server:

```bash
php artisan serve
```

10. Run the queue worker for processing queued jobs:

```bash
php artisan queue:work
```

Your Laravel backend API is now set up and running at `http://127.0.0.1:8000`.

### 3. Frontend (Nuxt.js)

#### Prerequisites:
- Node.js >= 14.x
- npm or yarn

#### Setup:

1. Navigate to the `front` directory:

```bash
cd ../front
```

2. Install JavaScript dependencies:

```bash
npm install
# or
yarn install
```

3. Create a copy of the `.env.example` file and rename it to `.env`:

```bash
cp .env.example .env
```

4. Set the base URL for API requests in the `.env` file:

```plaintext
SERVER_BASE_URL=http://127.0.0.1:8000/api
```

Replace `http://127.0.0.1:8000/api` with your backend API URL if it's different.

5. Start the Nuxt.js development server:

```bash
npm run dev
# or
yarn dev
```

Your Nuxt.js frontend is now set up and running at `http://localhost:3000`.

## Questions or Issues?

If you have any questions or encounter any issues while setting up or using Projectify, feel free to open an issue on the GitHub repository: [Projectify Issues](https://github.com/PreciousGariya/projectify/issues)

Happy coding! 🚀
```

This addition includes SMTP configuration steps for Laravel's email functionality. Let me know if there's anything else you need!