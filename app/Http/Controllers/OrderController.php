<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'products'])->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Orders retrieved successfully',
            'data' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Create order',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'status' => $request->input('status', 'pending'),
            'total_amount' => 0,
        ]);

        $totalAmount = 0;
        $pivotData = [];

        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            $quantity = $productData['quantity'];
            $price = $product->price;

            $pivotData[$productData['product_id']] = [
                'quantity' => $quantity,
                'price' => $price,
            ];

            $totalAmount += $price * $quantity;
        }

        $order->products()->attach($pivotData);
        $order->update(['total_amount' => $totalAmount]);

        $order->load('products');
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'products']);
        return response()->json([
            'status' => 'success',
            'message' => 'Order retrieved successfully',
            'data' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load('products');
        return response()->json([
            'status' => 'success',
            'message' => 'Edit order',
            'data' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        // Sync products if provided
        if ($request->has('product_ids')) {
            $order->products()->sync($request->input('product_ids'));
        }

        $order->load('products');
        return response()->json([
            'status' => 'success',
            'message' => 'Order updated successfully',
            'data' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->products()->detach(); // Remove pivot entries
        $order->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Order deleted successfully'
        ]);
    }
}
