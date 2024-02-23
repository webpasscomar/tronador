@section('title', 'Admin Instituciones')

<div>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 col-6 mt-4">
                <h3>Instituciones</h3>
            </div>
            <div class="col-md-4 col-6 mt-3 mt-md-4 text-right">
                <button wire:click="create" class="btn btn-success" data-toggle="modal" data-target="#roleModal"><i
                        class="fas fa-plus-circle mr-2" style="color: white;"></i>Agregar
                </button>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mt-3 datatable" id="myTable">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Instituciones</th>
                        <th scope="col">Sigla</th>
                        <th scope="col" class="text-center" style="width: 15%">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($institutions as $key => $institution)
                        <tr>
                            <th scope="row" class="align-middle" scope="row">{{ $institution->id }}</th>
                            <td class="align-middle">{{ $institution->name }}</td>
                            <td class="align-middle">{{ $institution->initial }}</td>
                            <td class="align-middle">
                                <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                    <div class="m-1 mt-3">
                                        <livewire:toggle-button :model="$institution" field="status"
                                                                key="{{ $institution->id }}"/>
                                    </div>
                                    <button wire:click="edit({{ $institution->id }})"
                                            class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                            data-target="#roleModal" title="Editar"><i class="fa fa-edit"></i></button>
                                    <button wire:click="$emit('alertDelete',{{ $institution->id }})"
                                            class="btn btn-sm btn-danger m-1" title="Eliminar"><i
                                            class="fas fa-trash-alt" style="color: white "></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @if ($showModal === 'block')
        {{-- Modal Form   --}}
        @include('livewire.admin.institutions-form');
    @endif
</div>
