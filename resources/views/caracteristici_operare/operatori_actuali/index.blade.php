@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Operatori actuali</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('operatori-actuali::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare</a>                        
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
                                            <span>Nivel de performanta</span>
                                        </span>
                                    </th>
                                     <th>
                                        <span>
                                            <span>Varsta</span>                                    
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Data angajarii</span>                                    
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Salar brut</span>
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Actiuni</span>
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($operatori->count())
                                @foreach ($operatori as $operatie)
                                <tr>                                    
                                    <td>{{ $operatie->nume }}</td>
                                    <td>{{ @$operatie->nivel_performanta}}</td>
                                    <td>{{ $operatie->varsta}}</td>
                                    <td>{{ @$operatie->data_angajarii}}</td>
                                    <td>{{ $operatie->salar_brut }} LEI</td>
                                    <td class="actions">
                                        <a href="{{ route('operatori-actuali::edit',['id' =>$operatie->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $operatie->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $operatie->id, 'item' => $operatie->nume, 'form_route'=> 'operatori-actuali::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista actiuni de productie</td>
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
