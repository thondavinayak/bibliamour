# 📚 BibliAmour - Online Library Management System

**BibliAmour** is a responsive and secure web-based library management system developed as part of the *Web Centric Development* coursework at **ESIGELEC, Rouen**. The project enables users to register, browse, and borrow books online, while administrators can manage users and book inventory through a feature-rich admin dashboard.

## 🌐 Website Features

### 🔓 Public Features
- Multilingual support (French, English, Hindi, German) via Google Translate
- Welcome page with background video and introduction
- Carousel of new or featured books
- User registration and login
- Profile management
- Browse available books and view details

### 👤 User Features
- View and borrow available books
- Dashboard to view borrowed books
- Profile with uploaded photo and personal information
- Session-based notifications and feedback

### 🛠️ Admin Features
- Manage users (promote to admin, delete users)
- Manage books (edit details, update quantity, delete, add new books)
- Dashboard with statistics (total users/books, low-stock, top borrower)
- View all borrowing activity across users

## 📁 Project Structure
/www
├── css/
├── js/
├── images/
├── index.php
├── header.php
├── menu.php
├── footer.php
├── register.php
├── login.php
├── dashboard.php
├── availablebooks.php
├── profileinfo.php
├── logout.php
├── listbooks.php (admin)
├── listusers.php (admin)
├── addbook.php (admin)
├── db/
├── users.sql
├── books.sql
├── borrowed_books.sql
└── dbwebcentrc.sql




## 🛠️ Setup Instructions

### 1. Install UwAmp
Download and install UwAmp (or XAMPP) for running Apache and MySQL servers locally.

### 2. Configure UwAmp
- Set default ports for Apache and MySQL.
- Start the server.

### 3. Copy Files
Place the project files into the `www` folder inside the UwAmp directory.

### 4. Setup Database
- Go to `http://localhost/phpmyadmin`.
- Create a database (e.g., `library_management`).
- Import `dbwebcentrc.sql` or the individual SQL files:
  - `users.sql`
  - `books.sql`
  - `borrowed_books.sql`

### 5. Run the Website
Open a browser and visit:






