# Laravel Mini Projects - Level 1

## 📜 Overview
This repository contains a collection of **10 beginner-level Laravel projects** designed to help junior developers master foundational Laravel concepts. These projects cover topics such as CRUD operations, authentication, role-based access control, API development, and more. The projects are suitable for those who have a basic understanding of PHP and Laravel and are looking to improve their skills through hands-on learning.

## 🚀 Projects Included
1. **01 Tasks CRUD with Soft Deletes**:
   - Demonstrates CRUD operations for tasks.
   - Includes **soft deletes** and **pagination**.
   
2. **02 Simple User Authentication**:
   - Implements basic **login**, **register**, and **logout** functionality.
   - Includes validation and error handling for forms.

3. **03 Post CRUD with Authentication**:
   - Combines CRUD operations on posts with **user authentication**.
   - Uses **authorization** to limit actions to the post owner.

4. **04 Multi-Auth with File Upload**:
   - Demonstrates multiple user roles (Admin, User) with **different access levels**.
   - Implements file upload functionality.

5. **05 Product Management with Pagination and Filters**:
   - Implements a RESTful API with **pagination**, **search**, **filtering**, and **sorting** for products.
   - Uses **Laravel Seeder** to generate a large dataset for testing.

6. **06 Profile Management with Password Reset**:
   - Allows users to update profile information.
   - Implements custom password reset logic without using Laravel’s built-in reset function.

7. **07 RESTful API with Role-Permission Based Authentication**:
   - Provides a full **REST API** for managing resources.
   - Implements **role-permission-based** authentication using Laravel Sanctum.

8. **08 Multilingual API CRUD for Articles**:
   - Supports article creation and retrieval in multiple languages.
   - Includes dynamic validation and **middleware** for setting the locale.

9. **09 Role-Permission Based System with Authentication**:
   - Demonstrates a full **role-permission** system.
   - Blade directives are used to customize views based on permissions.

10. **10 Junior Laravel Developer Task Solution**:
    - Solves a common junior developer task.
    - Includes user verification, CRUD for posts and tags, and caching.

## 🛠️ Requirements
- **PHP** >= 8.0
- **Laravel** >= 8.x
- **Composer**
- **SQLite/MySQL** (depending on the project)

## 🎥 Video Overview
Watch the video playlist tutorials where we build and explain each project in detail! Coming soon... 🎬

## 📥 Installation
To set up the project, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Abdogoda/Laravel-Mini-Projects-Level-1.git
   cd Laravel-Mini-Projects-Level-1
   ```

2. **Navigate to a project directory** (e.g., `01_tasks_crud`):
   ```bash
   cd 01_tasks_crud
   ```

3. **Install the dependencies**:
   ```bash
   composer install
   npm install
   ```

4. **Set up the environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run database migrations**:
   ```bash
   php artisan migrate --seed
   ```

6. **Serve the application**:
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.

## 📂 Project Structure
Each project is contained in its own folder:
```
📦 Laravel-Mini-Projects-Level-1
 ┣ 📂 01_tasks_crud
 ┣ 📂 02_simple_auth
 ┣ 📂 03_post_crud_with_auth
 ┣ 📂 04_multi_auth_with_file_upload
 ┣ 📂 05_pagination_searching_filtering_sorting
 ┣ 📂 06_profile_management_with_password_reset
 ┣ 📂 07_restful_api_with_auth
 ┣ 📂 08_multilangual_api_crud
 ┣ 📂 09_role_permission_based_system
 ┗ 📂 10_junior_laravel_interview_task
```

## 🛠️ Tools and Technologies
- **Laravel**: PHP framework used for building each mini-project.
- **Laravel Sanctum**: Used for API authentication.
- **SQLite**: Lightweight database used for simplicity.
- **MySQL**: Optional for larger projects.
- **Blade**: Template engine for rendering views.

## 💡 How to Navigate
Each folder represents a separate project. Navigate to a project’s folder and follow the installation steps to run that specific project. Detailed instructions can be found in each project's README.

## 🧑‍💻 Contributing
Feel free to fork this repository and submit pull requests if you'd like to add more projects or improvements.

## 📄 License
This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for more information.

## 📧 Contact
If you have any questions or feedback, please feel free to reach out to me at [abdogoda0a@gmail.com].
