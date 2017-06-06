@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Operatori necesari pentru Functionarea I.L.</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('operatori-necesari::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare</a>                        
                    </div>
                </div>
            </div>   
            <br>
            <div class="row">
                @include('partials.flash_message')  
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <span>
                                            <span>Operatori</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Instrument de lucru</span>        
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
                                @if ($operatori_necesari->count())
                                @foreach ($operatori_necesari as $operator)
                                <tr>   
                                    <td>{{ $test->opName($operator->id_op)}}</td>
                                    <td>{{ $operator->Il->nume}}</td>
                                    <td class="actions">
                                        <a href="{{ route('operatori-necesari::edit',['id' =>$operator->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $operator->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $operator->id, 'item' => $operator->nume, 'form_route'=> 'operatori-necesari::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista operatori asignati pentru I.L.</td>
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
