# 🔒 Simple Auth System

This is a simple authentication system built using Laravel without using external libraries. It includes **user registration**, **login**, and **logout** functionalities, along with form validation and error handling.

## 🌟 Features

- **User Registration**: Register with a username, email, and password. 📝
- **User Login**: Login with credentials to access protected routes. 🔑
- **User Logout**: Securely end user sessions. 🚪
- **Form Validation**: Ensure proper input during registration and login. ✅
- **Error Handling**: Display user-friendly error messages for invalid inputs. ⚠️
- **Protected Routes**: Restrict access to certain routes for logged-in users only. 🔐

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

- **Login Validation**:
  ```php
  $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:8',
  ]);
  ```

- **User Authentication**:
  ```php
  if (Auth::attempt($credentials)) {
      return redirect()->route('dashboard');
  }
  ```

## 🗂️ Project Structure

```
📦 laravel-auth-system
 ┣ 📂 app/Http/Controllers/Auth
 ┃ ┗ 📄 LoginController.php  # Handles login
 ┃ ┗ 📄 LogoutController.php  # Handles logout
 ┃ ┗ 📄 RegisterController.php  # Handles registration
 ┣ 📂 resources/views/auth
 ┃ ┣ 📄 login.blade.php     # Login form
 ┃ ┗ 📄 register.blade.php  # Registration form
 ┣ 📂 resources/views
 ┃ ┗ 📄 dashboard.blade.php # Dashboard accessible after login
 ┣ 📂 database/migrations
 ┃ ┗ 📄 create_users_table.php  # Migration for user registration
 ┗ 📄 routes/web.php  # Defines routes for authentication
```

## 📚 Routes and API Endpoints

| Method | URI                   | Description                              | Middleware    |
|--------|-----------------------|------------------------------------------|---------------|
| GET    | /login                | Display the login form                   | None          |
| GET    | /register             | Display the register form                | None          |
| POST   | /login                | Perform the login logic                  | None          |
| POST   | /register             | Perform the register logic               | None          |
|        |                       |                                          |               |
| POST   | /logout               | Perform the logout logic                 | `auth`        |
| GET    | /dashbaord            | Show user's dashboard                    | `auth`        |


## 👨‍💻 Development Tools

- **Laravel 11**: The PHP framework used to build the application.
- **SQLite**: The database for storing tasks.
- **Bootstrap 5**: For frontend styling.

## 📜 License

This project is open-source and available under the MIT License.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
