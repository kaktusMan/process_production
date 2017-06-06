@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Schimburi de lucru</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('schimburi-de-lucru::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Creare</a>                        
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
                                            <span>Proces de productie</span>        
                                        </span>
                                    </th>
                                    <th>
                                        <span>
                                            <span>Numar de schimburi</span>        
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
                                @if ($nr_schimburi->count())
                                @foreach ($nr_schimburi as $operatie)
                                <tr>                                    
                                    <td>{{ @$operatie->Prp->nume }}</td>
                                    <td>{{ $operatie->val }}</td>
                                    <td class="actions">
                                        <a href="{{ route('schimburi-de-lucru::edit',['id' =>$operatie->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $operatie->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $operatie->id, 'item' => $operatie->nume, 'form_route'=> 'schimburi-de-lucru::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista schimburi de lucru pentru procesele de productie</td>
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
