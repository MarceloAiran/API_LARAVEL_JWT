<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreUpdateCategoryFormRequest;

class CategoryController extends Controller
{
    private $category, $totalPage = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request)
    {
        $categories = $category->getResults($request->name);
                        
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$category = $this->category->find($id))
        return response()->json(['error' => 'not found'], 404);

        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'not found'], 404);

        $category->update($request->all());

        //Por padrao o status 200 já é passado automaticamente.
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->category->find($id))
        return response()->json(['error' => 'not found'], 404);

        $category->delete();

        return response()->json(['success' => true], 204);
    }

    public function products($id)
    {
        // if(!$category = $this->category->with(['products'])->find($id))
        if(!$category = $this->category->find($id))
                return response()->json(['error' => 'not found'], 404);

        $products = $category->products()->paginate($this->totalPage);

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);



    }

    
}
