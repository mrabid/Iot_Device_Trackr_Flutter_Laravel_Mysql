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


## 🛠️ Setup Guide

### Prerequisites
- Flutter SDK (≥3.0)
- PHP (≥8.0) + Composer
- MySQL (≥5.7)
- XAMPP (for local hosting)

### Backend Setup
```bash
cd laravel_api
composer install
cp .env.example .env
php artisan key:generate
Configure .env with your MySQL credentials:

env
DB_DATABASE=iot_tracker
DB_USERNAME=root
DB_PASSWORD=
Run migrations:

bash
php artisan migrate --seed
Start server:

bash
php artisan serve --host=0.0.0.0 --port=8000
Frontend Setup
bash
cd flutter_app
flutter pub get
Update API base URL in lib/main.dart:

dart
Uri.parse('http://[YOUR_LOCAL_IP]:8000/api/devices')
Run app:

bash
flutter run
🌟 API Endpoints
Endpoint	Method	Description
/api/devices	GET	List all devices
/api/devices/{id}	GET	Get device details
/api/readings	POST	Store new sensor data
📸 Screenshots
Dashboard View	Device Details
Dashboard	Details
(Replace with your actual screenshots)

🤝 Contributing
Fork the project

Create your branch (git checkout -b feature/your-feature)

Commit changes (git commit -m 'Add feature')

Push (git push origin feature/your-feature)

Open a PR

📜 License
MIT © ABID

