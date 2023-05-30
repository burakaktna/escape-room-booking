# Laravel Escape Room Booking System

This is a RESTful API for an escape room booking system built with Laravel. Users can view available escape rooms, book a time slot, and manage their bookings. If the booking is made on the user's birthday, a 10% discount is automatically applied.

## Installation

1. Clone the repository:
```bash
git clone https://github.com/burakaktna/escape-room-booking.git
```

2. Change to the project directory:
```bash
cd escape-room-booking
```

3. Build and run the Docker containers:
```bash
docker-compose up -d --build
```

4. Enter the app container:
```bash
docker-compose exec app bash
```
5. Run the database migrations and seed the database:
```bash
php artisan migrate:fresh --seed
```

## Running Tests

To run all the tests, use:
```bash
composer test
```


## API Endpoints

- Register a new user: `POST /register`
```json
{
  "name": "Your Name",
  "email": "your-email@gmail.com",
  "date_of_birth": "MM/DD/YYYY",
  "password": "your-password",
  "password_confirmation": "your-password"
}
```

- Login: POST /login
```json
{
  "email": "your-email@gmail.com",
  "password": "your-password"
}
```
- Get the authenticated user: GET /user
- List all escape rooms: GET /escape-rooms
- Retrieve a specific escape room by its ID: GET /escape-rooms/{escapeRoom}
- List available time slots for a specific escape room: GET /escape-rooms/{escapeRoom}/time-slots
- Create a new booking for a specific escape room and time slot: POST /bookings
```json
{
  "escape_room_id": 1,
  "time_slot_id": 1,
  "participant_count": 1
}
```
- List all bookings for the authenticated user: GET /bookings
- Cancel a specific booking by its ID: DELETE /bookings/{booking}

## License

This project is open-sourced software licensed under the MIT license.

## Author

Muhammed Burak AKTUNA

Email: burak.aktna@gmail.com
