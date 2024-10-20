# 🚀 Multi Auth System with File Upload

This project implements a multi-authentication system in Laravel, allowing both teacher and user access with different functionalities. 

## 📝 Features

- **Multi Authentication**: teachers and users login, register, and logout.
- **File Upload**: Upload Profile images when register.
- **Middleware**: Define a middleware for teacher role.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## File Upload 🔗

    ```php
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('images', 'public');
    }
    ```

## 🗂️ Project Structure

```
📦 laravel-multi-auth
 ┣ 📂 app/Http/Controllers
 ┃ ┣ 📄 ProfileController.php        # Manages user and teacher profile
 ┃ ┣ 📂 Auth
 ┃ ┃ ┣ 📄 LoginController.php   # Handles teacher and user login
 ┃ ┃ ┣ 📄 RegisterController.php  # Handles teacher and user register
 ┃ ┃ ┗ 📄 LogoutController.php  # Handles teacher and user logout
 ┣ 📂 resources/views
 ┃ ┣ 📂 auth
 ┃ ┃ ┗📄 login.blade.php        # teacher and user login form
 ┃ ┃ ┗📄 register.blade.php      # teacher and user register form
 ┃ ┗ 📄 profile.blade.php        # User and teacher profile view
 ┣ 📂 database/migrations
 ┃ ┣ 📄 create_users_table.php      # Migration for users
 ┗ 📄 routes/web.php                # Defines routes for user and teacher authentication
```

## 📋 Routes Table

| Method | URI                     | Action                          |
|--------|-------------------------|---------------------------------|
| GET    | login                   |                                 |
| POST   | login                   | LoginController                 |
| GET    | register                |                                 |
| POST   | register                | RegisterController              |
| POST   | logout                  | LoguotController                |
| GET    | profile                 | ProfileController               |

## 👨‍💻 Development Tools

- **Laravel 11**: The PHP framework used to build the application.
- **SQLite**: The database for storing tasks.
- **Bootstrap 5**: For frontend styling.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
