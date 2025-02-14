<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Gate::denies('admin')){
            abort(403,"You do not have permission in 14th February");
        }
        $total =(($request->page??1)-1)*5;
        $branches = Branch::orderBy('id', 'DESC')->offset($total)->limit(5)->get();
        foreach ($branches as $branch) {
            $branch->created_at = formatToDate($branch->created_at);
            $branch->updated_at = formatToDate($branch->updated_at);
        }
        $totalBranches = Branch::count();
        $pages = ceil($totalBranches/5);
        return view('branch.index', compact('branches','pages','total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch = new Branch();
        $provinces = $branch->getAllProvinces();
        $suggestNumber = Branch::count() + 1;
        return view('branch.create', compact('provinces', 'suggestNumber'));
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
        $temporary = public_path("temporary") . DIRECTORY_SEPARATOR . $request->imageName;
        $directory = public_path("Store") . DIRECTORY_SEPARATOR . $request->imageName;
        if (!File::exists(public_path("Store"))) {
            File::makeDirectory(public_path("Store"), 0755, true);
        }
        if (File::move($temporary, $directory)) {
            File::deleteDirectory(public_path("temporary"));
        }


        try {
            Branch::create([
                Branch::NUMBER => $request->number,
                Branch::STREET => $request->street,
                Branch::VILLAGE => $request->village,
                Branch::COMMUNE => $request->commune,
                Branch::DISTRICT => $request->district,
                Branch::PROVINCE => $request->province,
                Branch::IMAGE => $request->imageName,
            ]);
            return redirect()->route('branch.index')->with('success', 'Branch created');
        } catch (Exception $e) {
            return redirect()->route('branch.index')->with('error', 'Server error while creating ' . $e->__toString());
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
        $object = new Branch();
        $provinces = $object->getAllProvinces();
        return view('branch.update', compact('branch', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "number" => "required|integer",
            "imageName" => "required|string"
        ]);

        $branch = Branch::findOrFail($id);

        if ($branch) {
            $imageName = str_replace("/Store/","",$request->imageName);
            if ($imageName != $branch->image) {
                $this->removeFileName($branch->image);
                $temporary = public_path('temporary' . DIRECTORY_SEPARATOR . $request->imageName);
                $directory = public_path('Store' . DIRECTORY_SEPARATOR . $request->imageName);
                if (!File::exists(public_path("Store"))) {
                    File::makeDirectory(public_path("Store"), 0755, true);
                }
                if (File::move($temporary, $directory)) {
                    File::deleteDirectory(public_path("temporary"));
                }
            }
            try {
                $branch->update([
                    Branch::NUMBER => $request->number,
                    Branch::STREET => $request->street,
                    Branch::VILLAGE => $request->village,
                    Branch::COMMUNE => $request->commune,
                    Branch::DISTRICT => $request->district,
                    Branch::PROVINCE => $request->province,
                    Branch::IMAGE => $imageName,
                ]);
                return redirect()->route('branch.index')->with('success', 'Branch updated');
            } catch (Exception $e) {
                return redirect()->route('branch.index')->with('error', 'Server error while updating ' . $e->__toString());
            }
        } else {
            return redirect()->route('branch.index')->with('error', 'This branch is not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        if ($branch) {
            $branch->delete();
            $branches = Branch::orderBy('id', 'DESC')->get();
            foreach ($branches as $branch) {
                $branch->created_at = formatToDate($branch->created_at);
                $branch->updated_at = formatToDate($branch->updated_at);
            }
            $json = [
                "branches" => $branches,
                "statusText" => "Branch remove success"
            ];
            return response($json, 200);
        } else {
            return response("Branch not found", 404);
        }
    }

    public function uploadAjax(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,pdf',
        ]);
        $image = $request->file('image');
        $fileName = date('d-m-y-h-i-s') . '-' . $image->getClientOriginalName();
        $directory = public_path('temporary');
        $image->move($directory, $fileName);
        return asset('temporary/' . $fileName);
    }

    public function removeFileName($fileName)
    {
        if (File::exists(public_path('Store/' . $fileName))) {
            File::delete(public_path('Store/' . $fileName));
        }
    }
}
