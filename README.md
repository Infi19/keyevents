# Keystone School of Engineering Events Management System

A web-based event management system designed for Keystone School of Engineering to manage and showcase school events. Built with Laravel and styled with Tailwind CSS.

## Features

### Event Management
- **Event Creation**
  - Title and detailed description
  - Date and time selection (with AM/PM format)
  - Image upload with preview
  - Event type categorization
  - Event category selection

### User Management
- **Role-based Access Control**
  - Admin: Create, edit, and manage events
  - Students: View events and event details
  - Authentication system for secure access

### Event Display
- **Homepage Features**
  - Featured upcoming event showcase
  - Responsive event grid layout
  - Event filtering capabilities
  - Event search functionality

### Notification System
- **Automated Email Notifications**
  - New event notifications to registered users
  - Event details included in notifications
  - Queue system for efficient email delivery

## Technical Requirements

- PHP >= 8.1
- Laravel 10.x
- MySQL/MariaDB
- Composer
- Node.js & NPM
- Web server (Apache/Nginx)

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
7. Run database migrations:
   ```bash
   php artisan migrate
   ```
8. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000` (or the URL specified in your `.env` file).
- Log in as an admin to create and manage events.
- Students can view events and subscribe to notifications.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Contact

For any inquiries or support, please contact [your-email@example.com].
