# Equity Management System

## Objective

Build a secure, scalable, and well-documented Laravel-based internal equity management platform for XYZ Company, with API-first design, role-based access, reporting, and scheduled tasks.

---

## Tech Stack

* **Framework:** Laravel 10+
* **Auth:** Laravel Breeze
* **Permissions:** Spatie Laravel Permission
* **Queue & Scheduling:** Laravel Scheduler, Jobs, Queues
* **API Auth:** JWT (tymon/jwt-auth)
* **Excel:** Laravel Excel
* **PDF:** Laravel DomPDF
* **Mail:** Laravel Mail System for Registered User

---

---

## Modules

### 1. User Authentication & Role Management

* Laravel Breeze + JWT Auth
* Roles: Admin, Manager, Analyst
* Permissions managed via Spatie package (Not fully completed)

### 2. Client Portfolio Management (Done)

* CRUD for Clients
* CRUD for Holdings
* Upload stock holdings via Excel sheet

### 3. Live Price Integration (Done)

* Live/Mock API to fetch stock prices
* Scheduled Job updates holding values

### 4. Reporting Module (Done)

* Client-wise & Sector-wise Reports
* Filters: Date Range, Sector, Client
* Export: PDF & Excel using Laravel Excel & DomPDF

### 5. Notification System 

* Greeting email on registration (Done)

### 6. Audit Trail (Not Completed)

* User actions tracked using Spatie Activitylog
* Logs edits, deletions, and actions

### 7. API Module (Done)

* RESTful API with JWT-based Auth
* CRUD endpoints for Clients and Holdings
* Optional Swagger integration (bonus)

---

## Security Features (Done)

* Request Validation with Form Requests
* API Throttling (`throttle:60,1`)
* Policy & Gate based Access Control - Not Done
* Eager Loading for SQL optimization
* Indexing `client_id`, `sector`, `buy_date` in holdings table

---

## Setup Instructions

### Prerequisites

* PHP >= 8.1
* Composer
* Laravel 10+
* MySQL

#Composer version 2.4.1
#PHP Version PHP 8.1.10
#Laravel Version 10.10
#Node version v18.8.0

### Install & Run

```
git clone https://github.com/tawfiquebd/equity-management-system.git

cd equity_management_system

git fetch --all

git checkout staging

cp .env.example .env

composer install

npm install 

php artisan key:generate

# Setup DB
php artisan migrate --seed

# JWT Setup
php artisan jwt:secret

# Run Queues & Scheduler
php artisan queue:work
php artisan schedule:work

# Serve
php artisan serve

npm run dev

```

---

## API Endpoints

> Below routes are prefixed with `/api` and protected via JWT Auth middleware.

### Auth

* `POST /api/login`
* `POST /api/register`
* `POST /api/logout`
* `POST /api/refresh`
* `GET /api/me`

### Clients

* `GET /api/clients`
* `POST /api/clients`
* `PUT /api/clients/{id}`
* `DELETE /api/clients/{id}`

### Holdings

* `GET /api/holdings`
* `POST /api/holdings`
* `PUT /api/holdings/{id}`
* `DELETE /api/holdings/{id}`

### Mock API

```
GET   /api/mock-stock-prices
```

##  Web API Endpoints

> Below routes are found in web.php

### CRUD

* `GET /clients`

* `GET` /`holdings`

### Reports

* `GET /reports/client-wise`

* `GET /reports/sector-wise`

### Imports Holdings Data

`GET `/holdings-data/import

---

##  Packages Used

* **spatie/laravel-permission** – Role & permission management
* **tymon/jwt-auth** – JWT authentication for APIs
* **laravel/excel** – Excel import/export
* **barryvdh/laravel-dompdf** – PDF exports
* **spatie/laravel-activitylog** – Action logging

---

## Test User Credentials

```
Email: test@example.com
Password: admin123
```

---

## Cron Jobs / Scheduled Tasks

* `update-holdings-prices` – Updates current market values in every five minutes by scheduler, which is added to `app/Console/Kernel.php`
  
* `send-greeting-mails` – Send greetings email to new user when user register in site.
  `[ Required to run : php artisan queue:work   and  php artisan schedule:work ]`
  `Also need Mailtrap username and password. which should be put in .env`

---
