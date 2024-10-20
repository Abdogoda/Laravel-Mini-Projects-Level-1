# Laravel Junior Developer Interview Task Solution

This project is a solution to a task typically assigned to a junior Laravel developer. It covers the implementation of an authentication system, tags and posts API resources, background jobs for scheduled tasks, and caching for specific statistics. The project uses **Laravel 8+** with **Sanctum** for API authentication, **SQLite** as the database, and implements various concepts suitable for beginner-level Laravel developers.

## 🚀 Features

- **User Authentication**:
  - **Registration, Login, and logout**: Endpoints for user registration login, and logout, collecting name, phone number, and password.
  - **OTP Verification**: Enhanced security during registration with OTP verification.

- **Tag Management**:
  - **CRUD Operations**: Users can create, read, update, and delete tags.
  - **Unique Tag Names**: Tags are stored as unique names to avoid duplicates.

- **Post Management**:
  - **CRUD Operations**: Users can create, view, update, delete (soft delete), and restore their posts.
  - **Post Attributes**: Each post can have multiple tags, a title, body, cover image, and a pinned status.
  - **Authorization Policies**: Ensures that only the user who created a post can edit or delete it.

- **Request Validation**: 
  - Validates incoming requests using dedicated request classes for each feature.

- **Scheduled Jobs**:
  - **Daily Cleanup**: A job that permanently deletes softly deleted posts older than 30 days.
  - **Data Fetching**: A periodic job to fetch random user data from an external API.

- **Statistics Endpoint**:
  - An endpoint to retrieve the total number of users, total posts, and the count of users with zero posts.

- **Caching**: Results are cached to enhance performance and minimize database queries.

- **Traits**:
  - **ApiResponseTrait**: Used for returning consistent success or error responses throughout the application.
  - **ImageControlTrait**: Handles uploading or deleting images, used in the post controller.

- **API Resources**: Each model has its own API resource for standardized responses.

- **Eager Loading**: Prevents N+1 query problems when dealing with model relationships.

- **Observers**: Used for the User and Post models to update cached statistics whenever models are created, updated, or deleted.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## API Documentation
You can find the API documentation in the following file:

[API Documentation (Postman JSON)](api-documentation.json)

## 🔧 Database Structure

### Users Table
- `id` (Primary Key)
- `name` (string, required)
- `phone` (string, required, unique)
- `password` (string, required)
- `verification_code` (integer, required, 6-digits)
- `verified_at` (timestamp, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Tags Table
- `id` (Primary Key)
- `name` (string, required, unique)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Posts Table
- `id` (Primary Key)
- `user_id` (Foreign Key, required)
- `title` (string, required, max: 255)
- `body` (text, required)
- `cover_image` (string, required when creating)
- `is_pinned` (boolean, required)
- `deleted_at` (timestamp for soft deletes)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Tag_Post (Pivot Table)
- `tag_id` (Foreign Key)
- `post_id` (Foreign Key)

## 🔗 Relationships
- **User and Post**: A user can have many posts. Each post belongs to one user.
- **Post and Tag**: Many-to-many relationship between posts and tags. A post can have multiple tags, and a tag can be associated with multiple posts.

## 🛣️ API Routes

| Method  | Route                        | Description                                            | Auth Required |
|---------|------------------------------|--------------------------------------------------------|---------------|
| POST    | `/api/v1/register`           | Register a new user                                    |      No       |
| POST    | `/api/v1/login`              | Login an existing user                                 |      No       |
| POST    | `/api/v1/verify`             | Verify a user account                                  |      No       |
| POST    | `/api/v1/logout`             | Logout from the system and delete user tokens          |      Yes      |
|         |                              |                                                        |               |
| GET     | `/api/v1/tags`               | Get a list of all tags                                 |      Yes      |
| POST    | `/api/v1/tags`               | Create a new tag                                       |      Yes      |
| GET     | `/api/v1/tags/{id}`          | Get a single tag                                       |      Yes      |
| PUT     | `/api/v1/tags/{id}`          | Update a specific tag                                  |      Yes      |
| DELETE  | `/api/v1/tags/{id}`          | Delete a specific tag                                  |      Yes      |
|         |                              |                                                        |               |
| GET     | `/api/v1/posts`              | Get a list of all user's posts                         |      Yes      |
| GET     | `/api/v1/posts/deleted`      | Get a list of all user's deleted posts                 |      Yes      |
| POST    | `/api/v1/posts`              | Create a new post                                      |      Yes      |
| GET     | `/api/v1/posts/{id}`         | Get a single post                                      |      Yes      |
| PUT     | `/api/v1/posts/{id}`         | Update a specific post (only for the creator)          |      Yes      |
| DELETE  | `/api/v1/posts/{id}`         | Soft delete a specific post (only for the creator)     |      Yes      |
| POST    | `/api/v1/posts/{id}/restore` | Restore a softly deleted post (only for the creator)   |      Yes      |
|         |                              |                                                        |               |
| GET     | `/api/v1/stats`              | Retrieve statistics about users and posts              |      Yes      |


## 🗂️ Project Structure
```
📦 laravel-junior-task
 ┣ 📂 app/Http/Controllers/Api/V1
 ┣ ┣ 📂 Auth
 ┃ ┃ ┣ 📄 LoginController.php                # Handles user login to the system
 ┃ ┃ ┣ 📄 RegisterController.php             # Handles user register to create an account
 ┃ ┃ ┗ 📄 VerificationController.php         # Handles verify the user account
 ┃ ┣ 📄 TagController.php                    # Handles tag management
 ┃ ┣ 📄 PostController.php                   # Handles post management
 ┃ ┗ 📄 StatsController.php                  # Controller for handling stats endpoint
 ┣ 📂 app/Http/Requests
 ┃ ┣ 📂 Auth
 ┃ ┃ ┣ 📄 LoginRequest.php                   # Request validation for login
 ┃ ┃ ┗ 📄 RegisterRequest.php                # Request validation for registration
 ┃ ┣ 📂 Tags
 ┃ ┃ ┣ 📄 StoreTagRequest.php                # Request validation for creating a new tag
 ┃ ┃ ┗ 📄 UpdateTagRequest.php               # Request validation for updating a tag
 ┃ ┣ 📂 Posts
 ┃ ┃ ┣ 📄 StorePostRequest.php               # Request validation for creating a new post
 ┃ ┃ ┗ 📄 UpdatePostRequest.php              # Request validation for updating a post
 ┣ 📂 app/Models
 ┃ ┣ 📄 User.php                             # User model with relationships
 ┃ ┣ 📄 Post.php                             # Post model with relationships
 ┃ ┣ 📄 Tag.php                              # Tag model with relationships
 ┣ 📂 app/Observers
 ┃ ┣ 📄 UserObserver.php                     # Observer for User model
 ┃ ┣ 📄 PostObserver.php                     # Observer for Post model
 ┣ 📂 app/Jobs
 ┃ ┣ 📄 DeleteSoftDeletedPosts.php           # Job for deleting old soft deleted posts
 ┃ ┗ 📄 GetRandomUserData.php                # Job for getting random user data
 ┣ 📂 app/Policies
 ┃ ┣ 📄 PostPolicy.php                       # Policy for post management
 ┣ 📂 database/migrations
 ┃ ┣ 📄 create_users_table.php               # Migration for users table
 ┃ ┣ 📄 create_posts_table.php               # Migration for posts table
 ┃ ┣ 📄 create_tags_table.php                # Migration for tags table
 ┃ ┣ 📄 create_post_tag_table.php            # Migration for post tag realationship table
 ┣ 📂 routes
 ┃ ┗ 📄 api.php                              # API routes definition
 ┃ ┗ 📄 console.php                          # Console routes definition for schedulling jobs
 ┣ 📄 .env                                   # Environment configuration
 ┗ 📄 api-documentation.json                 # Postman API Documentation
```

## 📜 Sample Code

### 🔍 Register & Verification Code Generation
```php
// Auth/RegisterRequest.php
public function rules() {
    return [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|regex:/^01[1250][0-9]{8}$/|unique:users,phone',
        'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&#]/']
    ];
}
// Auth/AuthController.php
public function register(RegisterRequest $request) {
    $user = User::create($request->all());
    $user->verification_code = rand(100000, 999999);
    $user->save();
    Log::info('Verification code for user ' . $user->id . ': ' . $user->verification_code);
} 
```
### Authorization Policy

#### Policy for Post Management
```php
// PostPolicy.php
public function update(User $user, Post $post) {
    return $user->id === $post->user_id; // Only allow the post creator to update
}

public function delete(User $user, Post $post) {
    return $user->id === $post->user_id; // Only allow the post creator to delete
}
```

### Statistics Endpoint

#### Get Stats
```php
// Controllers/Api/V1/StatsController.php
public function getStats() {
    $stats = Cache::remember('user_post_stats', 60, function () {
        $totalUsers = User::count();
        $totalPosts = Post::count();        
        $usersWithZeroPosts = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
        ->whereNull('posts.id')
        ->count('users.id');

        return [
            'total_users' => $totalUsers,
            'total_posts' => $totalPosts,
            'users_with_zero_posts' => $usersWithZeroPosts,
        ];
    });

    return $this->success(['stats' => $stats], 'Statistics retrieved successfully');
}
```

### 🗓️ Scheduled Jobs
- **Job to Delete Old Softly Deleted Posts**:
    ```php
    public function handle() {
        Post::onlyTrashed()
          ->where('deleted_at', '<=', Carbon::now()->subDays(30))
          ->forceDelete();
    }
    ```
- **Job to Fetch Data from API**:
    ```php
    public function handle() {
        $response = Http::get('https://randomuser.me/api/');
        Log::info('Random User Data:', $response->json('results'));
    }
    ```

## 🔧 Development Tools

- **Laravel 8+**: PHP framework for building the application.
- **Laravel Sanctum**: Simple token-based authentication for APIs.
- **SQLite**: Lightweight database used for easy setup.
- **Postman**: For testing API endpoints.
- **Scheduler**: Laravel’s built-in task scheduling for background jobs.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [your-email@example.com].
