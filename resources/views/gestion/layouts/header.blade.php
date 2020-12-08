
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin1" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" style="border-bottom: 1px solid gainsboro;top:-10px;" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand justify-content-center" href="home">
                        <!-- Logo icon -->
                        <b class="logo-icon d-lg-none d-xl-block">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <span style="font-family: 'Goldman', cursive; color:black;">JM</span>
                        </b>
                        <!--End Logo icon -->
                        <span class="logo-text d-none d-lg-block d-xl-none">
                             <span style="font-family: 'Goldman', cursive; color:black;">JESUS MORIS</span>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <li class="nav-item hidden-sm-down">
                            <h4 class="text-white ml-3">Sistema de gestión de contenido</h4>
                        </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-black waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="object-fit: cover;width:2em;height:2em;" src="{{ ((\Auth::user()->image_path!=null)?\Auth::user()->image_path:'/img/person.png') }}" alt="user" class="rounded-circle"> {{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="{{ ((\Auth::user()->image_path!=null)?\Auth::user()->image_path:'/img/person.png') }}" alt="user" class="rounded" style="object-fit: cover;width:6em;height:6em;"></div>
                                    <div class="ml-2">
                                        <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                        <p class=" mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="$('#cuentaModal').modal('show')" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Mi cuenta</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr-1 ml-1"></i> Cerrar sesión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="home" aria-expanded="false"><i class="mr-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        @can('view user')
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="usuarios" aria-expanded="false">
                                <i class="mr-3 fa fa-user" aria-hidden="true"></i><span
                                    class="hide-menu">Usuarios</span></a>
                        </li>
                        @endcan
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="publicaciones" aria-expanded="false"><i class="mr-3 fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Publicaciones</span></a>
                        </li>
                        @can('view config')
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="configuracion" aria-expanded="false"><i class="mr-3 fa fa-cog"
                                    aria-hidden="true"></i><span class="hide-menu">Configuraciones</span></a>
                        </li>
                        @endcan
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
                   <!-- Modal nuevo -->
                   <div class="modal fade" id="cuentaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mi cuenta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formCuenta">
                            <input type="hidden" id="id_usuario" value="-1"/>
                            <div class="form-group text-center">
                                    <img style="object-fit: cover;width:12em;height:12em;border:1px solid gainsboro;" src="{{ ((\Auth::user()->image_path!=null)?\Auth::user()->image_path:'/img/person.png') }}">
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="inputImagenPerfil">
                                        <label class="custom-file-label" for="customFile">Seleccione una imagen</label>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Nombre</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputName" placeholder="Nombre" value="{{ \Auth::user()->name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Email</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ \Auth::user()->email }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-md-4 col-form-label">Fch. nacimiento</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputDate" value="{{ date('Y-m-d', strtotime(\Auth::user()->dob)) }}" placeholder="Fecha de nacimiento" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-md-4 col-form-label">Password</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
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

            <script>
                $(document).ready(function(){
                    $('#formCuenta').submit(function(e){
                        e.preventDefault();
                        
                        var fd = new FormData();
                        var files = $('#inputImagenPerfil')[0].files;
                    
                        if(files.length > 0 ){
                            fd.append('image',files[0]);
                        }

                        fd.append('name', $('#inputName').val());
                        fd.append('email', $('#inputEmail').val());
                        if($('#inputPassword').val() != '')
                            fd.append('password', $('#inputPassword').val());
                        fd.append('role', '{{\Auth::user()->roles[0]->id}}');
                        fd.append('dob', $('#inputDate').val());

                    $.ajax({
                        data:fd,
                        url: '/gestion/usuarios/editar/{{\Auth::user()->id}}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        contentType: false,
                        processData: false,
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
                
            </script>

