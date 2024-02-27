<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
     aria-hidden="true"
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
                        {{--Apellido--}}
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
                        {{--Nombre--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="name">Nombre</label>
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
                        {{--Email--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="email">E-mail</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">E-mail<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <input type="email" name="email" class="form-control" id="email"
                                       wire:model="email">

                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--Teléfono--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="phone">E-mail</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Teléfono</div>
                                </div>
                                <input type="number" class="form-control" name="phone" id="phone"
                                       wire:model="phone">
                            </div>
                        </div>
                        {{--Fecha de nacimiento--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="birthday">E-mail</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Fecha de nacimiento</div>
                                </div>
                                <input type="date" class="form-control" name="birthday" id="birthday"
                                       wire:model="birthday">
                            </div>
                            @error('birthday')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--Nacionalidad--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="nationality_id">Nacionalidad</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nacionalidad<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <select class="form-select" id="nationality_id" aria-label="Default select example"
                                        wire:model="nationality_id">
                                    <option value="" selected>Seleccione una nacionalidad</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('nationality_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--Organismo/Institución--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="institution_id">Organismo / Institución</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Organismo / Institución<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <select class="form-select" id="institution_id" aria-label="Default select example"
                                        name="institution_id" wire:model="institution_id">
                                    <option value="" selected>Seleccione la sigla</option>
                                    @foreach ($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->initial }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('institution_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--Role--}}
                        <div class="col-6 mb-2">
                            <label class="sr-only" for="rolesSelected">Rol</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rol<span
                                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                    </div>
                                </div>
                                <select class="form-select" id="rolesSelected" aria-label="Default select example"
                                        wire:model="rolesSelected">
                                    <option value="">Seleccione un rol</option>
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
                        {{--Contraseña--}}
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
                        {{--Repetir contraseña--}}
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
                {{--Mensaje campos obligatorios--}}
                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span
                            class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>
            {{--Modal Footer--}}
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar
                </button>
                @if ($user_id !== 0)
                    <button wire:click="store" class="btn btn-primary">Actualizar</button>
                @else
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
