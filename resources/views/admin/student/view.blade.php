<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <!-- Student Profile Card -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ asset('img/profile.png') }}" class="rounded-circle mb-3 mx-auto d-block" width="120" height="120" alt="Student Image">
                        <h5 class="card-title">{{ $student->fullName }}</h5>
                        <p class="mb-1"><strong>LRN:</strong> {{ $student->lrn }}</p>
                        <p class="mb-1"><strong>Grade Level:</strong> {{ $student->gradeLevel->name ?? 'N/A' }}</p>
                        <p><strong>Section:</strong> {{ $student->section->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Parent/Guardian Information Card -->
                <div class="card mt-3">
                    <div class="card-header bg-white fw-bold text-center">
                        <i class="bi bi-people"></i> Parent/Guardian Information
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Father's Name</strong></td>
                                <td>: {{ $student->fathername ?? 'N/A' }} </td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td>: {{ $student->f_contact ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Mother's Name</strong></td>
                                <td>: {{ $student->mothername ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td>: {{ $student->m_contact ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Guardian's Name</strong></td>
                                <td>: {{ $student->guardian ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td>: {{ $student->g_contact ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- General and Other Information -->
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header bg-white fw-bold">
                        <i class="bi bi-info-circle"></i> General Information
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Gender</strong></td>
                                <td>: {{ $student->gender ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Birthday</strong></td>
                                <td>: {{ $student->bday ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Birth Place</strong></td>
                                <td>: {{ $student->bplace ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>PSA Number</strong></td>
                                <td>: {{ $student->PSA_num ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Facebook Name</strong></td>
                                <td>: {{ $student->fb_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>: {{ $student->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td>: {{ $student->contact_no ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-white fw-bold">
                        <i class="bi bi-geo-alt"></i> Address
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>House Number</strong></td>
                                <td>: {{ $student->house_no ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Street</strong></td>
                                <td>: {{ $student->street ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Barangay</strong></td>
                                <td>: {{ $student->bgry ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Municipality</strong></td>
                                <td>: {{ $student->municipality ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Province</strong></td>
                                <td>: {{ $student->province ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Country </strong></td>
                                <td>: {{ $student->country ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Zipcode</strong></td>
                                <td>: {{ $student->zipcode ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
