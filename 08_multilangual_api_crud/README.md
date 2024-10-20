# Multilangual API CRUD 

## 📜 Project Overview
The AITS project (Article Information Translation System) is designed to manage articles with full multilingual capabilities, enabling CRUD operations while supporting both English and Arabic languages. The project is developed from scratch without using any external translatable libraries, providing flexibility and full control over language handling.

## 🚀 Features
- **Article CRUD Operations**: Create, read, update, and delete articles in multiple languages.
- **Multilingual Support**: Articles can have titles and content in both English and Arabic.
- **Dynamic Validation**: Implement dynamic validation rules that adapt based on the accepted languages in the request header.
- **Custom Middleware**: Use middleware to set the locale for each request based on the `Accept-Language` header.
- **Helper Functions**: Create helper functions to retrieve localized fields easily.
- **API Resources**: Utilize API resources to format JSON responses for articles.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## API Documentation
You can find the API documentation in the following file:

[API Documentation (Postman JSON)](api-documentation.json)

## 📝 Sample Code

### 🔍 Dynamic Validation Logic
In the `ArticleController`, the store and update functions will dynamically loop through accepted languages to set validation rules for each title and content. For example:
```php
foreach ($acceptedLanguages as $lang) {
    $rules["title_{$lang}"] = 'required|string|max:225';
    $rules["content_{$lang}"] = 'required|string';
}
```

### 🗄️ Middleware for Locale Setting
The `SetLocale` middleware checks for the `Accept-Language` header in the request and sets the application locale accordingly:
```php
public function handle($request, Closure $next){
    $locale = $request->header('Accept-Language', config('app.fallback_locale'));
    if (in_array($locale, config('app.accepted_locales'))) {
        app()->setLocale($locale);
    }
    return $next($request);
}
```

### 🛠️ Helper Function for Localized Fields
The helper function `get_localized_field` will return the localized title based on the current locale or return all titles in an array if no specific language is provided.

## 📜 Database Migration
The articles table will contain the following columns:
- `id` (Primary Key)
- `title_en` (string, required)
- `title_ar` (string, required)
- `content_en` (text, required)
- `content_ar` (text, required)
- `created_at` (timestamp)
- `updated_at` (timestamp)

## 🗂️ Project Structure
```
📦 aits
 ┣ 📂 app/Http/Controllers
 ┃ ┗ 📄 ArticleController.php          # Handles article CRUD operations
 ┣ 📂 app/Http/Middleware
 ┃ ┗ 📄 SetLocale.php                  # Middleware to set application locale
 ┣ 📂 app/Helpers
 ┃ ┗ 📄 helpers.php                    # Contains helper functions for localization
 ┣ 📂 app/Models
 ┃ ┗ 📄 Article.php                    # Article model with multilingual fields
 ┣ 📂 app/Http/Resources
 ┃ ┗ 📄 ArticleResource.php             # Resource for formatting article API responses
 ┣ 📂 database/migrations
 ┃ ┗ 📄 create_articles_table.php       # Migration for articles table with multilingual fields
 ┣ 📂 config
 ┃ ┗ 📄 app.php                        # Configuration for default locale and accepted languages
 ┗ 📄 routes/api.php                   # API routes for article management
```

## 🛣️ API Endpoints
| Method | Endpoint                 | Description                               |
|--------|--------------------------|-------------------------------------------|
| GET    | /api/articles            | Retrieve all articles (multilingual)      |
| GET    | /api/articles/{id}       | Retrieve an article (multilingual)        |
| POST   | /api/articles            | Create a new article (multilingual)       |
| GET    | /api/articles/{id}       | Retrieve a specific article               |
| PUT    | /api/articles/{id}       | Update a specific article                 |
| DELETE | /api/articles/{id}       | Delete a specific article                 |

## 🔧 Development Tools

- **Laravel**: PHP framework for building the API.
- **Laravel Sanctum**: Simple token-based authentication for APIs.
- **Postman**: For testing API endpoints.
- **MySQL**: Database to store products, categories, and brands.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
