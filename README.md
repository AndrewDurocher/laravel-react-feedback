# Feedback Application

A modern feedback collection application built with React frontend and Laravel API backend.

## Architecture

- **Frontend**: React application running on port 3000
- **Backend**: Laravel API running on port 8000

## Project Structure

```
feedback-app/
├── frontend/          # React frontend application
│   ├── src/
│   │   ├── components/
│   │   │   ├── FeedbackForm.js
│   │   │   └── FeedbackList.js
│   │   └── App.js
│   ├── package.json
│   └── README.md
└── backend/          # Laravel API backend
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/
    │   │   │   └── Api/
    │   │   │       └── FeedbackController.php
    │   │   └── Requests/
    │   │       └── StoreFeedbackRequest.php
    │   └── Models/
    │       └── Feedback.php
    ├── database/
    │   ├── factories/
    │   │   └── FeedbackFactory.php
    │   └── migrations/
    │       └── 2025_04_09_082213_create_feedback_table.php
    ├── routes/
    │   └── api.php
    └── .env
```

## Setup Instructions

### Backend (Laravel API)

1. Navigate to the backend directory:
   ```bash
   cd backend
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file:
   ```bash
   cp .env.example .env
   ```

4. Configure your database in `.env`

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Seed the database (optional):
   ```bash
   php artisan db:seed
   ```

8. Start the API server:
   ```bash
   php artisan serve
   ```

The API will be available at http://localhost:8000

### Frontend (React)

1. Navigate to the frontend directory:
   ```bash
   cd frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm run dev
   ```

The application will be available at http://localhost:3000

## API Endpoints

- `GET /api/feedback` - Get list of feedback (supports pagination and rating filter)
- `POST /api/feedback` - Submit new feedback

## Features

- ✅ Modern React frontend with beautiful UI
- ✅ RESTful Laravel API backend
- ✅ Form validation (both client and server-side)
- ✅ Real-time feedback display
- ✅ Rating system with emojis (🥲 to 🤩)
- ✅ Responsive design
- ✅ Pagination support
- ✅ Rating filters

## Requirements

### Backend
- PHP 8.1+
- Composer
- MySQL/PostgreSQL

### Frontend
- Node.js 16+
- npm

## 🔧 Installation

### Backend Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/lilypad-pos-feedback.git
   cd lilypad-pos-feedback
   ```

2. Install PHP dependencies:
   ```bash
   cd backend
   composer install
   ```

3. Configure your environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up your database in the .env file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lilypad_pos
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   For SQLite (alternative):
   ```
   DB_CONNECTION=sqlite
   # Comment out the other DB_* variables
   ```
   Then create the SQLite file:
   ```bash
   touch database/database.sqlite
   ```

5. Run migrations and seed the database with sample data:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   
   This will import 30 sample feedback entries from the included JSON file.

6. Start the development server:
   ```bash
   php artisan serve
   ```
   The Laravel application will be available at http://localhost:8000

### Frontend Setup

1. Navigate to the frontend directory:
   ```bash
   cd ../frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm start
   ```
   The React application will be available at http://localhost:3000

## 🧪 Testing

### Backend Tests
Run the Laravel test suite:
```bash
cd backend
php artisan test
```

### Frontend Tests
Run the React test suite:
```bash
cd frontend
npm test
```

## 📦 Production Build

### Backend
For production deployment, ensure you set appropriate values in your `.env` file:
```
APP_ENV=production
APP_DEBUG=false
```

### Frontend
Build the React application for production:
```bash
cd frontend
npm run build
```
The build files will be created in the `build` directory, which can be served by any static file server.

## 📱 Usage

### Submitting Feedback
1. Enter your name
2. Write your feedback message
3. Select a rating from 🥲 to 🤩
4. Click "Submit Feedback"

### Viewing Feedback
- All recent feedback entries are displayed in a table
- Filter by rating using the emoji buttons
- The table shows customer name, message, rating, and date

## 🏗️ Project Structure

### Backend
```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       └── FeedbackController.php
│   │   └── Requests/
│   │       └── StoreFeedbackRequest.php
│   └── Models/
│       └── Feedback.php
├── database/
│   ├── factories/
│   │   └── FeedbackFactory.php
│   └── migrations/
│       └── 2025_04_09_082213_create_feedback_table.php
├── routes/
│   ├── api.php
│   └── web.php
```

### Frontend
```
frontend/
├── public/
│   └── index.html
└── src/
    ├── components/
    │   ├── FeedbackForm.js
    │   └── FeedbackList.js
    ├── App.js
    ├── index.js
    └── index.css
```

## 🔄 API Endpoints

### GET /api/feedback
Retrieves the 10 most recent feedback entries.

Query parameters:
- `