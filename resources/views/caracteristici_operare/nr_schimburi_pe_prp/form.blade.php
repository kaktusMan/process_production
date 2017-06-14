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
            <div class="form-group {{ $errors->has('id_prp') ? ' has-error' : '' }}">
                <label>Proces de productie</label>
                <select name="id_prp" id="id_prp"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare proces de productie</option>
                    @foreach ($procese_productie as $key => $option)
                    <option <?php echo $key == $nr_schimb->id_prp ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_prp'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_prp') }}</strong>
                </span>
                @endif
            </div> 
            <div class="form-group {{ $errors->has('val') ? ' has-error' : '' }}">
                <label>Numar de schimburi</label>
                <select name="val" id="val"  class="custom-select validate[required]" data-search="5">
                    <option value="">Setare numar de schimburi</option>
                    @foreach ($val_optiuni as $key1 => $val)
                    <option <?php echo $val == $nr_schimb->val ? 'selected="selected"' : ''; ?> value="{{ $val }}">{{ $key1 }}</option>
                    @endforeach
                </select>
                @if ($errors->has('val'))
                <span class="help-block">
                    <strong>{{ $errors->first('val') }}</strong>
                </span>
                @endif
            </div>

            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare  
            </button>
        </div>
    </div>
</div>