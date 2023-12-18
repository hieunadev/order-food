## System Requirements

Before getting started, make sure your machine has the following requirements:

- [PHP](https://www.php.net/) (latest version)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/)

## Installation

1. **Clone the Repository:**

```
git clone https://github.com/hieunadev/order-food.git
```
2. **Install PHP Packages:**
```
composer install
```
3. **Create the Environment File:**
```
cp .env.example .env
```
5. **Generate Application Key:**
```
php artisan key:generate
```
6. **Run the Application:**
```
php artisan serve
```
Access the application at http://127.0.0.1:8000/

