<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Acadyear;
use App\Models\Schedule;
use Barryvdh\DomPDF\PDF;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function getActiveSy()
    {
        return Acadyear::where('status', 'active')->first();
    }

    public function index()
    {
        // 
    
        $schedules = Schedule::paginate(10);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();
        $gradeLevels = GradeLevel::all();
        // $schedules = Schedule::all();

        $activeSy = $this->getActiveSy();

        return view('schedule.index', compact('schedules', 'subjects', 'teachers', 'sections', 'gradeLevels', 'activeSy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::with('gradeLevel')->get();
        $teachers = Teacher::all();
        $sections = Section::with('gradeLevel')->get();
        $gradeLevels = GradeLevel::all();

        $activeSy = $this->getActiveSy();

        return view('schedule.create', compact('subjects', 'teachers', 'sections', 'gradeLevels', 'activeSy'));
    }

    public function store(Request $request)
    {
        // Get the grade level ID based on the name
        $gradeLevelId = GradeLevel::where('name', $request->grade_lvl)->value('id');

        $validatedData = $request->validate([
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i|after:time_from',
            'days' => 'required|array',
            'room' => 'required|string',
            'subject_id' => 'required|exists:subject,id',
            'section_id' => 'required|exists:section,id',
            'teacher_id' => 'required|exists:teacher,id',
            // Remove validation for grade_lvl as it's not directly in the database
        ]);

        // Get the active school year if not provided
        if (empty($request->sy_id)) {
            $activeSy = $this->getActiveSy();
            $syId = $activeSy ? $activeSy->id : null;
        } else {
            $syId = $request->sy_id;
        }

        // Convert days array to comma-separated string
        $days = implode(',', $request->days);

        try {
            Schedule::create([
                'time_from' => $validatedData['time_from'],
                'time_to' => $validatedData['time_to'],
                'day' => $days,
                'room' => $validatedData['room'],
                'subject_id' => $validatedData['subject_id'],
                'section_id' => $validatedData['section_id'],
                'teacher_id' => $validatedData['teacher_id'],
                'sy_id' => $syId,
                'grade_lvl_id' => $gradeLevelId, // Use the correct field name and ID value
            ]);

            return redirect()->route('schedule.index')->with('success', 'Schedule created successfully.');
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Error creating schedule: ' . $e->getMessage());
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
public function edit(string $id)
{
    $schedule = Schedule::findOrFail($id);
    $subjects = Subject::with('gradeLevel')->get();
    $teachers = Teacher::all();
    $sections = Section::with('gradeLevel')->get();
    $gradeLevels = GradeLevel::all();
    $activeSy = $this->getActiveSy();

    // Convert comma-separated days to array for form
    $selectedDays = explode(',', $schedule->day);

    return view('schedule.edit', compact('schedule', 'subjects', 'teachers', 'sections', 'gradeLevels', 'activeSy', 'selectedDays'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    $schedule = Schedule::findOrFail($id);

    // Format time values if needed
    if ($request->has('time_from')) {
        // Parse the time and reformat it to ensure H:i format
        $timeFrom = date('H:i', strtotime($request->time_from));
        $request->merge(['time_from' => $timeFrom]);
    }
    
    if ($request->has('time_to')) {
        // Parse the time and reformat it to ensure H:i format
        $timeTo = date('H:i', strtotime($request->time_to));
        $request->merge(['time_to' => $timeTo]);
    }
    
    // Get the grade level ID based on the name
    $gradeLevelId = GradeLevel::where('name', $request->grade_lvl)->value('id');
    
    $validatedData = $request->validate([
        'time_from' => 'required|date_format:H:i',
        'time_to' => 'required|date_format:H:i|after:time_from',
        'days' => 'required|array',
        'room' => 'required|string',
        'subject_id' => 'required|exists:subject,id',
        'section_id' => 'required|exists:section,id',
        'teacher_id' => 'required|exists:teacher,id',
    ]);

    // Get the active school year if not provided
    if (empty($request->sy_id)) {
        $activeSy = $this->getActiveSy();
        $syId = $activeSy ? $activeSy->id : null;
    } else {
        $syId = $request->sy_id;
    }

    // Convert days array to comma-separated string
    $days = implode(',', $request->days);

    try {
        $schedule->update([
            'time_from' => $validatedData['time_from'],
            'time_to' => $validatedData['time_to'],
            'day' => $days,
            'room' => $validatedData['room'],
            'subject_id' => $validatedData['subject_id'],
            'section_id' => $validatedData['section_id'],
            'teacher_id' => $validatedData['teacher_id'],
            'sy_id' => $syId,
            'grade_lvl_id' => $gradeLevelId,
        ]);

        return redirect()->route('schedule.index')->with('status', 'Schedule updated successfully.');
    } catch (Exception $e) {
        Log::error($e);
        return back()->with('error', 'Error updating schedule: ' . $e->getMessage());
    }
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    try {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.index')->with('status', 'Schedule deleted successfully.');
    } catch (Exception $e) {
        Log::error($e);
        return back()->with('error', 'Error deleting schedule: ' . $e->getMessage());
    }
}



public function download(Request $request)
{
    try {
        $gradeLevel = $request->query('gradeLevel');
        $sectionId = $request->query('sectionId');

        if (!$gradeLevel || !$sectionId) {
            return back()->with('error', 'Please select both a grade level and section.');
        }

        // Get section information
        $section = Section::findOrFail($sectionId);
        
        // Fetch schedules for the selected grade level and section
        $schedules = Schedule::with(['subject', 'teacher', 'section', 'gradeLevel'])
            ->whereHas('gradeLevel', function ($query) use ($gradeLevel) {
                $query->where('name', $gradeLevel);
            })
            ->whereHas('section', function ($query) use ($sectionId) {
                $query->where('id', $sectionId);
            })
            ->get();

        $activeSy = $this->getActiveSy();

        if ($schedules->isEmpty()) {
            return back()->with('error', 'No schedule found for the selected class.');
        }

        // Load the PDF view with filtered schedules
        $pdf = app('dompdf.wrapper')->loadView('schedule.pdf', compact('schedules', 'activeSy', 'gradeLevel', 'section'));

        return $pdf->stream("Schedule_{$gradeLevel}_{$section->name}.pdf");
    } catch (\Exception $e) {
        Log::error($e);
        return back()->with('error', 'Error generating schedule PDF: ' . $e->getMessage());
    }
}



}