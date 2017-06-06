@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Caracteristici tehnice relevante pentru materiile prime</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('caract_materii::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adauga caracteristica</a>                        
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
                                            <span>Lungime finala</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Latime finala</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Inaltime finala</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Densitate</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Greutate finala</span>        
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
                                    <td>{{ $caracteristica->lungime_finala }}</td>
                                    <td>{{ $caracteristica->latime_finala }}</td>
                                    <td>{{ $caracteristica->inaltime_finala }}</td>
                                    <td>{{ $caracteristica->densitate }}</td>
                                    <td>{{ $caracteristica->greutate_finala }}</td>
                                    <td class="actions">
                                        <a href="{{ route('caract_materii::edit',['id' =>$caracteristica->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $caracteristica->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $caracteristica->id,  'form_route'=> 'caract_materii::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista caracteristici tehnice</td>
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