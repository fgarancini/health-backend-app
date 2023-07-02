# Laravel Priaid API Integration

This Laravel project integrates with the Priaid API to provide symptom and diagnosis data for users. It includes user registration, login, and logout functionality using Laravel Sanctum for API authentication.

## Features

-   User registration and authentication using Laravel Sanctum.
-   Integration with the Priaid API to fetch symptom and diagnosis data.
-   Ability to switch between the Priaid API sandbox and live API.
-   Saving and viewing user diagnosis history.

## Prerequisites

-   Docker and Docker Compose
-   PHP
-   Composer

## Installation

1. Clone the repository:

`git clone https://github.com/fgarancini/health-backend-app`

2. Navigate to the project directory:

`cd health-backend-app`

3. Start the Docker containers:

`./vendor/bin/sail up`

4. Run database migrations:

`./vendor/bin/sail artisan migrate`

## Usage

1. Access the project from your web browser at [http://0.0.0.0:80](http://0.0.0.0:80).

2. Register a new user account or log in with existing credentials.

3. Explore the different features of the application, including fetching symptoms and diagnoses from the Priaid API and saving user diagnosis history.

## Configuration

The project includes a `.env` file where you can configure various settings:

-   `API_MEDIC_AUTH_URI`: The URL for the Priaid API Auth (sandbox or live).
-   `API_MEDIC_HEALTH_SERVICE_URI`: The URL for the Priaid API Data (sandbox or live).
-   `API_MEDIC_KEY`: Your Priaid API key.
-   `API_MEDIC_SECRET` : Your Priaid API Secret
-   Other Laravel-specific configuration options.
