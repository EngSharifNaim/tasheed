@if(isset($cities))@foreach ($cities as $key=>$city)	<hr><div class="row" ><div class="col-md-4" >	<div class="form-group  center" style="margin-right:40px;">		<div class="md-checkbox has-info">			<input type="checkbox" id="citie_ids_{{$key}}" class="md-check"  name="citie_ids[]" value="{{ $city->id }}" checked="checked" readonly="true"  >			<label  class=" control-label" for="citie_ids_{{$key}}">				<span></span>				<span class="check"></span>				<span class="box"></span> : {{ __('admin.shiping_to_city') }} => @if(Lang::locale() == 'ar') {{ $city->name_ar }} @else {{ $city->name_en }} @endif  </label>		</div>		<!----->	</div></div><div class="col-md-6" >	<div class="form-group">		<label class="col-md-4 control-label">{{ __('admin.shiping_coast') }} :</label>		<div class="col-md-8">			<input type="number"  class="form-control " name="shiping_coast[]" value="{{ old('shiping_coast') }}" placeholder="{{ __('admin.shiping_coast') }}" required = "true" >		</div>	</div></div></div>	<hr>@endforeach@endif@if(isset($shipings))@foreach($shipings as $key=>$shiping)<hr><div class="row" >	<div class="col-md-4" >		<div class="form-group  center" style="margin-right:40px;">			<div class="md-checkbox has-info">				<input type="checkbox" id="citie_ids_{{$key}}" class="md-check"  name="citie_ids[]" value="{{ $shiping->citie->id }}" checked="checked" readonly="true"  >				<label  class=" control-label" for="citie_ids_{{$key}}">					<span></span>					<span class="check"></span>					<span class="box"></span> : {{ __('admin.shiping_to_city') }} => @if(Lang::locale() == 'ar') {{ $shiping->citie->name_ar }} @else {{ $shiping->citie->name_en }} @endif  </label>			</div>			<!----->		</div>	</div>	<div class="col-md-6" >		<div class="form-group">			<label class="col-md-4 control-label">{{ __('admin.shiping_coast') }} :</label>			<div class="col-md-8">				<input type="number"  class="form-control " name="shiping_coast[]" value="{{ $shiping->shiping_coast }}" placeholder="{{ __('admin.shiping_coast') }}" required = "true" >			</div>		</div>	</div></div><hr>@endforeach@endif