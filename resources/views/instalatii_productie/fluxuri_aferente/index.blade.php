@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Fluxurile instalatiilor de productie</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('fluxuri-pp::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare</a>                        
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
                                            <span>Cod</span>        
                                        </span>
                                    </th> 
                                    <th>
                                        <span>
                                            <span>Instalatia</span>        
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
                                @if ($fluxuri->count())
                                @foreach ($fluxuri as $flux)
                                <tr>                                    
                                    <td>{{ $flux->nume }}</td>
                                    <td>{{ $flux->cod }}</td>
                                    <td>{{ @$flux->tipuriPp->nume }}</td>
                                    <td class="actions">
                                        <a href="{{ route('fluxuri-pp::edit',['id' =>$flux->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $flux->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $flux->id,  'form_route'=> 'fluxuri-pp::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista fluxuri aferente instalatilor de productie</td>
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