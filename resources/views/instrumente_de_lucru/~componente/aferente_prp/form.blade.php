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
                <label>Nume</label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $il_aferent->nume }}" placeholder="nume">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('cod') ? ' has-error' : '' }}">
                <label>Cod</label>
                <input type="text" class="form-control validate[required]" name="cod" id="cod" value="{{ old('cod') ? old('cod') : $il_aferent->cod }}" placeholder="cod">
                @if ($errors->has('cod'))
                <span class="help-block">
                    <strong>{{ $errors->first('cod') }}</strong>
                </span>
                @endif              
            </div>
             <div class="form-group {{ $errors->has('nr_inventar') ? ' has-error' : '' }}">
                <label>Numar de inventar</label>
                <input type="text" class="form-control validate[required]" name="nr_inventar" id="nr_inventar" value="{{ old('nr_inventar') ? old('nr_inventar') : $il_aferent->nr_inventar }}" placeholder="numar inventar">
                @if ($errors->has('nr_inventar'))
                <span class="help-block">
                    <strong>{{ $errors->first('nr_inventar') }}</strong>
                </span>
                @endif              
            </div>
            
        </div>

       <div class="col-md-6">
             <div class="form-group {{ $errors->has('detalii') ? ' has-error' : '' }}">
                <label>Detalii</label> 
                <input type="area" class="form-control validate[required]" name="detalii" id="detalii" value="{{ old('detalii') ? old('detalii') : $il_aferent->detalii }}" placeholder="detalii">
                @if ($errors->has('detalii'))
                <span class="help-block">
                    <strong>{{ $errors->first('detalii') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('id_prp') ? ' has-error' : '' }}">
                <label>Tip proces de productie</label>
                <select name="id_prp" id="id_prp"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare tip proces de porductie</option>
                    @foreach ($tipuri_procese as $index => $value)
                    <option <?php echo $index == $il_aferent->id_prp ? 'selected="selected"' : ''; ?> value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_prp'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_prp') }}</strong>
                </span>
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-purple submit has-icon pull-right" style="margin-top: 12px;">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare Il
            </button>
        </div>
    </div>
</div>






