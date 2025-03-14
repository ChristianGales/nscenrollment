<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 me-3">Student Enrollment Form ( <span class="text-danger"> * </span> ) Required</h6>

                        <h6 class="m-0  me-3">FOR SCHOOL YEAR 2024-2025</h6>
                    </div>

                    
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('admin.student.store') }}" method="POST">
                            @csrf

                            {{-- LRN & Grade Level --}}
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">LRN / ID Number <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="lrn" required maxlength="12" 
                                                   pattern="\d{12}" title="12-digit Learner Reference Number">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Grade Level <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-control" name="grade_lvl" required>
                                                    <option value="">Select Grade Level</option>
                                                    {{-- @foreach($gradeLevels as $grade)
                                                        <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Student Basic Information --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Student Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Lastname <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Firstname <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Middlename <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                         <div class="col-md-3">
                                            <label class="form-label">Suffix</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-control">
                                                    <option value=""></option>
                                                    <option value="">Jr.</option>
                                                    <option value="">Sr.</option>
                                                    <option value="">I</option>
                                                    <option value="">II</option>
                                                    <option value="">III</option>
                                                    <option value="">IV</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Sex <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-control">
                                                    <option value=""></option>
                                                    <option value="">Male</option>
                                                    <option value="">Female</option>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Birthdate <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Birth Place <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">PSA Number <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Facebook Name</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Email</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Contact Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Current Address --}}
                            <div class="card mb-2">
                                <div class="card-header">
                                    <h6 class="m-0">Address</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">House Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Street</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Municipality <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Province <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Country <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                             {{-- Permanent Address --}}
                             {{-- <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Permanent Address</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">House Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Street</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Barangay</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Municipality</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Province</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Country</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Zip Code</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                             </div> --}}

                            {{-- Family Pies --}}
                            <div class="card mb-2">
                                <div class="card-header">
                                    <h6 class="m-0">Family Background</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Father Fullname</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-3">
                                            <label class="form-label">Middlename</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="test" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Lastname</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> --}}

                                        <div class="col-md-3">
                                            <label class="form-label">Father Contact Number <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Mother Fullname <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Mother Contact Number <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Guardian Fullname <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Guardian Contact Number <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            {{-- <div class="card mb-2">
                                <div class="card-header">
                                    <h6 class="m-0">Mother</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Fullname</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Middlename</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Lastname</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Contact Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}
                          
                            {{-- <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Guardian</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Fullname</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Middlename</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Lastname</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Contact Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}

                            {{-- # --}}
                            {{-- <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label class="form-label">Balik/Aral Transferee</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Last School Attended ('N/A') if not applicable</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label class="form-label">Last School Year Completed ('N/A') if not applicable</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Last Grade Level ('N/A') if not applicable</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">School ID Last School Attended ('N/A') if not applicable</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> --}}

                             {{-- # --}}
                             {{-- <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <label class="form-label">Disabled</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select type="text" class="form-control">
                                                    <option value="">Yes</option>
                                                    <option value="">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Member of 4ps</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select type="text" class="form-control">
                                                    <option value="">Yes</option>
                                                    <option value="">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Belong to IP Group</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select type="text" class="form-control">
                                                    <option value="">Yes</option>
                                                    <option value="">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Prepared Modality</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-control" name="modality" required>
                                                    <option value="FACE TO FACE">Face to Face</option>
                                                    <option value="MODULAR (PRINT)">Modular (Print)</option>
                                                    <option value="MODULAR (DIGITAL)">Modular (Digital)</option>
                                                    <option value="ONLINE">Online</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                   
                                </div>
                            </div> --}}
                          
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.student.index') }}" class="btn btn-inline-dark my-4 mb-2 me-2">Cancel</a>
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Enroll Student</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Optional: Add client-side validations or dynamic form behaviors
    </script>
    @endpush
</x-app-layout>