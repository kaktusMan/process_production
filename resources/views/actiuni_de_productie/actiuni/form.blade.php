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
<div class="tab-content clearfix">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('nume') ? ' has-error' : '' }}">
                <label>Nume acțiune de producție</label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $actiuni->nume }}" placeholder="Nume acțiune de producție">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('tranzitie_intre_op') ? ' has-error' : '' }}">
                <label>Tranziție între operație</label>
                <select name="tranzitie_intre_op" id="tranzitie_intre_op"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare traziție între operații</option>
                    @foreach ($optiuni as $key => $option)
                    <option <?php echo $option == $actiuni->tranzitie_intre_op ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
                @if ($errors->has('tranzitie_intre_op'))
                <span class="help-block">
                    <strong>{{ $errors->first('tranzitie_intre_op') }}</strong>
                </span>
                @endif
            </div>
           
        </div>
        <div class="col-md-6">
             <div class="form-group {{ $errors->has('stationare_op') ? ' has-error' : '' }}">
                <label>Staționare operatie</label>
                <select name="stationare_op" id="stationare_op"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare Staționare</option>
                    @foreach ($optiuni as $key => $option)
                    <option <?php echo $option == $actiuni->stationare_op ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
                @if ($errors->has('stationare_op'))
                <span class="help-block">
                    <strong>{{ $errors->first('stationare_op') }}</strong>
                </span>
                @endif
            </div>
                <div class="form-group {{ $errors->has('tipuri_id') ? ' has-error' : '' }}">
                    <label>Tip material</label>
                    <select name="tipuri_id" id="tipuri_id"  class="custom-select validate[required]" data-search="5" tabindex="8">
                        <option value="">Setare tip material</option>
                        @foreach ($tipuri_materiale as $index => $value)
                        <option <?php echo $index == $actiuni->tipuri_id ? 'selected="selected"' : ''; ?> value="{{ $index }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipuri_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tipuri_id') }}</strong>
                    </span>
                    @endif
                </div>
                
            <br/>  
        </div>
    </div>
    <div>
       <button type="submit" class="btn btn-purple submit has-icon pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare
        </button> 
    </div>
</div>