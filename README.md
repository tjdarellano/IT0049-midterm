# IT0049 Point of Sale System

CodeIgniter 4 POS project for the IT0049 midterm requirements.

## Setup

1. Create a MySQL database named `it0049_pos` in XAMPP phpMyAdmin.
2. Confirm the database values in `.env`.
3. From the project folder run `php spark migrate` and `php spark db:seed PosSeeder`.
4. Ensure `public/uploads/products` and `public/uploads/avatars` are writable.
5. Open `http://localhost/IT0049/midterms/public/`.

Demo login: `admin` / `admin123`.

The application includes authenticated dashboard access, product/customer/staff CRUD, validated image uploads, password hashing, stock-aware sales recording, and sales history.
