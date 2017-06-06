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
        <div class="form-center">
            <div class="form-group {{ $errors->has('operatori') ? ' has-error' : '' }}">
                <label>Selectare operatori</label>
                <select name="operatori[]" multiple class="custom-select">
                    @foreach ($operatori as $key1 => $option)
                    <option <?php echo in_array($key1, str_split($operator_necesar->id_op)) ? 'selected="selected"' : "" ?> value="{{ $key1 }}">{{ $option }}</option>
                    @endforeach 
                </select>
                @if ($errors->has('operatori'))
                <span class="help-block">
                    <strong>{{ $errors->first('operatori') }}</strong>
                </span>
                @endif  
            </div>
            
            <div class="form-group {{ $errors->has('id_il') ? ' has-error' : '' }}">
                <label>Instrumente de lucru</label>
                <select name="id_il" id="id_il"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare instrumente de lucru</option>
                    @foreach ($lista_il as $key => $option)
                    <option <?php echo $key == $operator_necesar->id_il ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_il'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_il') }}</strong>
                </span>
                @endif
            </div>
            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare
            </button>
        </div>
    </div>
</div>






