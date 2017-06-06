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
            <div class="form-group {{ $errors->has('nume') ? ' has-error' : '' }}">
                <label>Nume mod de folosinta </label>
                <input type="text" class="form-control validate[required]" name="nume" id="nume" value="{{ old('nume') ? old('nume') : $aplicatie->nume }}" placeholder="nume">
                @if ($errors->has('nume'))
                <span class="help-block">
                    <strong>{{ $errors->first('nume') }}</strong>
                </span>
                @endif              
            </div>
            <button type="submit" class="btn btn-purple submit has-icon pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Salvare mod
            </button>
        </div>
    </div>
</div>






