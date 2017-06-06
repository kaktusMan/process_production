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
    <div class="form-center">
        <div class="tab-content clearfix">
            <div class="form-group {{ $errors->has('nume') ? ' has-error' : '' }}">
                <label>Nume modalitati</label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $modalitate->nume }}" placeholder="Nume modalitate de realizare">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div> 
            <div class="form-group {{ $errors->has('id_actiune') ? ' has-error' : '' }}">
                    <label>Actiune de productie</label>
                    <select name="id_actiune" id="id_actiune"  class="custom-select validate[required]" data-search="5" tabindex="8">
                        <option value="">Setare actiunea de productie</option>
                        @foreach ($tipuri_actiuni as $index => $value)
                        <option <?php echo $index == $modalitate->id_actiune ? 'selected="selected"' : ''; ?> value="{{ $index }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_actiune'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_actiune') }}</strong>
                    </span>
                    @endif
                </div>
            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare 
            </button>
        </div>
    </div>
</div>







