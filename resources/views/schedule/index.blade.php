<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            
           {{-- alerts --}}
         @session('status')
         <div class="alert alert-success alert-dismissible text-white" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endsession


            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 me-3">Manage Schedule</h6>
                        <div class="d-flex align-items-center">
                             {{--  filters --}}
                          <!-- Grade Level filter -->
                            <div class="input-group input-group-outline me-2" style="width: 200px;">
                                <select id="gradeLevelFilter" class="form-control">
                                    <option value="">All Grade Levels</option>
                                    @foreach ($gradeLevels as $gradeLevel)
                                        <option value="{{ $gradeLevel->name }}">{{ $gradeLevel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Section filter -->
                            <div class="input-group input-group-outline me-2" style="width: 200px;">
                                <select id="sectionFilter" class="form-control">
                                    <option value="">All Sections</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->name }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <a href="{{ route('schedule.download') }}" class="btn mb-0 me-1 bg-gradient-info">
                                <i class="material-symbols-rounded text-sm me-2">print</i>Print Schedule
                            </a> --}}

                            <a href="#" class="btn mb-0 me-1 bg-gradient-info" data-bs-toggle="modal" data-bs-target="#printScheduleModal">
                                <i class="material-symbols-rounded text-sm me-2">print</i>Print Schedule
                            </a>
                            
                            

                            <a href="{{ route('schedule.create') }}" class="btn mb-0 bg-gradient-dark">
                                <i class="material-symbols-rounded text-sm me-2">add</i>Add Schedule
                            </a>

                           
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teacher</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Day</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Section</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($schedules as $schedule)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                                {{ $schedule->subject->subject_name ?? 'N/A' }} ({{ $schedule->subject->gradeLevel->name ?? 'N/A' }})
                                                            </span>
                                                        </td>
                                                        
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $schedule->teacher->fullname ?? 'N/A' }}</span>
                                                        </td>
                                                        
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                                {{ date('h:i A', strtotime($schedule->time_from)) }} - 
                                                                {{ date('h:i A', strtotime($schedule->time_to)) }}
                                                            </span>
                                                        </td>
                                                        
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $schedule->day }}</span>
                                                        </td>
                                                        
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $schedule->section->name}}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $schedule->room }}</span>
                                                        </td>
                                                      
                                                        
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex justify-content-center align-items-center">

                                                                <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $schedule->id }}">
                                                                    <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Schedule">delete</i>
                                                                </button>

                                                                {{-- <a href="{{ route('download.pdf') }}" class="btn btn-primary">Download PDF</a> --}}

                                                               
                                                                <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-link text-info px-3 mb-0">
                                                                    <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Schedule">edit_square</i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    {{-- print schedule modal --}}
                                                    <div class="modal fade" id="printScheduleModal" tabindex="-1" aria-labelledby="printScheduleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="printScheduleModalLabel">Select Class Schedule</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="printScheduleForm">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Grade Level</label>
                                                                            <div class="input-group input-group-outline">
                                                                                <select class="form-control" name="gradeLevel" id="gradeLevelSelect" required>
                                                                                    <option value="">Select Grade Level</option>
                                                                                    @foreach ($gradeLevels as $grade)
                                                                                        <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Section</label>
                                                                            <div class="input-group input-group-outline">
                                                                                <select class="form-control" name="sectionId" id="sectionSelect" required>
                                                                                    <option value="">Select Section</option>
                                                                                    @foreach ($sections as $section)
                                                                                        <option value="{{ $section->id }}" data-grade="{{ $section->gradeLevel->name }}">
                                                                                            {{ $section->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn bg-gradient-info">
                                                                                <i class="material-symbols-rounded text-sm me-2">print</i>Print Schedule
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    


                                                        {{-- Delete Confirmation Modal --}}
                                                  <div class="modal fade" id="deleteModal{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this record?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('schedule.destroy', $schedule) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn bg-gradient-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                      {{-- Pagination --}}
                                  {{ $schedules->links() }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
   document.addEventListener('DOMContentLoaded', function() {
    // Get the filter elements
    const gradeLevelFilter = document.getElementById('gradeLevelFilter');
    const sectionFilter = document.querySelector('select[id="sectionFilter"]');
    
    // Get the schedule table
    const scheduleTable = document.querySelector('.table.align-items-center.mb-0');
    const tableBody = scheduleTable ? scheduleTable.querySelector('tbody') : null;
    
    // Add no schedule message row (initially hidden)
    if (tableBody) {
        // Check if the message already exists
        let noScheduleRow = tableBody.querySelector('.no-schedule-message');
        
        if (!noScheduleRow) {
            // Create the message row if it doesn't exist
            noScheduleRow = document.createElement('tr');
            noScheduleRow.className = 'no-schedule-message';
            noScheduleRow.style.display = 'none';
            
            const messageTd = document.createElement('td');
            messageTd.colSpan = 8; // Span across all columns
            messageTd.className = 'text-center py-4';
            messageTd.innerHTML = '<span class="text-secondary font-weight-bold">No Schedule Set</span>';
            
            noScheduleRow.appendChild(messageTd);
            tableBody.appendChild(noScheduleRow);
        }
    }
    
    // Apply filters when they change
    if (gradeLevelFilter) {
        gradeLevelFilter.addEventListener('change', applyFilters);
    }
    
    if (sectionFilter) {
        sectionFilter.addEventListener('change', applyFilters);
    }
    
    // Initial check for empty table
    checkEmptyTable();
    
    // Function to apply all active filters
    function applyFilters() {
        if (!scheduleTable) return;
        
        const rows = scheduleTable.querySelectorAll('tbody tr:not(.no-schedule-message)');
        const selectedGradeLevel = gradeLevelFilter ? gradeLevelFilter.value : '';
        const selectedSection = sectionFilter ? sectionFilter.value : '';
        
        let visibleRowCount = 0;
        
        rows.forEach(row => {
            let showRow = true;
            
            // Get the grade level from the subject column (first cell)
            const subjectCell = row.querySelector('td:first-child .text-secondary');
            const subjectText = subjectCell ? subjectCell.textContent : '';
            // Extract grade level from format "Subject Name (Grade Level)"
            const gradeLevelMatch = subjectText.match(/\((.*?)\)/);
            const rowGradeLevel = gradeLevelMatch ? gradeLevelMatch[1].trim() : '';
            
            // Get the section from the section column (fifth cell, 0-indexed)
            const sectionCell = row.querySelector('td:nth-child(5) .text-secondary');
            const rowSection = sectionCell ? sectionCell.textContent.trim() : '';
            
            // Apply grade level filter if selected
            if (selectedGradeLevel && !rowGradeLevel.includes(selectedGradeLevel)) {
                showRow = false;
            }
            
            // Apply section filter if selected
            if (selectedSection && rowSection !== selectedSection) {
                showRow = false;
            }
            
            // Show or hide the row based on the filter results
            row.style.display = showRow ? '' : 'none';
            
            if (showRow) {
                visibleRowCount++;
            }
        });
        
        // Show or hide the "No Schedule Set" message
        const noScheduleRow = scheduleTable.querySelector('.no-schedule-message');
        if (noScheduleRow) {
            noScheduleRow.style.display = visibleRowCount === 0 ? '' : 'none';
        }
    }
    
    // Function to check if table is empty on page load
    function checkEmptyTable() {
        if (!scheduleTable) return;
        
        const dataRows = scheduleTable.querySelectorAll('tbody tr:not(.no-schedule-message)');
        const noScheduleRow = scheduleTable.querySelector('.no-schedule-message');
        
        if (noScheduleRow) {
            noScheduleRow.style.display = dataRows.length === 0 ? '' : 'none';
        }
    }
});

//
// Filter sections based on selected grade level
document.getElementById("gradeLevelSelect").addEventListener("change", function() {
    let selectedGrade = this.value;
    let sectionSelect = document.getElementById("sectionSelect");
    let sectionOptions = sectionSelect.querySelectorAll("option");
    
    // Reset section dropdown
    sectionSelect.value = "";
    
    // Show/hide section options based on selected grade
    for (let i = 0; i < sectionOptions.length; i++) {
        let option = sectionOptions[i];
        
        if (option.value === "") {
            // Always show the placeholder option
            option.style.display = "";
        } else if (option.dataset.grade === selectedGrade) {
            option.style.display = "";
        } else {
            option.style.display = "none";
        }
    }
});

// Handle form submission
document.getElementById("printScheduleForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let gradeLevel = document.getElementById("gradeLevelSelect").value;
    let sectionId = document.getElementById("sectionSelect").value;

    if (!gradeLevel || !sectionId) {
        alert("Please select both a grade level and section.");
        return;
    }

    // Build URL with both parameters
    let downloadUrl = "/schedule/download-pdf?gradeLevel=" + encodeURIComponent(gradeLevel) + 
                      "&sectionId=" + encodeURIComponent(sectionId);

    // Open PDF in new tab
    window.open(downloadUrl, '_blank');
});

    </script>
    
  </x-app-layout>