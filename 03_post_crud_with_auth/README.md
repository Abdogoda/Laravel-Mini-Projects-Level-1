# Post CRUD with Auth 📝🔒

A Laravel project demonstrating a simple **CRUD** (Create, Read, Update, Delete) system for posts with **user authentication**. This project allows users to **register, login, and logout** while ensuring that only authenticated users can create, edit, or delete posts. Additionally, all users (including guests) can view posts. The project includes a **Profile** page for authenticated users to view their information and manage their posts.

## Features ✨

- **Authentication**: Register, login, and logout without using any external libraries.
- **Profile Management**: Users can view their profile information and manage their own posts on the profile page.
- **CRUD Operations**: Users can create, read, update, and delete their own posts.
- **Relationships**: Demonstrates a one-to-many relationship between users and posts.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## Relationships 🔗

- **User - Post**: One-to-Many relationship between `User` and `Post`. A user can have many posts, but each post belongs to a single user.
- Defined in `User` model:
    ```php
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    ```

## Project Structure 📂

```
📦 laravel-post-crud-auth
 ┣ 📂 app/Http/Controllers
 ┃ ┣ 📂 Auth
 ┃ ┃ ┣ 📄 LoginController.php      # Handles login and logout
 ┃ ┃ ┗ 📄 RegisterController.php   # Handles user registration
 ┃ ┣ 📄 PostController.php         # Manages CRUD operations for posts
 ┃ ┗ 📄 ProfileController.php      # Displays user profile information and posts
 ┣ 📂 resources/views/auth
 ┃ ┣ 📂 auth          
 ┃ ┃ ┣ 📄 login.blade.php           # Login form
 ┃ ┃ ┗ 📄 register.blade.php        # Registration form
 ┃ ┣ 📂 posts          
 ┃ ┃ ┣ 📄 create.blade.php          # Form for creating a new post
 ┃ ┃ ┣ 📄 edit.blade.php            # Form for editing a post
 ┃ ┃ ┣ 📄 index.blade.php           # Lists all posts with pagination
 ┃ ┃ ┣ 📄 show.blade.php            # Displays a specific post
 ┃ ┗ 📄 profile.blade.php           # Displays user's profile and their posts
 ┣ 📂 database/migrations
 ┃ ┣ 📄 create_users_table.php     # Migration for user registration
 ┃ ┣ 📄 create_posts_table.php     # Migration for posts
 ┗ 📄 routes/web.php               # Defines routes for authentication and posts
```

## 📚 Routes and API Endpoints

| Method | URI                   | Description                              | Middleware    |
|--------|-----------------------|------------------------------------------|---------------|
| GET    | /login                | Display the login form                   | None          |
| GET    | /register             | Display the register form                | None          |
| POST   | /login                | Perform the login logic                  | None          |
| POST   | /register             | Perform the register logic               | None          |
|        |                       |                                          |               |
| GET    | /posts                | Display all posts                        | None          |
| GET    | /posts/create         | Show form to create a new post           | `auth`        |
| POST   | /posts                | Store a new post                         | `auth`        |
| GET    | /posts/{post}/edit    | Show form to edit an existing post       | `auth`        |
| PUT    | /posts/{post}         | Update an existing post                  | `auth`        |
| DELETE | /posts/{post}         | Delete a post                            | `auth`        |
|        |                       |                                          |               |
| POST   | /logout               | Perform the logout logic                 | `auth`        |
| GET    | /profile              | Show user's Profile and view his posts   | `auth`        |


## 👨‍💻 Development Tools

- **Laravel 11**: The PHP framework used to build the application.
- **SQLite**: The database for storing tasks.
- **Bootstrap 5**: For frontend styling.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
