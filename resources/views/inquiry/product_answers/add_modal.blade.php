<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h2 class="modal-title" id="myModalLabel"><strong>Ваш склад</strong></h2>
</div>
<div id="result"></div>

<div class="modal-body no-padding">

    <form action="{{ route('asnwer.store') }}" method="post" class="smart-form">
        <fieldset>


        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                {{ trans('general.save') }}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('general.cancel') }}
            </button>
        </footer>
    </form>

</div>
