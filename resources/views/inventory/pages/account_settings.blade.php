@extends('inventory.master')

@section('title', 'Technician List')

@push('style')

    <style>
    </style>

@endpush

@section('content')

    <div class="row">
        @if($user->type = 1)
            <div class="offset-md-2 col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-description text-center p-1"> <b class="text-info"> {{ $user->name }}'s </b> Update Your Information  </h5>
                        <form class="forms-sample" method="POST" action="{{ url('account_settings') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputUsername1">Username</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="{{ $user->name }}" placeholder="Username">
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}" placeholder="Email" readonly>
                            </div> --}}
                            <div class="form-group">
                                <label for="old_p">Old Password</label>
                                <input type="password" class="form-control" id="old_p" name="old_password" placeholder="*********">
                            </div>
                            <div class="form-group">
                                <label for="new_p">New Password</label>
                                <input type="password" class="form-control" id="new_p" name="new_password" placeholder="**********">
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" accept="image/*" name="avatar" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                          <input type="text" class="form-control file-upload-info" placeholder="Upload Image">
                                          <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" >
                                    <label>Preview Image</label>
                                    <div class="navbar-profile">
                                        <img class="img-xs rounded-circle" src="{{ asset('inventory/profile/'. $user->avatar) }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2" style=" float: right; ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        @else

        <div class="offset-md-1 col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h5 class="card-description text-center p-1"> <b class="text-info"> {{ $user->name }}'s </b> Update Your Information  </h5>
                    <form class="forms-sample" method="POST" action="{{ url('account_settings') }}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="{{ $user->name }}" placeholder="Username">
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}" placeholder="Email" readonly>
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="old_password" placeholder="*********">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="new_password" placeholder="**********">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="pass_confirm" placeholder="*********">
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="avatar" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                      <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                      <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                      </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4" style="float: right">
                                <label>Preview Image</label>
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="{{ asset('inventory/profile/'. $user->avatar) }}" alt="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" style=" float: right; ">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        @endif

    </div>



@endsection

@push('script')
<script src="{{ asset('inventory/assets/js/file-upload.js') }}"></script>
@endpush
