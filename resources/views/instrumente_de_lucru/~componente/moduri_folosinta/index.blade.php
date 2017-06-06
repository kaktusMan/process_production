@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Moduri de folosinta a il existente</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('mod-aplicare::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adauga mod</a>                        
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
                                    <th class="actions">
                                        <span>
                                            <span>Actiuni</span>
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($aplicatii->count())
                                @foreach ($aplicatii as $aplicatie)
                                <tr>                                    
                                    <td>{{ $aplicatie->nume }}</td>
                                    <td class="actions">
                                        <a href="{{ route('mod-aplicare::edit',['id' =>$aplicatie->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $aplicatie->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $aplicatie->id,  'form_route'=> 'mod-aplicare::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista moduri de folosinta</td>
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