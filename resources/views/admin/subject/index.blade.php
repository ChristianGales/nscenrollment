<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">

            @session('status')
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endsession

            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <h6 class="mb-2 mb-md-0">Manage Subject</h6>
                            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 w-100 w-md-auto">
                                {{-- grade lvl filter --}}
                                <div class="input-group input-group-outline mb-2 mb-sm-0 w-100" >
                                    <select id="gradeLevelFilter" class="form-control">
                                        <option value="">All Grade Levels</option>
                                        @foreach ($gradeLevels as $gradeLevel)
                                            <option value="{{ $gradeLevel->id }}">{{ $gradeLevel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="{{ route('admin.subject.create') }}" class="btn mb-0 bg-gradient-dark w-100">
                                    <i class="material-symbols-rounded text-sm me-2">add</i>Add Subject
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-2 p-md-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="card-body px-0 pb-2 w-100">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0" id="subjectTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject Name</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade Level</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($subjects->isEmpty())
                                                    <tr>
                                                        <td colspan="3" class="text-center">
                                                            <span class="text-secondary text-md font-weight-bold">No Subject Found</span>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($subjects as $subject)
                                                        <tr data-grade-level="{{ $subject->grade_lvl_id }}">
                                                            <td class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold">{{ $subject->subject_name }}</span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $subject->gradeLevel->name ?? 'N/A' }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <div class="d-flex justify-content-center align-items-center flex-wrap gap-2">
                                                                    <button type="button" class="btn btn-link text-danger text-gradient px-2 px-md-3 mb-0"
                                                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $subject->id }}">
                                                                        <i class="material-symbols-rounded text-lg me-1 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Subject">delete</i>
                                                                    </button>

                                                                    <a href="{{ route('admin.subject.edit', $subject) }}" class="btn btn-link text-info px-2 px-md-3 mb-0">
                                                                        <i class="material-symbols-rounded text-lg me-1 me-md-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Subject">edit_square</i>
                                                                    </a>
                                                                </div>
                                                            </td>

                                                            {{-- Delete Confirmation Modal --}}
                                                            <div class="modal fade" id="deleteModal{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-sm modal-md" role="document">
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
                                                                            <form action="{{ route('admin.subject.destroy', $subject) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn bg-gradient-danger">Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- after table use this as pagination --}}
                                        {{ $subjects->links() }}

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
            const tableElement = document.getElementById('subjectTable') || document.getElementById('sectionTable');

            if (gradeLevelFilter && tableElement) {
                gradeLevelFilter.addEventListener('change', function() {
                    const selectedGradeLevel = this.value;
                    const rows = tableElement.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const rowGradeLevel = row.getAttribute('data-grade-level');

                        if (selectedGradeLevel === '' || rowGradeLevel === selectedGradeLevel) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</x-app-layout>