<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::orderBy('id','DESC')->get();
        foreach($positions as $position){
            $position->created_at_date = formatToDate($position->created_at);
            $position->updated_at_date = formatToDate($position->updated_at);
        }
        return view('position.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|string|min:5|max:100',
        ]);

        try{
            Position::create([
                Position::NAME => $request->name,
            ]);
            return redirect()->route('position.index')->with('success','Position created');
        }catch(Exception $e){
            return redirect()->route('position.index')->with('error','Server error while creating');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('position.update',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|min:5|max:100',
        ]);
        $position = Position::findOrFail($id);
        if($position){
            try{
                $position->update([
                    Position::NAME => $request->name,
                ]);
                return redirect()->route('position.index')->with('success','Position updated');
            }catch(Exception $e){
                return redirect()->route('position.index')->with('error','Server error while updating');
            }
        }else{
            return redirect()->route('position.index')->with('error','Position not found');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }
}
