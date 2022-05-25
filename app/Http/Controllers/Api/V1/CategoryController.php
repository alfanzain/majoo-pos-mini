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

            return $this->responseSuccess('', $categories->paginate(10));
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
            'name' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $this->responseError('Category could not be created. Please try again');
        }

        $category = Category::create($data);

        return $this->responseSuccess('Category created');
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
            return $this->responseError('Category not found');
        }

        try {
            $category = Category::where('id', $id)->get();

            return $this->responseSuccess('', $category);
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
            'name' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $this->responseError('Category could not be updated. Please try again');
        }

        $category = Category::find($id);

        if (!$category) {
            return $this->responseError('Category not found');
        }

        $category->fill($data);
        $category->save();

        return $this->responseSuccess('Category updated', $category);
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
            return $this->responseError('Category not found');
        }

        if ($category->products()->count() > 0) {
            return $this->responseError('This category has used on one or more products');
        }

        $category->delete();

        return $this->responseSuccess('Category deleted');
    }
}
