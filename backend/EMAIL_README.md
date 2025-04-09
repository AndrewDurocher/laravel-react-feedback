# LilYPad POS - Customer Feedback Module

Thank you for the opportunity to complete this technical assignment for the Full-Stack Developer role at LilYPad POS. I've built a lightweight Customer Feedback Module that demonstrates both Laravel/Livewire and React implementations.

## Project Overview

I've built a complete customer feedback system with:

### Backend (Laravel/Livewire)
- RESTful API for feedback submission and retrieval
- Server-side rendered UI with Livewire components
- Form validation and error handling
- Custom emoji rating scale from 🥲 to 🤩
- Filtering by rating
- Comprehensive test coverage

### Frontend (React)
- Single-page application with React
- Interactive form with client-side validation
- Real-time feedback list with filtering functionality
- Responsive design with Tailwind CSS

## Setup Instructions

### Backend Setup

1. Clone the repository and navigate to the backend folder:
   ```bash
   git clone https://github.com/your-username/lilypad-pos-feedback.git
   cd lilypad-pos-feedback/backend
   ```

2. Install dependencies:
   ```bash
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

5. Run migrations and seed the database with sample data:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   
   Alternatively, after launching the app, you can click the "Load Sample Data" button on the empty feedback list to populate it with 30 sample entries.

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

## Assumptions and Design Choices

1. **Dual Implementation**: I chose to implement both a Laravel/Livewire server-side solution and a React client-side solution to demonstrate flexibility with both approaches.

2. **Database Design**: I kept the data model simple with customer name, message, rating, and timestamps. This covers the requirements while keeping the design clean.

3. **Emoji Rating Scale**: The custom emoji scale (🥲 to 🤩) provides an intuitive and fun way for users to express their satisfaction levels.

4. **Validation**: I implemented validation on both client and server sides to ensure data integrity and provide immediate feedback to users.

5. **Filtering**: The filter-by-rating feature enhances usability by allowing quick access to specific feedback categories.

## Improvements with More Time

With additional time, I would consider the following enhancements:

1. **Authentication**: Add user authentication for administrative access to manage feedback.

2. **Pagination**: Implement pagination to support viewing more than 10 feedback entries.

3. **Search Functionality**: Add the ability to search for specific feedback content.

4. **Analytics Dashboard**: Create visualizations of feedback trends over time.

5. **Mobile Optimization**: Further refine the responsive design for an optimal mobile experience.

6. **Testing**: Add more comprehensive test coverage, including React component tests.

7. **Accessibility**: Ensure WCAG compliance for accessibility.

8. **Internationalization**: Add support for multiple languages.

Thank you for reviewing my submission. I look forward to discussing my approach and the architectural decisions I made during the implementation.

Best regards,
[Your Name]