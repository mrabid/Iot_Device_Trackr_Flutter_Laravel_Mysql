# 🌐 IoT Device Tracker (Flutter + Laravel + MySQL)

A cross-platform mobile app to monitor IoT devices and sensor data in real-time, with a Laravel backend API and MySQL database.

![App Screenshot](screenshots/dashboard.png) *(Add your screenshot path here)*

## 🚀 Features

### Flutter App (Frontend)
- 📱 Real-time device monitoring
- 📊 Temperature/humidity data visualization
- 🔄 Pull-to-refresh functionality
- 📶 WiFi/Local network API connectivity
- 📱 Responsive UI for Android/iOS

### Laravel (Backend API)
- 🔐 RESTful API endpoints
- 🗃️ MySQL database integration
- ⏱️ Timestamped sensor readings
- 📡 Paginated device data responses
- 🛠️ CORS support for Flutter app

## 🛠️ Tech Stack

| Component       | Technology |
|----------------|------------|
| **Frontend**   | Flutter (Dart) |
| **Backend**    | Laravel (PHP) |
| **Database**   | MySQL |
| **API**        | RESTful JSON |
| **Local Host** | XAMPP |

## 📂 Project Structure

Iot_Device_Trackr_Flutter_Laravel_Mysql/
├── flutter_app/ # Flutter frontend
│ ├── lib/
│ │ └── main.dart # Primary app code
│ └── pubspec.yaml # Flutter dependencies
│
├── laravel_api/ # Laravel backend
│ ├── app/Http/Controllers/ # API controllers
│ ├── database/migrations/ # DB schemas
│ └── routes/api.php # API endpoints
│
└── screenshots/ # App visuals


# IoT Device Tracker
![Flutter](https://img.shields.io/badge/Flutter-02569B?style=for-the-badge&logo=flutter&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

A complete IoT monitoring solution with Flutter mobile app, Laravel API backend, and MySQL database.

## Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [API Reference](#api-reference)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)

## Features
### Mobile App (Flutter)
- Real-time device monitoring
- Interactive data charts
- Cross-platform (Android/iOS)
- Local network connectivity

### Backend (Laravel)
- RESTful API endpoints
- MySQL database integration
- Authentication support
- Data pagination

## Tech Stack
**Frontend:**  
Flutter 3.x · Dart · HTTP Client  

**Backend:**  
Laravel 10.x · PHP 8.x · MySQL  

**Development:**  
XAMPP · Postman · Git  

## Installation

### Backend Setup
```bash
# Clone repository
git clone https://github.com/mrabid/Iot_Device_Trackr_Flutter_Laravel_Mysql.git
cd Iot_Device_Trackr_Flutter_Laravel_Mysql/laravel_api

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Set database credentials in .env
DB_DATABASE=iot_tracker
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate --seed

# Start server
php artisan serve --host=0.0.0.0 --port=8000
