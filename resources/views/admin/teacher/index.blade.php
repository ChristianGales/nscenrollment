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
                      <h6 class="mb-0 me-3">Manage Teacher</h6>
                      <div class="d-flex align-items-center">
                          <div class="input-group input-group-outline me-2" style="width: 200px;">
                              <label class="form-label">Type here...</label>
                              <input type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                          </div>
                          <a href="{{ route('admin.teacher.create') }}" class="btn mb-0 bg-gradient-dark">
                              <i class="material-symbols-rounded text-sm me-2">add</i>Add Teacher
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
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            @if ($teachers->isEmpty())
                                                <tr>
                                                    <td colspan="3" class="text-center">
                                                        <span class="text-secondary text-md font-weight-bold">No Teacher Found</span>
                                                    </td>
                                                </tr>
                                            @else
                                              @foreach ($teachers as $teacher)
                                                  <tr>
                                                      <td class="align-middle text-center">
                                                          <span class="text-secondary text-xs font-weight-bold">{{ $teacher->fullname }}</span>
                                                      </td>
                                                      <td class="align-middle text-center">
                                                          <span class="text-secondary text-xs font-weight-bold">{{ ucfirst($teacher->gender) }}</span>
                                                      </td>
                                                      <td class="align-middle text-center">
                                                          <div class="d-flex justify-content-center align-items-center">
                                                              <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $teacher->id }}">
                                                                  <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Teacher">delete</i>
                                                              </button>
                                                              <a href="{{ route('admin.teacher.edit', $teacher) }}" class="btn btn-link text-info px-3 mb-0">
                                                                  <i class="material-symbols-rounded text-lg me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Teacher">edit_square</i>
                                                              </a>
                                                          </div>
                                                      </td>
                                                  </tr>
                                                  {{-- Delete Confirmation Modal --}}
                                                  <div class="modal fade" id="deleteModal{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                                                  <form action="{{ route('admin.teacher.destroy', $teacher) }}" method="POST">
                                                                      @csrf
                                                                      @method('DELETE')
                                                                      <button type="submit" class="btn bg-gradient-danger">Delete</button>
                                                                  </form>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              @endforeach
                                            @endif
                                          </tbody>
                                      </table>
                                  </div>
                                  {{-- Pagination --}}
                                  {{ $teachers->links() }}
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
