# 🛍️ Product Pagination, Searching, Filtering, and Sorting

This project implements a product management system with features such as pagination, searching, filtering, and sorting, using Laravel as the backend framework.

## ✨ Features

- **Seeding**: Seed the database with 1000 fake records for testing.
- **Pagination**: Navigate through large datasets efficiently.
- **Searching**: Search products by name or description.
- **Filtering**: Filter products based on categories and price ranges (min, max) using a slider.
- **Sorting**: Sort products by name, price, or date created (asc, desc).
- **Dynamic UI**: Intuitive user interface for better user experience.

## 🎥 Video Overview
Watch the video tutorial where we build and explain each feature in detail! Coming soon... 🎬

## 💻 Sample Code

```php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtering by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filtering by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Searching by name or description
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort_by = $request->get('sort_by', 'name');
        $order = $request->get('order', 'asc');
        $products = $query->orderBy($sort_by, $order)->paginate(10);

        return view('products.index', compact('products'));
    }
}
```

## 🗂️ Project Structure

```
📦 product-pagination-system
 ┣ 📂 app/Http/Controllers
 ┃ ┗ 📄 ProductController.php   # Handles product management functions
 ┣ 📂 app/Models
 ┃ ┗ 📄 Product.php              # Product model
 ┣ 📂 database/migrations
 ┃ ┗ 📄 create_products_table.php # Migration for products table
 ┣ 📂 resources/views/products
 ┃ ┣ 📄 index.blade.php          # View for displaying products
 ┣ 📂 routes
 ┃ ┗ 📄 web.php                  # Defines routes for product management
 ┗ 📄 .env                        # Environment file for configuration
```

## 📜 Routes Table

| Method | URI                 | Action                      | Description                      |
|--------|---------------------|-----------------------------|----------------------------------|
| GET    | /products           | ProductController@index     | Display a listing of products    |

## 🔧 Development Tools

- **Laravel**: PHP framework for web application development.
- **SQLITE**: Database management system.
- **PHP**: Server-side scripting language.
- **HTML/CSS/JavaScript**: Frontend technologies for building the user interface.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact 📧

For any questions or feedback, please reach out to me at [abdogoda0a@gmail.com].
