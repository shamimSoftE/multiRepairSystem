@extends('inventory.master')

@section('title', 'Customer List')

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
                        <h4>Customer List</h4>
                        <!-- Button trigger modal -->
                        <button type="button" style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#customerAdd">
                            Add Customer
                        </button>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-white">Name</th>
                            <th class="text-white">Mobile</th>
                            <th class="text-white">E-Mail</th>
                            <th class="text-white">Date Of Birth</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody id="customerTable">

                        </tbody>
                    </table>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="paginationData" style=" float: right; ">{{ $customers->links() }}</div>
                </div>
            </div>
        </div>
    </div>



    <!--Add Modal -->
    {{-- <div class="modal fade" id="customerAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="CustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="CustomerLabel">Add Customer</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;">&times;</span>
            </button>
            </div>
            <form action="{{ url('Customer_store') }}" method="POST">
                @csrf

                <div class="modal-body ">
                    <div class="form-group">
                        <label>Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Customer Name" required>
                    </div>

                    <div class="form-group">
                        <label>Brand/Model<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="model" value="{{ old('model') }}" placeholder="Customer Brand/Model" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control text-white" cols="15" rows="5" placeholder="Customer Description">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div> --}}

    {{-- edit modal --}}
    <div class="modal fade" id="customerEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="proLabelEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proLabelEdit">Edit Customer</h5>
                    <button type="button" class="btn-close text-white"
                        style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;"
                        data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ url('customer_update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Customer Name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Contact Number<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control text-white" name="mobile" value="{{ old('mobile') }}" placeholder="Customer Contact Number" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control text-white" name="email" value="{{ old('email') }}" placeholder="Customer Email" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>DOB<sup class="text-danger">*</sup></label>
                                        <input type="date" class="form-control text-white" name="dob" value="{{ old('dob') }}" placeholder="Technician Date Of Birth">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control text-white" cols="15" rows="5" placeholder="Customer Adress">{{ old('address') }}</textarea>
                        </div>
                        <input type="hidden" name="id">
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
        // get Customer ===========================================================================
        var pageNum = 1;
        pageNum = $('.active>.page-link, .page-link.active').text();

        function loadRecords(page = pageNum) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: '/customers?page=' + page,
                method: 'GET',
                success: function (response) {
                    $('#customerTable').html(response);
                }
            });
        }

        $(document).ready(function () {
            loadRecords();
        });



         // Customer Edit=============================================================================
         function editcustomer(id) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: 'customer_edit',
                method: 'GET',
                data: {id: id},
                success: function (res) {
                    console.log(res);
                    $("#customerEdit [name=id]").val(res.id);
                    $("#customerEdit [name=name]").val(res.name);
                    $("#customerEdit [name=email]").val(res.email);
                    $("#CustomerEdit [name=mobile]").val(res.mobile);
                    $("#CustomerEdit [name=dob]").val(res.dob);
                    $("#CustomerEdit [name=address]").val(res.address);
                    $("#CustomerEdit").modal("show");
                    // Toastify({text: data[1], duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"}).showToast();
                },
                error: function(error) {
                    Toastify({text: "Problem Setup Update Failed !", duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"}).showToast();
                }
            });
        }

        // deleteProblemSetUp
        function deletecustomer(id) {

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
                        url: 'customer_delete',
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
