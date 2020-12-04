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
                                            <h3 class="page-title mb-0 p-0">Usuarios</h3>
                                            <div class="d-flex align-items-center">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
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
                                <table id="tabla" class="table dt-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>F. Nacimiento</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usuarios as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->dob }}</td>
                                                <td>{{ ucfirst($user->roles[0]->name) }}</td>
                                                <td>
                                                    @if($user->status)
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                    @else
                                                    <span class="badge badge-pill badge-danger">Inactivo</span>
                                                    @endif                                                    
                                                </td>
                                                <td>
                                                    @if($user->id != Auth::user()->id)
                                                        <button class="btn btn-danger btn-small" title="Bloquear/desbloquear usuario" onclick="actDesUsuario({{$user->id}})"><i class="fas <?php echo (($user->status)?'fa-lock':'fa-lock-open') ?>"></i></button>
                                                    @endif
                                                    <button title="Editar usuario" onclick="editarUsuario({{$user->id}})" class="btn btn-warning btn-small text-white"><i class="fas fa-pencil-alt"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                        <h5 class="modal-title" id="exampleModalLabel">Formulario nuevo usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="formNuevo">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Nombre</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="inputNameN" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmailN" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="inputPasswordN" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-4 col-form-label">Fecha de nacimiento</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="inputDOB" placeholder="Fecha de nacimiento" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-4 col-form-label">Rol</label>
                            <div class="col-md-8">
                                <select class="form-control" id="inputRolN" required>
                                    <option value="">Seleccione un rol</option>
                                    @role('superadmin')
                                    <option value="1">Superadministrador</option>
                                    @endrole
                                    <option value="2">Administrador</option>
                                    <option value="3">Escritor</option>
                                </select>
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
            <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario edición usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="formEditar">
                        <input type="hidden" id="id_usuario" value="-1"/>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Nombre</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="inputNameN2" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmailN2" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-4 col-form-label">Fecha de nacimiento</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="inputDOB2" placeholder="Fecha de nacimiento" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-4 col-form-label">Rol</label>
                            <div class="col-md-8">
                                <select class="form-control" id="inputRolN2" required>
                                    <option value="">Seleccione un rol</option>
                                    @role('superadmin')
                                    <option value="1">Superadministrador</option>
                                    @endrole
                                    <option value="2">Administrador</option>
                                    <option value="3">Escritor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="inputPassworNd" placeholder="Password">
                                <small><b>**</b> Solo modificar en caso de querer cambiar la contraseña.</small>
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
        $( "#inputDOB" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#inputDOB2" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#tabla').DataTable({
            responsive: true,
            language: { 
                url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            },
            dom: '<"toolbar">frtip',
            fnInitComplete: function(){
                $('div.toolbar').html('<button class="btn btn-primary" data-toggle="modal" data-target="#nuevoModal"><i class="fa fa-plus">&nbsp;Nuevo usuario</i></button>');
            }
        });
        $('#formNuevo').submit(function(e){
            e.preventDefault();
            var datos = {
                name: $('#inputNameN').val(),
                email: $('#inputEmailN').val(),
                password: $('#inputPasswordN').val(),
                dob: $('#inputDOB').val(),
                role: $('#inputRolN').val(),
            };
            console.log(datos);
            $.ajax({
                data:datos,
                url: '/gestion/usuarios',
                type: 'POST',
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

        $('#formEditar').submit(function(e){
            e.preventDefault();
            var datos = {
                name: $('#inputNameN2').val(),
                email: $('#inputEmailN2').val(),
                password: $('#inputPasswordN2').val(),
                dob: $('#inputDOB2').val(),
                role: $('#inputRolN2').val(),
            };
            console.log(datos);
            $.ajax({
                data:datos,
                url: '/gestion/usuarios/' + $('#id_usuario').val(),
                type: 'PUT',
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
    } );

    function actDesUsuario(id){
        $.ajax({
                data:{id:id},
                url: '/gestion/usuarios/habilitar',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        }).done(function(data){
                if(data.status == 'ok'){
                    location.reload();
                }else{
                    alert(data.msg);
                }
        });
    }

    function editarUsuario(id){
        $.ajax({
            url: '/gestion/usuarios/' + id,
            type: 'GET',
        }).done(function(data){
            $('#inputNameN2').val(data.name);
            $('#inputEmailN2').val(data.email);
            $('#inputDOB2').val(data.dob);
            $('#inputRolN2').val(data.role.id);
            $('#id_usuario').val(data.id)
            $('#editarModal').modal('show');
        });

    }
</script>
@endsection