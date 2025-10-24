<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# 🏠 Student Room Reservation System

A Laravel-based web application that allows university students to reserve dorm rooms in a **queue-based system** with smart prioritization and confirmation flow.

---

## 🚀 Overview

The **Student Room Reservation System** manages room reservations in a structured and fair queue.  
Each student can reserve **one room as priority 1** and, if necessary, select a **backup room (priority 2)** until the first is confirmed.

The system ensures that all students have an opportunity to reserve rooms fairly, with real-time updates, payment-based confirmation, and email notifications.

---

## ✨ Features

- 👩‍🎓 **Student Registration & Authentication**
  - Secure user registration and login system using Laravel Auth.
  - Email verification before access to reservation features.

- 🛏️ **Room Reservation Queue**
  - Each student can select **one room** as priority one.
  - If the selected room is pending, a **second priority** must be selected.
  - Real-time validation ensures no duplicate selections.

- 💳 **Room Confirmation & Payment**
  - After selecting a room, the student must confirm and pay within **30 minutes**.
  - If payment is not made, the room is released back into the queue.

- 📨 **Email Notifications**
  - Registration verification emails.
  - Room selection confirmation emails.

- ⚙️ **Database & Seeder Support**
  - Factories and seeders are included to generate test data for rooms and students.

- 🔐 **Middleware Protection**
  - Custom middleware for:
    - Authentication (`AuthMiddleware`)
    - Email verification (`VerifiedMiddleware`)
    - Room confirmation (`ConfirmedMiddleware`)

---

## 🧱 Tech Stack

| Component | Technology |
|------------|-------------|
| Framework | Laravel 12 |
| Language | PHP 8.3 |
| Database | MySQL |
| Mail | Laravel Mail or Mailhog (for testing) |
| ORM | Eloquent ORM |
| Testing | PHPUnit |
| Frontend | Blade + Bootstrap |
| Queue | Laravel Queue System |

---

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository
git clone https://github.com/NadaReda22/DormReservation.git
cd DormReservation
2️⃣ Install Dependencies
composer install
npm install && npm run build

3️⃣ Configure Environment

Create a .env file and update database and mail settings:

cp .env.example .env


Edit .env:

DB_DATABASE=student_rooms
DB_USERNAME=root
DB_PASSWORD=
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_FROM_ADDRESS="example@university.edu"

4️⃣ Generate Application Key
php artisan key:generate

5️⃣ Run Migrations and Seeders
php artisan migrate --seed

6️⃣ Serve the Application
php artisan serve

>>>>>>> 69c398a4ba19e5cf4bb5f31227ef557e66382991
