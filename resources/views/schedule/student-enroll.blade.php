<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 me-3">Add Student</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('student.store') }}" method="POST">
                            @csrf
                            
                            {{-- Student Basic Information --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">LRN / ID Number</label>
                                    <input type="text" class="form-control" name="lrn" required maxlength="12" 
                                           pattern="\d{12}" title="12-digit Learner Reference Number">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                            </div>

                            {{-- Personal Details --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Sex</label>
                                    <select class="form-control" name="gender" required>
                                        <option value="MALE">Male</option>
                                        <option value="FEMALE">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Birthdate</label>
                                    <input type="date" class="form-control" name="bdate" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Birthplace</label>
                                    <input type="text" class="form-control" name="birthplace">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-control" name="age">
                                </div>
                            </div>

                            {{-- Contact Information --}}
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="contact_no">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" name="facebook">
                                </div>
                            </div>

                            {{-- Grade Level --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Grade Level</label>
                                    <select class="form-control" name="grade_lvl" required>
                                        <option value="">Select Grade Level</option>
                                        @foreach($gradeLevels as $grade)
                                            <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">School Year</label>
                                    <select class="form-control" name="sy_id" required>
                                        @foreach($schoolYears as $sy)
                                            <option value="{{ $sy->id }}" 
                                                    {{ $sy->status == 'ACTIVE' ? 'selected' : '' }}>
                                                {{ $sy->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Address Information --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Current Address</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="form-label">House #</label>
                                            <input type="text" class="form-control" name="current_house_no">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Street</label>
                                            <input type="text" class="form-control" name="current_street">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Barangay</label>
                                            <input type="text" class="form-control" name="current_barangay" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Municipality</label>
                                            <input type="text" class="form-control" name="current_municipality" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Family Information --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Guardian Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Guardian First Name</label>
                                            <input type="text" class="form-control" name="guardian_firstname" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Guardian Middle Name</label>
                                            <input type="text" class="form-control" name="guardian_middlename">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Guardian Last Name</label>
                                            <input type="text" class="form-control" name="guardian_lastname" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Guardian Contact</label>
                                            <input type="text" class="form-control" name="guardian_contact" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Additional Details --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Modality</label>
                                    <select class="form-control" name="modality" required>
                                        <option value="FACE TO FACE">Face to Face</option>
                                        <option value="MODULAR (PRINT)">Modular (Print)</option>
                                        <option value="MODULAR (DIGITAL)">Modular (Digital)</option>
                                        <option value="ONLINE">Online</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">4Ps Member</label>
                                    <select class="form-control" name="fourps">
                                        <option value="NO">No</option>
                                        <option value="YES">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Disabled</label>
                                    <select class="form-control" name="disable">
                                        <option value="NO">No</option>
                                        <option value="YES">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">IP Group</label>
                                    <select class="form-control" name="ip">
                                        <option value="NO">No</option>
                                        <option value="YES">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('student.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Student</button>
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