# Laravel Blog

Laravel Blog is a website that offers comprehensive features for blog content management, including CRUD for blogs, users, and categories. Powered by Laravel, Laravel Breeze, and Filament, this site provides a user-friendly interface for creating, reading, editing, and deleting blog articles, as well as efficiently managing users and categories. The blog page is designed to showcase content attractively, making it easy for visitors to find and read relevant articles.

## Tech Stack

- **Laravel 10**
- **MySQL Database**
- **Laravel Breeze**
- **Filament 2**

## Features

- Main features available in this application:
  - Login & Register
  - CRUD Posts
  - CRUD Categories
  - CRUD Users
  - CRUD Text Widget
  - Search Blog

## Installation

Follow the steps below to clone and run the project in your local environment:

1. Clone repository:

    ```bash
    git clone https://github.com/Akbarwp/Laravel-Filament-Blog.git
    ```

2. Install dependencies use Composer and NPM:

    ```bash
    composer install
    npm install
    ```

3. Copy file `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Setup database in the `.env` file:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_blog
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Run migration database:

    ```bash
    php artisan migrate
    ```

7. Run seeder database:

    ```bash
    php artisan db:seed
    ```

8. Run website:

    ```bash
    npm run dev
    php artisan serve
    ```

## Screenshot

- ### **Homepage**

<img src="https://github.com/user-attachments/assets/5d5fc99f-fd33-4882-a614-0a2c5bb2a842" alt="Halaman Blog" width="" />
&nbsp;&nbsp;&nbsp;
<img src="https://github.com/user-attachments/assets/385a6ab3-72df-44a4-a597-972fc27583f1" alt="Halaman Detail Blog" width="" />
<br><br>

- ### **Category page**

<img src="https://github.com/user-attachments/assets/24cabd9d-e350-40f5-b007-2320d313a573" alt="Halaman Kategori" width="" />
&nbsp;&nbsp;&nbsp;
<img src="https://github.com/user-attachments/assets/5ed25365-1f6e-4d1c-af90-03fa14b22140" alt="Halaman Tambah Kategori" width="" />
<br><br>

- ### **Post page**

<img src="https://github.com/user-attachments/assets/28924d44-5216-41ed-a429-e84f035387d2" alt="Halaman Post" width="" />
&nbsp;&nbsp;&nbsp;
<img src="https://github.com/user-attachments/assets/f285f261-672c-4bc7-b0df-00b524935a9d" alt="Halaman Tambah Post" width="" />
<br><br>

- ### **Widget page**

<img src="https://github.com/user-attachments/assets/7ca9db9f-fc2c-49d2-be5a-f07bc926aab0" alt="Halaman Widget" width="" />
<br><br>

- ### **User page**

<img src="https://github.com/user-attachments/assets/b46a80de-9b72-434b-af16-37c263fe8c63" alt="Halaman User" width="" />
<br><br>
