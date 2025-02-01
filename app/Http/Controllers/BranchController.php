<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\CommonMark\Delimiter\Bracket;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::orderBy('id','DESC')->get();
        foreach($branches as $branch){
            $branch->created_at = formatToDate($branch->created_at);
            $branch->updated_at = formatToDate($branch->updated_at);
        }
        return view('branch.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch = new Branch();
        $provinces = $branch->getAllProvinces();
        $suggestNumber = Branch::count()+1;
        return view('branch.create',compact('provinces','suggestNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "number" => "required|integer",
            "imageName" => "required|string"
        ]);
        $temporary = public_path("temporary").DIRECTORY_SEPARATOR.$request->imageName;
        $directory = public_path("Store").DIRECTORY_SEPARATOR.$request->imageName;
        if(!File::exists(public_path("Store"))){
            File::makeDirectory(public_path("Store"),0755,true);
        }
        if(File::move($temporary,$directory)){
            File::deleteDirectory(public_path("temporary"));
        }


        try{
            Branch::create([
                Branch::NUMBER => $request->number,
                Branch::STREET => $request->street,
                Branch::VILLAGE => $request->village,
                Branch::COMMUNE => $request->commune,
                Branch::DISTRICT => $request->district,
                Branch::PROVINCE => $request->province,
                Branch::IMAGE => $request->imageName,
            ]);
            return redirect()->route('branch.index')->with('success','Branch created');
        }catch(Exception $e){
            return redirect()->route('branch.index')->with('error','Server error while creating '.$e->__toString());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.update',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        if($branch){
            // $branch->delete();
            return response("Branch remove success",200);
        }
        else{
            return response("Branch not found",404);
        }
    }

    public function uploadAjax(Request $request){
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,pdf',
        ]);
        $image = $request->file('image');
        $fileName = date('d-m-y-h-i-s').'-'.$image->getClientOriginalName();
        $directory = public_path('temporary');
        $image->move($directory, $fileName);
        return asset('temporary/'.$fileName);
    }
}
