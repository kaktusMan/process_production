@extends('layouts.admin')

@section('content')
<div class="master-wrapper main-dashboard">
    <div class="dashboard-container">
        <div class="row">
            <div class="container-title clearfix">
                <h2>Struncturarea Procesului de Productie</h2>
            </div>
        </div>

        <div class="row"> 
        </div><br><br>
        <div class="row ">

         	<div class="col-xs-12 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Referinte</h3>
                    </div>
                    <div class="panel-body padding-bottom">
                        <ul class="promotion-list">							
							<li><a href="https://en.wikipedia.org/wiki/Process" class="active" target="_blank" title="Process">Process</a></li>
							<li><a href="https://en.wikipedia.org/wiki/Business_processi/Process" target="_blank" title="Business processi">Business process</a></li>
							<li><a href="https://en.wikipedia.org/wiki/Manufacturing_process_managements" target="_blank" title="Manufacturing process managements">Manufacturing process managements</a></li>
	                    </ul>
                    </div>
                </div>
            </div> 
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cuvinte cheie</h3>
                    </div>
                    <div class="panel-body padding-bottom">
                        <ul class="promotion-list">							
						<li>Instrumente de lucru</li>
						<li>Flux de lucru</li>
						<li>Proces de lucru</li>
                    </ul>
                    </div>
                </div>
            </div> 
        </div> 
        
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                   <img src="{{ asset('image/proces.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
