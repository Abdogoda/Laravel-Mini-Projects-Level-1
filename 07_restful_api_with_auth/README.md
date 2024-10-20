# 📦 RESTful API with Authentication

This project is a RESTful API built with Laravel, which provides functionalities for managing products, categories, and brands. The API is secured using Laravel Sanctum for token-based authentication.

## 🚀 Features

- **User Authentication**: Secure API endpoints using Laravel Sanctum.
- **RESTful API**: Create, Read, Update, and Delete (CRUD) operations for products, categories, and brands.
- **Policies**: Implement policies to ensure users can only update or delete their own products.
- **Multiple Relationships**: Establish relationships between products, categories, and brands.
- **Eager Loading**: Optimize performance by loading related models.
- **Error Handling**: Proper validation and error responses.
- **API Resources**: Format JSON responses using Laravel's API resource classes.
- **Seeding**: Seed the database with 10150 fake records for testing.
- **Pagination**: Navigate through large datasets efficiently.
- **Searching**: Search products by name or description.
- **Filtering**: Filter products based on categories and price ranges (min, max) using a slider.
- **Sorting**: Sort products by name, price, or date created (asc, desc).

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## API Documentation
You can find the API documentation in the following file:

[API Documentation (Postman JSON)](api-documentation.json)

## 📝 Sample Code

### Authentication Example

#### Register User
```php
// AuthController.php
public function register(Request $request){
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken

    return response()->json([
        'message' => 'User registered successfully.',
        'user' => new UserResource($user),
        'token' => $token
    ]);
}
```

### Product Example

#### Create Product
```php
public function store(StoreProductRequest $request){
    $filename = time(). '.' .$request->file("image")->getClientOriginalExtension();
    $request->file("image")->storeAs('uploaded/products', $filename, 'public');

    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $filename,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'brand_id' => $request->brand_id,
        'user_id' => $request->user_id,
    ]);

    return response()->json([
        'message' => 'Product created successfully.', 
        'product' => new ProductResource($product)
    ]);
}
```

#### Get Products with Eager Loading
```php
public function index(){
    return ProductResource::collection(Product::with(['category', 'brand'])->paginate(10));
}
```

### API Resources Example

#### Product Resource
```php
class ProductResource extends JsonResource{
    public function toArray($request){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
        ];
    }
}
```

## 🗂️ Project Structure

```
📦 07_restful_api_with_auth
 ┣ 📂 app/Http/Controllers/Api
 ┃ ┣ 📄 RegisterController.php      # Handles user registration
 ┃ ┣ 📄 LoginController.php         # Handles user login
 ┃ ┣ 📄 LogoutController.php        # Handles user logout
 ┃ ┣ 📄 ProductController.php       # Handles CRUD operations for products
 ┃ ┣ 📄 CategoryController.php      # Handles CRUD operations for categories
 ┃ ┗ 📄 BrandController.php         # Handles CRUD operations for brands
 ┣ 📂 app/Http/Resources
 ┃ ┗ 📄 UserResource.php            # Resource class for formatting user responses
 ┃ ┣ 📄 ProductResource.php         # Resource class for formatting product responses
 ┃ ┣ 📄 CategoryResource.php        # Resource class for formatting category responses
 ┃ ┗ 📄 BrandResource.php           # Resource class for formatting brand responses
 ┣ 📂 app/Models
 ┃ ┣ 📄 User.php                    # User model with relationships
 ┃ ┣ 📄 Product.php                 # Product model with relationships
 ┃ ┣ 📄 Category.php                # Category model
 ┃ ┗ 📄 Brand.php                   # Brand model
 ┣ 📂 app/Policies
 ┃ ┗ 📄 ProductPolicy.php           # Policy for product actions
 ┣ 📂 database/migrations
 ┃ ┣ 📄 create_users_table.php      # Migration for users table
 ┃ ┣ 📄 create_products_table.php   # Migration for products table
 ┃ ┣ 📄 create_categories_table.php # Migration for categories table
 ┃ ┗ 📄 create_brands_table.php     # Migration for brands table
 ┣ 📂 routes
 ┃ ┗ 📄 api.php                     # API routes definition
 ┣ 📄 .env                          # Environment configuration
 ┗ 📄 api-documentation.json        # Postman API Documentation
```

## 🛣️ API Routes

| Method  | Route                    | Description                                |
|---------|--------------------------|--------------------------------------------|
| POST    | `/api/register`          | Register a new user                        |
| POST    | `/api/login`             | Login an existing user                     |
| POST    | `/api/logout`            | Logout the authenticated user              |
|         |                          |                                            |
| GET     | `/api/products`          | Get a list of all products                 |
| POST    | `/api/products`          | Create a new product                       |
| GET     | `/api/products/{id}`     | Get a single product                       |
| PUT     | `/api/products/{id}`     | Update a specific product                  |
| DELETE  | `/api/products/{id}`     | Delete a specific product                  |
|         |                          |                                            |
| GET     | `/api/categories`        | Get a list of all categories               |
| POST    | `/api/categories`        | Create a new category                      |
| GET     | `/api/categories/{id}`   | Get a single category                      |
| PUT     | `/api/categories/{id}`   | Update a specific category                 |
| DELETE  | `/api/categories/{id}`   | Delete a specific category                 |
|         |                          |                                            |
| GET     | `/api/brands`            | Get a list of all brands                   |
| POST    | `/api/brands`            | Create a new brand                         |
| GET     | `/api/brands/{id}`       | Get a single brand                         |
| PUT     | `/api/brands/{id}`       | Update a specific brand                    |
| DELETE  | `/api/brands/{id}`       | Delete a specific brand                    |


## 🔧 Development Tools

- **Laravel**: PHP framework for building the API.
- **Laravel Sanctum**: Simple token-based authentication for APIs.
- **Postman**: For testing API endpoints.
- **MySQL**: Database to store products, categories, and brands.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
