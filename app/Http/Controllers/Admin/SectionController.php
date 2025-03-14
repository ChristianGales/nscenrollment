<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Teacher;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $sections = Section::paginate(10);
        $gradeLevels = GradeLevel::all();
        return view('admin.section.index', [
            'sections' => $sections,
            'gradeLevels' => $gradeLevels,
        ]);

        $sections = Section::all();
        return view('admin.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gradeLevels = GradeLevel::all(); // Fetch grade levels
        return view('admin.section.create', compact('gradeLevels')); // Pass to the view using compact
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:section',
            'grade_lvl_id' => 'required|exists:grade_lvl,id', // Validate existence in grade_lvl table
        ]);

        Section::create([
            'name' => $request->input('name'),
            'grade_lvl_id' => $request->input('grade_lvl_id'), // Use the correct input name
        ]);

        return redirect()->route('admin.section.index')->with('status', 'Section Created Successfully');
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
    public function edit(Section $section) // Use route model binding
    {
        $gradeLevels = GradeLevel::all();
        return view('admin.section.edit', compact('section', 'gradeLevels')); 
    }

    public function update(Request $request, Section $section) // Use route model binding
    {
        $request->validate([
            'name' => 'required|unique:section,name,' . $section->id, // Unique except for the current section
            'grade_lvl_id' => 'required|exists:grade_lvl,id',
        ]);

        $section->update([
            'name' => $request->input('name'),
            'grade_lvl_id' => $request->input('grade_lvl_id'),
        ]);

        return redirect()->route('admin.section.index')->with('status', 'Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
        $section->delete();
        return redirect()->route('admin.section.index')->with('status', 'Section Deleted Successfully');

    }
}
