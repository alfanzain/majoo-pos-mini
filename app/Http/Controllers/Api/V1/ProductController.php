<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        try {
            $products = Product::query();

            $searchQuery = request()->query('q');

            $products->when($searchQuery, function($query) use ($searchQuery) {
                return $query->where("name", "LIKE", "%" . strtolower($searchQuery) . "%");
            });

            return $this->responseSuccess('', $products->paginate(10));
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products,name|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|numeric',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $this->responseError('Product could not be created. Please try again');
        }

        $product = Product::create($data);

        return $this->responseSuccess('Product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$id) {
            return $this->responseError('Product not found');

        }

        try {
            $product = Product::where('id', $id)->get();

            return $this->responseSuccess('', $product);
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
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
        $rules = [
            'name' => 'required|unique:products,name|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|numeric',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $this->responseError('Product could not be updated. Please try again');
        }

        $product = Product::find($id);

        if (!$product) {
            return $this->responseError('Product not found');
        }

        $product->fill($data);
        $product->save();

        return $this->responseSuccess('Product updated', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->responseError('Product not found');
        }

        $product->delete();

        return $this->responseSuccess('Product deleted');
    }
}
