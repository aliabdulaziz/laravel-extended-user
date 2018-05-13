@extends('laravelextendeduser::layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- User Profile -->
            <form class="card user-profile" method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="card-header">
                    <h4 class="float-left mb-0 mt-2">User Profile</h4>
                    <div class="btn-group float-right text-uppercase" role="group">
                        <a href="{{ route('profile') }}" class="btn btn-secondary btn-100">Cancel</a>
                        <button type="button" class="btn btn-success btn-100 text-uppercase" onclick="submitForm(event)">Save</button>
                    </div>
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
                
                @if(config('laravelextendeduser.profile.avatar') !== false)
                <div class="card-body border-bottom">
                    <!-- Image -->
                    <div class="user-profile-image">
                        <div class="user-profile-image--default">
                            <img src="{{ url($user->image) }}">
                        </div>
                        <div class="user-profile-image--selection">
                            <img src="{{ url($user->image) }}">
                        </div>
                        <div class="user-profile-image--button">
                            <input type="file" name="image">
                            <div class="user-profile-image--button-label">Change</div>
                        </div>
                    </div>
                    @if(isset($user->profile['image']))
                    <div class="mt-2 text-center">
                        <button type="button" class="btn btn-light text-danger text-uppercase font-weight-bold btn-100"
                        onclick="removeUserProfileImage()">
                            Remove
                        </button>
                    </div>
                    @endif
                </div>
                 @endif

                <div class="card-header">
                    <h5 class="float-left mb-0 mt-1 w-100 text-center">
                        <span class="text-info">{{ $user->email }}</span> <small class="text-muted font-italic">(Private)</small>
                    </h5>
                </div>

                <div class="card-body">
                    <div class="form-group row pt-3">
                        <label for="name" class="col-sm-4 col-form-label text-sm-right">
                            Name <small class="text-danger font-italic">(Required)</small>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" value="{{ (old()) ? old('name') : $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="job" class="col-sm-4 col-form-label text-sm-right">Job</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="job" name="job" 
                            value="{{ (old()) ? old('job') : ( (isset($user->profile['job'])) ? $user->profile['job'] : '' ) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-4 col-form-label text-sm-right">Company</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="company" name="company" 
                            value="{{ (old()) ? old('company') : ( (isset($user->profile['company'])) ? $user->profile['company'] : '' ) }}">
                        </div>
                    </div>
                </div>
                
                @if(config('laravelextendeduser.profile.contact') !== false)
                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Contact</h5>
                </div>

                <div class="card-body">
                    <!-- Phones -->
                    <div class="dynamic-form-fields">
                    @if($phones =  (old()) ? old('phones') : ( (isset($user->profile['phones'])) ? $user->profile['phones'] : null ))
                        @foreach($phones as $key => $phone)
                        <div class="form-group row dynamic-form-field">
                            @unless($key)
                            <label class="col-sm-4 col-form-label text-sm-right">Phone no.</label>
                            @else
                            <label class="col-sm-4 col-form-label text-sm-right"></label>
                            @endunless
                            <div class="col-auto">
                                <input type="text" class="form-control" style="width: 75px;" name="{{ 'phones['.$key.'][0]' }}" 
                                value="{{ $phone[0] }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="{{ 'phones['.$key.'][1]' }}" 
                                value="{{ $phone[1] }}">
                            </div>  
                            <div class="col-auto pl-0">
                                @unless($key)
                                <button type="button" class="btn btn-success add-new-field-button" onclick="addNewField(event, 'phones', true)" 
                                {{ (count($phones) > 2) ? 'disabled' : 'enabled' }}>
                                    +
                                </button>
                                @else
                                <button type="button" class="btn btn-danger remove-field-button" onclick="deleteField(event)">
                                    -
                                </button>
                                @endunless
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="form-group row dynamic-form-field">
                            <label class="col-sm-4 col-form-label text-sm-right">Phone no.</label>
                            <div class="col-auto">
                                <input type="text" class="form-control" style="width: 75px;" name="phones[0][0]">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="phones[0][1]">
                            </div>  
                            <div class="col-auto pl-0">
                                <button type="button" class="btn btn-success add-new-field-button" onclick="addNewField(event, 'phones', true)">
                                    +
                                </button>
                            </div>
                        </div>
                    @endif
                    </div>
                    <!-- Mobiles -->
                    <div class="dynamic-form-fields">
                    @if($mobiles =  (old()) ? old('mobiles') : ( (isset($user->profile['mobiles'])) ? $user->profile['mobiles'] : null ))
                        @foreach($mobiles as $key => $mobile)
                        <div class="form-group row dynamic-form-field">
                            @unless($key)
                            <label class="col-sm-4 col-form-label text-sm-right">Mobile no.</label>
                            @else
                            <label class="col-sm-4 col-form-label text-sm-right"></label>
                            @endunless
                            <div class="col-auto">
                                <input type="text" class="form-control" style="width: 75px;" name="{{ 'mobiles['.$key.'][0]' }}" 
                                value="{{ $mobile[0] }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="{{ 'mobiles['.$key.'][1]' }}" 
                                value="{{ $mobile[1] }}">
                            </div>  
                            <div class="col-auto pl-0">
                                @unless($key)
                                <button type="button" class="btn btn-success add-new-field-button" onclick="addNewField(event, 'mobiles', true)" 
                                {{ (count($mobiles) > 2) ? 'disabled' : 'enabled' }}>
                                    +
                                </button>
                                @else
                                <button type="button" class="btn btn-danger remove-field-button" onclick="deleteField(event)">
                                    -
                                </button>
                                @endunless
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="form-group row dynamic-form-field">
                            <label class="col-sm-4 col-form-label text-sm-right">Mobile no.</label>
                            <div class="col-auto">
                                <input type="text" class="form-control" style="width: 75px;" name="mobiles[0][0]">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="mobiles[0][1]">
                            </div>  
                            <div class="col-auto pl-0">
                                <button type="button" class="btn btn-success add-new-field-button" onclick="addNewField(event, 'mobiles', true)">
                                    +
                                </button>
                            </div>
                        </div>
                    @endif
                    </div>
                    <!-- Emails -->
                    <div class="dynamic-form-fields">
                    @if($emails =  (old()) ? old('emails') : ( (isset($user->profile['emails'])) ? $user->profile['emails'] : null ))
                        @foreach($emails as $key => $email)
                        <div class="form-group row dynamic-form-field">
                            @unless($key)
                            <label class="col-sm-4 col-form-label text-sm-right">Email</label>
                            @else
                            <label class="col-sm-4 col-form-label text-sm-right"></label>
                            @endunless
                            <div class="col">
                                <input type="text" class="form-control" name="{{ 'emails['.$key.']' }}" 
                                value="{{ $email }}">
                            </div>  
                            <div class="col-auto pl-0">
                                @unless($key)
                                <button type="button" class="btn btn-success add-new-field-button" onclick="addNewField(event, 'emails')" 
                                {{ (count($emails) > 2) ? 'disabled' : 'enabled' }}>
                                    +
                                </button>
                                @else
                                <button type="button" class="btn btn-danger remove-field-button" onclick="deleteField(event)">
                                    -
                                </button>
                                @endunless
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="form-group row dynamic-form-field">
                            <label class="col-sm-4 col-form-label text-sm-right">Email</label>
                            <div class="col">
                                <input type="text" class="form-control" name="emails[0]">
                            </div>  
                            <div class="col-auto pl-0">
                                <button type="button" class="btn btn-success add-new-field-button" onclick="addNewField(event, 'emails')">
                                    +
                                </button>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
                @endif
                
                @if(config('laravelextendeduser.profile.address') !== false)
                <div class="card-header border-top">
                    <h5 class="float-left mb-0 mt-1">Address</h5>
                </div>
                
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-sm-right">Country</label>
                        <div class="col">
                            <!-- use <select name="country"> to auto-list countries -->
                            <select class="form-control" name="country" 
                            data-value="{{ (old()) ? old('country') : ( (isset($user->profile['country'])) ? $user->profile['country'] : '' ) }}">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-sm-right">Town / City</label>
                        <div class="col">
                            <input type="text" class="form-control" name="city" 
                            value="{{ (old()) ? old('city') : ( (isset($user->profile['city'])) ? $user->profile['city'] : '' ) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-sm-right">Street / Road</label>
                        <div class="col">
                            <input type="text" class="form-control" name="road" 
                            value="{{ (old()) ? old('road') : ( (isset($user->profile['road'])) ? $user->profile['road'] : '' ) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-sm-right">Building</label>
                        <div class="col">
                            <input type="text" class="form-control" name="building" 
                            value="{{ (old()) ? old('building') : ( (isset($user->profile['building'])) ? $user->profile['building'] : '' ) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-sm-right">Office</label>
                        <div class="col">
                            <input type="text" class="form-control" name="office" 
                            value="{{ (old()) ? old('office') : ( (isset($user->profile['office'])) ? $user->profile['office'] : '' ) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-sm-right">Extra Details</label>
                        <div class="col">
                            <input type="text" class="form-control" name="extra_details" 
                            value="{{ (old()) ? old('extra_details') : ( (isset($user->profile['extra_details'])) ? $user->profile['extra_details'] : '' ) }}">
                        </div>
                    </div>
                </div>
                @endif

                <div class="card-footer">
                    <div class="btn-group float-right text-uppercase" role="group">
                        <a href="{{ route('profile') }}" class="btn btn-secondary btn-100">Cancel</a>
                        <button type="button" class="btn btn-success btn-100 text-uppercase" onclick="submitForm(event)">Save</button>
                    </div>
                </div>
            </form>
            <!-- /User Profile -->
            
            @if(config('laravelextendeduser.profile.avatar') !== false)
            <!-- Remove User Profile Image -->
            <form id="remove-user-image-form" method="POST" action="{{ url('profile/image') }}">
                {{ csrf_field() }}

                {{ method_field('DELETE') }}
            </form>
            <!-- /Remove User Profile Image -->
            @endif
            
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function submitForm(event) {

        let form = $(event.target).closest('form')[0];

        form.submit();
    }

    function addNewField(event, name, multiFields = false) {

        let parent = $(event.target).closest('.dynamic-form-fields');
        let fields = parent.find('.dynamic-form-field');

        if (fields.length > 1) {
            $(event.target).prop('disabled', true);
        }

        // Organize indexes
        let counter = 0;

        $(fields).each(function (event) {

            if (multiFields) {
                for (i = 0; i < 2; i++) {
                    $($(this).find('input')[i]).attr('name', name+'['+counter+']['+i+']');
                }
            } else {
                $(this).find('input').attr('name', name+'['+counter+']');
            }

            counter++;

        });

        // Append new field
        if (multiFields) {
            var content = '<div class="form-group row dynamic-form-field">'+
                '<label class="col-sm-4 col-form-label text-sm-right"></label>'+
                '<div class="col-auto">'+
                    '<input type="text" class="form-control" style="width: 75px;" name="'+name+'['+fields.length+'][0]">'+
                '</div>'+
                '<div class="col">'+
                    '<input type="text" class="form-control" name="'+name+'['+fields.length+'][1]">'+
                '</div>'+
                '<div class="col-auto pl-0">'+
                    '<button type="button" class="btn btn-danger remove-field-button"'+ 
                    'onclick="deleteField(event)">'+
                        '-'+
                    '</button>'+
                '</div>'+
            '</div>';
        } else {
            var content = '<div class="form-group row dynamic-form-field">'+
                '<label class="col-sm-4 col-form-label text-sm-right"></label>'+
                '<div class="col">'+
                    '<input type="text" class="form-control" name="'+name+'['+fields.length+']">'+
                '</div>'+
                '<div class="col-auto pl-0">'+
                    '<button type="button" class="btn btn-danger remove-field-button"'+ 
                    'onclick="deleteField(event)">'+
                        '-'+
                    '</button>'+
                '</div>'+
            '</div>';
        }

        parent.append(content);

    }

    function deleteField(event) {
        let parent = $(event.target).closest('.dynamic-form-field')[0];
        let addButton = $(parent).closest('.dynamic-form-fields')
            .find('.dynamic-form-field')
            .find('.add-new-field-button')[0];
        $(addButton).prop('disabled', false);
        parent.remove();
    }

    function removeUserProfileImage() {
        $('#remove-user-image-form').submit();
    }
</script>
@endsection
