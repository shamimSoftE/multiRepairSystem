@extends('inventory.master')

@section('title', 'Supplier List')

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
                    <h4>Supplier List</h4>
                    <!-- Button trigger modal -->
                    <button type="button" style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#supplierAdd">
                        Add Supplier
                    </button>
                </div>

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th class="text-white">Name</th>
                        <th class="text-white">Address</th>
                        <th class="text-white">Mobile</th>
                        <th class="text-white" title="Opening Balance">Balance</th>
                        <th class="text-white">Action</th>
                      </tr>
                    </thead>
                    <tbody id="supplierTable">

                    </tbody>
                  </table>
                </div>
                <div class="paginationData">{{ $suppliers->links() }}</div>
              </div>
            </div>
        </div>
    </div>



    <!--Add Modal -->
    <div class="modal fade" id="supplierAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="suppliearLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title fs-5" id="suppliearLabel">Add New Supplier</h5>
            <button type="button" class="close text-white fs-5" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;">&times;</span>
            </button>
            </div>
            <form action="{{ url('supplier_store') }}" method="POST">
                @csrf
                <div class="modal-body ">

                    <div class="form-group">
                        <label>Supplier Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Supplier name">
                    </div>

                    <div class="form-group">
                        <label>Address<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="address" value="{{ old('address') }}" placeholder="Supplier address">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Mobile Number<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control text-white" name="mobile" value="{{ old('mobile') }}" placeholder="Supplier mobile number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control text-white" name="phone" value="{{ old('phone') }}" placeholder="Supplier phone">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label >E-mail</label>
                        <input type="email" class="form-control text-white" name="email" value="{{ old('email') }}" placeholder="Supplier email">
                    </div>

                    <div class="form-group">
                        <label>Web</label>
                        <input type="text" class="form-control text-white" name="web" value="{{ old('web') }}" placeholder="Supplier website link">
                    </div>

                    <div class="form-group d-flex">
                        <label style="width: 35%;margin-top: 12px;">Opening Balance<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="opening_balance" value="{{ old('opening_balance') }}" style="width: 85%;" placeholder="Supplier opening balance">
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
  <div class="modal fade" id="supplierEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="supplierLabelEdit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="supplierLabelEdit">Edit Supplier</h1>
          <button type="button" class="btn-close bg-dark text-white"
            style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;"
           data-bs-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <form action="{{ url('supplier_update') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Supplier Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control text-white" name="name" placeholder="Supplier name">
                </div>

                <input type="hidden" name="id">

                <div class="form-group">
                    <label>Address<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control text-white" name="address" placeholder="Supplier address">
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Mobile Number<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control text-white" name="mobile" placeholder="Supplier mobile number">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control text-white" name="phone" placeholder="Supplier phone">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label >E-mail</label>
                    <input type="email" class="form-control text-white" name="email" placeholder="Supplier email">
                </div>

                <div class="form-group">
                    <label>Web</label>
                    <input type="text" class="form-control text-white" name="web" placeholder="Supplier website link">
                </div>

                <div class="form-group d-flex">
                    <label style="width: 35%;margin-top: 12px;">Opening Balance<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control text-white" name="opening_balance" style="width: 85%;" placeholder="Supplier opening balance">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@push('script')
    <script>
        // get supplier data==========================================================================
        var pageNum = 1;
        pageNum = $('.active>.page-link, .page-link.active').text();

        function loadRecords(page = pageNum) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: '/supplier?page=' + page,
                method: 'GET',
                success: function (response) {
                    $('#supplierTable').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        // edit supplier==============================================================================
        function supplierEdit(id) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: 'supplier_edit',
                method: 'GET',
                data: {id: id},
                success: function (res) {
                    $("#supplierEdit [name=id]").val(res.id);
                    $("#supplierEdit [name=name]").val(res.name);
                    $("#supplierEdit [name=address]").val(res.address);
                    $("#supplierEdit [name=contact_person]").val(res.contact_person);
                    $("#supplierEdit [name=email]").val(res.email);
                    $("#supplierEdit [name=mobile]").val(res.mobile);
                    $("#supplierEdit [name=phone]").val(res.phone);
                    $("#supplierEdit [name=web]").val(res.web);
                    $("#supplierEdit [name=opening_balance]").val(res.opening_balance);
                    $("#supplierEdit").modal("show");
                    // Toastify({text: data[1], duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"}).showToast();
                },
                error: function(error) {
                    Toastify({text: "Supplier Update Failed !", duration: 10050, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"}).showToast();
                }
            });

        }

        $(document).ready(function () {
            loadRecords();

        });

        // delete confirm message
        function supplierDelete(id) {

            Swal.fire({
            title: 'Are you sure?',
            text: "want to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajaxSetup({ headers: {"X-CSRF-TOKEN": $( 'meta[name="csrf-token"]' ).attr("content"),}, });
                    $.ajax({
                        url: 'supplier_delete',
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


        // $(document).on('click', '.confirmDelete', function(params) {
        //     let id = $(".confirmDelete").attr("data_val");
        //     console.log(id);

        // })


    </script>



@endpush
