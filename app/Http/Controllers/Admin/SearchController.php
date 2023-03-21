<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    // $searchTerm = $request->input('query', '');

    // $orders = Order::where('fullname', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('status_message', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
    //     ->paginate(10);

    // $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('brand', 'LIKE', '%' . $searchTerm . '%')
    //     ->paginate(10);

    // $categories = Category::where('name', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
    //     ->paginate(10);

    // $tasks = Task::where('assignee', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('status', 'LIKE', '%' . $searchTerm . '%')
    //     ->paginate(10);

    // $brands = Brand::where('name', 'LIKE', '%' . $searchTerm . '%')->paginate(10);

    // $users = User::where('name', 'LIKE', '%' . $searchTerm . '%')
    //     ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
    //     ->paginate(10);

    // return view('admin.search', [
    //     'results' => [],
    //     'searchTerm' => $searchTerm,
    //     'orders' => $orders,
    //     'products' => $products,
    //     'categories' => $categories,
    //     'tasks' => $tasks,
    //     'brands' => $brands,
    //     'users' => $users,
    // ]);

    //     $searchTerm = $request->input('query', '');

    //     $orders = Order::where('fullname', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('status_message', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
    //         ->paginate(10);

    //     $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('brand', 'LIKE', '%' . $searchTerm . '%')
    //         ->paginate(10);

    //     $categories = Category::where('name', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
    //         ->paginate(10);

    //     $tasks = Task::where('assignee', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('status', 'LIKE', '%' . $searchTerm . '%')
    //         ->paginate(10);

    //     $brands = Brand::where('name', 'LIKE', '%' . $searchTerm . '%')->paginate(10);

    //     $users = User::where('name', 'LIKE', '%' . $searchTerm . '%')
    //         ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
    //         ->paginate(10);

    //     $results = array();
    //     if ($orders->count() > 0) {
    //         $results['orders'] = $orders;
    //     }
    //     if ($products->count() > 0) {
    //         $results['products'] = $products;
    //     }
    //     if ($categories->count() > 0) {
    //         $results['categories'] = $categories;
    //     }
    //     if ($tasks->count() > 0) {
    //         $results['tasks'] = $tasks;
    //     }
    //     if ($brands->count() > 0) {
    //         $results['brands'] = $brands;
    //     }
    //     if ($users->count() > 0) {
    //         $results['users'] = $users;
    //     }

    //     if (count($results) == 0) {
    //         $message = "No results found for \"$searchTerm\".";
    //     } else {
    //         $message = "Search Results for \"$searchTerm\"";
    //     }

    //     return view('admin.search', [
    //         'results' => $results,
    //         'searchTerm' => $searchTerm,
    //         'message' => $message,
    //     ]);
    // }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $orders = Order::where('fullname', 'LIKE', '%' . $searchTerm . '%')->paginate(10);
        $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('description', 'LIKE', '%' . $searchTerm . '%')->paginate(10);
        $categories = Category::where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('description', 'LIKE', '%' . $searchTerm . '%')->paginate(10);
        $tasks = Task::where('description', 'LIKE', '%' . $searchTerm . '%')->orWhere('assignee', 'LIKE', '%' . $searchTerm . '%')->paginate(10);
        $brands = Brand::where('name', 'LIKE', '%' . $searchTerm . '%')->paginate(10);
        $users = User::where('name', 'LIKE', '%' . $searchTerm . '%')->orWhere('email', 'LIKE', '%' . $searchTerm . '%')->paginate(10);

        return view('admin.search', compact('searchTerm', 'orders', 'products', 'categories', 'tasks', 'brands', 'users'));
    }
}
