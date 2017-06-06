@extends('layouts.admin')

@section('content')

<div class="master-wrapper">
    <div class="row">
        <div class="dashboard-container">
            <div class="row">
                <div class="container-title clearfix">
                    <h2>Il aferent proceselor de productie</h2>                   
                    <div class="dashboard-buttons">
                        <a href="{{ route('aferente-prp::create') }}" class="btn btn-purple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Adauga I.L.</a>                        
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
                                            <span>Cod</span>        
                                        </span>
                                    </th> 
                                    <th>
                                        <span>
                                            <span>Proces productie</span>        
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
                                @if ($il_aferente->count())
                                @foreach ($il_aferente as $il_aferent)
                                <tr>                                    
                                    <td>{{ $il_aferent->nume }}</td>
                                    <td>{{ $il_aferent->cod }}</td>
                                    <td>{{ @$il_aferent->tipuriPrp->nume }}</td>
                                    <td class="actions">
                                        <a href="{{ route('aferente-prp::edit',['id' =>$il_aferent->id]) }}" alt="Editează" title="Editează"><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                                        <a href="#" alt="Sterge" title="Sterge" data-toggle="modal" data-target=".delete-modal-{{ $il_aferent->id }}"><i class="fa fa-trash"></i>&nbsp;</a>                           
                                        @include('partials.delete_modal', ['id' => $il_aferent->id,  'form_route'=> 'aferente-prp::delete'])                        
                                    </td>                         
                                </tr>
                                @endforeach
                                @else
                                <tr class="odd pointer">
                                    <td class="text-center" colspan="7">Nu exista il aferente proceselor de productie</td>
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