@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Orele nete functionale pe schimbul de lucru</h2>                  
                    <div class="dashboard-buttons">
                        <a href="{{ route('ore-functionale::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare</a>                        
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
                                            <span>Numarul de ore a operatorilor</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Numarul de ore a I.L.</span>        
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
                                @if ($nr_ore->count())
                                @foreach ($nr_ore as $index)
                                <tr>                                    
                                    <td>{{ $index->ore_nete_op }}</td>
                                    <td>{{ $index->ore_nete_il }}</td>
                                    <td class="actions">
                                        <a href="{{ route('ore-functionale::edit',['id' =>$index->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $index->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $index->id, 'item' => $index->id, 'form_route'=> 'ore-functionale::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista detalii</td>
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
