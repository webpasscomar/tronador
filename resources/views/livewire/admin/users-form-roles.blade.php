<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
     aria-hidden="true"
     style="display: {{ $muestraModalRoles }}; background-color:rgba(51,51,51,0.9);">
    {{-- <div class="modal" tabindex="-1" role="dialog" wire:ignore.self> --}}

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">
                    Roles
                </h5>
            </div>
            <div class="modal-body">

                <h2>{{ $user_nombre_rol }}</h2>
                <div class="col-md-4 text-right float-right mb-1">
                    <button wire:click="newRole" class="btn btn-success" data-toggle="modal"
                            data-target="#roleModalRole"><i class="fas fa-plus-circle mr-2"
                                                            style="color: white;"></i>Agregar
                        Rol
                    </button>
                </div>

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Rol</th>
                        <th class="p-2 text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users_roles as $user_rol)
                        <tr>
                            <td style="width: 30%;" class="p-1 align-middle">{{ $user_rol->rol_nombre }}
                            </td>
                            <td style="width: 10%;" class="p-1 text-center">
                                <button wire:click="deleteRole({{ $user_rol->id }})" class="btn btn-sm btn-danger"
                                        title="Eliminar"><i class="fas fa-trash-alt" style="color: white "></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModalRoles" class="btn btn-secondary"
                            data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
