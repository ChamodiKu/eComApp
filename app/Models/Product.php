<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    /**
     * use class Product
     * 
     * @table products
     * 
     * @property int $id
     * @property string $brand
     * @property string $product_name
     * @property string $product_image
     * @property integer $quantity
     * @property decimal $cost_price
     * @property decimal $sell_price
     * @property text $description
     * @property integer $rating
     * @property boolean $is_active
     * 
     */

    protected $fillable = [
        'brand',
        'product_name',
        'product_image',
        'quantity',
        'cost_price',
        'sell_price',
        'description',
        'rating',
        'is_active'
    ];

    public function customerCarts()
    {
        return $this->hasMany(CustomerCart::class);
    }

    public static function getAllProductsForFilter (Request $request)
    {
        return Product::where(function ($query) use ($request) {
                if($request->searchProduct != null) {
                    $query->where('product_name', 'like', '%' . $request->searchProduct . '%');
                }
                if($request->searchBrand != null) {
                    $query->Where('brand', 'like', '%' . $request->searchBrand . '%');
                }
                if($request->searchRate != null) {
                    $query->Where('rate', $request->searchRate);
                }
                if($request->minPrice != null && $request->maxPrice != null) {
                    $query->whereBetween('sell_price', [$request->minPrice, $request->maxPrice]);
                } else if($request->minPrice != null && $request->maxPrice == null) {
                    $query->where('sell_price', '>=', $request->minPrice);
                } else if($request->minPrice == null && $request->maxPrice != null) {
                    $query->where('sell_price', '<=', $request->maxPrice);
                }
            })
            ->get();
    }
}
