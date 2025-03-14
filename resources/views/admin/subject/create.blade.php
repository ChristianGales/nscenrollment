<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Add Subject</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('admin.subject.store') }}" method="POST">
                            @csrf

                            <label class="form-label">Subject Name</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="subject_name" id="subject_name" required>
                            </div>

                            <div class="mb-3">  <label class="form-label">Grade Level(s)</label><br> @if(isset($gradeLevels))
                                    @foreach ($gradeLevels as $gradeLevel)
                                        <div class="form-check form-check-inline"> <input class="form-check-input" type="checkbox" name="grade_lvl_id[]" id="gradeLevel{{ $gradeLevel->id }}" value="{{ $gradeLevel->id }}">
                                            <label class="form-check-label" for="gradeLevel{{ $gradeLevel->id }}">{{ $gradeLevel->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.section.index') }}" class="btn btn-inline-dark my-4 mb-2 me-2">Back</a>
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>