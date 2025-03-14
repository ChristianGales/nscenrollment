<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
          <div class="col-md-12 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                {{-- Left --}}
                <h6 class="mb-0 me-3">Manage Student</h6>
            
                {{-- Right --}}
                <div class="d-flex align-items-center">  {{-- Container for right-aligned elements --}}
                    <div class="input-group input-group-outline me-2" style="width: 200px;">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <a href="#" class="btn mb-0 bg-gradient-dark"><i class="material-symbols-rounded text-sm me-2">add</i>Add Student</a>
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
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">LRN</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fullname</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade Level</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Section</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">210047</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">Gales, Christian Charles P.</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">Grade 1</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">Rose</span>
                              </td>
                              <td class="align-middle text-center">
                                  <a class="btn btn-link text-info text-gradient px-3 mb-0" href="javascript:;"><i class="material-symbols-rounded text-sm me-2">receipt_long</i>Profile</a>
                                  <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-symbols-rounded text-sm me-2">delete_forever</i>Delete</a>
                                  <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-symbols-rounded text-sm me-2">edit_square</i>Edit</a>
                              </td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>
  
  </x-app-layout>
  