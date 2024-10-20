# Role-Permission Based System with Authentication

## 📜 Overview
This is a **Role-Permission Based System** built with Laravel, designed to manage user roles, permissions, and authentication. It allows users to be assigned roles, which in turn grant specific permissions. The system ensures that only users with the right permissions can access or perform certain actions.

## 🚀 Features
- **User Authentication**: Secure login and registration using Laravel Sanctum for token-based authentication.
- **Role Management**: Admins can create, update, and delete roles.
- **Permission Management**: Admins can create, assign, and manage permissions for each role.
- **Dynamic Permission Checks**: Use Blade directives to conditionally show or hide content based on user permissions.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## 🔧 Database Structure

### Users Table
- `id` (Primary Key)
- `name` (string, required)
- `email` (string, required, unique)
- `password` (string, required)
- `role_id` (Foreign Key to roles table, required)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Roles Table
- `id` (Primary Key)
- `name` (string, required, unique)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Permissions Table
- `id` (Primary Key)
- `name` (string, required, unique)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Permission_Role Table (Pivot Table)
- `role_id` (Foreign Key)
- `permission_id` (Foreign Key)

## 🔗 Relationships
- **User and Role**: Each user belongs to one role. A role can have many users.
- **Role and Permission**: A role can have multiple permissions, and a permission can be assigned to multiple roles (many-to-many relationship).

## 🛠️ API Endpoints
| Method | Endpoint                   | Description                               |
|--------|----------------------------|-------------------------------------------|
| POST   | /api/register              | Register a new user                       |
| POST   | /api/login                 | Log in an existing user                   |
| POST   | /api/logout                | Log out from existing user                |
| GET    | /api/profile               | view user's profile                       |
|        |                            |                                           |
| GET    | /api/users                 | Retrieve all users (Admin only)           |
| GET    | /api/users/create          | Create a user form (Admin only)           |
| POST   | /api/users                 | Store a new user (Admin only)             |
|        |                            |                                           |
| GET    | /api/roles                 | Get all available roles (Admin only)      |
| GET    | /api/roles/create          | Create a role form (Admin only)           |
| POST   | /api/roles                 | Store a new role (Admin only)             |
| GET    | /api/roles/{id}            | Show a specific role (Admin only)         |
| GET    | /api/roles/{id}/edit       | Edit a role form (Admin only)             |
| PUT    | /api/roles/{id}            | Update a specific role (Admin only)       |
| DELETE | /api/roles/{id}            | Delete a specific role (Admin only)       |

## 📜 Sample Code

### 🔍 Role and Permission Management
In the `RoleController`, admins can create, update, and delete roles and assign permissions:
```php
public function store(Request $request) {
    $role = Role::create($request->all());
    $role->permissions()->sync($request->permissions);
    return response()->json($role, 201);
}
```

### 🗄️ Middleware for Role Access
The `RoleMiddleware` checks if the authenticated user has the required role to access specific routes:
```php
public function handle($request, Closure $next, $role) {
    if (!auth()->user()->role->name === $role) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }
    return $next($request);
}
```

### 🛠️ User Authentication
Laravel Sanctum is used for token-based authentication, allowing users to register and log in:
```php
public function login(Request $request) {
    $request->validate(['email' => 'required', 'password' => 'required']);
    if (!auth()->attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    return response()->json(['token' => auth()->user()->createToken('token')->plainTextToken]);
}
```

### 🛠️ Blade Directive for Permission Check
Add the following code to the `boot` method in your `AppServiceProvider` to create a Blade directive for checking permissions:
```php
public function boot()
{
    Blade::if('hasPermission', function ($permission) {
        return auth()->check() && auth()->user()->hasPermission($permission);
    });
}
```

### 📑 Usage in Blade
With the Blade directive, you can conditionally display content:
```blade
@hasPermission('edit-roles')
    <a href="{{ route('roles.edit', $role->id) }}">Edit Role</a>
@endhasPermission
```

## 🔧 Development Tools

- **Laravel**: PHP framework for building the application.
- **Laravel Sanctum**: Simple token-based authentication for APIs.
- **Bootstrap 5**: For frontend styling.
- **SQLITE**: Database to store users and projects.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].