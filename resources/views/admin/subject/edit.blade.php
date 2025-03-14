<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Edit Subject</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('admin.subject.update', $subject->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label class="form-label">Subject Name</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="subject_name" value="{{ $subject->subject_name }}">
                            </div>

                            <label class="form-label">Grade Level</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="grade_lvl_id">
                                    @foreach($gradeLevels as $gradeLevel)
                                        <option value="{{ $gradeLevel->id }}" {{ $subject->grade_lvl_id == $gradeLevel->id ? 'selected' : '' }}>
                                            {{ $gradeLevel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                          

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.subject.index') }}" class="btn btn-inline-dark my-4 mb-2 me-2">Back</a>
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>