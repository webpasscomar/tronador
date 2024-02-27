@section('title', 'Admin Tipos')

<div>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 col-6 mt-4">
                <h3>Tipos de referencia</h3>
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
                        <th scope="col">ID</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Type</th>
                        <th scope="col">Icono</th>
                        <th scope="col" class="text-center" style="width: 15%">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tipos as $key => $tipo)
                        <tr>
                            <th scope="row" class="align-middle">{{ $tipo->id }}</th>
                            <td class="align-middle">{{ $tipo->nombre }}</td>
                            <td class="align-middle">{{ $tipo->name }}</td>
                            <td class="align-middle" style="cursor: pointer"
                                wire:click="openModalImage({{ $tipo->id }})">
                                @if (file_exists(public_path('storage/iconos/'.$tipo->icon)) && $tipo->icon)
                                    <img src="{{ asset('storage/iconos/'. $tipo->icon) }}" alt="{{ $tipo->nombre }}"
                                         width="40" height="40"
                                    >
                                @else
                                    <img
                                        src="{{ asset('img/no_disponible.png') }}"
                                        alt="no_disponible" width="40" height="40"
                                    >
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                    <div class="m-1 mt-3">
                                        <livewire:toggle-button :model="$tipo" field="status"
                                                                key="{{ $tipo->id }}"/>
                                    </div>
                                    <button wire:click="edit({{ $tipo->id }})"
                                            class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                            data-target="#roleModal" title="Editar"><i class="fa fa-edit"></i></button>
                                    <button wire:click="$emit('alertDelete',{{ $tipo->id }})"
                                            class="btn btn-sm btn-danger m-1" title="Eliminar"><i
                                            class="fas fa-trash-alt" style="color: white "></i></button>
                                </div>
                            </td>
                        </tr>
                        @if ($showModalImage)
                            {{-- Mostrar modal de imagén amliada --}}
                            <x-modal-image
                                image="{{ file_exists(public_path('storage/iconos/'. $currentImage)) && $currentImage ? asset('storage/iconos/' . $currentImage) : asset('img/no_disponible.png') }}"
                                title="{{ $currentTitle }}" imageId="{{ $key }}"/>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @if ($showModal === 'block')
        {{-- Modal Form   --}}
        @include('livewire.admin.tipos-form');
    @endif
</div>
