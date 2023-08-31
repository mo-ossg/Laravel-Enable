<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     // $this->authorize('viewAny', Category::class);
    //     $this->authorizeResource(Category::class, 'category');  // على مستوى النظام كامل resources عشان اطبق
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::all();
        return response()->view('cms.categories.index',['categories' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'description' => 'nullable|string|min:3|max:100',
            'status' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $category = new Category();
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->status = $request->input('status');
            $isSaved = $category->save();
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create Failed'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                "message" => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return response()->view('cms.categories.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'description' => 'nullable|string|min:3|max:100',
            'status' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $category->name        = $request->input('name');
            $category->description = $request->input('description');
            $category->status      = $request->input('status');
            $isUpdated = $category->save();
            return response()->json([
                'message' => $isUpdated ? 'Updated Successfully' : 'Update Failed'
            ],$isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $isDelete = $category->delete();
        return response()->json([
            'title'=> $isDelete ? 'Deleted successfully' : 'Deleted Failed',
            'icon' => $isDelete ? 'success' : 'error',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
