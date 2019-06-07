@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Datos del usuario' . $user->nombre . ' ' . $user->apellido)

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs//datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
    @include('layouts.partials.admin-sidebar')
    <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Admin Dashboard</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard') }} class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Usuarios</a></li>
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard/user-list') }} class="breadcrumb-link">Ver todos</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detalles del usuario</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- users table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Detalles del usuario: {{ $user->nombre}} {{ $user->apellido}}</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Nombre/s</th>
                                            <th>Apellido/s</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Pais</th>
                                            <th>Fecha de registro</th>
                                            <th>Fecha de nacimiento & Edad</th>
                                            <th>DNI</th>
                                            <th>Creditos</th>
                                            <th>Saldo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><button class="btn-primary" data-toggle="modal" data-target="#editUserModal" data-uid="{{ $user->id }}" data-nombre="{{ $user->nombre }}" data-apellido="{{ $user->apellido }}" data-saldo="{{ $user->saldo }}" data-creditos="{{ $user->creditos }}"><i class="far fa-edit"></i>Editar</button></td><td>{{ $user->id}}</td>
                                            <td>{{ $user->nombre}}</td>
                                            <td>{{ $user->apellido }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if($user->premium == 1)
                                                <td>
                                                    <i class="fas fa-ticket-alt"></i>Premium
                                                    <br>
                                                    <button class="btn-primary" data-toggle="modal" data-target="#demoteUserModal" data-uid="{{ $user->id }}"><i class="fas fa-user"></i>Convertir en básico</button>
                                                </td>
                                            @else
                                                <td>
                                                    <p class="text-center"><i class="fas fa-user"></i>Regular</p>
                                                    <br>
                                                    <button class="btn-primary" data-toggle="modal" data-target="#promoteUserModal" data-uid="{{ $user->id }}"><i class="fas fa-ticket-alt"></i>Convertir en premium</button>
                                                </td>
                                            @endif
                                            <td>{{ $user->pais }}</td>
                                            <td>{{ $user->created_at}}</td>
                                            <td>{{ $user->fecha_nacimiento }} ({{ $user->age}})</td>
                                            <td>{{ $user->DNI }}</td>
                                            <td>{{ $user->creditos }}</td>
                                            <td>${{ $user->saldo }}</td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Nombre/s</th>
                                            <th>Apellido/s</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Pais</th>
                                            <th>Fecha de registro</th>
                                            <th>Fecha de nacimiento & Edad</th>
                                            <th>DNI</th>
                                            <th>Creditos</th>
                                            <th>Saldo</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end users table  -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Alerts  -->
                    <!-- ============================================================== -->
                    <div class="flash-message"></div>
                    <!-- ============================================================== -->
                    <!-- End Alerts  -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->

    <!-- Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="editUserForm" action="{{ route('admin.editUser') }}" role="form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="userID"></label>
                                <input type="text" name="userID" class="form-control" id="userID" value="" hidden>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="userNombre">Nombre</label>
                                <input type="text" name="userNombre" class="form-control" id="userNombre" placeholder=""  disabled>
                                <div class="valid-feedback">
                                    Válido
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="userApellido">Apellido</label>
                                <input type="text" name="userApellido" class="form-control" id="userApellido" placeholder="" disabled>
                                <div class="valid-feedback">
                                    Válido
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="inputUserCreditos">Creditos</label>
                                <input type="number" name="userCreditos" class="form-control" id="inputUserCreditos" placeholder="" value="" autofocus>
                                <div class="valid-feedback">
                                    Válido
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="inputUserSaldo">Saldo</label>
                                <input type="number" step="0.01" name="userSaldo" class="form-control" id="inputUserSaldo" placeholder="" value="">
                                <div class="valid-feedback">
                                    Válido
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar cambios</button>
                    <button type="button" class="btn btn-primary" onclick="form_submit()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Promote User Modal -->
    <div class="modal fade" id="promoteUserModal" tabindex="-1" role="dialog" aria-labelledby="promoteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="promoteUserModalLabel">Convertir en Premium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="promoteUserForm">
                        <input type="text" name="promoteUserID" class="form-control" id="promoteUserID" value="" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="promoteUserSubmit">Convertir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Promote User Modal -->

    <!-- Demote User Modal -->
    <div class="modal fade" id="demoteUserModal" tabindex="-1" role="dialog" aria-labelledby="demoteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoteUserModalLabel">Convertir en Básico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="demoteUserForm">
                        <input type="text" name="demoteUserID" class="form-control" id="demoteUserID" value="" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="demoteUserSubmit">Convertir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Demote User Modal -->
@endsection

@section('js')
    <script> // Edit User

        // Reset modal input after closing it
        $('#editUserModal').on('hidden.bs.modal', function(e)
        {
            $("#editUserModal .modal-body input").val("")
        }) ;

        // Display user data
        $('#editUserModal').on('show.bs.modal', function (event) {
            var nombre = $(event.relatedTarget).data('nombre');
            var apellido = $(event.relatedTarget).data('apellido');
            var creditos = $(event.relatedTarget).data('creditos');
            var saldo = $(event.relatedTarget).data('saldo');
            var id = $(event.relatedTarget).data('uid');
            $(event.currentTarget).find('input[name="userNombre"]').attr('placeholder',nombre);
            $(event.currentTarget).find('input[name="userApellido"]').attr('placeholder',apellido);
            $(event.currentTarget).find('input[name="userCreditos"]').attr('value',creditos);
            $(event.currentTarget).find('input[name="userCreditos"]').attr('placeholder',creditos);
            $(event.currentTarget).find('input[name="userSaldo"]').attr('value',saldo);
            $(event.currentTarget).find('input[name="userSaldo"]').attr('placeholder',saldo);
            $(event.currentTarget).find('input[name="userID"]').attr('value',id);
            $(event.currentTarget).find('[autofocus]').focus();
        });

        // Set autofocus atribute
        $('#editUserModal').on('shown.bs.modal', function (event) {
            $(event.currentTarget).find('[autofocus]').focus();
        });

        // Button
        function form_submit() {
            var inputCreditos = document.getElementById("inputUserCreditos");
            var inputSaldo = document.getElementById("inputUserSaldo");

            if (inputCreditos && inputCreditos.value && inputSaldo && inputSaldo.value) {
                document.getElementById("editUserForm").submit();
            }
            else {
                alert ('Saldo y créditos no pueden estar vacíos');
            }
        }
    </script>

    <script> // Promote user

        // Display user data
        $('#promoteUserModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('uid');
            $(event.currentTarget).find('input[name="promoteUserID"]').attr('value',id);
        });
    </script>

    // Promote User
    <script>
        jQuery(document).ready(function(){
            jQuery('#promoteUserSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/admin/dashboard/promote-user') }}",
                    method: 'post',
                    data: {
                        id: jQuery('#promoteUserID').val(),
                    },
                    dataType: 'html', //Optional: type of data returned from server
                    success: function(data) {
                        $('div.flash-message').html(data);
                        $('').append('whatever you want');
                    }});
            });
        });
    </script>

    <script> // Demote

        // Display user data
        $('#demoteUserModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('uid');
            $(event.currentTarget).find('input[name="demoteUserID"]').attr('value',id);
        });
    </script>

    // Promote User
    <script>
        jQuery(document).ready(function(){
            jQuery('#demoteUserSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/admin/dashboard/demote-user') }}",
                    method: 'post',
                    data: {
                        id: jQuery('#demoteUserID').val(),
                    },
                    dataType: 'html', //Optional: type of data returned from server
                    success: function(data) {
                        $('div.flash-message').html(data);
                    }});
            });
        });
    </script>
@endsection