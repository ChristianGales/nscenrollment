<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 me-3">Edit Student ( <span class="text-danger"> * </span> ) Required</h6>
                        <h6 class="m-0 me-3">FOR SCHOOL YEAR 2024-2025</h6>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mx-3 mt-3 text-white">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- LRN & Grade Level --}}
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">LRN / ID Number <span class="text-danger">*</span>
                                                @error('lrn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('lrn') is-invalid @enderror">
                                                <input type="number" class="form-control" name="lrn" maxlength="12" pattern="\d{12}" value="{{ old('lrn', $student->lrn) }}">
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <label class="form-label">Grade Level <span class="text-danger">*</span>
                                                @error('grade_lvl_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('grade_lvl_id') is-invalid @enderror">
                                                <select class="form-control @error('grade_lvl_id') is-invalid @enderror" name="grade_lvl_id">
                                                    <option value="">Select Grade Level</option>
                                                    @foreach($gradeLevels as $gradeLevel)
                                                        <option value="{{ $gradeLevel->id }}" {{ old('grade_lvl_id', $student->grade_lvl_id) == $gradeLevel->id ? 'selected' : '' }}>{{ $gradeLevel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6">
                                            <label class="form-label">Student Status <span class="text-danger">*</span>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            
                                            <div class="input-group input-group-outline mb-3 @error('status') is-invalid @enderror">
                                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                                    <option value="">Select Student Status</option>
                                                    <option value="Enrolled" {{ old('status', $student->status) == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                                                    <option value="Not Enrolled" {{ old('status', $student->status) == 'Not Enrolled' ? 'selected' : '' }}>Not Enrolled</option>
                                                    <option value="Transferred" {{ old('status', $student->status) == 'Transferred' ? 'selected' : '' }}>Transferred</option>
                                                    <option value="Graduated" {{ old('status', $student->status) == 'Graduated' ? 'selected' : '' }}>Graduated</option>
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
                                            <label class="form-label">Lastname <span class="text-danger">*</span>
                                                @error('lastname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('lastname') is-invalid @enderror">
                                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $student->lastname) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Firstname <span class="text-danger">*</span>
                                                @error('firstname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('firstname') is-invalid @enderror">
                                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $student->firstname) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Middlename <span class="text-danger">*</span>
                                                @error('middlename')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('middlename') is-invalid @enderror">
                                                <input type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename', $student->middlename) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Suffix</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-control" name="suffix">
                                                    <option value=""></option>
                                                    <option value="Jr." {{ old('suffix', $student->suffix) == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                    <option value="Sr." {{ old('suffix', $student->suffix) == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                    <option value="I" {{ old('suffix', $student->suffix) == 'I' ? 'selected' : '' }}>I</option>
                                                    <option value="II" {{ old('suffix', $student->suffix) == 'II' ? 'selected' : '' }}>II</option>
                                                    <option value="III" {{ old('suffix', $student->suffix) == 'III' ? 'selected' : '' }}>III</option>
                                                    <option value="IV" {{ old('suffix', $student->suffix) == 'IV' ? 'selected' : '' }}>IV</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Gender <span class="text-danger">*</span>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('gender') is-invalid @enderror">
                                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Birthdate <span class="text-danger">*</span>
                                                @error('bday')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('bday') is-invalid @enderror">
                                                <input type="date" class="form-control @error('bday') is-invalid @enderror" name="bday" value="{{ old('bday', $student->bday) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Birth Place <span class="text-danger">*</span>
                                                @error('bplace')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('bplace') is-invalid @enderror">
                                                <input type="text" class="form-control @error('bplace') is-invalid @enderror" name="bplace" value="{{ old('bplace', $student->bplace) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">PSA Number <span class="text-danger">*</span>
                                                @error('PSA_num')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('PSA_num') is-invalid @enderror">
                                                <input type="text" class="form-control @error('PSA_num') is-invalid @enderror" name="PSA_num" value="{{ old('PSA_num', $student->PSA_num) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Facebook Name <span class="text-danger">*</span>
                                                @error('fb_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('fb_name') is-invalid @enderror">
                                                <input type="text" class="form-control @error('fb_name') is-invalid @enderror" name="fb_name" value="{{ old('fb_name', $student->fb_name) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Email <span class="text-danger">*</span>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('email') is-invalid @enderror">
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $student->email) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Contact <span class="text-danger">*</span>
                                                @error('contact_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('contact_no') is-invalid @enderror">
                                                <input type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no', $student->contact_no) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             {{-- Address --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Address</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">House Number <span class="text-danger">*</span>
                                                @error('house_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('house_no') is-invalid @enderror">
                                                <input type="text" class="form-control @error('house_no') is-invalid @enderror" name="house_no" value="{{ old('house_no', $student->house_no) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Street <span class="text-danger">*</span>
                                                @error('street')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('street') is-invalid @enderror">
                                                <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street', $student->street) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Barangay <span class="text-danger">*</span>
                                                @error('bgry')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('bgry') is-invalid @enderror">
                                                <input type="text" class="form-control @error('bgry') is-invalid @enderror" name="bgry" value="{{ old('bgry', $student->bgry) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Municipality <span class="text-danger">*</span>
                                                @error('municipality')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('municipality') is-invalid @enderror">
                                                <input type="text" class="form-control @error('municipality') is-invalid @enderror" name="municipality" value="{{ old('municipality', $student->municipality) }}">
                                            </div>
                                        </div>

                                    
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Province <span class="text-danger">*</span>
                                                @error('province')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('province') is-invalid @enderror">
                                                <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ old('province', $student->province) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Country <span class="text-danger">*</span>
                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('country') is-invalid @enderror">
                                                <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country', $student->country) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Zipcode <span class="text-danger">*</span>
                                                @error('zipcode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('zipcode') is-invalid @enderror">
                                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode', $student->zipcode) }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                         

                             {{-- Family Pies --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0">Family Background</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Father's Name <span class="text-danger">*</span>
                                                @error('fathername')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('fathername') is-invalid @enderror">
                                                <input type="text" class="form-control @error('fathername') is-invalid @enderror" name="fathername" value="{{ old('fathername', $student->fathername) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Father's Contact <span class="text-danger">*</span>
                                                @error('f_contact')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('f_contact') is-invalid @enderror">
                                                <input type="text" class="form-control @error('f_contact') is-invalid @enderror" name="f_contact" value="{{ old('f_contact', $student->f_contact) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Mother's Name <span class="text-danger">*</span>
                                                @error('mothername')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('mothername') is-invalid @enderror">
                                                <input type="text" class="form-control @error('mothername') is-invalid @enderror" name="mothername" value="{{ old('mothername', $student->mothername) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Mother's Contact <span class="text-danger">*</span>
                                                @error('m_contact')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('m_contact') is-invalid @enderror">
                                                <input type="text" class="form-control @error('m_contact') is-invalid @enderror" name="m_contact" value="{{ old('m_contact', $student->m_contact) }}">
                                            </div>
                                        </div>

                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Guardian <span class="text-danger">*</span>
                                                @error('guardian')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('guardian') is-invalid @enderror">
                                                <input type="text" class="form-control @error('guardian') is-invalid @enderror" name="guardian" value="{{ old('guardian', $student->guardian) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Guardian Contact <span class="text-danger">*</span>
                                                @error('g_contact')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                            <div class="input-group input-group-outline mb-3 @error('g_contact') is-invalid @enderror">
                                                <input type="text" class="form-control @error('g_contact') is-invalid @enderror" name="g_contact" value="{{ old('g_contact', $student->g_contact) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.student.index') }}" class="btn btn-inline-dark my-4 mb-2 me-2">Cancel</a>
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Update Student</button>
                            </div>

                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</x-app-layout>



