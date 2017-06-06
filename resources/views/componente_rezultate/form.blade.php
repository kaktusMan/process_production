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
            <div class="form-group {{ $errors->has('lungime_finala') ? ' has-error' : '' }}">
                <label>Lungime finala </label>
                <input type="text" class="form-control validate[required]" name="lungime_finala" id="lungime_finala" value="{{ old('lungime_finala') ? old('lungime_finala') : $componenta->lungime_finala }}" placeholder="lungime">
                @if ($errors->has('lungime_finala'))
                <span class="help-block">
                    <strong>{{ $errors->first('lungime_finala') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('latime_finala') ? ' has-error' : '' }}">
                <label>Latime finala</label>
                <input type="text" class="form-control validate[required]" name="latime_finala" id="latime_finala" value="{{ old('latime_finala') ? old('latime_finala') : $componenta->latime_finala }}" placeholder="latime">
                @if ($errors->has('latime_finala'))
                <span class="help-block">
                    <strong>{{ $errors->first('latime_finala') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('inaltime_finala') ? ' has-error' : '' }}">
                <label>Inaltime finala</label>
                <input type="text" class="form-control validate[required]" name="inaltime_finala" id="inaltime_finala" value="{{ old('inaltime_finala') ? old('inaltime_finala') : $componenta->inaltime_finala }}" placeholder="inaltime">
                @if ($errors->has('inaltime_finala'))
                <span class="help-block">
                    <strong>{{ $errors->first('inaltime_finala') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('volum_brut') ? ' has-error' : '' }}">
                <label>Volum brut</label>
                <input type="text" class="form-control validate[required]" name="volum_brut" id="volum_brut" value="{{ old('volum_brut') ? old('volum_brut') : $componenta->volum_brut }}" placeholder="volum brut">
                @if ($errors->has('volum_brut'))
                <span class="help-block">
                    <strong>{{ $errors->first('volum_brut') }}</strong>
                </span>
                @endif              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('volum_net') ? ' has-error' : '' }}">
                <label>Volum net</label>
                <input type="text" class="form-control validate[required]" name="volum_net" id="volum_net" value="{{ old('volum_net') ? old('volum_net') : $componenta->volum_net }}" placeholder="volum net">
                @if ($errors->has('volum_net'))
                <span class="help-block">
                    <strong>{{ $errors->first('volum_net') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('greutate_finala') ? ' has-error' : '' }}">
                <label>Greutate finala </label>
                <input type="text" class="form-control validate[required]" name="greutate_finala" id="greutate_finala" value="{{ old('greutate_finala') ? old('greutate_finala') : $componenta->greutate_finala }}" placeholder="greutate finala">
                @if ($errors->has('greutate_finala'))
                <span class="help-block">
                    <strong>{{ $errors->first('greutate_finala') }}</strong>
                </span>
                @endif              
            </div> 
            <div class="form-group {{ $errors->has('densitate') ? ' has-error' : '' }}">
                <label>Densitate</label>
                <input type="text" class="form-control validate[required]" name="densitate" id="densitate" value="{{ old('densitate') ? old('densitate') : $componenta->densitate }}" placeholder="densitate">
                @if ($errors->has('densitate'))
                <span class="help-block">
                    <strong>{{ $errors->first('densitate') }}</strong>
                </span>
                @endif              
            </div>
            <div class="form-group {{ $errors->has('grad_rugozitate') ? ' has-error' : '' }}">
                <label>Gradul de rugozitate a suprafetei</label>
                <input type="text" class="form-control validate[required]" name="grad_rugozitate" id="grad_rugozitate" value="{{ old('grad_rugozitate') ? old('grad_rugozitate') : $componenta->grad_rugozitate }}" placeholder="grad rugozitate">
                @if ($errors->has('grad_rugozitate'))
                <span class="help-block">
                    <strong>{{ $errors->first('grad_rugozitate') }}</strong>
                </span>
                @endif              
            </div>
             
            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare  
            </button>
        </div>
    </div>
</div>






