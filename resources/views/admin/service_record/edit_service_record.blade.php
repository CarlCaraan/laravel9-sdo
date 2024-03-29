@extends('admin.admin_master')

@section('title') Create Service Record | Division of Laguna @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Start Breadcrumb -->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="text-primary">Create Service Record</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-success" href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Service Record</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->

<!-- Start Page Content -->
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="alert alert-success">
                        <strong>Note:</strong> User will be notified through their email.
                    </div>

                    <!-- Start User Details -->
                    <div class="card border p-2 mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 mb-2">
                                    <h6>User Details:</h6><br />
                                    <span><strong>Email:</strong> {{ $editData['user']['email'] }}</span><br />
                                    <span><strong>Name:</strong> {{ $editData['user']['first_name'] . " " . $editData['user']['last_name']  }}</span><br />
                                    <span><strong>Sex:</strong> {{ $editData['user']['gender'] }}</span> <br />
                                    <small><strong>User Secret ID:</strong> <ins>{{ $editData['user']['tracking_id'] }}</ins></small> <br />
                                </div>
                                <div class="col-lg-2 mb-2">
                                    @if (!empty($editData['user']['profile_photo_path']))
                                    <img class="img-fluid float-end rounded" src="{{ url('upload/user_images/'.$editData['user']['profile_photo_path']) }}" alt="Profile Photo">
                                    @else
                                    <img class="img-fluid" src="{{ (!empty($editData['user']['profile_photo_path'])) ? url('upload/user_images/'.$value['user']['profile_photo_path']) : url('upload/user_images/default_photo.png') }}" alt="Profile Photo">
                                    @endif
                                </div>
                            </div> <!-- End Row -->
                        </div>
                    </div>
                    <!-- End User Details -->

                    <form action="{{ route('update.request.sr') }}" method="POST">
                        @csrf

                        <h6>Additional Information (Required):</h6>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="sr_middle_name">Middle Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="sr_middle_name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="sr_dob">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="sr_dob" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="sr_pob">Place of Birth<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="sr_pob" required>
                                </div>
                            </div>
                        </div> <!-- End Row -->


                        <h6>Fill Up Service Record:</h6>
                        <input type="hidden" name="id" value="{{ $editData->id }}">

                        <div class="add_item">
                            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_from">Service From<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="sr_from[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_to">Service To<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="sr_to[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_designation">Designation<span class="text-danger">*</span></label>
                                            <select class="form-select" name="sr_designation[]" required>
                                                <option value="" disabled selected>Select</option>
                                                <option value="Administrative Aide I">Administrative Aide I</option>
                                                <option value="Administrative Aide II">Administrative Aide II</option>
                                                <option value="Administrative Aide III">Administrative Aide III</option>
                                                <option value="Administrative Aide IV">Administrative Aide IV</option>
                                                <option value="Administrative Aide V">Administrative Aide V</option>
                                                <option value="Administrative Aide VI">Administrative Aide VI</option>
                                                <option value="Administrative Asst. II">Administrative Asst. II</option>
                                                <option value="Administrative Asst. III">Administrative Asst. III</option>
                                                <option value="Administrative Officer II">Administrative Officer II</option>
                                                <option value="Asst. Principal">Asst. Principal</option>
                                                <option value="Disbursing Officer II">Disbursing Officer II</option>
                                                <option value="Head Teacher I">Head Teacher I</option>
                                                <option value="Head Teacher II">Head Teacher II</option>
                                                <option value="Head Teacher III">Head Teacher III</option>
                                                <option value="Head Teacher IV">Head Teacher IV</option>
                                                <option value="Head Teacher V">Head Teacher V</option>
                                                <option value="Head Teacher VI">Head Teacher VI</option>
                                                <option value="Head Teacher VII">Head Teacher VII</option>
                                                <option value="Master Teacher I">Master Teacher I</option>
                                                <option value="Master Teacher II">Master Teacher II</option>
                                                <option value="PSDS">PSDS</option>
                                                <option value="Registrar I">Registrar I</option>
                                                <option value="School Principal I">School Principal I</option>
                                                <option value="School Principal II">School Principal II</option>
                                                <option value="School Principal III">School Principal III</option>
                                                <option value="School Principal IV">School Principal IV</option>
                                                <option value="Senior Bookkeeper">Senior Bookkeeper</option>
                                                <option value="Special Science Teacher I">Special Science Teacher I</option>
                                                <option value="Teacher I">Teacher I</option>
                                                <option value="Teacher II">Teacher II</option>
                                                <option value="Teacher III">Teacher III</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_status">Status<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sr_status[]" required>
                                        </div>
                                    </div>
                                </div> <!-- End Row -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_salary">Salary <strong>(Annual)</strong><span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="text" class="form-control" name="sr_salary[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_place_of_assignment">Office Entity Station/Place of Assignment<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sr_place_of_assignment[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="sr_branch">Branch<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="sr_branch[]" required>
                                        </div>
                                    </div>
                                </div> <!-- End Row -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label" for="sr_separation_date_caused">Separation Date Caused</label>
                                        <input type="text" class="form-control" name="sr_separation_date_caused[]">
                                    </div>
                                    <div class="col-md-4" style="padding-top: 30px;">
                                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                    </div>
                                </div> <!-- End Row -->

                            </div> <!-- End delete_whole_extra_item_add -->
                        </div> <!-- End Add Item -->
                        <button type="submit" class="btn btn-primary float-end">Create Service Record</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Page Content -->

<!-- Start Hidden Row Javascript -->
<div style="display: none;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <h3 class="border-top mt-4 pt-2">Add Item</h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="sr_from">Service From<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="sr_from[]" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="sr_to">Service To<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="sr_to[]" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="sr_designation">Designation<span class="text-danger">*</span></label>
                        <select class="form-select" name="sr_designation[]" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Administrative Aide I">Administrative Aide I</option>
                            <option value="Administrative Aide II">Administrative Aide II</option>
                            <option value="Administrative Aide III">Administrative Aide III</option>
                            <option value="Administrative Aide IV">Administrative Aide IV</option>
                            <option value="Administrative Aide V">Administrative Aide V</option>
                            <option value="Administrative Aide VI">Administrative Aide VI</option>
                            <option value="Administrative Asst. II">Administrative Asst. II</option>
                            <option value="Administrative Asst. III">Administrative Asst. III</option>
                            <option value="Administrative Officer II">Administrative Officer II</option>
                            <option value="Asst. Principal">Asst. Principal</option>
                            <option value="Disbursing Officer II">Disbursing Officer II</option>
                            <option value="Head Teacher I">Head Teacher I</option>
                            <option value="Head Teacher II">Head Teacher II</option>
                            <option value="Head Teacher III">Head Teacher III</option>
                            <option value="Head Teacher IV">Head Teacher IV</option>
                            <option value="Head Teacher V">Head Teacher V</option>
                            <option value="Head Teacher VI">Head Teacher VI</option>
                            <option value="Head Teacher VII">Head Teacher VII</option>
                            <option value="Master Teacher I">Master Teacher I</option>
                            <option value="Master Teacher II">Master Teacher II</option>
                            <option value="PSDS">PSDS</option>
                            <option value="Registrar I">Registrar I</option>
                            <option value="School Principal I">School Principal I</option>
                            <option value="School Principal II">School Principal II</option>
                            <option value="School Principal III">School Principal III</option>
                            <option value="School Principal IV">School Principal IV</option>
                            <option value="Senior Bookkeeper">Senior Bookkeeper</option>
                            <option value="Special Science Teacher I">Special Science Teacher I</option>
                            <option value="Teacher I">Teacher I</option>
                            <option value="Teacher II">Teacher II</option>
                            <option value="Teacher III">Teacher III</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" for="sr_status">Status<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sr_status[]" required>
                    </div>
                </div>
            </div> <!-- End Row -->

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="sr_salary">Salary <strong>(Annual)</strong><span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" name="sr_salary[]" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="sr_place_of_assignment">Office Entity Station/Place of Assignment<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sr_place_of_assignment[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label" for="sr_branch">Branch<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sr_branch[]" required>
                    </div>
                </div>
            </div> <!-- End Row -->

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label" for="sr_separation_date_caused">Separation Date Caused</label>
                    <input type="text" class="form-control" name="sr_separation_date_caused[]">
                </div>
                <div class="col-md-4" style="padding-top: 30px;">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div> <!-- End Row -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1;
        });
    });
</script>
<!-- End Hidden Row Javascript -->
@endsection