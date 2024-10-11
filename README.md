# COVID Vaccine Registration and Scheduling System

This project is a COVID vaccine registration system developed using Laravel. The system allows users to register for
vaccination at a vaccine center and schedules their vaccination date based on availability. Users can search their
vaccination status using their National ID (NID).

## Features

- User registration for vaccination.
- Selection of vaccine centers during registration.
- Vaccination scheduling based on a "first come, first served" strategy.
- Email notification sent to users the night before their scheduled vaccination date.
- Search functionality to check vaccination status based on NID.
- Statuses: 
  - `Not registered`
  - `Not scheduled` 
  - `Scheduled`
  - `Vaccinated`.
- Pre-populated database with vaccine centers (no CRUD for centers).
- Scheduling only on weekdays (Sunday to Thursday).

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Node.js & npm/yarn
- Laravel 11
- **TNTSearch**

## Installation

1. Clone the repository:

```bash
git clone git@github.com:polashmahmud/covid-vaccine-registration-system.git
```

2. Navigate to the project directory:

```bash
cd covid-vaccine-registration-system
```

3. Install dependencies:

```bash
composer install
```

4. Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Configure the `.env` file with your database details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

7. Configure the mail settings in the `.env` file:

```env
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

8. Run migrations and seed the vaccine centers:

```bash
php artisan migrate --seed
```

9. Install frontend dependencies and compile assets:

```bash
npm install && npm run dev
```

10. Update your `.env` file to use TNTSearch as the Scout driver:

```env
SCOUT_DRIVER=tntsearch
```

11. Add the search indexing command to your setup process:

```bash
php artisan scout:import "App\\Models\\User"
```

12. Run the application:

```bash
php artisan serve
```

Now, the application should be accessible at `http://localhost:8000`.

13. Run the queue worker to send email notifications:

```bash
php artisan queue:work
```

14. To schedule users for vaccination, run the following command:

```bash
php artisan schedule:run
```

## TNTSearch Integration

This project uses **TNTSearch** along with Laravel Scout for the search functionality. The search is optimized for speed
and performance, allowing users to quickly find their vaccination status based on their NID.

Make sure to install and configure TNTSearch by following these steps:

1. Update your `.env` file to use TNTSearch as the Scout driver:

```env
SCOUT_DRIVER=tntsearch
```

2. Add the search indexing command to your setup process:

```bash
php artisan scout:import "App\\Models\\User"
```

## Usage

1. **User Registration:**
    - Navigate to `/register` to register for a vaccination.
    - Select a vaccine center during registration.

2. **Search for Vaccination Status:**
    - Navigate to home page and enter your NID to check the vaccination status.
    - The system will display the status based on the NID.
    - The statuses are `Not registered`, `Not scheduled`, `Scheduled`, and `Vaccinated`.
    - If the user is `Scheduled`, the system will display the scheduled date.
    - If the user is `Vaccinated`, the system will display the vaccination date.
    - If the user is not found, the system will display `Not registered`.
    - NID number should be 17 digits.

## Email Notification

The system sends an email notification at 9 PM the night before the user's scheduled vaccination date. Ensure that your
mail settings are configured correctly in the `.env` file.

## Optimizations

- **Indexing:** Using **TNTSearch** for optimized search functionality. The search is fast and efficient. The search
  index is updated whenever a new user is registered or scheduled.
- **Caching:** Given more time, I would implement caching to centralize the caching logic and reduce the number of database queries.
- **Queuing:** Using Laravel queues for sending email notifications. This ensures that the application remains
  responsive and the user does not have to wait for the email to be sent.
- **Atomic Locks:** Using atomic locks to prevent race conditions when scheduling users for vaccination. This ensures
  that only one user can be scheduled at a time.

## Future Enhancements

If an SMS notification feature is needed in the future, the following changes would be made:

- **Integration:** Integrate with an SMS gateway service such as Twilio or Nexmo.
- **Notification:** Update the notification logic to send both email and SMS by modifying the `NotifyUser` class to
  include SMS functionality.
- **Environment Variables:** Add SMS API credentials in the `.env` file.
- **phone_number:** Add a phone number field to the user registration form.

## Testing

Due to time constraints, I was unable to write tests for this project. In the future, I plan to write unit and feature tests using Pest.

## License

This project is licensed under the MIT License.
