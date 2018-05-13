@extends('laravelextendeduser::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- User Profile -->
            <div class="card user-profile">
                <div class="card-header">
                    <h4 class="float-left mb-0 mt-2">User Profile</h4>
                    <a href="{{ url('/profile/edit') }}" class="btn btn-primary btn-100 float-right text-uppercase">Edit</a>
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
                
                @if(config('laravelextendeduser.profile.avatar') !== false)
                <div class="card-body border-bottom">
                    <!-- Image -->
                    <div class="user-profile-image">
                        <div class="user-profile-image--default">
                            <img src="{{ url($user->image) }}">
                        </div>
                    </div>
                </div>
                @endif

                <div class="card-header">
                    <h5 class="float-left mb-0 mt-1 w-100 text-center">
                        <span class="text-info">{{ $user->email }}</span> <small class="text-muted font-italic">(Private)</small>
                    </h5>
                </div>

                <div class="card-body">
                   <div class="row mb-2">
                        <div class="col-sm-6 text-sm-right">Name</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">{{ $user->name }}</span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Job</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['job'])) ? $user->profile['job'] : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Company</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['company'])) ? $user->profile['company'] : '' }}
                            </span>
                        </div>
                    </div>
                </div>

                @if(config('laravelextendeduser.profile.contact') !== false)
                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Contact</h5>
                </div>
                
                <div class="card-body">
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Phone no.</div>
                        <div class="col-sm-6 field-bg">
                        @if($phones =  (old()) ? old('phones') : ( (isset($user->profile['phones'])) ? $user->profile['phones'] : '' ))
                            @foreach($phones as $key => $phone)
                            <div class="row">
                                <span class="text-muted">
                                @if($phone[0])
                                   {{ '+'.$phone[0].' '.$phone[1] }}
                                @endif
                                </span>
                            </div>
                            @endforeach
                         @endif
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Mobile no.</div>
                        <div class="col-sm-6 field-bg">
                        @if($mobiles =  (old()) ? old('mobiles') : ( (isset($user->profile['mobiles'])) ? $user->profile['mobiles'] : '' ))
                            @foreach($mobiles as $key => $mobile)
                            <div class="row">
                                <span class="text-muted">
                                @if($mobile[0])
                                   {{ '+'.$mobile[0].' '.$mobile[1] }}
                                @endif
                                </span>
                            </div>
                            @endforeach
                         @endif
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Email</div>
                        <div class="col-sm-6 field-bg">
                        @if($emails =  (old()) ? old('emails') : ( (isset($user->profile['emails'])) ? $user->profile['emails'] : '' ))
                            @foreach($emails as $key => $email)
                            <div class="row">
                                <span class="text-muted">
                                   {{ $email }}
                                </span>
                            </div>
                            @endforeach
                         @endif
                        </div>
                    </div>
                </div>
                @endif
                
                @if(config('laravelextendeduser.profile.address') !== false)
                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Address</h5>
                </div>

                <div class="card-body">
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Country</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['country'])) ? $user->profile['country'] : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Town / City</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['city'])) ? $user->profile['city'] : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Street / Road</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['road'])) ? $user->profile['road'] : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Building</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['building'])) ? $user->profile['building'] : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Office</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['office'])) ? $user->profile['office'] : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-sm-6 text-sm-right">Extra Details</div>
                        <div class="col-sm-6 field-bg">
                            <span class="text-muted">
                                {{ (isset($user->profile['extra_details'])) ? $user->profile['extra_details'] : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <!-- /User Profile -->
            
        </div>
    </div>
</div>
@endsection