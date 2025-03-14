<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\Subject;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(10);
        $gradeLevels = GradeLevel::all();
            return view('admin.subject.index', [
                'subjects' => $subjects,
                'gradeLevels' => $gradeLevels,
            ]);


        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $gradeLevels = GradeLevel::all();
        return view('admin.subject.create', compact('gradeLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
            'grade_lvl_id' => 'required|array',
            'grade_lvl_id.*' => 'exists:grade_lvl,id', 
        ]);
    
        DB::beginTransaction();

        try {
            $subjectName = $request->input('subject_name'); 
    
            foreach ($request->input('grade_lvl_id') as $gradeLvlId) {
                $subject = new Subject;
                $subject->subject_name = $subjectName;  
                $subject->grade_lvl_id = $gradeLvlId; 
                $subject->save();
            }
    
            DB::commit();
            return redirect()->route('admin.subject.index')->with('status', 'Subjects Created Successfully');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return back()->with('error', 'Error creating subjects. Please try again.');
        }
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
    public function edit(Subject $subject)
    {
        $gradeLevels = GradeLevel::all();
        return view('admin.subject.edit', compact('subject', 'gradeLevels')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_name' => 'required|unique:subject,subject_name,' . $subject->id,
            'grade_lvl_id' => 'required|exists:grade_lvl,id',
        ]);
    
        $subject->update([
            'subject_name' => $request->input('subject_name'),
            'grade_lvl_id' => $request->input('grade_lvl_id'), 
        ]);
    
        return redirect()->route('admin.subject.index')->with('status', 'Subject updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();
        return redirect()->route('admin.subject.index')->with('status', 'Subject Deleted Successfuly');
    }
}
