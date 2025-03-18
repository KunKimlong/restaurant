<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::orderBy('id','DESC')->get();
        foreach ($foods as $food) {
            $food->created_at_date = formatToDate($food->created_at);
            $food->updated_at_date = formatToDate($food->updated_at);
        }
        return view('food.index',compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "type"=>"required",
            "price"=>"required",
            "discount"=>"required",
            "image"=>"required",
        ]);

        $temporary = public_path("temporary") . DIRECTORY_SEPARATOR . $request->imageName;
        $directory = public_path("Store") . DIRECTORY_SEPARATOR . $request->imageName;
        if (!File::exists(public_path("Store"))) {
            File::makeDirectory(public_path("Store"), 0755, true);
        }
        if (File::move($temporary, $directory)) {
            File::deleteDirectory(public_path("temporary"));
        }

        try {
            Food::create([
                Food::NAME => $request->name,
                Food::TYPE => $request->type,
                Food::PRICE => $request->price,
                Food::DISCOUNT => $request->discount,
                Food::IMAGE => $request->imageName,
            ]);
            return redirect()->route('food.index')->with('success', 'Food created');
        } catch (Exception $e) {
            return redirect()->route('food.index')->with('error', 'Server error while creating ' . $e->__toString());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('food.update',compact("food"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>"required",
            "type"=>"required",
            "price"=>"required",
            "discount"=>"required",
        ]);

        $food = Food::findOrFail($id);

        if(!$food){

        }

        $imageName = str_replace("/Store/", "", $request->imageName);
        if ($food->image != $imageName) {
            $this->removeFileName($food->image);
            $temporary = public_path("temporary") . DIRECTORY_SEPARATOR . $request->imageName;
            $directory = public_path("Store") . DIRECTORY_SEPARATOR . $request->imageName;
            if (!File::exists(public_path("Store"))) {
                File::makeDirectory(public_path("Store"), 0755, true);
            }
            if (File::move($temporary, $directory)) {
                File::deleteDirectory(public_path("temporary"));
            }
        }
        try {
            $food->update([
                Food::NAME => $request->name,
                Food::TYPE => $request->type,
                Food::PRICE => $request->price,
                Food::DISCOUNT => $request->discount,
                Food::IMAGE => $request->imageName,
            ]);
            return redirect()->route('food.index',)->with('success', 'Food updated');
        } catch (Exception $e) {
            return redirect()->route('food.create', $id)->with('error', 'Server error while creating ' . $e->__toString());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        if($food){
            $food->delete();
            $foods = Food::orderBy('id','DESC')->get();
            $json = [
                "foods" => $foods,
                "statusText" => "Food remove success"
            ];
            return response($json,200);
        }
        else{
            return response("Food not found",404);
        }
    }

    public function removeFileName($fileName)
    {
        if (File::exists(public_path('Store/' . $fileName))) {
            File::delete(public_path('Store/' . $fileName));
        }
    }
}
