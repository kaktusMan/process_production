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
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $il_posibil->nume }}" placeholder="nume">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('furnizor') ? ' has-error' : '' }}">
                <label>Furnizor</label>
                <input type="text" class="form-control validate[required]" name="furnizor" id="furnizor" value="{{ old('furnizor') ? old('furnizor') : $il_posibil->furnizor }}" placeholder="furnizor">
                @if ($errors->has('furnizor'))
                <span class="help-block">
                    <strong>{{ $errors->first('furnizor') }}</strong>
                </span>
                @endif              
            </div> 
        </div>

       <div class="col-md-6">

            <div class="form-group {{ $errors->has('marca') ? ' has-error' : '' }}">
                <label>Marca I.L.</label>
                <input type="text" class="form-control validate[required]" name="marca" id="marca" value="{{ old('marca') ? old('marca') : $il_posibil->marca }}" placeholder="marca instrument">
                @if ($errors->has('marca'))
                <span class="help-block">
                    <strong>{{ $errors->first('marca') }}</strong>
                </span>
                @endif              
            </div>
            
            <div class="form-group {{ $errors->has('id_tip_il') ? ' has-error' : '' }}">
                <label>Tip proces de productie</label>
                <select name="id_tip_il" id="id_tip_il"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare tip proces de porductie</option>
                    @foreach ($tipuri_il as $index => $value)
                    <option <?php echo $index == $il_posibil->id_tip_il ? 'selected="selected"' : ''; ?> value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_tip_il'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_tip_il') }}</strong>
                </span>
                @endif
            </div> 
            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare Il
            </button>
        </div>
    </div>
</div>






