<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $teachers = Teacher::paginate(10);
        
        return view('admin.teacher.index', [
            'teachers' => $teachers
        ]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|unique:teacher,fullname',
            'gender' => 'required|in:Male,Female',
        ]);
    
        Teacher::create([
            'fullname' => $request->input('fullname'),
            'gender' => $request->input('gender'),
            
        ]);
    
        return redirect()->route('admin.teacher.index')->with('status', 'Teacher Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $teachers = Teacher::findOrFail($id);
        return view('admin.teacher.edit', compact('teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teachers = Teacher::findOrFail($id);
    
        $request->validate([
            'fullname' => 'required|unique:teacher,fullname,'.$id,
            'gender' => 'required|in:Male,Female',
        ]);
    
        $teachers->update([
            'fullname' => $request->input('fullname'),
            'gender' => $request->input('gender'),
        ]);
    
        return redirect()->route('admin.teacher.index')->with('status', 'Teacher Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
        $teacher->delete();
        return redirect()->route('admin.teacher.index')->with('status', 'Teacher Deleted Successfully');

    }
}
