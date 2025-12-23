<form enctype="multipart/form-data" action="{{ route('paypal.update') }}" method="POST">
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col-2">
            <h5> {{__('PayPal Payment Gateway')}}</h5>
        </div>
        <div class="col-10 pr-0">
            <label class="switch switch-success mr-3">
                <span> {{__('')}}</span>
                <input type="checkbox" value="1" name="paypal_status" {{$master['paypal_status'] ? 'checked' : ''}}>
                <span class="slider"></span>
            </label>


        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('PRODUCTION_CLIENT_ID:')}}</label>
            <div class="input-group">
                <input type="password" name="P_PRODUCTION_CLIENT_ID"
                    class="form-control  @error('P_PRODUCTION_CLIENT_ID') invalid-input @enderror"
                    placeholder="{{__('Please Enter Valid Key')}}" required min="1"
                    value="{{$master['P_PRODUCTION_CLIENT_ID'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer"
                        onclick="toggleInput('P_PRODUCTION_CLIENT_ID')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('P_PRODUCTION_CLIENT_ID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('SANDBOX_CLIENT_ID:')}}</label>
            <div class="input-group">
                <input type="password" name="P_SANDBOX_CLIENT_ID"
                    class="form-control  @error('P_SANDBOX_CLIENT_ID') invalid-input @enderror"
                    placeholder="{{__('Please Enter Valid Key')}}" required min="1"
                    value="{{$master['P_SANDBOX_CLIENT_ID'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('P_SANDBOX_CLIENT_ID')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('P_SANDBOX_CLIENT_ID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="https://www.appinvoice.com/en/s/documentation/how-to-get-paypal-client-id-and-secret-key-22" target="_blank" rel="noopener noreferrer" class="btn btn-raised ripple btn-raised-primary m-1">Help</a>
                    <button type="submit" class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                    <button type="reset"
                        class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>