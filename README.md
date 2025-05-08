# Keystone School of Engineering Events Management System:- Key Events

A web-based event management system designed for Keystone School of Engineering to manage and showcase school events. Built with Laravel, styled with Tailwind CSS, and enhanced with Gemini AI for report generation.

## Features

### Event Management
- **Event Creation and Administration**
  - Create events with detailed information (title, description, date/time)
  - Upload event images and brochures
  - Set event type (In-Person/Virtual) and category
  - Configure available seats and registration options
  - Admin approval workflow for organizer-created events

### Role-Based System
- **Three-Tier User Roles**
  - **Admin**: Full system control, user management, event approvals
  - **Organizer**: Create and manage events, media galleries, and generate reports
  - **Student**: Browse events, register for events, view personal certificates

### Event Display and Discovery
- **Responsive Frontend**
  - Featured upcoming event showcase
  - Filterable event grid layout
  - Advanced search functionality
  - Detailed event pages with registration options

### Registration System
- **Event Registration**
  - Seat availability tracking
  - Student enrollment management
  - Registration confirmation
  - Attendance certificates

### Media Gallery
- **Event Media Management**
  - Upload and organize event photos
  - Gallery view for each event
  - Media access controls based on user role

### Notification System
- **Automated Communications**
  - New event notifications
  - Registration confirmations
  - Event reminders
  - Queue system for efficient email delivery

### Report Generation with Gemini AI
- **AI-Powered Event Reporting**
  - Generate professional event reports using Google's Gemini AI
  - Customize reports with event details and photos
  - Preview and edit generated content
  - Download final reports in PDF format
  - Fallback template-based system when AI unavailable

## Technical Architecture

- **Backend**: Laravel 10.x PHP framework
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel's built-in auth system with role management
- **File Storage**: Local storage for event images and documents
- **AI Integration**: Google Gemini API for intelligent report generation
- **PDF Generation**: Barryvdh/DomPDF for report downloads

## Setup for Gemini AI Integration

To use the Gemini AI features:

1. Get a Gemini API key from the [Google AI Studio](https://makersuite.google.com/)
2. Add your API key to the `.env` file:
   ```
   GEMINI_API_KEY=your-api-key-here
   ```

If no API key is provided, the system will use a template-based fallback for report generation.

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```bash
   cd <project-directory>
   ```

3. Install PHP dependencies:
   ```bash
   composer install
   ```

4. Install Node.js dependencies:
   ```bash
   npm install
   ```

5. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

6. Generate an application key:
   ```bash
   php artisan key:generate
   ```

7. Configure your database connection in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=keyevents
   DB_USERNAME=root
   DB_PASSWORD=
   ```

8. Run database migrations:
   ```bash
   php artisan migrate
   ```

9. Link storage for public file access:
   ```bash
   php artisan storage:link
   ```

10. Build frontend assets:
    ```bash
    npm run build
    ```

11. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

- Access the application at `http://localhost:8000` (or the URL specified in your `.env` file)
- Register a new account or log in with existing credentials
- Based on your assigned role (admin, organizer, or student), you'll be directed to the appropriate dashboard
- Admins can manage users, approve events, and access all system features
- Organizers can create events, manage media galleries, and generate reports
- Students can browse events, register for participation, and access their certificates

## System Requirements

- PHP >= 8.1
- Laravel 10.x
- MySQL/MariaDB
- Composer
- Node.js & NPM
- Web server (Apache/Nginx)

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.

