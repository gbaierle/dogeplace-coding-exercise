# DogePlace Coding Exercise

DogePlace is a new hotel for dogs that wants to manage Clients, their Dogs and the Bookings.

The exercise consists in:
- Retrieve all Clients and Bookings
- Create and update Clients
- Add possibility to book a new client (considering price, check-in date and check-out date);
- Add possibility to give 10% discount in the booking if the average age of dogs of a client registered is less than 10 years;
- Add possibility to soft delete a client
- Validate client email
- Restrict to unique client emails

The exercise uses a preloaded JSON data in the `database` folder.

## Requirements
- composer
- PHP >= 8.2

### Steps to test the code:

1. Install dependencies
```
composer install
```

2. Run unit tests
```
./vendor/bin/phpunit tests/ClientTest.php
./vendor/bin/phpunit tests/BookingTest.php
```

### Rest API

- Run PHP server

```shell
php -S 127.0.0.1:6666
```

Available enpoints:

```
GET     /dogs       -- List all dogs
GET     /clients    -- List clients
POST    /client     -- Create client
PUT     /client     -- Update Client
DELETE  /client/:id -- Delete client
GET     /bookings   -- List bookings
POST    /booking    -- Book client (add booking)
```
