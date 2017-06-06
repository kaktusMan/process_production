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
                <label>Nume optimizare_fl </label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $optimizare_fl->nume }}" placeholder="nume">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('cod') ? ' has-error' : '' }}">
                <label>Cod optimizare_fl</label>
                <input type="text" class="form-control validate[required]" name="cod" id="cod" value="{{ old('cod') ? old('cod') : $optimizare_fl->cod }}" placeholder="cod">
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
                <input type="area" class="form-control validate[required]" name="detalii" id="detalii" value="{{ old('detalii') ? old('detalii') : $optimizare_fl->detalii }}" placeholder="detalii">
                @if ($errors->has('detalii'))
                <span class="help-block">
                    <strong>{{ $errors->first('detalii') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('id_fl') ? ' has-error' : '' }}">
                <label>Tip flux</label>
                <select name="id_fl" id="id_fl"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare tip flux</option>
                    @foreach ($tipuri_fluxuri as $index => $value)
                    <option <?php echo $index == $optimizare_fl->id_fl ? 'selected="selected"' : ''; ?> value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_fl'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_fl') }}</strong>
                </span>
                @endif
            </div>
            <br/>
            <button type="submit" class="btn btn-purple submit has-icon pull-right" style="margin-top: 12px;">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare optimizare_fl
            </button>
        </div>
    </div>
</div>