@extends('layouts.admin')
@section('content')

<div class="master-wrapper">
    <div class="row">       
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>{{ $form_title }}</h2>

                    <div class="dashboard-buttons">
                        <a href="{{route('actiuni::list') }}" class="btn btn-purple has-icon pull-right"><i class="fa fa-angle-left"></i> &nbsp;Înapoi</a>
                    </div>
                </div>
            </div>

            <br/>

            <form action="{{ $form_route }}" class="validationEngine" method="POST">
                @include('actiuni_de_productie.actiuni.form', ['actiuni' => $actiuni])
            </form>
        </div>
    </div>
</div>

@stop
