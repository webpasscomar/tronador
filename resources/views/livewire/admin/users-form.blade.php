<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $muestraModal }}; background-color:rgba(51,51,51,0.9);">
    {{-- <div class="modal" tabindex="-1" role="dialog" wire:ignore.self> --}}

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">
                    @if ($user_id)
                        Editar usuario
                    @else
                        Crear usuario
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='closeModal'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="lastname">Apellido</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Apellido<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="lastname" id="lastname"
                                    wire:model="lastname">

                            </div>
                            @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-2">
                            <label class="sr-only" for="name">Nombre <small class="text-danger">
                                    *</small></label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nombre<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name"
                                    wire:model="name">

                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-2">
                            <label class="sr-only" for="email">E-mail <small class="text-danger">
                                    *</small></label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">E-mail<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <input type="mail" class="form-control" name="email" id="email"
                                    wire:model="email">

                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-2">
                            <label class="sr-only" for="rolesSelected">Role</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Role<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <select class="form-select" id="rolesSelected" aria-label="Default select example"
                                    name="rolesSelected" wire:model="rolesSelected">
                                    <option value="" selected>Seleccione un role</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('rolesSelected')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-2">
                            <label class="sr-only" for="password">Contraseña</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Contraseña<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="password" wire:model="password">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-2">
                            <label class="sr-only" for="repassword">Repetir contraseña</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Repetir contraseña<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <input type="password" class="form-control" id="repassword" name="repassword"
                                    wire:model="repassword">
                            </div>
                            @error('repassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span
                            class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                @if ($user_id !== 0)
                    <button wire:click="store" class="btn btn-primary">Actualizar</button>
                @else
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
