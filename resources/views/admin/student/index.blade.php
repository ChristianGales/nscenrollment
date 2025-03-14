<x-app-layout>
  <div class="container-fluid py-2">
      <div class="row">

          {{-- alerts --}}
          @session('success')
              <div class="alert alert-success alert-dismissible text-white" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
          @endsession

          @session('error')
              <div class="alert alert-danger alert-dismissible text-white" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close"> 
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
          @endsession

          <div class="col-md-12 mt-4">
              <div class="card">
                  <div class="card-header pb-4 px-3 d-flex align-items-center justify-content-between">
                      <h6 class="mb-0 me-3">Manage Students</h6>
                      <div class="d-flex align-items-center">
                          {{-- grade lvl filter --}}
                          <div class="input-group input-group-outline me-2" style="width: 200px;">
                              <select id="gradeLevelFilter" class="form-control">
                                  <option value="">All Grade Levels</option>
                                  @foreach ($gradeLevels as $gradeLevel)
                                      <option value="{{ $gradeLevel->id }}">{{ $gradeLevel->name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          {{-- section filter --}}
                          <div class="input-group input-group-outline me-2" style="width: 200px;">
                              <select id="sectionFilter" class="form-control">
                                  <option value="">All Sections</option>
                                  @foreach ($sections as $section)
                                      <option value="{{ $section->id }}">{{ $section->name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          {{-- status filter --}}
                          <div class="input-group input-group-outline me-2" style="width: 200px;">
                            <select id="statusFilter" class="form-control">
                                <option value="">All Statuses</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                          {{-- search --}}
                          <div class="input-group input-group-outline me-2" style="width: 200px;">
                              <label class="form-label">Search student...</label>
                              <input type="text" class="form-control" id="searchInput">
                          </div>

                          <a href="{{ route('admin.student.create') }}" class="btn mb-0 bg-gradient-dark">
                              <i class="material-symbols-rounded text-sm me-2">contact_page</i>Enroll Student
                          </a>
                      </div>
                  </div>

                  <div class="card-body pt-0 p-3">
                      <ul class="list-group">
                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                              <div class="card-body px-0 pb-2">
                                  <div class="table-responsive p-0">
                                      <table class="table align-items-center mb-0" id="studentTable">
                                          <thead>
                                              <tr>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">LRN</th>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fullname</th>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade Level</th>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Section</th>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @foreach ($students as $student)
                                              <tr data-grade-level="{{ $student->grade_lvl_id }}" data-section="{{ $student->section_id }}"  data-status="{{ $student->status }}">
                                                  <td class="align-middle text-center">
                                                      <span class="text-secondary text-xs font-weight-bold">{{ $student->lrn }}</span>
                                                  </td>
                                                  <td class="align-middle text-center">
                                                      <span class="text-secondary text-xs font-weight-bold">{{ $student->fullName }}</span>
                                                  </td>
                                                  <td class="align-middle text-center">
                                                      <span class="text-secondary text-xs font-weight-bold">
                                                          {{ $student->gradeLevel->name ?? 'N/A' }}
                                                      </span>
                                                  </td>
                                                  <td class="align-middle text-center">
                                                      <span class="text-secondary text-xs font-weight-bold">
                                                          {{ $student->section->name ?? 'N/A' }}
                                                      </span>
                                                  </td>
                                                  <td class="align-middle text-center">
                                                    @php
                                                        $status = $student->status ?? 'N/A';
                                                        $badgeClass = '';
                                                
                                                        switch ($status) {
                                                            case 'Enrolled':
                                                                $badgeClass = 'badge-sm bg-gradient-info';
                                                                break;
                                                            case 'Not Enrolled':
                                                                $badgeClass = 'badge-sm bg-gradient-warning';
                                                                break;
                                                            case 'Transfered':
                                                                $badgeClass = 'badge-sm bg-gradient-dark';
                                                                break;
                                                            case 'Graduated':
                                                                $badgeClass = 'badge-sm bg-gradient-success';
                                                                break;
                                                            default:
                                                                // Handle default case or 'N/A'
                                                                $badgeClass = 'badge-sm bg-gradient-secondary'; // Or any default style you prefer
                                                                break;
                                                        }
                                                    @endphp
                                                
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ $status }}
                                                    </span>
                                                    
                                                </td>

                                               
                                                
                                                {{-- <td class="align-middle text-center">
                                                      <div class="d-flex justify-content-center align-items-center">

                                                        <a class="btn btn-link text-dark text-gradient px-3 mb-0" href="#">
                                                            <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Transfer Student">description</i>
                                                        </a>

                                                        @if ($student->gradeLevel->name == 'Grade 6' || $student->gradeLevel->name == 'Grade 10')
                                                        <button type="button" class="btn btn-link text-success text-gradient px-3 mb-0"
                                                                data-bs-toggle="modal" data-bs-target="#graduateModal{{ $student->id }}">
                                                            <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                               data-bs-title="Graduate Student">school</i>
                                                        </button>

                                                        <div class="modal fade" id="graduateModal{{ $student->id }}" tabindex="-1" role="dialog"
                                                            aria-labelledby="graduateModalLabel{{ $student->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="graduateModalLabel{{ $student->id }}">Confirm Graduation</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to graduate this student?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <form action="{{ route('admin.student.graduate', $student) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')  <button type="submit" class="btn bg-gradient-success">Graduate</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                      </div>
                                                </td> --}}
                                                
                                                  <td class="align-middle text-center">
                                                      <div class="d-flex justify-content-center align-items-center">

                                                        <a class="btn btn-link text-dark text-gradient px-3 mb-0" href="{{ route('admin.student.download', $student->id) }}">
                                                            <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Certificate of Registration">description</i>
                                                        </a>

                                                          <a class="btn btn-link text-info text-gradient px-3 mb-0" href="{{ route('admin.student.show', $student)}}">
                                                              <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Student Profile">account_circle</i>
                                                          </a>

                                                          <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}">
                                                            <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Student">delete</i>
                                                          </button>

                                                          
                                          
                                                          <a href="{{ route('admin.student.edit', $student) }}" class="btn btn-link text-info px-3 mb-0">
                                                              <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Student Profile">edit_square</i>
                                                          </a>
                                                      </div>
                                                  </td>
                                              </tr>

                                              {{-- Delete Confirmation Modal --}}
                                              <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                                            <form action="{{ route('admin.student.destroy', $student) }}" method="POST">
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
                                  {{-- pagination --}}
                                  {{ $students->links() }}
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
        const gradeLevelFilter = document.getElementById('gradeLevelFilter');
        const sectionFilter = document.getElementById('sectionFilter');
        const searchInput = document.getElementById('searchInput');
        const studentTable = document.getElementById('studentTable');
        const statusFilter = document.getElementById('statusFilter'); // Get the status filter

        // Function to filter students
        function filterStudents() {
            const selectedGradeLevel = gradeLevelFilter.value;
            const selectedSection = sectionFilter.value;
            const searchTerm = searchInput.value.toLowerCase();
            const selectedStatus = statusFilter.value; // Get the selected status
            const rows = studentTable.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const rowGradeLevel = row.getAttribute('data-grade-level');
                const rowSection = row.getAttribute('data-section');
                const rowStatus = row.getAttribute('data-status'); // Assuming you add this attribute
                const studentName = row.querySelectorAll('td')[1].textContent.toLowerCase();
                const studentLRN = row.querySelectorAll('td')[0].textContent.toLowerCase();

                const gradeMatch = selectedGradeLevel === '' || rowGradeLevel === selectedGradeLevel;
                const sectionMatch = selectedSection === '' || rowSection === selectedSection;
                const searchMatch = searchTerm === '' ||
                    studentName.includes(searchTerm) ||
                    studentLRN.includes(searchTerm);
                const statusMatch = selectedStatus === '' || rowStatus === selectedStatus; // Status match

                if (gradeMatch && sectionMatch && searchMatch && statusMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Add event listeners
        gradeLevelFilter.addEventListener('change', filterStudents);
        sectionFilter.addEventListener('change', filterStudents);
        searchInput.addEventListener('input', filterStudents);
        statusFilter.addEventListener('change', filterStudents); // Status filter event listener

        // Add event listener for search input focus/blur
        const searchContainer = searchInput.parentElement;
        searchInput.addEventListener('focus', function() {
            searchContainer.classList.add('focused');
        });
        searchInput.addEventListener('blur', function() {
            if (!this.value) {
                searchContainer.classList.remove('focused');
            }
        });

        // Initial filter application (optional but recommended)
        filterStudents();
    });
</script>
</x-app-layout>