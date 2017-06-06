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
    {{-- <div class="form-center"> --}}
        <div class="tab-content clearfix">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('nume') ? ' has-error' : '' }}">
            <label>Nume</label>
            <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $operator->nume }}" placeholder="nume prenume">
            @if ($errors->has('nume'))
            <span class="help-block">
                <strong>{{ $errors->first('nume') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('id_tip_op') ? ' has-error' : '' }}">
            <label>Tip</label>
            <select name="id_tip_op" id="id_tip_op"  class="custom-select validate[required]" data-search="5">
                <option value="">Setare tip operator</option>
                @foreach ($tipuri_operatori as $key => $option)
                <option <?php echo $key == $operator->id_tip_op ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                @endforeach
            </select>
            @if ($errors->has('id_tip_op'))
            <span class="help-block">
                <strong>{{ $errors->first('id_tip_op') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('varsta') ? ' has-error' : '' }}">
            <label>Varsta</label>
            <input type="text" class="form-control validate[required]" name="varsta" id="varsta" value="{{ old('varsta') ? old('varsta') : $operator->varsta }}" placeholder="varsta operator">
            @if ($errors->has('varsta'))
            <span class="help-block">
                <strong>{{ $errors->first('varsta') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('id_pp') ? ' has-error' : '' }}">
            <label>Instalatia de productie</label>
            <select name="id_pp" id="id_pp"  class="custom-select validate[required]" data-search="5">
                <option value="">Setare instalatie</option>
                @foreach ($instalatii as $key => $option)
                <option <?php echo $key == $operator->id_pp ? 'selected="selected"' : ''; ?> value="{{ $key }}">{{ $option }}</option>
                @endforeach
            </select>
            @if ($errors->has('id_pp'))
            <span class="help-block">
                <strong>{{ $errors->first('id_pp') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('sex') ? ' has-error' : '' }}">
            <label>Sex</label>
            <select name="sex" id="sex"  class="custom-select validate[required]" data-search="5">
                <option value="">Setare sex</option>
                @foreach ($sex_optiuni as $key1 => $val)
                <option <?php echo $val == $operator->sex ? 'selected="selected"' : ''; ?> value="{{ $val }}">{{ $key1 }}</option>
                @endforeach
            </select>
            @if ($errors->has('id_mod_realizare'))
            <span class="help-block">
                <strong>{{ $errors->first('id_mod_realizare') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('stare_civila') ? ' has-error' : '' }}">
            <label>Starea civila</label>
            <select name="stare_civila" id="stare_civila"  class="custom-select validate[required]" data-search="5">
                <option value="">Setare stare civila</option>
                @foreach ($starea_civila_optiuni as $index => $value)
                <option <?php echo $value == $operator->stare_civila ? 'selected="selected"' : ''; ?> value="{{ $value }}">{{ $index }}</option>
                @endforeach
            </select>
            @if ($errors->has('stare_civila'))
            <span class="help-block">
                <strong>{{ $errors->first('stare_civila') }}</strong>
            </span>
            @endif
        </div>
         <div class="form-group {{ $errors->has('salar_brut') ? ' has-error' : '' }}">
            <label>Salar brut Lei</label>
            <input type="text" class="form-control validate[required]" name="salar_brut" id="salar_brut" value="{{ old('salar_brut') ? old('salar_brut') : $operator->salar_brut }}" placeholder="salar brut">
            @if ($errors->has('salar_brut'))
            <span class="help-block">
                <strong>{{ $errors->first('salar_brut') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">

        <div class="form-group {{ $errors->has('nivel_performanta') ? ' has-error' : '' }}">
            <label>Nivel performanta</label>
            <input type="text" class="form-control validate[required]" name="nivel_performanta" id="nivel_performanta" value="{{ old('nivel_performanta') ? old('nivel_performanta') : $operator->nivel_performanta }}" placeholder="nivel performanta">
            @if ($errors->has('nivel_performanta'))
            <span class="help-block">
                <strong>{{ $errors->first('nivel_performanta') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('val_bonuri_de_masa') ? ' has-error' : '' }}">
            <label>Valoare bonuri de masa</label>
            <input type="text" class="form-control validate[required]" name="val_bonuri_de_masa" id="val_bonuri_de_masa" value="{{ old('val_bonuri_de_masa') ? old('val_bonuri_de_masa') : $operator->val_bonuri_de_masa }}" placeholder="valoare bonuri de masa">
            @if ($errors->has('val_bonuri_de_masa'))
            <span class="help-block">
                <strong>{{ $errors->first('val_bonuri_de_masa') }}</strong>
            </span>
            @endif
        </div>

         <div class="form-group {{ $errors->has('data_angajarii') ? ' has-error' : '' }}">
            <label>Data angajarii</label>
            <input type="date" class="form-control validate[required]" name="data_angajarii" id="data_angajarii" value="{{ old('data_angajarii') ? old('data_angajarii') : $operator->data_angajarii }}">
            @if ($errors->has('data_angajarii'))
            <span class="help-block">
                <strong>{{ $errors->first('data_angajarii') }}</strong>
            </span>
            @endif
        </div>


        <br/>  
        <button type="submit" class="btn btn-purple submit has-icon pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare  
        </button>
    </div>
        
</div>
</div>
