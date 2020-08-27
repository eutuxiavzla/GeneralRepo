@extends('cms.layout.main')
@section('title')
    Usuarios
@endsection


@section('content')
    <h2>Usuarios de la administración</h2>
    <hr>
    <section class="container-fluid">
        <form action="{{ route('cms.users.create') }}" id="form_create_user" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                <h4 class="col-12">Crear usuarios</h4>
                <div class="col-md-4 form-group px-1">
                    <input class="form-control " type="text" name="name" placeholder="Nombre" autocomplete="off" required>
                </div>
                <div class="col-md-4 form-group px-1">
                    <input class="form-control " type="email" name="email" placeholder="Email" autocomplete="off" required>
                </div>
                <div class="col-md-4 form-group px-1">
                    <select class="form-control" name="role_id">
                        <option>Seleccionar rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group px-1">
                    <input class="form-control" type="password" id="contraseña" name="password" placeholder="Contraseña"
                        autocomplete="off" required>
                    <a href="#"><small class="inactive pass_watcher">Ver contraseña</small></a>
                </div>
                <div class="col-md-4 form-group px-1">
                    <input class="form-control" type="password" id="confirmar_contraseña" name="password2" placeholder="Confirmar contraseña"
                        autocomplete="off" required>
                    <a href="#"><small class="inactive pass_watcher">Ver contraseña</small></a>
                </div>
            </div>
            <div class="row form-group px-1">
                <input type="submit" id="crear_user_submit" class="btn btn-sm btn-primary px-5" value="Crear">
                <small id="emailHelp" style="display: none;" class="form-text text-danger col-12 px-1">Las contraseñas no coinciden.</small>
            </div>
        </form>

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <hr>
        <section class="mt-4">
            <table>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
                <tbody>
                    @foreach ($usuarios as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button type="button" id="{{ $user->id }}" class="btn btn-sm btn-info change_pass" data-toggle="modal"
                                    data-target="#modalContraseña">Editar Contraseña</button>
                                <button type="button" id="{{ $user->id }}" class="btn btn-sm btn-primary editar"
                                    data-toggle="modal" data-target="#modalEditar">Editar</button>
                                <button type="button" id="{{ $user->id }}" class="btn btn-sm btn-danger eliminar"
                                    data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </section>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="editar_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <h5>Nombre</h5>
                            <input id="editar_name" class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <h5>Email</h5>
                            <input id="editar_email" class="form-control" type="email" name="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="editar_submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="contraseña_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <h5>Nueva Contraseña</h5>
                            <input class="form-control" id="modal_password" type="password" name="password">
                            <a href="#"><small class="inactive modal_change_input">Ver contraseña</small></a>
                        </div>
                        <div class="form-group">
                            <h5>Confirmar Contraseña</h5>
                            <input class="form-control" id="modal_password_confirm" type="password" name="corfirm_password">
                            <a href="#"><small class="inactive modal_change_input">Ver contraseña</small></a>
                        </div>
                        <small id="modal_password_verify" style="display: none;" class="form-text text-danger col-12 px-1">Las contraseñas no coinciden.</small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="contraseña_submit" class="btn btn-primary">Actualizar Contraseña</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div id="eliminar_user">
                        
                    </div>
                    <form action="" id="eliminar_form" method="POST">
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Usuario</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let passChange = document.querySelectorAll('.pass_watcher');

        let modalPassChange = document.querySelectorAll('.modal_change_input');





        modalPassChange.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                let inputPass = e.target.parentNode.parentNode.children[1];
                let accion = e.target;



                if(accion.classList.contains('inactive'))
                {
                    inputPass.type = "text"
                    accion.classList.remove('inactive')
                    accion.classList.add('active')

                    accion.textContent = 'Ocultar contraseña';
                } else if(accion.classList.contains('active')) {
                    inputPass.type = "password"
                    accion.classList.remove('active')
                    accion.classList.add('inactive')

                    accion.textContent = 'Ver contraseña';
                }
            });
        });


        passChange.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                let inputPass = e.target.parentNode.parentNode.children[0];
                let accion = e.target;


                if(accion.classList.contains('inactive'))
                {
                    inputPass.type = "text"
                    accion.classList.remove('inactive')
                    accion.classList.add('active')

                    accion.textContent = 'Ocultar contraseña';
                } else if(accion.classList.contains('active')) {
                    inputPass.type = "password"
                    accion.classList.remove('active')
                    accion.classList.add('inactive')

                    accion.textContent = 'Ver contraseña';
                }
            });
        });
    </script>

    <script type="text/javascript">
        let editarButtons = document.querySelectorAll('.editar');
        let passButtons = document.querySelectorAll('.change_pass');
        let eliminarButtons = document.querySelectorAll('.eliminar');

        let editarSubmit = document.getElementById('editar_submit');
        let passSubmit = document.getElementById('contraseña_submit');
        let deleteSubmit = document.getElementById('eliminar_submit');


        //--------------SUBMIT CREAR USUARIOS ------------

        let alert_passwords = document.getElementById('emailHelp');
        let submitUserCreate = document.getElementById('crear_user_submit');

        submitUserCreate.addEventListener('click', (e) => {
            e.preventDefault();
            let password = document.getElementById('contraseña')
            let password_confirm = document.getElementById('confirmar_contraseña')
            let form = document.getElementById('form_create_user');

            if(password.value == password_confirm.value)
            {
                console.log('entrar');
                form.submit();
            } else {
                alert_passwords.style.display = 'block';
            }

        });



        deleteSubmit.addEventListener('click', (e) => {
            let form = document.getElementById('eliminar_form');

            form.submit();
        });

        passSubmit.addEventListener('click', (e) => {
            let form = document.getElementById('contraseña_form')
            let password_modal = document.getElementById('modal_password')
            let password_confirm_modal = document.getElementById('modal_password_confirm');
            let verify_modal_password = document.getElementById('modal_password_verify')


            if(password_modal.value === password_confirm_modal.value){
                form.submit();
            } else {
                verify_modal_password.style.display = 'block';
            }
        });

        editarSubmit.addEventListener('click', (e) => {
            let form = document.getElementById('editar_form')

            form.submit();
        });

        if (editarButtons) {
            editarButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    let id = e.target.id;
                    getUser(id, 'editar');
                });
            });
        }

        if (passButtons) {
            passButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    let id = e.target.id
                    getUser(id, 'contraseña');
                })
            });
        }

        if (eliminarButtons) {
            eliminarButtons.forEach(buttons => {
                buttons.addEventListener('click', (e) => {

                    let eliminar_user = document.getElementById('eliminar_user');
                    let user_info = e.target.parentNode.parentNode.children[1].textContent

                    eliminar_user.innerHTML = `
                        El usuario <strong>${user_info}</strong> sera eliminado. <br>
                        ¿Esta seguro que desea eliminarlo?
                    `

                    let id = e.target.id
                    getUser(id, 'eliminar');
                });
            });
        }

        function getUser(id, accion) {
            axios.get(`/cms/get/user/${id}`)
                .then(response => {
                    if (accion == 'editar') {
                        editarModal(response.data);
                    } else if (accion == 'contraseña') {
                        contraseñaModal(id);
                    } else if (accion == 'eliminar') {
                        eliminarModal(id);
                    }
                });
        }

        function eliminarModal(id) {
            let form = document.getElementById('eliminar_form')

            form.action = `/cms/eliminar/user/${id}`;

        }

        function contraseñaModal(id) {
            let form = document.getElementById('contraseña_form')

            form.action = `/cms/password/user/${id}`;
        }

        function editarModal(data) {
            let name = document.getElementById('editar_name');
            let email = document.getElementById('editar_email');
            let form = document.getElementById('editar_form');

            form.action = `/cms/update/user/${data.id}`
            name.value = data.name;
            email.value = data.email;
        }

    </script>
@endsection
