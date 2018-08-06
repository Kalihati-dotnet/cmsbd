<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="trash"></i> Are you sure you want to delete this?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                <form action="" id="delete_form" method="POST">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <input class="btn btn-danger pull-right delete-confirm" value="Yes, Delete it!" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>