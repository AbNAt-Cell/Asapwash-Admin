<form enctype="multipart/form-data" action="{{ route('stripe.update') }}" method="POST">
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col-2">
            <h5> {{__('Stripe Payment Gateway')}}</h5>
        </div>
        <div class="col-10 pr-0">
            <label class="switch switch-success mr-3">
                <span> {{__('')}}</span>
                <input type="checkbox" value="1" name="stipe_status" {{$master['stipe_status'] ? 'checked' : ''}}>
                <span class="slider"></span>
            </label>


        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('STRIPE_SECRET:')}}</label>
            <div class="input-group">
                <input type="password" name="STRIPE_SECRET"
                    class="form-control  @error('STRIPE_SECRET') invalid-input @enderror"
                    placeholder="{{__('Please Enter Valid Key')}}" required min="1"
                    value="{{$master['STRIPE_SECRET'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('STRIPE_SECRET')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('STRIPE_SECRET')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group col-6 mb-4">

            <label for="inputEmail4" class="ul-form__label"> {{__('STRIPE_KEY:')}}</label>
            <div class="input-group">
                <input type="password" name="STRIPE_KEY"
                    class="form-control  @error('STRIPE_KEY') invalid-input @enderror"
                    placeholder="{{__('Please Enter Valid Key')}}" required min="1"
                    value="{{$master['STRIPE_KEY'] ?? ''}}" id="STRIPE_KEY">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('STRIPE_KEY')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('STRIPE_KEY')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="https://stripe.com/docs/keys#obtain-api-keys" target="_blank" rel="noopener noreferrer" class="btn btn-raised ripple btn-raised-primary m-1">Help</a>
                    <button type="submit" class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                    <button type="reset"
                        class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>