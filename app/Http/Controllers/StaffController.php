<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Position;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Staff::where('role', 'admin')->first();
        $staffs = Staff::where('role', '<>', 'admin')->orderBy('id', 'DESC')->get();
        if ($admin) {
            $staffs = collect([$admin])->merge($staffs);
        }
        $staffs = collect($staffs);
        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::orderBy('id', 'desc')->get()->pluck('name', 'id');
        $branches = Branch::orderBy('id', 'desc')->get()->pluck('number', 'id');
        return view('staff.create', compact('positions', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "first_name" => 'required|string',
            "last_name" => 'required|string',
            "gender" => 'required|string',
            "join_date" => 'required',
            "date_of_birth" => 'required',
            "role" => 'required',
        ]);
        if (!empty($request->imageName)) {
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
            Staff::create([
                Staff::FISRT_NAME => $request->first_name,
                Staff::LAST_NAME => $request->last_name,
                Staff::GENDER => $request->gender,
                Staff::PHONE_NUMBER => $request->phone_number,
                Staff::EMAIL => $request->email,
                Staff::PASSWORD => Hash::make($request->password),
                Staff::POSITION_ID => $request->position,
                Staff::BRANCH_ID => $request->branch,
                Staff::JOIN_DATE => $request->join_date,
                Staff::DATE_OF_BIRTH => $request->date_of_birth,
                Staff::SALARY => $request->salary,
                Staff::ROLE => $request->role,
                Staff::ADDRESS => $request->address,
                Staff::PROFILE => $request->imageName
            ]);
            return redirect()->route('staff.create')->with('success', 'Staff created');
        } catch (Exception $e) {
            return redirect()->route('staff.create')->with('error', 'Server error while creating ' . $e->__toString());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        if($staff){
            return view("staff.show",compact('id','staff'));
        }
        else{
            return redirect()->route('staff.index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $positions = Position::orderBy('id', 'desc')->get()->pluck('name', 'id');
        $branches = Branch::orderBy('id', 'desc')->get()->pluck('number', 'id');
        $staff = Staff::findOrFail($id);
        return view('staff.update', compact('positions', 'branches', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "first_name" => 'required|string',
            "last_name" => 'required|string',
            "gender" => 'required|string',
            "join_date" => 'required',
            "date_of_birth" => 'required',
            "role" => 'required',
        ]);
        $staff = Staff::findOrFail($id);
        if (!empty($request->imageName)) {
            $imageName = str_replace("/Store/", "", $request->imageName);
            if ($staff->profile != $imageName) {
                $this->removeFileName($staff->profile);
                $temporary = public_path("temporary") . DIRECTORY_SEPARATOR . $request->imageName;
                $directory = public_path("Store") . DIRECTORY_SEPARATOR . $request->imageName;
                if (!File::exists(public_path("Store"))) {
                    File::makeDirectory(public_path("Store"), 0755, true);
                }
                if (File::move($temporary, $directory)) {
                    File::deleteDirectory(public_path("temporary"));
                }
            }
        }

        try {
            $staff->update([
                Staff::FISRT_NAME => $request->first_name,
                Staff::LAST_NAME => $request->last_name,
                Staff::GENDER => $request->gender,
                Staff::PHONE_NUMBER => $request->phone_number,
                Staff::EMAIL => $request->email,
                Staff::PASSWORD => Hash::make($request->password),
                Staff::POSITION_ID => $request->position,
                Staff::BRANCH_ID => $request->branch,
                Staff::JOIN_DATE => $request->join_date,
                Staff::DATE_OF_BIRTH => $request->date_of_birth,
                Staff::SALARY => $request->salary,
                Staff::ROLE => $request->role,
                Staff::ADDRESS => $request->address,
                Staff::PROFILE => $request->imageName
            ]);
            return redirect()->route('staff.edit', $id)->with('success', 'Staff updated');
        } catch (Exception $e) {
            return redirect()->route('staff.create', $id)->with('error', 'Server error while creating ' . $e->__toString());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        if($staff){
            $staff->delete();
            $staffs = Staff::orderBy('id','DESC')->get();
            foreach($staffs as $staff){
                $staff->position_name = $staff->position->name;
                $staff->branch_name = "Resturant ".convertToRoman($staff->branch->number);
            }
            $json = [
                "staffs" => $staffs,
                "statusText" => "Staff remove success"
            ];
            return response($json, 200);
        }else{
            return response("Staff not found",404);
        }
    }

    public function removeFileName($fileName)
    {
        if (File::exists(public_path('Store/' . $fileName))) {
            File::delete(public_path('Store/' . $fileName));
        }
    }
}
