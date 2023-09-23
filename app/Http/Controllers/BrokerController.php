<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class BrokerController extends Controller
{

    // public function __construct() {
    // $this->authorizeResource(Broker::class, 'broker');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Broker::withCount('permissions')->get();
        return response()->view('cms.brokers.index', ['brokers' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.brokers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'email' => 'required|string|email|unique:brokers,email',
            'name' => 'required|string|min:3|max:45',
        ]);
        if (!$validator->fails()) {
            $broker = new Broker();
            $broker->name = $request->input('name');
            $broker->email = $request->input('email');
            $broker->password = Hash::make(123456);
            $isSaved = $broker->save();
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
    public function show(Broker $broker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Broker $broker)
    {
        //
        return response()->view('cms.brokers.edit', ['broker' => $broker]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Broker $broker)
    {
        //
        $validator = Validator($request->all(), [
            'email' => 'required|string|email|unique:brokers,email',
            'name' => 'required|string|min:3|max:45',
        ]);
        if (!$validator->fails()) {
            $broker->name = $request->input('name');
            $broker->email = $request->input('email');
            $isSaved = $broker->save();
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Updated Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                "message" => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Broker $broker)
    {
        //
        $isDelete = $broker->delete();
        return response()->json([
            'title'=> $isDelete ? 'Deleted successfully' : 'Deleted Failed',
            'icon' => $isDelete ? 'success' : 'error',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
