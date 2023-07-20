<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = City::all();
        return response()->view('cms.cities.index',['cities' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:45', // هين بتكتب شو الاشياء المطلوبة في الاسم
        ],[
            'name.required'=>'Enter city name!',      // من هين بقدر اغير رسالة الخطأ لكل خطأ بدل الافتراضي
            'name.min'     =>'Please enter at least 3 characters'
        ]);

        // dd($request->all()); // form هيك انا وصلت للبيانات الي بعتها المستخدم داخل

        $city = new City();
        // $city->name = $request->get('name');
        // $city->name = $request->name;
        $city->name = $request->input('name');
        $isSaved = $city->save();

        session()->flash('alert-type',$isSaved ? "success" : "danger");
        session()->flash('message'   ,$isSaved ? "Created Successfully" : "Create failed!");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
        return response()->view('cms.cities.edit',['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
        // dd(request()->all());

        $request->validate([
            'name' => 'required|string|min:3|max:45'
        ]);

        $city->name = $request->input('name');
        $isUpdated = $city->save();

        session()->flash('message',$isUpdated ? "Updated Successfully" : "Update Failed");
        session()->flash('alert-type',$isUpdated ? "success" : "danger");

        // return redirect()->back();
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
        // dd('Delete');
        $isDeleted = $city->delete();
        return redirect()->back();
    }
}
