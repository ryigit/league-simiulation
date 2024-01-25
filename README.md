## League Simulator

This is a simple league simulator powered by PHP and Laravel. Functionalities:

- Create Fixtures
- Simulate Games by Week
- Predict Champion Depending on Existing Data

## Installation

1. Create an .env file and provide database connection details in Laravel way.
2. Run migrations with: 
> php artisan serve

3. Run seeder to load tests data:

>php artisan db:seed --class=TeamsSeeder

4. Build assets with

> npm run build

5. Start Local development server:

> php artisan serve

6. Now you yan access app at http://127.0.0.1:8000/
