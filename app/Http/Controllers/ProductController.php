<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $groupedData = $products->groupBy(function ($item) {
            $transactionDate = Carbon::parse($item->transactionDate);
            return $transactionDate->format('Y-m');
        });

        $formattedData = $groupedData->map(function ($items, $key) {
            $total = $items->count('id');
            return [
                'tanggal' => $key,
                'total' => $total,
            ];
        })->values();

        return response()->json([
            'data' => $formattedData,
            'status' => [
                [
                    "id" => 0,
                    "name" => "SUCCESS",
                ],
                [
                    "id" => 1,
                    "name" => "FAILED",
                ]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    public function list($year_month)
    {
        $year = substr($year_month, 0, 4);
        $month = substr($year_month, 5, 2);

        $products = Product::whereYear('transactionDate', $year)
            ->whereMonth('transactionDate', $month)
            ->get();

        return response()->json(['data' => $products]);
    }
}
