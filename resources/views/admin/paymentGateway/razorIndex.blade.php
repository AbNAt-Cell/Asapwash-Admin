<form enctype="multipart/form-data" action="{{ route('razor.update') }}" method="POST">
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col-4">
            <h5> {{__('Razorpay Payment Gateway')}}</h5>
        </div>
        <div class="col-8 pr-0" >
            <label class="switch switch-success mr-3">
                <span> {{__('')}}</span>
                <input type="checkbox" value="1" name="razor_status" {{$master['razor_status'] ? 'checked' : ''}}>
                <span class="slider"></span>
            </label>


        </div>
        <div class="form-group col-6 mb-4">
            <label for="inputEmail4" class="ul-form__label"> {{__('RAZORPAY KEY:')}}</label>
            <div class="input-group">
                <input type="password" name="RAZOR_ID" class="form-control  @error('RAZOR_ID') invalid-input @enderror"
                    placeholder="{{__('Please Enter Valid Key')}}" required min="1"
                    value="{{$master['RAZOR_ID'] ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent pointer" onclick="toggleInput('RAZOR_ID')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('RAZOR_ID')
            <div class="invalid-div">{{ $message }}</div>
            @enderror

        </div>

    </div>
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="https://razorpay.com/docs/payments/dashboard/settings/api-keys/" target="_blank" rel="noopener noreferrer" class="btn btn-raised ripple btn-raised-primary m-1">Help</a>
                    <button type="submit" class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                    <button type="reset"
                        class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>