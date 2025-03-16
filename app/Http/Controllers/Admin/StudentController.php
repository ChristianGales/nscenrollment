<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Acadyear;

use App\Models\Schedule;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Models\StudentSubject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
   


     public function index()
     {
         // Get all students with pagination
         $students = Student::paginate(10);
         $gradeLevels = GradeLevel::all();
         $sections = Section::all();
     
         // Fetch the active school year
         $schoolYear = Acadyear::where('is_active', 1)->first();

         
         $statuses = ['Enrolled', 'Not Enrolled', 'Transferred', 'Graduated']; 
     
         return view('admin.student.index', [
             'students' => $students,
             'gradeLevels' => $gradeLevels,
             'sections' => $sections,
             'statuses' => $statuses,
             'schoolYear' => $schoolYear,
         ]);
     }
     

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $gradeLevels = DB::table('grade_lvl')->get();
        return view('admin.student.create', compact('gradeLevels'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
    $validated = $request->validate([
        'lrn' => 'required|digits:12|unique:student,lrn',
        'grade_lvl_id' => 'required|exists:grade_lvl,id',
        'lastname' => 'required|string|max:255',
        'firstname' => 'required|string|max:255',
        'middlename' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:10',
        'gender' => 'required|in:Male,Female',
        'bday' => 'required|date|before:today',
        'bplace' => 'required|string|max:255',
        'PSA_num' => 'required|string|max:255|unique:student,PSA_num',
        'fb_name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'contact_no' => 'nullable|string|max:20',
        'house_no' => 'nullable|string|max:50',
        'street' => 'nullable|string|max:255',
        'bgry' => 'required|string|max:255',
        'municipality' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'zipcode' => 'required|string|max:20',
        'fathername' => 'nullable|string|max:255',
        'f_contact' => 'required|string|max:20',
        'mothername' => 'required|string|max:255',
        'm_contact' => 'required|string|max:20',
        'guardian' => 'required|string|max:255',
        'g_contact' => 'required|string|max:20',
        
    ], [
        'lrn.required' => 'The LRN / ID Number is required.',
        'lrn.digits' => 'The LRN / ID Number must be exactly 12 digits.',
        'lrn.unique' => 'This LRN / ID Number is already registered.',
        'grade_lvl_id.required' => 'Please select a grade level.',
        'grade_lvl_id.exists' => 'The selected grade level is invalid.',    
        'gender.required' => 'Please select a gender.',
        'bday.before' => 'The birthdate must be a date before today.',
        'PSA_num.unique' => 'This PSA Number is already registered.',
        'email.email' => 'Please enter a valid email address.',
    ]);

        // Get the current school year
        $currentSchoolYear = Acadyear::where('status', 'active')->first();
        
        if (!$currentSchoolYear) {
            return redirect()->back()->with('error', 'No active school year found.');
        }

        // Find a section for the grade level
        $section = Section::where('grade_lvl_id', $request->grade_lvl_id)->first();
        
        if (!$section) {
            return redirect()->back()->with('error', 'No section found for this grade level.');
        }

        DB::beginTransaction();
        try {
            // Create new student with auto-assigned section
            $student = Student::create(array_merge(
                $request->all(),
                ['section_id' => $section->id]
            ));

           // Get subjects for this grade level (update to use grade_lvl_id)
            $subjects = Subject::where('grade_lvl_id', $request->grade_lvl_id)->get();
            
            // Create student_subjects records
            foreach ($subjects as $subject) {
                StudentSubject::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'sy_id' => $currentSchoolYear->id,
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('admin.student.index')
                ->with('success', 'Student enrolled successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $gradeLevels = DB::table('grade_lvl')->get();
        $sections = Section::where('grade_lvl_id', $student->grade_lvl_id)->get();

        return view('admin.student.view', compact('student', 'gradeLevels', 'sections'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $gradeLevels = DB::table('grade_lvl')->get();
        
        return view('admin.student.edit', compact('student', 'gradeLevels'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'lrn' => 'required|digits:12|unique:student,lrn,' . $student->id,
            // 'grade_lvl_id' => 'required|exists:grade_lvl,id',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'gender' => 'required|in:Male,Female',
            'bday' => 'required|date|before:today',
            'bplace' => 'required|string|max:255',
            'PSA_num' => 'required|string|max:255|unique:student,PSA_num,' . $student->id,
            'fb_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'contact_no' => 'nullable|string|max:20',
            'house_no' => 'nullable|string|max:50',
            'street' => 'nullable|string|max:255',
            'bgry' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'fathername' => 'nullable|string|max:255',
            'f_contact' => 'required|string|max:20',
            'mothername' => 'required|string|max:255',
            'm_contact' => 'required|string|max:20',
            'guardian' => 'required|string|max:255',
            'g_contact' => 'required|string|max:20',
        ], [
            'lrn.required' => 'The LRN / ID Number is required.',
            'lrn.digits' => 'The LRN / ID Number must be exactly 12 digits.',
            'lrn.unique' => 'The LRN / ID Number has already been taken.',
        
            'grade_lvl_id.required' => 'Please select a grade level.',
            'grade_lvl_id.exists' => 'The selected grade level is invalid.',    
            'gender.required' => 'Please select a gender.',
            'bday.before' => 'The birthdate must be a date before today.',
        
            'email.email' => 'Please enter a valid email address.',
            'PSA_num.unique' => 'The PSA Number has already been taken.',
        ]);
        

        $student->update($request->all());
        
        return redirect()->route('admin.student.index')
            ->with('success', 'Student information updated successfully');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.student.index')
            ->with('success', 'Student deleted successfully');
    }

    public function download(Student $student) {
        // Get the student's subjects from student_subject table
        $studentSubjects = DB::table('student_subject')
                            ->where('student_id', $student->id)
                            ->pluck('subject_id');
    
        // Fetch subjects directly, ensuring all enrolled subjects are included
        $subjects = Subject::whereIn('id', $studentSubjects)->get();
    
        // Get schedules for these subjects in the student's section and grade level
        $schedules = Schedule::with(['subject', 'section', 'teacher'])
                            ->where('section_id', $student->section_id)
                            ->where('grade_lvl_id', $student->grade_lvl_id)
                            ->whereIn('subject_id', $studentSubjects)
                            ->get()
                            ->keyBy('subject_id'); // Use subject_id as key for quick lookup
    
        $scheduleData = [];
    
        foreach ($subjects as $subject) {
            $schedule = $schedules->get($subject->id); // Retrieve schedule if it exists
    
            $scheduleData[] = [
                'subject' => $subject->subject_name,
                'time' => $schedule ? ($schedule->time_from . ' - ' . $schedule->time_to) : 'N/A',
                'day' => $schedule ? $schedule->day : 'N/A',
                'room' => $schedule ? $schedule->room : 'N/A',
                'teacher' => $schedule ? $schedule->teacher->fullname : 'N/A',
            ];
        }
    
        // Get the current school year
        $schoolYear = Acadyear::where('is_active', 1)->first();
    
        // Get the student's grade level and section
        $gradeSection = Section::find($student->section_id);
        $gradeLevel = GradeLevel::find($student->grade_lvl_id);
    
        // Generate PDF
        $pdf = \PDF::loadView('admin.student.pdf', [
            'student' => $student,
            'scheduleData' => $scheduleData,
            'schoolYear' => $schoolYear,
            'gradeLevel' => $gradeLevel,
            'section' => $gradeSection,
        ]);
    
        // Download the PDF with a filename based on the student's name
        return $pdf->stream('Certificate_of_Registration_'.$student->lastname.'_'.$student->firstname.'.pdf');
    }
    
}