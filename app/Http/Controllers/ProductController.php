<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        // Return a JSON response   
        return response()->json([
            'message' => 'Products retrieved successfully.',
            'data' => ProductResource::collection(
                    Product::all()
                ),
        ], 200);
  
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            // Create the Product with the validated data, 
            $product = Product::create($request->validated());

            // Attach ingredients to the product with quantities. Required to update the products_ingredients pivot table
            foreach ($request->ingredients as $ingredient) {
                $product->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }

            // Return a response with the newly created product
            return response()->json([
                'message' => 'Product created successfully.',
                'data' => new ProductResource($product),
            ], 201);
         
        } catch (\Throwable $th) {
       
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            // Return a success response
            return response()->json([
                'message' => 'Product Found.',
                'data' => new ProductResource($product),
            ], 200);
        } catch (\Throwable $th) {
       
        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        try {
            // Update the product with the validated data
            $product->update($request->validated());

            // Prepare an array of ingredients with quantities for sync
            $ingredientsData = [];
            if ($request->has('ingredients')) {
                foreach ($request->ingredients as $ingredient) {
                    // Add ingredient_id as the key and quantity as the pivot data
                    $ingredientsData[$ingredient['id']] = ['quantity' => $ingredient['quantity']];
                }
                // Sync the ingredients with the product, updating the quantities
                // Existing relationships will be updated, new ones will be added, old ones removed
                $product->ingredients()->sync($ingredientsData);
            }

            // Refresh the product to get the updated relationships
            $product->refresh();

            // Return a success response
            return response()->json([
                'message' => 'Product updated successfully.',
                'data' => new ProductResource($product),
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //Detach ingredients if needed
        $product->ingredients()->detach();

        // Delete the product
        $product->delete();

        // Return success response
        return response()->json([
            'message' => 'Product deleted successfully.',
        ], 200);
    }
}
