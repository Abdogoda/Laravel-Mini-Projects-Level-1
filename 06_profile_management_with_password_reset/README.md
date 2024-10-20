# Profile Management With Password Reset

This project provides essential functionality for managing user profiles, changing passwords, and resetting forgotten passwords. It is designed for beginners who are familiar with Laravel basics and want to deepen their understanding of user authentication and profile management.

## ✨ Features

- **Profile Management**: 
  - Edit user details like name, email, and profile picture.
- **Change Password**: 
  - Allows authenticated users to securely change their password.
- **Reset Password**: 
  - Provides a password reset link via email if a user forgets their password.
- **Email Notifications**: 
  - Automatically sends a secure password reset link to the user's email.
- **Validation**: 
  - Ensures proper validation for profile updates and password changes.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## 👨‍💻 Code Examples

- **Registration Validation**:
  ```php
  $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|confirmed',
  ]);
  ```

- **Send Email**:
  ```php
    Mail::to($request->email)->send(new ResetPasswordMail($token, $email));
  ```

## 🗂️ Project Structure

```
📦 laravel-auth-system
 ┣ 📂 app/Http/Controllers/Auth
 ┃ ┗ 📄 LoginController.php  # Handles login
 ┃ ┗ 📄 LogoutController.php  # Handles logout
 ┃ ┗ 📄 RegisterController.php  # Handles registration
 ┃ ┗ 📄 PasswordResetController.php  # Handles reseting password
 ┃ ┗ 📄 PasswordForgotController.php  # Handles forgoting password
 ┃ ┗ 📄 ProfileController.php  # Handles profile editing
 ┣ 📂 resources/views
 ┃ ┗📂 auth
 ┃ ┃ ┣ 📄 login.blade.php     # Login form
 ┃ ┃ ┣ 📄 register.blade.php  # Registration form
 ┃ ┃ ┣ 📄 password-forgot.blade.php     # Password forgot form
 ┃ ┃ ┗ 📄 password-reset.blade.php      # Password reset form
 ┃ ┗ 📄 profile.blade.php   # Profile accessible after login
 ┣ 📂 database/migrations
 ┃ ┗ 📄 create_users_table.php  # Migration for user registration
 ┗ 📄 routes/web.php  # Defines routes for authentication
```

## 📚 Routes and API Endpoints

| Method | URI                        | Description                              | Middleware |
|--------|----------------------------|------------------------------------------|------------|
| GET    | /login                     | Display the login form                   |    None    |
| GET    | /register                  | Display the register form                |    None    |
| POST   | /login                     | Perform the login logic                  |    None    |
| POST   | /register                  | Perform the register logic               |    None    |
| GET    | /forgot-password           | Display the forgot password form         |    None    |
| POST   | /forgot-password           | Perform the forgot password logic        |    None    |
| GET    | /reset-password/{token}    | Display the reset password form          |    None    |
| POST   | /reset-password            | Perform the reset password logic         |    None    |
|        |                            |                                          |            |
| POST   | /logout                    | Perform the logout logic                 |    `auth`  |
| GET    | /profile                   | Show user's profile                      |    `auth`  |
| POST   | /profile                   | Edit user's profile information          |    `auth`  |
| POST   | /profile/password-change   | Change the user's password               |    `auth`  |



## 👨‍💻 Development Tools

- **Laravel 11**: The PHP framework used to build the application.
- **SQLite**: The database for storing tasks.
- **Bootstrap 5**: For frontend styling.
- **Mailtrap**: Tool for testing email sending functionality during development.

## 📜 License

This project is open-source and available under the MIT License.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].