@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Actiuni de productie</h2>                       
                    <div class="dashboard-buttons">
                        <a href="{{ route('actiuni::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare acțiune de producție</a>                        
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
                                            <span>Nume operație</span>        
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
                            @if ($operatii->count())
                            @foreach ($operatii as $operatie)
                            <tr>                                    
                                <td>{{ $operatie->nume }}</td> 
                                <td class="actions">
                                    <a href="{{ route('actiuni::edit',['id' =>$operatie->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                    <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $operatie->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                    @include('partials.delete_modal', ['id' => $operatie->id, 'item' => $operatie->nume, 'form_route'=> 'actiuni::delete'])                        
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
