# 📝 Task CRUD Operations

Welcome to the **Task Manager**! This is a simple Laravel-based application that allows us to manage tasks with **CRUD operations**, featuring **soft delete**, and **force delete** for easy task management. 🚀

## 🌟 Features

- **View Tasks**: View all tasks with a title, description, and status.
- **View a Task**: View a specific task with a title, description, and status.
- **Create a Task**: Add a new task with a title, description, and status.
- **Edit a Task**: Update the details of existing tasks.
- **Delete a Task**: Move a task to the trash (soft delete).
- **Restore a Task**: Restore soft-deleted tasks back to the main list.
- **Force Delete**: Permanently remove tasks from the database.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## 🧑‍💻 Code Examples

- **Soft Delete a Task**:
  ```php
  $task->delete();  // Soft delete
  ```

- **Restore a Task**:
  ```php
  $task->restore();  // Restore soft-deleted task
  ```

- **Force Delete a Task**:
  ```php
  $task->forceDelete();  // Permanently delete the task
  ```

- **Paginate Tasks**:
  ```php
  $tasks = Task::paginate(5);  // Paginate tasks by 5 per page
  ```

## 🗂️ Project Structure

Here's a quick overview of the project structure:

```
📦 task-manager
 ┣ 📂 app/Http/Controllers
 ┃ ┗ 📄 TaskController.php  # Handles CRUD operations
 ┣ 📂 resources/views/tasks
 ┃ ┣ 📄 index.blade.php  # Lists tasks with pagination
 ┃ ┣ 📄 show.blade.php  # View a specific task
 ┃ ┗ 📄 create.blade.php   # Task creation form
 ┃ ┗ 📄 edit.blade.php   # Task editing form
 ┣ 📂 database/migrations
 ┃ ┗ 📄 create_tasks_table.php  # Migration for tasks with soft deletes
 ┗ 📄 routes/web.php  # Defines routes for task operations
```

## 📚 Routes and API Endpoints

| Method | URI                        | Description                              | Middleware    |
|--------|----------------------------|------------------------------------------|---------------|
| GET    | /tasks                     | Display all tasks                        | None          |
| GET    | /tasks/create              | Show form to create a new task           | None          |
| POST   | /tasks                     | Store a new task                         | None          |
| GET    | /tasks/{task}/edit         | Show form to edit an existing task       | None          |
| PUT    | /tasks/{task}              | Update an existing task                  | None          |
| DELETE | /tasks/{task}              | Soft Delete a task                       | None          |
| POST   | /tasks/{task}/force-delete | Force Delete a task                      | None          |
| POST   | /tasks/{task}/restore      | Restore a soft Deleted task              | None          |

## 👨‍💻 Development Tools

- **Laravel 11**: The PHP framework used to build the application.
- **SQLite**: The database for storing tasks.
- **Bootstrap 5**: For frontend styling.

## 📝 License

This project is open-source and available under the MIT License.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
