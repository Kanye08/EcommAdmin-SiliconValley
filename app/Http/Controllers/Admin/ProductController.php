<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }
    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move('$uploadPath', '$filename');
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        return redirect('/admin/products')->with('message', 'Product Added Successfully!');
    }

    // edit 
    public function edit(int $product_id)
    {
        return view('admin.category.edit', compact('category'));
    }

    // // update
    // public function update(CategoryFormRequest $request, $category)
    // {
    //     $category = Category::findOrFail($category);

    //     $validatedData = $request->validated();

    //     $category->name = $validatedData['name'];
    //     $category->slug = Str::slug($validatedData['slug']);
    //     $category->description = $validatedData['description'];

    //     if ($request->hasFile('image')) {

    //         $uploadPath = 'uploads/category/';


    //         $path = 'uploads/category/' . $category->image;
    //         if (File::exists($path)) {
    //             File::delete($path);
    //         }
    //         $file = $request->file('image');
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;

    //         $file->move('uploads/category/', $filename);

    //         $category->image = $uploadPath . $filename;
    //     }

    //     $category->meta_title = $validatedData['meta_title'];
    //     $category->meta_keyword = $validatedData['meta_keyword'];
    //     $category->meta_description = $validatedData['meta_description'];

    //     $category->status = $request->status == true ? '1' : '0';

    //     $category->update();

    //     return redirect('admin/category')->with('message', 'Category Updated Successfully!');
    // }
}
