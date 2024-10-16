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
     * Display a listing of the resource.
     */
    public function index()
    {

        // Return a JSON response 
           
        return response()->json([
            'message' => 'Products retrieved successfully.',
            'data' => ProductResource::collection(
                    Product::all()
                ),
        ], Response::HTTP_CREATED);

       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
                // Create the Product with the validated data, handle nullable status_id
            $product = Product::create([
                'name' => $request->name,
                'category' => $request->category,
                'batch_number' => $request->batch_number,
                'research_status_id' => $request->research_status_id, // This can be null
                'manufacturing_date' => $request->manufacturing_date, 
                'expiration_date' => $request->expiration_date,
                
            ]);


            // Attach ingredients to the product with quantities
            foreach ($request->ingredients as $ingredient) {
                $product->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }

            // Return a response with the newly created product
            return response()->json([
                'message' => 'Product created successfully.',
                'data' => new ProductResource($product),
            ], Response::HTTP_CREATED);
         
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
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
       
        }
        
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
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
        ], Response::HTTP_OK);
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
