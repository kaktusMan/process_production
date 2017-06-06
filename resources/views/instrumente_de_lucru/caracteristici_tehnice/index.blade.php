@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Caracteristici tehnice relevante</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('caracteristici::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare</a>                        
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
                                            <span>Lungime maxima</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Latime maxima</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Inaltime maxima</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Volum</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Greutate</span>        
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
                                @if ($caracteristici->count())
                                @foreach ($caracteristici as $caracteristica)
                                <tr>                                    
                                    <td>{{ $caracteristica->lungime_maxima }}</td>
                                    <td>{{ $caracteristica->latime_maxima }}</td>
                                    <td>{{ $caracteristica->inaltime_maxima }}</td>
                                    <td>{{ $caracteristica->volum }}</td>
                                    <td>{{ $caracteristica->greutate }}</td>
                                    <td class="actions">
                                        <a href="{{ route('caracteristici::edit',['id' =>$caracteristica->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $caracteristica->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $caracteristica->id,  'form_route'=> 'caracteristici::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista caracteristici tehnice relevante</td>
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




