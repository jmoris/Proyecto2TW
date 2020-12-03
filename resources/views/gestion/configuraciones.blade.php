@extends('gestion.layouts.app')

@section('contenido')
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- ============================================================== -->
                                <!-- Bread crumb and right sidebar toggle -->
                                <!-- ============================================================== -->
                                <div class="page-breadcrumb" style="padding-left: 0px!important;">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-8 align-self-center">
                                            <h3 class="page-title mb-0 p-0">Configuraciones</h3>
                                            <div class="d-flex align-items-center">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">Configuraciones</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="width:100%; margin-top:15px;"></div>
                                <!-- ============================================================== -->
                                <!-- End Bread crumb and right sidebar toggle -->
                                <!-- ============================================================== -->
                                <!-- ============================================================== -->
                                <!-- Container fluid  -->
                                <!-- ============================================================== -->
                                <div class="row">
                                        <div class="col-md-8" style="border-right: 1px solid gainsboro;">
                                            <legend><small>Categorias</small></legend>
                                            <table id="tabla" class="table dt-responsive" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th width="90%">Nombre</th>
                                                        <th width="10%">Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($categorias as $categoria)
                                                        <tr>
                                                            <td>{{ $categoria->name }}</td>
                                                            <td>
                                                                <button class="btn btn-danger btn-small" title="Eliminar categoria" onclick="eliminarCategoria({{$categoria->id}})"><i class="fas fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <legend><small>Opciones del blog</small></legend>
                                            <form id="frmConfig" class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="nroEntradas" class="col-sm-6 col-form-label">Nro. entradas</label>
                                                    <div class="col-sm-6">
                                                    <input type="number" class="form-control" id="nroEntradas" value="{{ $config->nro_entradas }}" min="1" max="10">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="filtroPopuplares">Filtro entradas populares</label>
                                                    <select class="form-control" id="filtroPopulares">
                                                        <option value="0" {{ (($config->filtro_populares==0)?'selected':'') }}>Vistas</option>
                                                        <option value="1" {{ (($config->filtro_populares==1)?'selected':'') }}>Rating</option>
                                                    </select>
                                                </div>
                                                <div class="mt-5 text-center">
                                                    <button type="submit" class="btn btn-primary btn-small"><i class="fa fa-save">&nbsp; Guardar cambios</i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal nuevo -->
            <div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario nueva categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="frmNuevo">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Nombre</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="inputName" placeholder="Nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </div>
                    </form>

                </div>
            </div>
@endsection

@section('scripts')
<style>
    .dataTables_filter {
        text-align: left !important;
        float: left !important;
    }
    .toolbar {
        float: right !important;
    }
</style>
<script>
    $(document).ready( function () {
        $('#tabla').DataTable({
            responsive: true,
            searching: false,
            language: { 
                url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            },
            dom: '<"toolbar">frtip',
            fnInitComplete: function(){
                $('div.toolbar').html('<button class="mb-1 btn btn-primary" data-toggle="modal" data-target="#nuevoModal"><i class="fa fa-plus">&nbsp;Nueva categoria</i></button>');
            }
        });

        $('#frmConfig').submit(function(e){
            e.preventDefault();
            var data = {
                nro_entradas : $('#nroEntradas').val(),
                filtro_populares : $('#filtroPopulares').val()
            };
            $.ajax({
                url: 'configuracion/blog',
                type: 'post',
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(data){
                if(data.status == 'ok'){
                    alert(data.msg);
                    location.reload();
                }else{
                    alert(data.msg);
                }
            });
        });

        $('#frmNuevo').submit(function(e){
            e.preventDefault();
            var data = {
                name : $('#inputName').val(),
            };
            $.ajax({
                url: 'configuracion/categoria',
                type: 'post',
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(data){
                if(data.status == 'ok'){
                    alert(data.msg);
                    location.reload();
                }else{
                    alert(data.msg);
                }
            });
        });
    });

    function eliminarCategoria(id){
        $.ajax({
            url: '/gestion/configuracion/categoria/'+ id,
            type: 'post',
            data: {id:id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        }).done(function(data){
            if(data.status == 'ok'){
                alert(data.msg);
                location.reload();
            }else{
                alert(data.msg);
            }
        });
    }
</script>
@endsection