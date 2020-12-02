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
                                            <h3 class="page-title mb-0 p-0">Publicaciones</h3>
                                            <div class="d-flex align-items-center">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">Publicaciones</li>
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
                                                <th width="40%">Titulo</th>
                                                <th>Fecha creación</th>
                                                <th>Autor</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($entradas as $entrada)
                                                <tr>
                                                    <td>{{ $entrada->title }}</td>
                                                    <td>{{ $entrada->created_at }}</td>
                                                    <td>{{ $entrada->user->name }}</td>
                                                    <td>
                                                        @if($entrada->status)
                                                        <span class="badge badge-pill badge-success">Activo</span>
                                                        @else
                                                        <span class="badge badge-pill badge-danger">Inactivo</span>
                                                        @endif                                                    
                                                    </td>
                                                    <td>
                                                    <button class="btn btn-danger btn-small" title="Bloquear/desbloquear entrada" onclick="actDesPublicacion({{$entrada->id}})"><i class="fas <?php echo (($entrada->status)?'fa-lock':'fa-lock-open') ?>"></i></button>
                                                    <button onclick="editarPublicacion({{$entrada->id}})" class="btn btn-warning btn-small text-white"><i class="fas fa-pencil-alt"></i></button>
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario nueva publicación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="frmNueva">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Titulo</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="inputTitle" placeholder="Titulo de la publicación">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Imagen</label>
                                <div class="col-md-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputImagen">
                                        <label class="custom-file-label" for="customFile">Seleccione una imagen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Categorias</label>
                                <div class="col-md-10">
                                    <select multiple class="form-control" id="inputCategorias">
                                        @foreach($categorias as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div id="editor" style="height: 40vh">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario edicición publicación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="frmEditar">
                    <input type="hidden" id="id_publicacion" value="-1"/>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Titulo</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="inputTitle2" placeholder="Titulo de la publicación">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Imagen</label>
                                <div class="col-md-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputImagen2">
                                        <label class="custom-file-label" for="customFile">Seleccione una imagen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Categorias</label>
                                <div class="col-md-10">
                                    <select multiple class="form-control" id="inputCategorias2">
                                        @foreach($categorias as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div id="editor2" style="height: 40vh">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                    </div>
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
<link
      href="https://unpkg.com/quill-image-uploader@1.2.1/dist/quill.imageUploader.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/quill-image-uploader@1.2.1/dist/quill.imageUploader.min.js"></script>
<script src='https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js'></script>
<script>
    var quill2 = null;
    Quill.register("modules/imageUploader", ImageUploader);
    $(document).ready( function () {
        $('#tabla').DataTable({
            language: { 
                url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            },
            dom: '<"toolbar">frtip',
            fnInitComplete: function(){
                $('div.toolbar').html('<button class="btn btn-primary" data-toggle="modal" data-target="#nuevoModal"><i class="fa fa-plus">&nbsp;Nueva publicación</i></button>');
            }
        });
        $('#inputImagen').on('change',function(){
            var fieldVal = $(this).val();

            // Change the node's value by removing the fake path (Chrome)
            fieldVal = fieldVal.replace("C:\\fakepath\\", "");

            if (fieldVal != undefined || fieldVal != "") {
                $(this).next(".custom-file-label").attr('data-content', fieldVal);
                $(this).next(".custom-file-label").text(fieldVal);
            }
        })
        var quill = new Quill('#editor', {
            modules: {
                imageResize: {
                    displaySize: true
                },
                toolbar: [
                    [{ header: [1, 2, 3, 4, 5, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                    ['image', 'code-block'],
                ],
                imageUploader: {
                    upload: file => {
                        return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append("image", file);

                        fetch(
                            "https://api.imgbb.com/1/upload?key=bf5ce7990d902d8460a27bed8687799b",
                            {
                            method: "POST",
                            body: formData
                            }
                        )
                            .then(response => response.json())
                            .then(result => {
                            console.log(result);
                            resolve(result.data.url);
                            })
                            .catch(error => {
                            reject("Upload failed");
                            console.error("Error:", error);
                            });
                        });
                    }
                }
            },
            placeholder: 'Escribe tu publicación...',
            theme: 'snow'  // or 'bubble'
        });
        quill2 = new Quill('#editor2', {
            modules: {
                imageResize: {
                    displaySize: true
                },
                toolbar: [
                    [{ header: [1, 2, 3, 4, 5, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                    ['image', 'code-block'],
                ],
                imageUploader: {
                    upload: file => {
                        return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append("image", file);

                        fetch(
                            "https://api.imgbb.com/1/upload?key=bf5ce7990d902d8460a27bed8687799b",
                            {
                            method: "POST",
                            body: formData
                            }
                        )
                            .then(response => response.json())
                            .then(result => {
                            console.log(result);
                            resolve(result.data.url);
                            })
                            .catch(error => {
                            reject("Upload failed");
                            console.error("Error:", error);
                            });
                        });
                    }
                }
            },
            placeholder: 'Escribe tu publicación...',
            theme: 'snow'  // or 'bubble'
        });
        $('#frmNueva').submit(function(e){
            e.preventDefault();
            var content = quill.root.innerHTML
            var fd = new FormData();
            var files = $('#inputImagen')[0].files;
        
            if(files.length > 0 ){
                fd.append('image',files[0]);
            }

            fd.append('title', $('#inputTitle').val());
            fd.append('content', content);
            var cats = $('#inputCategorias').val();
            fd.append('categorias', cats);
            $.ajax({
                data:fd,
                url: '/gestion/publicaciones',
                type: 'POST',
                dataType: 'JSON',
                contentType: false,
                processData: false,
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
        $('#frmEditar').submit(function(e){
            e.preventDefault();
            var content = quill2.root.innerHTML
            var fd2 = new FormData();
            var files = $('#inputImagen2')[0].files;
        
            if(files.length > 0 ){
                fd2.append('image',files[0]);
            }

            fd2.append('title', $('#inputTitle2').val());
            fd2.append('content', content);
            var cats = $('#inputCategorias2').val();
            fd2.append('categorias', cats);
            console.log(fd2);
            $.ajax({
                data:fd2,
                url: '/gestion/publicaciones/' + $('#id_publicacion').val(),
                type: 'POST',
                processData: false,
                contentType: false,
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

    function actDesPublicacion(id){
        $.ajax({
                url: '/gestion/publicaciones/habilitar/' + id,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        }).done(function(data){
                if(data.status == 'ok'){
                    location.reload();
                }else{
                    alert(data.msg);
                }
        });
    }

    function editarPublicacion(id){
        $.ajax({
            url: '/gestion/publicaciones/' + id,
            type: 'GET',
        }).done(function(data){
            $('#inputTitle2').val(data.title);
            $.each(data.categorias, function(i,e){
                $("#inputCategorias2 option[value='" + e + "']").prop("selected", true);
            });
            quill2.container.firstChild.innerHTML = data.content;
            $('#id_publicacion').val(data.id)
            $('#editarModal').modal('show');
        });

    }
</script>
@endsection