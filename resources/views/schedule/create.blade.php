<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 me-3">Add Schedule</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('schedule.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Time From</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="time" class="form-control" name="time_from" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Time To</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="time" class="form-control" name="time_to" required>
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
                                                    <input class="form-check-input" type="checkbox" name="days[]" value="{{ $day }}" id="{{ $day }}" {{ in_array($day, old('days', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <label class="form-label">Room</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" name="room" required>
                                    </div>
                                </div>
                            </div>
                           
                            <label class="form-label">Grade Level</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="grade_lvl" id="grade_lvl" required>
                                    <option value="">Select Grade Level</option>
                                    @foreach ($gradeLevels as $grade)
                                        <option value="{{ $grade->name }}" {{ old('grade_lvl') == $grade->name ? 'selected' : '' }}>
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Subject</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="subject_id" id="subject_id" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($gradeLevels as $grade)
                                        @php
                                            $filteredSubjects = $subjects->where('gradeLevel.name', $grade->name);
                                        @endphp
                                        @if ($filteredSubjects->isNotEmpty())
                                            @foreach ($filteredSubjects as $subject)
                                                <option value="{{ $subject->id }}" data-grade="{{ $subject->gradeLevel->name ?? '' }}">
                                                    {{ $subject->subject_name }} ({{ $subject->gradeLevel->name ?? 'N/A' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="section_id" id="section_id" required>
                                    <option value="">Select Section</option>
                                    @foreach ($gradeLevels as $grade)
                                        @php
                                            $filteredSections = $sections->where('gradeLevel.name', $grade->name);
                                        @endphp
                                        @if ($filteredSections->isNotEmpty())
                                            @foreach ($filteredSections as $section)
                                                <option value="{{ $section->id }}" data-grade="{{ $section->gradeLevel->name ?? '' }}">
                                                    {{ $section->name }} ({{ $section->gradeLevel->name ?? 'N/A' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <label class="form-label">Teacher</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="teacher_id" required>
                                    <option value="">Select Teacher</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
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
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let gradeSelect = document.getElementById("grade_lvl");
        let subjectSelect = document.getElementById("subject_id");
        let sectionSelect = document.getElementById("section_id");

        function filterOptions(selectElement, gradeLevel) {
            let options = selectElement.querySelectorAll("option");
            let hasValidOption = false;
            
            options.forEach(option => {
                if (option.dataset.grade === gradeLevel || option.value === "") {
                    option.style.display = "block";
                    if (option.value !== "") {
                        hasValidOption = true;
                    }
                } else {
                    option.style.display = "none";
                }
            });

            // Reset selection if no matching options
            if (!hasValidOption) {
                selectElement.value = "";
            }
        }

        gradeSelect.addEventListener("change", function() {
            let selectedGrade = gradeSelect.value;
            filterOptions(subjectSelect, selectedGrade);
            filterOptions(sectionSelect, selectedGrade);
        });

        // Trigger initial filtering when the page loads
        if (gradeSelect.value) {
            filterOptions(subjectSelect, gradeSelect.value);
            filterOptions(sectionSelect, gradeSelect.value);
        }
    });
</script>