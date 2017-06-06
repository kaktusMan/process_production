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
            <div class="form-group {{ $errors->has('lungime_maxima') ? ' has-error' : '' }}">
                <label>Lungime maxima </label>
                <input type="text" class="form-control validate[required]" name="lungime_maxima" id="lungime_maxima" value="{{ old('lungime_maxima') ? old('lungime_maxima') : $caracteristica->lungime_maxima }}" placeholder="lungime">
                @if ($errors->has('lungime_maxima'))
                <span class="help-block">
                    <strong>{{ $errors->first('lungime_maxima') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('latime_maxima') ? ' has-error' : '' }}">
                <label>Latime maxima</label>
                <input type="text" class="form-control validate[required]" name="latime_maxima" id="latime_maxima" value="{{ old('latime_maxima') ? old('latime_maxima') : $caracteristica->latime_maxima }}" placeholder="latime">
                @if ($errors->has('latime_maxima'))
                <span class="help-block">
                    <strong>{{ $errors->first('latime_maxima') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('inaltime_maxima') ? ' has-error' : '' }}">
                <label>Inaltime maxima</label>
                <input type="text" class="form-control validate[required]" name="inaltime_maxima" id="inaltime_maxima" value="{{ old('inaltime_maxima') ? old('inaltime_maxima') : $caracteristica->inaltime_maxima }}" placeholder="inaltime">
                @if ($errors->has('inaltime_maxima'))
                <span class="help-block">
                    <strong>{{ $errors->first('inaltime_maxima') }}</strong>
                </span>
                @endif              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('volum') ? ' has-error' : '' }}">
                <label>Volum</label>
                <input type="text" class="form-control validate[required]" name="volum" id="volum" value="{{ old('volum') ? old('volum') : $caracteristica->volum }}" placeholder="volum">
                @if ($errors->has('volum'))
                <span class="help-block">
                    <strong>{{ $errors->first('volum') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('greutate') ? ' has-error' : '' }}">
                <label>Greutate </label>
                <input type="text" class="form-control validate[required]" name="greutate" id="greutate" value="{{ old('greutate') ? old('greutate') : $caracteristica->greutate }}" placeholder="greutate">
                @if ($errors->has('greutate'))
                <span class="help-block">
                    <strong>{{ $errors->first('greutate') }}</strong>
                </span>
                @endif              
            </div>
             
            <br/>
            <button type="submit" class="btn btn-purple submit has-icon pull-right" style="margin-top: 12px;">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare Caracteristici
            </button>
        </div>
    </div>
</div>






