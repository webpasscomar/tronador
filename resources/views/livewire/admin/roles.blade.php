<div>

    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-8">
                <h3>Roles</h3>
            </div>
            <div class="col-md-4 text-right">
                <button wire:click="create" class="btn btn-success" data-toggle="modal" data-target="#roleModal"><i
                        class="fas fa-plus-circle mr-2" style="color: white;"></i>Agregar
                    Rol</button>
            </div>
        </div>

        <!-- Roles Table -->
        {{-- <h1>Cantidad {{ $cantidad }}</h1> --}}
        <table class="table table-hover table-bordered mt-3 datatable" id="rolesTable">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripción</th>
                    <th style="width: 10%" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td class="p-1 text-center">
                            <button wire:click="edit({{ $role->id }})" class="btn btn-sm btn-primary"
                                data-toggle="modal" data-target="#roleModal" title="Editar"><i
                                    class="fa fa-edit"></i></button>
                            <button wire:click="$emit('alertDelete',{{ $role->id }})" class="btn btn-sm btn-danger"
                                title="Eliminar"><i class="fas fa-trash-alt" style="color: white "></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @if ($muestraModal == 'block')
        <!-- Role Form Modal -->
        <div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
            aria-hidden="true" style="display: {{ $muestraModal }}">
            {{-- <div class="modal" tabindex="-1" role="dialog" wire:ignore.self> --}}

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel">
                            @if ($role_id)
                                Editar Rol
                            @else
                                Crear Nuevo Rol
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($accion == 'crear')
                            <div class="form-group">
                                <label for="role_id">Id</label>
                                <input type="text" class="form-control" wire:model="role_id">
                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Rol</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                        @if ($role_id !== 0)
                            <button wire:click="store" class="btn btn-primary">Actualizar</button>
                        @else
                            <button wire:click="store" class="btn btn-primary">Guardar</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endif





</div>
