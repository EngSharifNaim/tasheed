
    <form  id='form_update_addresse' method="post" action="{{ url('/update-addresse') }}" >
        <input type="hidden" name="checkoutpage" value="1">
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('site.addresse_arabic_lang') }}</label>
            <div class="col-sm-9">
                <input type="text" name="name_ar" class="form-control form-control-" id="colFormLabel" placeholder="{{ __('site.addresse_arabic_lang') }}" value="{{ $addresse->addresse_ar }}" required="true">
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('site.addresse_english_lang') }}</label>
            <div class="col-sm-9">
                <input type="text" name="name_en"  class="form-control form-control" id="colFormLabel" placeholder="{{ __('site.addresse_english_lang') }}" value="{{ $addresse->addresse_en }}" required="true">
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" name="name_en" class="col-sm-3 col-form-label col-form-label">{{ __('admin.city_belong') }}
            </label>
            <div class="col-sm-9">
                <select name="countrie_id" class="form-control " required="true">
                    <option value="0">{{ __('admin.choosecountryfirst') }}</option>
                    @foreach ($countireslist as $countrie)
                        <option value="{{ $countrie->id }}" @if($addresse->countrie_id == $countrie->id ) selected="true" @endif>@if(Lang::locale() == 'ar') {{ $countrie->name_ar }} @else {{ $countrie->name_en }} @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('admin.belongcity') }}</label>
            <div class="col-sm-9">
                <select name="citie_id" class="form-control " required="true">
                    <option value="{{ $addresse->citie->id }}">@if(Lang::locale() == 'ar')  {{ $addresse->citie->name_ar }} @else {{ $addresse->citie->name_en }}  @endif</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label col-form-label">{{ __('site.region_id') }}</label>
            <div class="col-sm-9">
                <select name="region_id" class="form-control " required="true">
                    <option value="{{ $addresse->region->id }}">@if(Lang::locale() == 'ar')  {{ $addresse->region->name_ar }} @else {{ $addresse->region->name_en }}  @endif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="submit_check" value="1"  >
            <input type="hidden" name="addresse_id" value="{{ $addresse->id }}"  >
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            <button  data-update_addresse_id="{{ $addresse->id }}" name="update_addresse_values"  class="btn btn-primary save-modal-btn">{{ __('site.save') }}</button>
        </div>
    </form>
        <script type="text/javascript">
            $(document).ready(function(){
                //update addresse form
                $("#form_update_addresse").ajaxForm({
                    success: function (response) {
                        $('#update_addresse_model').modal('toggle') ;
                        $('#update_addresse_model').modal('hide') ;
                        alert('{{ __('site.addresse_updated_well') }}');
                        $("#addresse_user").html(response);
                    },
                    error: function (response) {
                        alert('{{ __('site.unknow_error_happen') }}');
                    }
                })

            });
            </script>

