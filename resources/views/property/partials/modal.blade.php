<!-- Central Modal Danger Demo-->
<div class="modal fade" id="ModalDanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading"><h3 class="white-text">Eliminacion de Inmueble</h3></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-3">
                        <p></p>
                        <p class="text-center"><i class="fa fa-close fa-4x"></i></p>
                    </div>

                    <div class="col-9">
                        <p>Esta a punto de eliminar completamente los registros asociados al inmueble seleccionado. </p>
                        <h2><span class="badge">Realmente desea elimarlo?</span></h2>
                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a class="btn btn-primary"
                    onclick="event.preventDefault();
                    document.getElementById('delete-form').submit();"
                >Si, deseo eliminarlo</i></a>
                {!!Form::open(['url'=>'inmuebles/'.$property->id,'id'=>'delete-form','method'=>'DELETE'])!!}
                    {{ csrf_field() }}
                {!!Form::close()!!}
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">No, gracias</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>