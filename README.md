# Notezilla - Simple Note Taking Application

A clean, simple note-taking web application built with Laravel 12, Breeze authentication, and PostgreSQL. Create, edit, delete, and manage your notes with ease.

## Features

- **User Authentication** - Email/password registration and login with Laravel Breeze
- **Note Management** - Create, read, update, and delete your notes
- **Security** - Authorization policies ensure users can only access their own notes
- **Clean UI** - Built with Tailwind CSS for a modern, responsive design
- **Database** - PostgreSQL for reliable data storage
- **Tests** - Comprehensive feature and unit tests using PHPUnit/Pest

## Tech Stack

- **Framework**: Laravel 12
- **Database**: PostgreSQL 13+
- **Authentication**: Laravel Breeze
- **CSS**: Tailwind CSS
- **Testing**: Pest/PHPUnit
- **Deployment**: Laravel Cloud compatible

## Prerequisites

- PHP 8.2+
- Composer
- Node.js & npm
- PostgreSQL 13+ (or Podman for local development)
- Git

## Local Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd notes-app
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment File

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure PostgreSQL Database

#### Option A: Using Podman (Recommended for development)

Start a PostgreSQL container:

```bash
# Start or create a fresh PostgreSQL container
podman run -d --name postgres -e POSTGRES_PASSWORD=postgres -p 5432:5432 docker.io/library/postgres:latest

# Wait for the container to be ready
sleep 5

# Create the application database and user
podman exec -e PGPASSWORD=postgres postgres psql -U postgres -c "CREATE USER notezilla_user WITH PASSWORD 'notezilla_password';"
podman exec -e PGPASSWORD=postgres postgres psql -U postgres -c "CREATE DATABASE notezilla OWNER notezilla_user;"
podman exec -e PGPASSWORD=postgres postgres psql -U postgres -c "CREATE DATABASE notezilla_test OWNER notezilla_user;"
```

Update your `.env` file:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=notezilla
DB_USERNAME=notezilla_user
DB_PASSWORD=notezilla_password
```

#### Option B: Using System PostgreSQL

If you have PostgreSQL installed locally, create the databases:

```bash
createuser notezilla_user
createdb -O notezilla_user notezilla
createdb -O notezilla_user notezilla_test

# Set the password for notezilla_user
psql -U notezilla_user -d notezilla -c "ALTER USER notezilla_user WITH PASSWORD 'notezilla_password';"
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Build Assets

```bash
npm run build
```

For development with live reload:

```bash
npm run dev
```

### 7. Start the Application

In another terminal:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Running Tests

### All Tests

```bash
php artisan test
```

### Feature Tests Only

```bash
php artisan test tests/Feature
```

### Unit Tests Only

```bash
php artisan test tests/Unit
```

### Specific Test File

```bash
php artisan test tests/Feature/NoteTest.php
```

### Tests run against the `notezilla_test` database automatically (configured in `phpunit.xml`)

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── NoteController.php      # Note CRUD operations
│       └── ProfileController.php   # User profile management
├── Models/
│   ├── Note.php                    # Note model with relationships
│   └── User.php                    # User model
└── Policies/
    └── NotePolicy.php              # Authorization policies for notes

resources/
├── css/
│   └── app.css                     # Tailwind styles
├── js/
│   └── app.js                      # JavaScript entry point
└── views/
    ├── notes/                      # Note CRUD views
    ├── auth/                       # Authentication views
    └── layouts/                    # Layout components

routes/
├── web.php                         # Main web routes
└── auth.php                        # Authentication routes

database/
├── migrations/                     # Database migrations
└── factories/                      # Model factories for testing

tests/
├── Feature/
│   ├── NoteTest.php               # Note CRUD tests
│   └── Auth/                      # Authentication tests
└── Unit/
    ├── NoteTest.php               # Note model tests
    └── UserTest.php               # User model tests
```

## API Routes

### Public Routes
- `GET /` - Landing page

### Authentication Routes
- `POST /register` - Register new user
- `POST /login` - Login user
- `POST /logout` - Logout user
- `GET /forgot-password` - Password reset page
- `POST /forgot-password` - Request password reset
- `GET /reset-password/{token}` - Password reset form
- `POST /reset-password` - Update password

### Protected Routes (Require Authentication)
- `GET /notes` - List all user's notes
- `GET /notes/create` - Show create note form
- `POST /notes` - Store a new note
- `GET /notes/{note}` - View a single note
- `GET /notes/{note}/edit` - Show edit note form
- `PUT /notes/{note}` - Update a note
- `DELETE /notes/{note}` - Delete a note

## Authorization

Users can only view, edit, and delete their own notes. The `NotePolicy` class enforces these permissions:

```php
// Only the note owner can perform these actions
$this->authorize('view', $note);
$this->authorize('update', $note);
$this->authorize('delete', $note);
```

## Deployment on Laravel Cloud

### Prerequisites
- Laravel Cloud account
- GitHub repository with this code

### Setup Steps

1. **Connect GitHub Repository**
   - Log in to Laravel Cloud
   - Connect your GitHub account
   - Select this repository

2. **Configure Environment Variables**
   - Set all variables from `.env.example`
   - Ensure `APP_ENV=production` and `APP_DEBUG=false`
   - Set secure `APP_KEY` (generate with `php artisan key:generate`)

3. **Database Setup**
   - Laravel Cloud provides PostgreSQL by default
   - Run migrations automatically after deployment
   - Database credentials are provided via environment variables

4. **Deploy**
   - Push to main branch or manually trigger deployment
   - Laravel Cloud will:
     - Install dependencies (`composer install`)
     - Build assets (`npm run build`)
     - Run migrations (`php artisan migrate --force`)
     - Cache configuration

### Environment Variables for Production

```env
APP_NAME=Notezilla
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
DB_CONNECTION=pgsql
DB_HOST=<provided-by-laravel-cloud>
DB_PORT=5432
DB_DATABASE=<provided-by-laravel-cloud>
DB_USERNAME=<provided-by-laravel-cloud>
DB_PASSWORD=<provided-by-laravel-cloud>
SESSION_ENCRYPT=true
MAIL_MAILER=smtp
MAIL_HOST=<smtp-service>
MAIL_PORT=587
MAIL_USERNAME=<your-email>
MAIL_PASSWORD=<your-password>
MAIL_FROM_ADDRESS=noreply@notezilla.example.com
```

## Database Migrations

Migrations are automatically run during deployment. To run manually:

```bash
# Run pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Refresh all migrations (resets database)
php artisan migrate:refresh
```

## Security Considerations

- Passwords are hashed using bcrypt (configurable rounds in `.env`)
- CSRF protection on all POST/PUT/DELETE requests
- Session encryption in production (`SESSION_ENCRYPT=true`)
- User notes are private and enforced via authorization policies
- SQL injection protection via Eloquent ORM and parameterized queries

## Troubleshooting

### Database Connection Errors
- Ensure PostgreSQL is running: `podman ps | grep postgres`
- Check `.env` database credentials match your setup
- Verify the database exists: `podman exec postgres psql -U postgres -l`

### Tests Failing
- Ensure test database exists: `notezilla_test`
- Clear test database: `php artisan migrate:refresh --env=testing`
- Check phpunit.xml has correct test database config

### Assets Not Loading
- Rebuild: `npm run build`
- In development: `npm run dev` for hot reload

## License

MIT License - see LICENSE file for details

## Support

For issues and questions, please create a GitHub issue in this repository.

