@extends('inventory.master')

@section('title', 'Problem Setup List')

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
                        <h4>Problem Setup List</h4>
                        <!-- Button trigger modal -->
                        <button type="button" style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#problemSetupAdd">
                            Add Problem Setup
                        </button>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-white">Name</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody id="problemSetupTable">

                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="paginationData" style=" float: right; ">{{ $problems->links() }}</div>
                </div>
            </div>
        </div>
    </div>



    <!--Add Modal -->
    <div class="modal fade" id="problemSetupAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="proSetUpLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proSetUpLabel">Add Problem Setup</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;">&times;</span>
                    </button>
                </div>
                <form action="{{ url('problemSetup_store') }}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <label>Problem Name<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control text-white" name="problem_name" value="{{ old('problem_name') }}" placeholder="Problem Setup Name">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- edit modal --}}
    <div class="modal fade" id="proSetUpEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="proSetUpLabelEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proSetUpLabelEdit">Edit ProblemSetup</h5>
                    <button type="button" class="btn-close bg-dark text-white"
                        style="border: none; background-color: black!important; font-size: 31px; font-weight: 100;"
                        data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ url('problemSetup_update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Problem Name<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control text-white" name="problem_name" value="{{ old('problem_name') }}" placeholder="Problem Setup Name">
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
        // get problem setUp data ==================================================================
        var pageNum = 1;
        pageNum = $('.active>.page-link, .page-link.active').text();

        function loadRecords(page = pageNum) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: '/problemSetup?page=' + page,
                method: 'GET',
                success: function (response) {
                    $('#problemSetupTable').html(response);

                }
            });
        }

        $(document).ready(function () {
            loadRecords();
        });

        // proSetUpEdit
        function editProblemSetUp(id) {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                url: 'problemSetup_edit',
                method: 'GET',
                data: {id: id},
                success: function (res) {
                    $("#proSetUpEdit [name=id]").val(res.id);
                    $("#proSetUpEdit [name=problem_name]").val(res.problem_name);
                    $("#proSetUpEdit").modal("show");
                    // Toastify({text: data[1], duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #4caf50, #4caf50)"}).showToast();
                },
                error: function(error) {
                    Toastify({text: "Problem Setup Update Failed !", duration: 1500, close: false, gravity: "top",  backgroundColor: "linear-gradient(to right, #f44336, #e91e63)"}).showToast();
                }
            });
        }

        // deleteProblemSetUp
        function deleteProblemSetUp(id) {

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
                        url: 'problemSetUp_delete',
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
