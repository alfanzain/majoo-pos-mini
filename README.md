## Majoo POS Mini

Majoo POS Mini is a simple point-of-sale to display products. This project is built for Majoo appliance test.

## Installation

1. `git clone https://github.com/alfanzain/majoo-pos-mini majoo-pos-mini-test`
2. `composer install`
3. Copy .env.example then rename to .env
4. Change database credentials and create the database
5. `php artisan migrate --seed`
6. `php artisan key:generate`
7. `php artisan serve`
8. Access http://127.0.0.1:8000/login to login into admin page.
9. Access http://127.0.0.1:8000/ to see the homepage.


## Technology

- Laravel v9.11
- MySQL
- Bootstrap v5
- jQuery
- A bit of Tailwind CSS


## Entity Relationship Diagram

![image](https://user-images.githubusercontent.com/4216529/170176608-5dbf26db-f813-44c9-94ec-a09bb16f1f67.png)


## Activity Diagram

![image](https://user-images.githubusercontent.com/4216529/170178047-899c8d8a-a70c-4bb0-ac8f-3d4034bfca3f.png)


## Use Case Diagram

![image](https://user-images.githubusercontent.com/4216529/170179376-ae214dde-24b6-4cc5-904d-29f96f2f773b.png)
