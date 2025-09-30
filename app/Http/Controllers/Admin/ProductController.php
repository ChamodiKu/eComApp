<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\CreateProductRequest;
use App\Http\Requests\Admin\Products\updateProductRequest;
use App\Interfaces\Admin\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private ProductInterface $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    /**
     * View all products data
     */
    public function index($request)
    {
        try {
            if (Auth::user()->can('product-view')) {
                $products = $this->productInterface->index($request);

                $products = Product::getAllProductsForFilter($request);

                return view ('admin.product.all_products', compact('products'));
            } else {
                return view('admin.errors.403_forbidden');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new product.
     */
    public function createUi()
    {
        if (Auth::user()->can('product-create')) {

            return view('admin.products.components.create_product');
        } else {
            return view('admin.errors.403_forbidden');
        }
    }

    /**
     * Store a newly created product in storage.
     */
    public function create(CreateProductRequest $request)
    {
        try {
            if (Auth::user()->can('product-create')) {
                DB::beginTransaction();

                $product = $this->productInterface->create($request);

                $product = new Product();

                $product->product_name = $request->product_name;
                $product->brand = $request->brand;
                $product->description = $request->description;
                $product->quantity = $request->quantity;
                $product->cost_price = $request->cost_price;
                $product->sell_price = $request->sell_price;
                $product->rating = $request->rating;
                $product->is_active = $request->is_active;

                if ($request->product_image != null) {

                    $imageName = 'image_' . time() . '.' . $request->product_image->extension();

                    $request->product_image->move(public_path('images/products/images/'), $imageName);
                    $banner_image = 'images/products/images/' . $imageName;

                    $product->product_image = $banner_image;
                }
                
                $product->save();

                DB::commit();
                return response()->json(['status' => 200, 'message' => 'Product created successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {

            DB::rollBack();

            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateUi($id)
    {
        try {
            if (Auth::user()->can('product-edit')) {

                $product = $this->productInterface->updateUi($id);

                return response()->json(['status' => 200, 'message' => 'Product updated successfully !', 'data' => $product]);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, $id)
    {
        try {
            if (Auth::user()->can('product-edit')) {

                DB::beginTransaction();

                //updating product
                $product = $this->productInterface->update($request, $id);

                $product = Product::find($id);

                $product->product_name = $request->product_name;
                $product->brand = $request->brand;
                $product->description = $request->description;
                $product->quantity = $request->quantity;
                $product->cost_price = $request->cost_price;
                $product->sell_price = $request->sell_price;
                $product->rating = $request->rating;
                $product->is_active = $request->is_active;

                if ($request->product_image != null) {

                    $imageName = 'image_' . time() . '.' . $request->product_image->extension();

                    $request->product_image->move(public_path('images/products/images/'), $imageName);
                    $banner_image = 'images/products/images/' . $imageName;

                    $product->product_image = $banner_image;
                }
                
                $product->save();
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Product updated successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (Auth::user()->can('product-delete')) {
                DB::beginTransaction();

                $product = $this->productInterface->destroy($id);
                Product::destroy($id);
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Product deleted successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Status change of the specified resource.
     */
    public function changeStatus(Request $request, $id)
    {
        try {
            if (Auth::user()->can('product-status')) {
                DB::beginTransaction();

                $product = $this->productInterface->changeStatus($request, $id);
                $product = Product::find($id);

                $product->is_active = $request->is_active;
                $product->save();
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Product status changed successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }
}
