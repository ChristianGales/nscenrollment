
{{-- edit.blade.php --}}
<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 me-3">Edit Schedule</h6>
                    </div>
                    <div class="card-body pt-4 p-3">

                        

                      

                         <!-- Display validation errors -->
                         @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                                  
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <span aria-hidden="true">×</span>
                            </div>
                        @endif

                     <!-- Display error message if any -->
                     @if (session('error'))
                         <div class="alert alert-success alert-dismissible text-white" role="alert">
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                                <span aria-hidden="true">×</span>
                             {{ session('error') }}
                         </div>
                     @endif

                     
                        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Time From</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="time" class="form-control" name="time_from" value="{{ $schedule->time_from }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Time To</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="time" class="form-control" name="time_to" value="{{ $schedule->time_to }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Day(s)</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <div class="d-flex flex-wrap">
                                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="{{ $day }}" id="{{ strtolower($day) }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ strtolower($day) }}">{{ $day }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Room</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" name="room" value="{{ $schedule->room }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <label class="form-label">Grade Level</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="grade_lvl" id="grade_lvl" required>
                                    <option value="">Select Grade Level</option>
                                    @foreach ($gradeLevels as $grade)
                                        <option value="{{ $grade->name }}" {{ $schedule->subject->gradeLevel->id == $grade->id ? 'selected' : '' }}>
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Subject</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="subject_id" id="subject_id" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" data-grade="{{ $subject->gradeLevel->name ?? '' }}" {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->subject_name }} ({{ $subject->gradeLevel->name ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="section_id" id="section_id" required>
                                    <option value="">Select Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" data-grade="{{ $section->gradeLevel->name ?? '' }}" {{ $schedule->section_id == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }} ({{ $section->gradeLevel->name ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Teacher</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="teacher_id" required>
                                    <option value="">Select Teacher</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">School Year</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="sy_id" disabled>
                                    @if ($activeSy)
                                        <option value="{{ $activeSy->id }}" selected>{{ $activeSy->name }}</option>
                                    @else
                                        <option value="" disabled>No Active School Year</option>
                                    @endif
                                </select>
                                <input type="hidden" name="sy_id" value="{{ $activeSy->id ?? '' }}">
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('schedule.index') }}" class="btn btn-inline-dark my-4 mb-2 me-2">Back</a>
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Update Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</x-app-layout>