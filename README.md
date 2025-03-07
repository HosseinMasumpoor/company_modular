# Corporate Website Project

This project is a modular corporate website developed using Laravel version 11. The modularity of the project is achieved with the help of the `nwidart/laravel-modules` package. Below are some of the key features and modules of the project.

## Features

- **Design Patterns**: Utilizes various design patterns such as Observer, Service, and Repository.
- **Caching**: Implements Redis caching for improved performance.
- **Modular Development**: The project follows a modular architecture, making it easier to maintain and extend.
- **Multi-language support**: Supports multiple languages.
- **Role-Based Access Control**: Includes different access levels for administrators.
- **Dockerized**: The project is Dockerized, ensuring easy setup and consistent environments across different systems.
## API Development

The project is developed as an API, ensuring flexibility and scalability for future integrations.

## Modules

The project includes the following modules:

1. **Admin**: Manages administrative tasks and user roles.
2. **Articles**: Handles blog posts and news articles.
3. **Projects**: Manages company projects and portfolios.
4. **Services**: Details the services offered by the company.
5. **Partners**: Manages partnerships and collaborations.
6. **Customer Experience**: Displays customer feedback and testimonials.
7. **Categories**: Organizes content into various categories.
8. **Slider**: Manages the homepage and other sliders.
9. **FAQ**: Handles frequently asked questions.
10. **Customers**: Manages customer information and interactions.

## Installation

You can set up the project either **with Docker** or **without Docker**. Follow the instructions below based on your preference.

### Option 1: Without Docker


1. Clone the repository:
   ```bash
   git clone https://github.com/HosseinMasumpoor/company_modular.git

2. Navigate to the project directory:
   ```bash
   cd company_modular
   
3. Install dependencies:
   ```bash
   composer install

4. Set up your environment variables:
   ```bash
   cp .env.example .env

5. Generate an application key:
   ```bash
   php artisan key:generate

6. Run migrations:
   ```bash
   php artisan migrate

7. Seed the database:
   ```bash
   php artisan db:seed

8. Start the development server:
   ```bash
   php artisan serve

### Option 2: With Docker

1. Clone the repository:
   ```bash
   git clone https://github.com/HosseinMasumpoor/company_modular.git

2. Navigate to the project directory:
   ```bash
   cd company_modular

3. Set up your environment variables:
   ```bash
   cp .env.example .env

4. Build and start the Docker containers:
   ```bash
   docker-compose up -d

5. Run migrations and seed the database:
   ```bash
   docker exec -it corporate_app bash
   php artisan migrate
   php artisan db:seed
   exit

6. Access the project at:
   ```bash
   http://localhost:84
