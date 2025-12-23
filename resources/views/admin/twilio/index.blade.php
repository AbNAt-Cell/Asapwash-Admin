<form enctype="multipart/form-data" action="{{ route('twilio.update') }}" method="POST">
    @csrf
    <div class="row mb-3">


        <div class="col-2 mt-3">
            <h5> {{__('SMS/User Verification')}}</h5>

        </div>
        <div class="col-4 mt-3 pr-0" >
            <label class="switch switch-success mr-3">
                <span> {{__('')}}</span>
                <input type="checkbox" value="1" name="verification" {{$master['verification'] ?? 0 ? 'checked' : ''}}>
                <span class="slider"></span>
            </label>


        </div>
        <div class="col-6 mt-3">
            <label class="radio radio-primary">
                <input type="radio" name="sms_gateway" {{$master['sms_gateway'] === 'twilio' ?? 0 ? 'checked' : ''}}
                    value="twilio">
                <span>TWILIO</span>
                <span class="checkmark"></span>
            </label>
            <label class="radio radio-secondary">
                <input type="radio" name="sms_gateway" {{$master['sms_gateway'] ==='textLocal' ?? 0 ? 'checked' : ''}}
                    value="textLocal">
                <span>TextLocal</span>
                <span class="checkmark"></span>
            </label>

        </div>


        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('COUNTRY_CODE')}}</label>
            <input type="text" name="country_code" class="form-control  @error('country_code') invalid-input @enderror"
                placeholder="{{__('Please Enter Admin %')}}" required min="1" value="{{$master['country_code'] ?? ''}}">
            @error('country_code')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('TWILIO_NUMBER')}}</label>
            <input type="text" name="TWILIO_NUMBER"
                class="form-control  @error('TWILIO_NUMBER') invalid-input @enderror"
                placeholder="{{__('Please Enter Admin %')}}" required min="1"
                value="{{$master['TWILIO_NUMBER'] ?? ''}}">
            @error('TWILIO_NUMBER')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('TWILIO_SID')}}</label>
            <div class="input-group">
                <input type="password" name="TWILIO_SID"
                    class="form-control  @error('TWILIO_SID') invalid-input @enderror"
                    placeholder="{{__('Please Enter Admin %')}}" required min="1"
                    value="{{$master['TWILIO_SID'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('TWILIO_SID')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('TWILIO_SID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('TWILIO_AUTH_TOKEN')}}</label>
            <div class="input-group">
                <input type="password" name="TWILIO_AUTH_TOKEN"
                    class="form-control  @error('TWILIO_AUTH_TOKEN') invalid-input @enderror"
                    placeholder="{{__('Please Enter Admin %')}}" required min="1"
                    value="{{$master['TWILIO_AUTH_TOKEN'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('TWILIO_AUTH_TOKEN')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('TWILIO_AUTH_TOKEN')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('TEXT_LOCAL_API')}}</label>
            <div class="input-group">
                <input type="password" name="TEXT_LOCAL_API"
                    class="form-control  @error('TEXT_LOCAL_API') invalid-input @enderror"
                    placeholder="{{__('Please Enter Admin %')}}" required min="1"
                    value="{{$master['TEXT_LOCAL_API'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('TEXT_LOCAL_API')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('TEXT_LOCAL_API')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="https://www.twilio.com/docs/glossary/what-is-an-api-key" target="_blank" rel="noopener noreferrer" class="btn btn-raised ripple btn-raised-primary m-1">Help</a>
                    <button type="submit" class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                    <button type="reset"
                        class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>