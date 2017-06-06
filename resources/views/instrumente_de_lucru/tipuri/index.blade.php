@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Tipuri de lucru</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('tipuri::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adauga tip</a>                        
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
                                            <span>Nume tip</span>        
                                        </span>
                                    </th>
                                     <th>
                                        <span>
                                            <span>Nivele grupare</span>        
                                        </span>
                                    </th>
                                     <th>
                                        <span>
                                            <span>Moduri realizare</span>        
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
                                @if ($tipuri->count())
                                @foreach ($tipuri as $tip)
                                <tr>                                    
                                    <td>{{ $tip->nume }}</td>
                                    <td>{{ @$tip->nivele_grupare->nume }}</td>
                                    <td>{{ @$tip->modalitati_realiz->nume }}</td>
                                    <td class="actions">
                                        <a href="{{ route('tipuri::edit',['id' =>$tip->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $tip->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $tip->id, 'item' => $tip->nume, 'form_route'=> 'tipuri::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista tipuri de lucru</td>
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
