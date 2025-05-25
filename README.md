Table of Contents
1. Goal of the Project
2. Description of All Files and Steps
3. Welcome part of Website
o Welcome
o New Books
o Registration
o Connection
o About
o Footer
o Menu
4. User Registration
5. Login
o Available Books
o User Dashboard
o View Profile
o Disconnect
6. Books Section of the Website
o Book Borrowing
o Book Details
7. Admin Section of the Website
o Manage Users
o Manage Books
o Add Books
o Admin Dashboard
8. Security
o Validator Output
o SQL Injection Attacks1. Goal of the Project
The main goal of this project is to develop a responsive and secure online library management system. The
system provides a user-friendly platform where users can register, log in, browse, and borrow books, while
administrators can manage books and users. Additionally, this report includes a user manual to guide both users and
administrators on how to use the website effectively.
2. Description of All Files and Steps
2.1 UwAmp Setup
1. Download and install the UwAmp server from the official website.
2. Launch UwAmp and configure it to use the default ports for Apache and MySQL.
2.2 Copy Project into the www Folder
1. Place all project files in the www folder of the UwAmp installation directory.
2. Ensure the file structure is organized with folders for CSS, JavaScript, and images.
2.3 Login to phpMyAdmin
1. Open UwAmp and start the server.
2. Access phpMyAdmin via http://localhost/phpmyadmin.
2.4 Import Database
1. Create a new database, e.g., library_management.
2. Import the following SQL files:
o users.sql: Table for user information.
o books.sql: Table for storing book details.
o borrowed_books.sql: Table for tracking borrowed books.
Alternatively, import all these together using dbwebcentrc.sql.
2.5 Launch the Website
1. Open a browser and navigate to http://localhost/[project_folder].
2. The home page of the library system will load.3. Welcome part of Website
The Website is completely written in French and has options to translate into 3 other languages. Upon opening
the website we have a welcome page and option to check “Nouvea Livres” which has a carousel to display the
latest 3 books.
3.1 Welcome
Key Features and Functionality
1. Session Management for Notifications
o The session_start() function ensures that session data is accessible. This is crucial for displaying
messages sent from other pages, such as successful login or registration notifications.
o If a message exists in the session ($_SESSION['message']), it is displayed in a Bootstrap alert box, making
it visually appealing and user-friendly.
o After the message is displayed, it is removed using unset($_SESSION['message']); to avoid repeated
notifications.
2. Background Video Integration
o The <video> tag introduces a looping background video that plays silently.
o This enhances the aesthetic appeal of the welcome page, providing a modern and dynamic user
experience.
3. Header and Menu Integration
o The header.php and menu.php files are included at the top of the page to provide consistent branding,
navigation menus, and styling across the entire website.
4. Main Content: Welcome Message
o The main content introduces the BibliAmour project with a warm and engaging welcome message.
o It highlights the following:
 The project was developed by students at ESIGELEC Rouen as part of a course in Web-Centric
Development. The name "BibliAmour" reflects the developers' passion for books.
5. Site Functionality Overview
o A bulleted list clearly explains the website's core features:
 Registration and Login: Users can create accounts and log in easily.
 Viewing Books: A catalog of library books is accessible.
 Borrowing Books: Registered users can borrow books from the library.
 Book Management: Administrators can add or remove books.
6. Footer Inclusion
o The footer.php file is included at the end of the page to provide a consistent footer across all pages.
7. Translation Plugin
o We have integrated Google Translate plugin with support for translating the website into 3 languages –
English, German and Hindi
3.2 New Books:
• A dynamic carousel highlights the latest or most popular books in the library.
• Built using Bootstrap, the carousel automatically transitions between slides to grab users' attention.
1. Database Query
• The script starts by including the conn.php file, which establishes a connection to the database using the
username as root and password as root.
• A SQL query is executed to retrieve the first 3 books from the books table where the available_copies is greater
than 0, ensuring that only books that are currently available for borrowing are listed.
• The query selects the book ID, title, description, and photo fields.• This query is executed using a prepared statement to avoid SQL injection risks. The result is fetched and stored
in the $books variable as an associative array.
2. Page Setup
• The page title is set to "Available Books List" using the $title variable.
• The script includes the header.php and menu.php files, which likely contain the top navigation and header
elements for the webpage.
3. Displaying Books
• The script creates a container to hold the content and applies some Bootstrap classes to center and style the
page.
• A title "Featured Books" is displayed at the top.
• The books are displayed in a Bootstrap grid layout, with 3 columns per row (col-md-4). Each book is displayed
as a card element.3.3 Registration
This PHP script handles the user registration process for a website. It includes an HTML form that collects user details,
such as their name, email, password, and photo. The script also displays any messages passed from other pages (e.g.,
validation errors or success messages).
1. Session Management and Header
• Session Start: The session_start() function is called at the beginning to manage session variables. This allows
passing messages (e.g., success or error messages) between pages.
• Page Title: The page title is set to "Registration".
• Including Header and Menu: The header.php and menu.php files are included, which likely contain the common
navigation and layout elements for the website.
2. Displaying Messages
• The script checks if a session message ($_SESSION['message']) is set. If a message is present, it:
o Displays the message in an alert box (using Bootstrap classes for styling).
o Once the message is displayed, it is removed from the session using unset($_SESSION['message']) to
ensure it doesn’t persist on page refresh.
3. Registration Form
The registration form collects essential user information and is submitted to handle_registration2.php for further
processing. The form includes:
• Name: A text input field (name) where the user can enter their name.
• Photo: A file input (photo) for uploading a profile picture. A note is included to specify that the photo should be
less than 400 KB in size and be in .jpeg, .jpg, .png, or .gif format.
• Email: An email input (email) where the user must provide an email address. A note specifies that only gmail,
outlook, and yahoo email addresses are allowed.
• Password: A password input (password) where the user enters their password. The input is hidden (for privacy)
as it is of type password.
Each of these form fields is labeled appropriately and marked as required.
4. Submit Button
• A Submit Button is provided to submit the form.
o It uses a Bootstrap class (btn btn-outline-primary) to style the button.
o The button text is "Register", indicating that the user will be registering their details.3.4 Connection
This PHP script handles the login functionality for the users, allowing them to access their accounts by providing their
email and password. Here's a breakdown of how the code functions:
1. Session Handling
The script first checks if a session is already active using session_status() and starts one if it is not already initiated. This
ensures that session variables can be used to store messages and handle login states throughout the user’s session.
2. Including External Files
• The script includes two external files: header.php and menu.php. These files are responsible for rendering the
website’s header and menu, respectively, on the login page.
• These files help maintain consistency in the layout across different pages of the website.
3. Displaying Feedback Messages
The script checks if any feedback message is set in the session (using $_SESSION['message']).
• If a message exists, it is displayed in a Bootstrap alert box, informing the user about certain actions (e.g., failed
login attempt, incorrect credentials, etc.).
• After displaying the message, the session variable is unset (unset($_SESSION['message'])) to prevent it from
being shown again on page reload.
4. Login Form
The core of this page is the login form which asks the user to input their email address and password. The form has:
• Email Input: A field for the user’s email, which is validated to ensure it follows the correct email format (using
the type="email" attribute).
• Password Input: A field for the user’s password.
• Both fields have validation messages (invalid-feedback) which will be shown if the form fields are not correctly
filled out.
5. Form Submission
The form uses the POST method to send the user’s data (email and password) to the script handle_login.php for
further processing. This script will handle the authentication and session management (not shown in this code
snippet).3.5 About
This PHP script is for the "About Us" page of a website, showcasing the members of the team along with their names,
profiles, and LinkedIn links.
3.6 Menu
This PHP script creates a responsive navigation bar for the website BibliAmour with dynamic content based on the
user's login status and role (admin or regular user). Here's a breakdown of the functionality:
1. Navigation Bar Structure (HTML)
• Branding: Displays the logo or name of the website as "BibliAmour" on the left side.
• Toggle Button: A button (navbar-toggler) is included to collapse the navigation links on smaller screens,
providing a mobile-friendly experience.
• Navbar Links:
o Links are displayed differently based on the user's login status and role:
 For Logged-In Users:
 If the user is admin ($_SESSION['adminlogin']), they have access to management links
like "Manage Users," "Manage Books," and "Add Book."
 Regular users have access to links like "Available Books," "Dashboard," and "Profile."
 For Logged-Out Users:
 Links to "Home," "New Books," "Registration," and "Login" are shown.
• Active Link Highlighting: The script uses PHP to dynamically add the active class to the link of the current page,
based on the current page filename ($currentPage).
• Language Switcher: A Google Translate widget is included for page language translation, allowing users to
switch between multiple languages (English, French, Hindi, and German).
2. PHP Dynamic Content
• Session Check: The script checks if a user is logged in by verifying the $_SESSION['logged_in'] session variable.
o If the user is logged in, the appropriate links are shown depending on whether they are an admin or a
regular user.
o If the user is not logged in, it displays links for registration, login, and about.• Role-Based Navigation:
o Admin users (role = 0) get access to additional management options such as:
 Managing users (listusers.php)
 Managing books (listbooks.php)
 Adding books (addbook.php)
o Regular users (role = 1) see links to available books (availablebooks.php) and personal profile
(profileinfo.php).
3. Google Translate Integration
• The script includes a Google Translate element (#google_translate_element) in the navbar.
• This allows users to change the page language dynamically (from French to English, Hindi, or German) using a
dropdown menu provided by the Google Translate API.
• The language selector is styled to blend with the navbar (background-color: #343a40;).
4. Mobile-Responsive Design
• The navbar adapts to different screen sizes using Bootstrap's grid system.
• On smaller screens, the navigation items are collapsed into a hamburger menu, which can be toggled by
clicking the button.
5. JavaScript (Google Translate)
• The Google Translate widget is initialized using the googleTranslateElementInit() function.
• The includedLanguages parameter specifies which languages the page should be translated into (English,
French, Hindi, German).
4. User Registration
This PHP script handles the registration process for new users. It performs validation, checks for duplicate entries,
processes file uploads, securely hashes the password, and inserts user data into the database. Below is a detailed
explanation of its functionality:
5. User Login
• Users log in using their email and password.
• Secure session creation upon successful login:5.1 Available Books
This PHP script handles the display and borrowing of books for users on a library management system. It allows users
to view available books, borrow a selected book, and dynamically update the database to reflect changes in book
availability. Below is a breakdown of its functionality:
5.2 User Dashboard
This PHP script displays a dashboard for the logged-in user, showing a list of books they have borrowed. The page
retrieves data from the database and presents it in a structured, tabular format. Below is a detailed explanation of its
components and functionality:
5.3 Your AccountThis PHP script is designed to display the user's profile information in a secure and structured manner. It retrieves
details about the logged-in user from the session and presents them on a profile page. Below is a detailed breakdown
of its functionality:
5.4 Profile Logout
This PHP script handles the user logout process for the website. It securely destroys the user's session and provides a
confirmation message, ensuring that the user knows they have successfully logged out. Below is a detailed explanation
of its functionality:6. Books Section of the Website
6.1 Book Borrowing
Borrowing Process:
• When a user clicks the "Borrow Livre" button, the form submits the book_id via a POST request.
• The script retrieves the user's ID from the session ($_SESSION['user']) and checks if the selected book has
available copies in the database.
• If the book is available:
o A record is added to the borrowed_books table, linking the user and the book.
o The available_copies of the book in the books table is decremented by 1.
o A success message is stored in the session.
6.2 Book Details
This PHP script retrieves and displays details of a specific book based on its ID passed via the URL. It checks the
book's availability and allows logged-in users to borrow it by submitting a form. Upon borrowing, the script updates
the database to reduce the book's available copies and records the borrowing in a borrowed_books table. Success or
failure messages are displayed using session-based alerts7. Admin Section of the Website
7.1 Manage Users
This PHP script manages a user administration page accessible only to admin users (role = 0). It retrieves all users from
the database and displays them in a table with their details, including name, email, photo, and role. Admins can
perform two main actions:
1. Promote to Admin: For regular users (role = 1), a "Make Admin" button allows admins to update the user role
to 0 (admin) in the database.
2. Remove User: The "Remove User" button deletes a user from the database after confirmation.
Both actions use form submissions via POST, and the page refreshes to reflect the changes. User photos are displayed,
with default images shown for missing files, and an interactive modal allows for larger image previews. The layout
includes conditional rendering of buttons based on user roles, ensuring only valid actions are available for each user.
7.2 Manage BooksThis PHP script is a book management page for admin users (role = 0). It displays a list of books retrieved from the
database, including their titles, descriptions, photos, and available copies. Admins can perform several actions through
form submissions:
1. Remove Book: Deletes a book from the database.
2. Update Quantity: Modifies the number of available copies for a book.
3. Update Title: Changes the title of a book.
4. Update Description: Edits the description of a book.
5. Update Photo: Uploads a new image for a book.
The page includes a user-friendly interface with modals for viewing enlarged book photos and inline forms for
updating information. Each action is processed via secure POST requests and updates the database accordingly. After
any modification, the page refreshes to reflect the changes.
7.3 Add a Book
This PHP script provides a user interface for adding new books to a library system. It includes a form that allows
authorized users to input details such as the book's title, description, number of available copies, and an image file.
The uploaded image is required to meet specified constraints (size below 400 KB and formats like .jpeg, .jpg, .png, or
.gif). The form data is submitted via POST to a separate handler script, handle_addbook.php, for processing.
Additionally, if any session message exists (e.g., success or error notification from the handler script), it is displayed at
the top as an alert. The layout is user-friendly, responsive, and ensures that all fields are required for a valid
submission.7.4 Admin Dashboard
Borrowed Books
The script provides functionality for administrators to view all users and the books they have borrowed,
displayed in a tabular format. Administrators can see each user's ID, name, and the list of books they have borrowed,
grouped together. Regular users have a personalized view where they can see only the books they have borrowed,
along with their IDs and titles. If no books are borrowed, users are encouraged to borrow one. This system ensures
efficient management and tracking of book borrowing activities.
Statistics
Administrators can access a statistics section displaying key metrics, such as the total number of users and
books, books with fewer than two copies, and books with zero available copies. Additionally, the system identifies the
user who has borrowed the most books, along with the count. These insights help administrators monitor inventory
and borrowing trends, ensuring effective library management.
8. Security
All the pages of the website have been validated and errors are resolved. The login and user requests are
protected against SQL Injection attacks
