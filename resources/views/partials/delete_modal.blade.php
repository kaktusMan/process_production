<div class="modal fade delete-modal delete-modal-{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Confirmare ștergere</h4>
            </div>
            <div class="modal-body">				
                <p>Sunteți sigur(ă) că doriți să ștergeți următorul element?</p><br>
                <strong>{{ @$item }}</strong>				
            </div>
            <div class="modal-footer">
                <form class="delete-form" action="{{ route($form_route, $id) }}" method="post">
                    {{ csrf_field() }}					
					<input type="hidden" name="url_params" value="{{ serialize(Request::all()) }}"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nu</button>
                    <button type="submit" class="btn btn-default">
                        Da
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>