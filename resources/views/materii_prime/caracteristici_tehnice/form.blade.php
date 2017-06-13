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
        <div class="col-md-12">   
            <div class="form-group {{ $errors->has('nume') ? ' has-error' : '' }}">
                <label>Lista caracteristici tehnice relevante</label>
                <select name="nume" id="nume"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare caracteristica tehnice relevante</option>
                    @foreach ($caracteristici_relevante as $index => $value)
                    <option <?php echo $index == $caracteristica->nume ? 'selected="selected"' : ''; ?> value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-purple submit has-icon pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare  
        </button>
    </div>
</div>





