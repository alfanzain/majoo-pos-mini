<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        try {
            $categories = Category::query();

            $searchQuery = request()->query('q');

            $categories->when($searchQuery, function($query) use ($searchQuery) {
                return $query->where("name", "LIKE", "%" . strtolower($searchQuery) . "%");
            });

            return response()->json([
                'status' => 'success',
                'data' => $categories->paginate(10),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
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
            'name' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                // 'message' => $validator->errors()
                'message' => 'Category could not be created. Please try again'
            ]);
        }

        $category = Category::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created',
            'data' => $category
        ]);
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
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ]);
        }

        try {
            $category = Category::where('id', $id)->get();

            return response()->json([
                'status' => 'success',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
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
            'name' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        $category->fill($data);
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated',
            'data' => $category
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
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ]);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted'
        ]);
    }
}
