<?php

namespace App\Http\Controllers\Admin;

use App\Models\Acadyear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AcadYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $acadYears = Acadyear::paginate(10);
        
            return view('admin.year.index', [
                'acadYears' => $acadYears
            ]);

        // $acadYears = Acadyear::all();
        // return view('admin.year.index',  compact('acadYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:school_yr,name', 
        ]);
    
        Acadyear::create([
            'name' => $request->input('name'),
            'status' => 'inactive',
            'is_active' => false, 
        ]);
    
        return redirect()->route('admin.year.index')->with('status', 'Academic Year Created Successfully');
    }

    public function activate(Acadyear $acadYear)
    {
        // 1. Deactivate any currently active academic year
        Acadyear::where('is_active', true)->update(['is_active' => false, 'status' => 'inactive']); // Also set status to inactive
    
        // 2. Activate the selected academic year
        $acadYear->is_active = true;
        $acadYear->status = 'active'; // Set status to active
        $acadYear->save();
    
        return redirect()->back()->with('status', 'Academic Year Activated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $record = Record::findOrFail($id);
        // return view('admin.record.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $acadYears = Acadyear::findOrFail($id);
        return view('admin.year.edit', compact('acadYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $acadYears = Acadyear::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:school_yr,name',
        ]);

        $acadYears->update([
            'name' => $request->name,
            
        ]);
    
        return redirect()->route('admin.year.index')->with('status', 'Academic Year Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acadyear $acadYear)
    {
        //
        $acadYear->delete();
        return redirect()->route('admin.year.index')->with('status', 'Academic Year Deleted Successfully');
    }

   
}
