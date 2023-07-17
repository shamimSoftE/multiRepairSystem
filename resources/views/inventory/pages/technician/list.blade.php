@extends('inventory.master')

@section('title', 'Technician List')

@push('style')

    <style>
        .swal2-modal .swal2-title{
            color: #464646!important;
        }
    </style>

@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">
              <div class="card-body">
                <div class="card-title">
                    <h4>Technician List</h4>
                    <!-- Button trigger modal -->
                    <button type="button" style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#technicianAdd">
                        Add Technician
                    </button>
                </div>

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th class="text-white">Name</th>
                        <th class="text-white">E-mail</th>
                        <th class="text-white">Number</th>
                        <th class="text-white" title="Date Of Birth">DOB</th>
                        <th class="text-white">Address</th>
                        <th class="text-white">Action</th>
                      </tr>
                    </thead>
                    <tbody id="technicianTable">

                    </tbody>
                  </table>
                </div>
                <div class="paginationData">{{ $technicians->links() }}</div>
              </div>
            </div>
        </div>
    </div>



    <!--Add Modal -->
    <div class="modal fade" id="technicianAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="suppliearLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="suppliearLabel">Add New Technician</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;">&times;</span>
            </button>
            </div>
            <form action="{{ url('technician_store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label>Technician Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Technician Name">
                    </div>

                    <div class="form-group">
                        <label>Father Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="father_name" value="{{ old('father_name') }}" placeholder="Technician Father Name">
                    </div>

                    <div class="form-group">
                        <label>Mother Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="mother_name" value="{{ old('mother_name') }}" placeholder="Technician Mother Name">
                    </div>

                    <div class="form-group">
                        <label>Present Address<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="present_address" value="{{ old('present_address') }}" placeholder="Technician Present Address">
                    </div>

                    <div class="form-group">
                        <label>Permanent Address<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="permanent_address" value="{{ old('permanent_address') }}" placeholder="Technician Permanent Address">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>National ID<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control text-white" name="national_id" value="{{ old('national_id') }}" placeholder="Technician National ID number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>DOB<sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control text-white" name="dob" value="{{ old('dob') }}" placeholder="Technician Date Of Birth">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >E-mail<sup class="text-danger">*</sup></label>
                                <input type="email" class="form-control text-white" name="email" value="{{ old('email') }}" placeholder="Technician email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label >Contact Number<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control text-white" name="contact_number" value="{{ old('contact_number') }}" placeholder="Technician Contact Number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>


    {{-- edit modal --}}
    <div class="modal fade" id="technicianEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="technicianLabelEdit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-2" id="technicianLabelEdit">Edit Technician</h1>
            <button type="button" class="btn-close bg-dark text-white"
                style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;"
                data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{ url('technician_update') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>Technician Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Technician Name">
                    </div>
                    <input type="hidden" name="id">

                    <div class="form-group">
                        <label>Father Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="father_name" value="{{ old('father_name') }}" placeholder="Technician Father Name">
                    </div>

                    <div class="form-group">
                        <label>Mother Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="mother_name" value="{{ old('mother_name') }}" placeholder="Technician Mother Name">
                    </div>

                    <div class="form-group">
                        <label>Present Address<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="present_address" value="{{ old('present_address') }}" placeholder="Technician Present Address">
                    </div>

                    <div class="form-group">
                        <label>Permanent Address<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="permanent_address" value="{{ old('permanent_address') }}" placeholder="Technician Permanent Address">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>National ID<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control text-white" name="national_id" value="{{ old('national_id') }}" placeholder="Technician National ID number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>DOB<sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control text-white" name="dob" value="{{ old('dob') }}" placeholder="Technician Date Of Birth">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >E-mail<sup class="text-danger">*</sup></label>
                                <input type="email" class="form-control text-white" name="email" value="{{ old('email') }}" placeholder="Technician email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label >Contact Number<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control text-white" name="contact_number" value="{{ old('contact_number') }}" placeholder="Technician Contact Number">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // get technician=============================================
        var pageNum = 1;
        pageNum = $('.active>.page-link, .page-link.active').text();

        function loadRecords(page = pageNum) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: '/technician?page=' + page,
                method: 'GET',
                success: function (response) {
                    $('#technicianTable').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        // edit technician
        function technicianEdit(id) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: 'technician_edit',
                method: 'GET',
                data: {id: id},
                success: function (res) {
                    $("#technicianEdit [name=id]").val(res.id);
                    $("#technicianEdit [name=name]").val(res.name);
                    $("#technicianEdit [name=email]").val(res.email);
                    $("#technicianEdit [name=contact_number]").val(res.contact_number);
                    $("#technicianEdit [name=dob]").val(res.dob);
                    $("#technicianEdit [name=father_name]").val(res.father_name);
                    $("#technicianEdit [name=mother_name]").val(res.mother_name);
                    $("#technicianEdit [name=national_id]").val(res.national_id);
                    $("#technicianEdit [name=permanent_address]").val(res.permanent_address);
                    $("#technicianEdit [name=present_address]").val(res.present_address);
                    $("#technicianEdit").modal("show");

                    // Toastify({text: data[1], duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"}).showToast();
                },
                error: function(error) {
                    Toastify({text: "Technician Update Failed !", duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"}).showToast();
                }
            });

        }

        $(document).ready(function () {
            loadRecords();

        });

        // delete confirm message
        function technicianDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "want to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) =>
            {
                if (result.isConfirmed) {
                    $.ajaxSetup({ headers: {"X-CSRF-TOKEN": $( 'meta[name="csrf-token"]' ).attr("content"),}, });
                    $.ajax({
                        url: 'technician_delete',
                        type: "POST",
                        data: {id: id},
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            setTimeout(() => {
                                location.reload(true);
                            }, 2000);
                            // location.reload()

                        },
                        error: function (error) {
                            Swal.fire("Delete Failed!", "", "error");
                        },
                    });
                }
            })
        }


    </script>



@endpush
