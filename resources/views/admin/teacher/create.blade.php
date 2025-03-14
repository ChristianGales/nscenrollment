<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Add Teacher</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('admin.teacher.store') }}" method="POST">
                            @csrf

                            <label class="form-label">Teacher Name</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="fullname" required>
                            </div>

                            <label class="form-label">Gender</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.teacher.index') }}" class="btn btn-inline-dark my-4 mb-2 me-2">Back</a>
                                <button type="submit" class="btn bg-gradient-dark my-4 mb-2 px-5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>