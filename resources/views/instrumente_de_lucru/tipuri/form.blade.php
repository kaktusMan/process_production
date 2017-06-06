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
                <label>Nume tip</label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $tip->nume }}" placeholder="Nume tip instrument de lucru">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('id_modalit_realiz') ? ' has-error' : '' }}">
                <label>Modalitate de realizare</label>
                <select name="id_modalit_realiz" id="id_modalit_realiz"  class="custom-select validate[required]" data-search="5" tabindex="8">
                    <option value="">Setare Modalitate</option>
                    @foreach ($modalitati_realiz as $key1 => $val)
                    <option <?php echo $key1 == $tip->id_modalit_realiz ? 'selected="selected"' : ''; ?> value="{{ $key1 }}">{{ $val }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_modalit_realiz'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_modalit_realiz') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('id_niv_grupare') ? ' has-error' : '' }}">
                <label>Nivele de grupare a actiunilor</label>
                <select name="id_niv_grupare" id="id_niv_grupare"  class="custom-select validate[required]" data-search="5" tabindex="8">
                    <option value="">Setare nivel grupare</option>
                    @foreach ($nivele_grupare as $key1 => $val)
                    <option <?php echo $key1 == $tip->id_niv_grupare ? 'selected="selected"' : ''; ?> value="{{ $key1 }}">{{ $val }}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_niv_grupare'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_niv_grupare') }}</strong>
                </span>
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-purple submit has-icon pull-right" style="margin-top: 12px;">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare Tip
            </button>
        </div>   
    </div>
</div>