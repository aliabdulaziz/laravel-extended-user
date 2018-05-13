@extends('laravelextendeduser::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- User Account -->
            <form class="card user-account" method="POST" action="{{ url('/account') }}">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="card-header">
                    <h4 class="float-left mb-0 mt-2">User Account</h4>
                </div>

                <div class="card-body pb-0 pt-0">
                @if (session('status'))
                    <div class="alert alert-success mb-0 mt-3">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>

                <div class="card-body pb-0 pt-0">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-0 mt-3">
                            <h4 class="font-weight-bold">Profile update failed!</h4>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="card-body border-bottom text-center">

                    <div class="row">
                        <div class="col">
                            <h5 class="mb-2">
                                {{ $user->name }}
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h5 class="mb-2">
                                <span class="text-info">{{ $user->email }}</span> 
                                <small class="text-muted font-italic">(Private)</small>
                            </h5>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col mt-2 text-right">
                            <h6 class="text-uppercase font-weight-bold">
                                Email Status
                            </h6>
                        </div>
                        <div class="col mt-2 text-left">
                            <h6 class="text-uppercase font-weight-bold">
                                <span class="bg-success custom-badge">Verified</span>
                            </h6>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mt-2 text-right">
                            <h6 class="text-uppercase font-weight-bold">
                                User Type
                            </h6>
                        </div>
                        <div class="col mt-2 text-left">
                            <h6 class="text-uppercase font-weight-bold">
                                <span class="bg-info custom-badge">Regular User</span>
                            </h6>
                        </div>
                    </div> -->

                </div>
                
                @if(config('laravelextendeduser.account.password_change') !== false)
                <div class="card-header">
                    <h5 class="float-left mb-0 mt-1">Change Password</h5>
                </div>
                
                <div class="card-body">
                    <div class="form-group row pt-3">
                        <label for="current-passowrd" class="col-sm-5 col-form-label text-sm-right">Current Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="current-passowrd" name="current_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-passowrd" class="col-sm-5 col-form-label text-sm-right">New Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="new-passowrd" name="new_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-passowrd-confirmation" class="col-sm-5 col-form-label text-sm-right">Confirm Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="new-passowrd-confirmation" name="new_password_confirmation">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-auto offset-md-5">
                            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </div>
                    </div>
                </div>
                @endif
                
                @if(config('laravelextendeduser.account.account_deletion') !== false)
                <div class="card-body border-top">
                    <a href="{{ url('account/delete') }}" class="btn btn-danger btn-block">
                        Delete My Account
                    </a>
                </div>
                @endif

            </form>
            <!-- /User Account -->
            
        </div>
    </div>
</div>
@endsection