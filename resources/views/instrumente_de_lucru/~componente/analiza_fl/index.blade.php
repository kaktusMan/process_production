@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>I.L. pentru analiza optimizarii fluxului de productie</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('optimizari-fl::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adauga I.L.</a>                        
                    </div>
                </div>
            </div>    
            <br>
            <div class="row">
                <!-- begin .flash-message -->
                @include('partials.flash_message')  
                <!-- end .flash-message -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <span>
                                            <span>Nume</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Flux de productie</span>        
                                        </span>
                                    </th> 
                                    <th>
                                        <span>
                                            <span>Detalii</span>        
                                        </span>
                                    </th>
                                    <th class="actions">
                                        <span>
                                            <span>Actiuni</span>
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($optimizari_fl->count())
                                @foreach ($optimizari_fl as $optimizare_fl)
                                <tr>                                    
                                    <td>{{ $optimizare_fl->nume }}</td>
                                    <td>{{ @$optimizare_fl->tipuriFl->nume }}</td>
                                    <td>{{ $optimizare_fl->detalii }}</td>
                                    <td class="actions">
                                        <a href="{{ route('optimizari-fl::edit',['id' =>$optimizare_fl->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $optimizare_fl->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $optimizare_fl->id,  'form_route'=> 'optimizari-fl::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista il pentru analiza optimizarii fp</td>
                                </tr>
                                @endif  
                            </tbody>
                        </table>                     
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection                  