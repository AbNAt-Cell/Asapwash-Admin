<form enctype="multipart/form-data" action="{{ route('onesignal.update') }}" method="POST">
    @csrf
    <div class="row mb-3">



        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('APP_ID_USER')}}</label>
            <div class="input-group">
                <input type="text" name="APP_ID" class="form-control  @error('APP_ID') invalid-input @enderror"
                    required min="1" value="{{$master['APP_ID'] ?? ''}}">
            </div>
            @error('APP_ID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('APP_ID_OWNER')}}</label>
            <div class="input-group">
                <input type="text" name="APP_ID_OWNER" class="form-control  @error('APP_ID_OWNER') invalid-input @enderror"
                    required min="1" value="{{$master['APP_ID_OWNER'] ?? ''}}">
            </div>
            @error('APP_ID_OWNER')
            <div class="invalid-div">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('APP_ID_EMPLOYEE')}}</label>
            <div class="input-group">
                <input type="text" name="APP_ID_EMPLOYEE" class="form-control  @error('APP_ID_EMPLOYEE') invalid-input @enderror"
                    required min="1" value="{{$master['APP_ID_EMPLOYEE'] ?? ''}}">
            </div>
            @error('APP_ID_EMPLOYEE')
            <div class="invalid-div">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('REST_API_KEY_USER')}}</label>

            <div class="input-group">
                <input type="text" name="REST_API_KEY"
                    class="form-control  @error('REST_API_KEY') invalid-input @enderror" required min="1"
                    value="{{$master['REST_API_KEY'] ?? ''}}">
            </div>
            @error('REST_API_KEY')
            <div class="invalid-div">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('REST_API_KEY_OWNER')}}</label>

            <div class="input-group">
                <input type="text" name="REST_API_KEY_OWNER"
                    class="form-control  @error('REST_API_KEY_OWNER') invalid-input @enderror" required min="1"
                    value="{{$master['REST_API_KEY_OWNER'] ?? ''}}">
            </div>
            @error('REST_API_KEY_OWNER')
            <div class="invalid-div">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('REST_API_KEY_EMPLOYEE')}}</label>

            <div class="input-group">
                <input type="text" name="REST_API_KEY_EMPLOYEE"
                    class="form-control  @error('REST_API_KEY_EMPLOYEE') invalid-input @enderror" required min="1"
                    value="{{$master['REST_API_KEY_EMPLOYEE'] ?? ''}}">
            </div>
            @error('REST_API_KEY_EMPLOYEE')
            <div class="invalid-div">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('ORGANIZATION_AUTH_KEY')}}</label>
            <div class="input-group">
                <input type="text" name="USER_AUTH_KEY"
                    class="form-control  @error('USER_AUTH_KEY') invalid-input @enderror" required min="1"
                    value="{{$master['USER_AUTH_KEY'] ?? ''}}">
            </div>
            @error('TWILIO_SID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('PROJECT_NUMBER')}}</label>
            <div class="input-group">
                <input type="text" name="PROJECT_NUMBER"
                    class="form-control  @error('PROJECT_NUMBER') invalid-input @enderror" required min="1"
                    value="{{$master['PROJECT_NUMBER'] ?? ''}}">
            </div>
            @error('PROJECT_NUMBER')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="https://documentation.onesignal.com/docs/accounts-and-keys" target="_blank" rel="noopener noreferrer" class="btn btn-raised ripple btn-raised-primary m-1">Help</a>
                    <button type="submit" class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                    <button type="reset"
                        class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>