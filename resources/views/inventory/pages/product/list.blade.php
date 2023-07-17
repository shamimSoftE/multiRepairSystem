@extends('inventory.master')

@section('title', 'Product List')

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
                        <h4>Product List</h4>
                        <!-- Button trigger modal -->
                        <button type="button" style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#productAdd">
                            Add Product
                        </button>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-white">Name</th>
                            <th class="text-white">Model</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody id="productTable">

                        </tbody>
                    </table>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="paginationData" style=" float: right; ">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>



    <!--Add Modal -->
    <div class="modal fade" id="productAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="productLabel">Add Product</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;">&times;</span>
            </button>
            </div>
            <form action="{{ url('product_store') }}" method="POST">
                @csrf

                <div class="modal-body ">
                    <div class="form-group">
                        <label>Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Product Name" required>
                    </div>

                    <div class="form-group">
                        <label>Brand/Model<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control text-white" name="model" value="{{ old('model') }}" placeholder="Product Brand/Model" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control text-white" cols="15" rows="5" placeholder="Product Description">{{ old('description') }}</textarea>
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
    <div class="modal fade" id="productEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="proLabelEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proLabelEdit">Edit Product</h5>
                    <button type="button" class="btn-close text-white"
                        style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;"
                        data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ url('product_update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control text-white" name="name" value="{{ old('name') }}" placeholder="Product Name" required>
                        </div>

                        <div class="form-group">
                            <label>Brand/Model<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control text-white" name="model" value="{{ old('model') }}" placeholder="Product Brand/Model" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control text-white" cols="15" rows="5" placeholder="Product Description">{{ old('description') }}</textarea>
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
        // get product ===========================================================================
        var pageNum = 1;
        pageNum = $('.active>.page-link, .page-link.active').text();

        function loadRecords(page = pageNum) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: '/products?page=' + page,
                method: 'GET',
                success: function (response) {
                    $('#productTable').html(response);
                }
            });
        }

        $(document).ready(function () {
            loadRecords();
        });



         // product Edit=============================================================================
         function editProduct(id) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: 'product_edit',
                method: 'GET',
                data: {id: id},
                success: function (res) {
                    console.log(res);
                    $("#productEdit [name=id]").val(res.id);
                    $("#productEdit [name=name]").val(res.name);
                    $("#productEdit [name=model]").val(res.model);
                    $("#productEdit [name=model]").val(res.model);
                    $("#productEdit [name=description]").val(res.description);
                    $("#productEdit").modal("show");
                    // Toastify({text: data[1], duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"}).showToast();
                },
                error: function(error) {
                    Toastify({text: "Problem Setup Update Failed !", duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"}).showToast();
                }
            });
        }

        // deleteProblemSetUp
        function deleteProduct(id) {

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
                        url: 'product_delete',
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
