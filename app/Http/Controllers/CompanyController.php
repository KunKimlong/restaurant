<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::first();
        return view('company.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
        ]);
        $company = Company::findOrFail($request->id);
        if($company){
            $temporary = public_path("temporary") . DIRECTORY_SEPARATOR . $request->imageName;
            $directory = public_path("Store") . DIRECTORY_SEPARATOR . $request->imageName;
            if (!File::exists(public_path("Store"))) {
                File::makeDirectory(public_path("Store"), 0755, true);
            }
            if(!File::exists($directory)){
                if (File::move($temporary, $directory)) {
                    File::deleteDirectory(public_path("temporary"));
                }
            }
            $company->update([
                Company::NAME => $request->name,
                Company::ADDRESS => $request->address,
                Company::LOGO => $request->imageName,
            ]);
            return redirect()->route('show.company')->with('succss','Setting saved');
        }
        else{
            return redirect()->route('show.company')->with('error','Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
