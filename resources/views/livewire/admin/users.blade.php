@section('title', 'Admin Usuarios')
<div>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 col-6 mt-4">
                <h3>Usuarios</h3>
            </div>
            <div class="col-md-4 col-6 mt-3 mt-md-4 text-right">
                <button wire:click="create" class="btn btn-success" data-toggle="modal" data-target="#roleModal"><i
                        class="fas fa-plus-circle mr-2" style="color: white;"></i>Agregar
                </button>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mt-3 datatable" id="myTable">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Institución</th>
                        <th scope="col" style="width: 15%" class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row" class="align-middle">{{ $user->id }}</th>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->lastname }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">{{ $user->institutions->initial }}</td>
                            <td class="align-middle">
                                <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                    <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-primary"
                                            data-toggle="modal" data-target="#roleModal" title="Editar"><i
                                            class="fa fa-edit"></i></button>
                                    <button wire:click="$emit('alertDelete',{{ $user->id }})"
                                            class="btn btn-sm btn-danger" title="Eliminar"><i class="fas fa-trash-alt"
                                                                                              style="color: white "></i>
                                    </button>
                                    <button wire:click="changepass({{ $user->id }})" class="btn btn-sm btn-info"
                                            data-toggle="modal" data-target="#roleModal" title="Cambia Password"><i
                                            class="fas fa-key" style="color: white "></i></button>
                                    <button wire:click="roles({{ $user->id }})" class="btn btn-sm btn-warning"
                                            data-toggle="modal" data-target="#roleModal" title="Roles"><i
                                            class="fa fa-bars"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Editar --}}
    @if ($muestraModal == 'block')
        <!-- Role Form Modal -->
        @include('livewire.admin.users-form')
    @endif


    {{-- Modal Cambio de password --}}
    @if ($muestraModalPass == 'block')
        <!-- Role Form Modal -->
        @include('livewire.admin.users-form-pass')
    @endif


    {{-- Modal mostrar Roles  --}}

    @if ($muestraModalRoles == 'block')
        <!-- Role Form Modal -->
        @include('livewire.admin.users-form-roles')
    @endif

    @if ($muestraModalRole == 'block')
        <!-- Role Form Modal -->
        @include('livewire.admin.users-form-role')
    @endif
</div>
