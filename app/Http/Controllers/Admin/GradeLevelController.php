<?php

namespace App\Http\Controllers\Admin;

use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gradeLevels =  GradeLevel::paginate(10);

        return view('admin.grade.index', [
            'gradeLevels' => $gradeLevels
        ]);
        
        $gradeLevels = GradeLevel::all(); 
        return view('admin.grade.index', compact('gradeLevels')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.grade.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:grade_lvl,name', 
        ]);

        GradeLevel::create([
            'name' => $request->input('name'), // Use $request->input()
        ]);

        return redirect()->route('admin.grade.index')->with('status', 'Grade Level Created Successfully'); // Use route() helper
    }

    public function show($id)
    {
        $record = GradeLevel::findOrFail($id);
        return view('admin.record.show', compact('record')); // Ensure this view exists and is correct
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $gradeLevels = GradeLevel::findOrFail($id);
        return view('admin.grade.edit', compact('gradeLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $gradeLevels = GradeLevel::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:grade_lvl,name',
        ]);

        $gradeLevels->update([
            'name' => $request->name,
            
        ]);
    
        return redirect()->route('admin.grade.index')->with('status', 'Grade Level Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeLevel $gradeLevel) // Route model binding (recommended)
    {
        $gradeLevel->delete();
        return redirect()->route('admin.grade.index')->with('status', 'Grade Level Deleted Successfully');
    }
    
   
    
   
}
