@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Toate instrumentele de lucru</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('il-posibile::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adauga I.L.</a>                        
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
                                            <span>Furnizor</span>        
                                        </span>
                                    </th> 
                                    <th>
                                        <span>
                                            <span>Marca</span>        
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
                                @if ($il_posibile->count())
                                @foreach ($il_posibile as $il_posibil)
                                <tr>                                    
                                    <td>{{ $il_posibil->nume }}</td>
                                    <td>{{ $il_posibil->furnizor }}</td>
                                    <td>{{ $il_posibil->marca }}</td>
                                    <td>{{ @$il_posibil->tipuriIl->nume }}</td>
                                    <td class="actions">
                                        <a href="{{ route('il-posibile::edit',['id' =>$il_posibil->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $il_posibil->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $il_posibil->id,  'form_route'=> 'il-posibile::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista instrumente de lucru</td>
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