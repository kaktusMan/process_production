<div class="row">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{ csrf_field() }}
</div>
<div class="row">
    <div class="tab-content clearfix">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('nume') ? ' has-error' : '' }}">
                <label>Nume Instalatie </label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $instalatie->nume }}" placeholder="nume">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('cod') ? ' has-error' : '' }}">
                <label>Cod instalatie</label>
                <input type="text" class="form-control validate[required]" name="cod" id="cod" value="{{ old('cod') ? old('cod') : $instalatie->cod }}" placeholder="cod">
                @if ($errors->has('cod'))
                <span class="help-block">
                    <strong>{{ $errors->first('cod') }}</strong>
                </span>
                @endif              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('detalii') ? ' has-error' : '' }}">
                <label>Detalii</label> 
                <input type="area" class="form-control validate[required]" name="detalii" id="detalii" value="{{ old('detalii') ? old('detalii') : $instalatie->detalii }}" placeholder="detalii">
                @if ($errors->has('detalii'))
                <span class="help-block">
                    <strong>{{ $errors->first('detalii') }}</strong>
                </span>
                @endif              
            </div> 
            <br>
            <button type="submit" class="btn btn-purple submit has-icon pull-right" style="margin-top: 12px;">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare  
            </button>
        </div>
    </div>
</div>






