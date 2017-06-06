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
            <div class="form-group {{ $errors->has('grad_de_incarcare') ? ' has-error' : '' }}">
                <label>Grad de incarcare operator</label>
                <input type="text" class="form-control validate[required]" name="grad_de_incarcare" id="grad_de_incarcare" value="{{ old('grad_de_incarcare') ? old('grad_de_incarcare') : $grad->grad_de_incarcare }}" placeholder="grad">
                @if ($errors->has('grad_de_incarcare'))
                <span class="help-block">
                    <strong>{{ $errors->first('grad_de_incarcare') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('id_op') ? ' has-error' : '' }}">
                <label>Proces de productie</label>
                <select name="id_op" id="id_op"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare proces de productie</option>
                    @foreach ($operatori as $key => $option)
                    <option <?php echo $key == $grad->id_op ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_op'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_op') }}</strong>
                </span>
                @endif
            </div> 
            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare  
            </button>
        </div>
    </div>
</div>