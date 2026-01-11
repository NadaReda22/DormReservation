# 🏠 Student Room Reservation System

A Laravel-based web application that allows university students to reserve dorm rooms in a **queue-based system** with smart prioritization and confirmation flow.

---

## 🚀 Overview

The **Student Room Reservation System** manages room reservations in a structured and fair queue.  
Each student can reserve **one room as priority 1** and, if necessary, select a **backup room (priority 2)** until the first is confirmed.

The system ensures that all students have an opportunity to reserve rooms fairly, with real-time updates, payment-based confirmation, and email notifications.

--<img src="./tests/Screenshot%20(411).png" width="300" height="300" alt="3D Viewer">
<img src="./tests/Screenshot%20(412).png" width="300" height="300" alt="3D Viewer">
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
```bash
git clone https://github.com/NadaReda22/DormReservation.git

cd DormReservation
```
2️⃣ Install Dependencies
```bash
composer install
npm install && npm run build
```
3️⃣ Configure Environment

Create a .env file and update database and mail settings:
```bash
cp .env.example .env
```

Edit .env:
```bash
DB_DATABASE=student_rooms
DB_USERNAME=root
DB_PASSWORD=
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_FROM_ADDRESS="example@university.edu"
```
4️⃣ Generate Application Key
```bash
php artisan key:generate
```
5️⃣ Run Migrations and Seeders
```bash
php artisan migrate --seed
```
6️⃣ Serve the Application
```bash
php artisan serve
```
---

👨‍💻 Author

Nada Reda Backend Developer | Problem Solving |  (2025)

[LinkedIn](https://www.linkedin.com/in/nada-reda22) | [Email](mailto:nadoarmando22@gmail.com) | [Youtube](https://www.youtube.com/watch?v=iCj78jLZz1I)

