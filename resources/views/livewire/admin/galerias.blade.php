@section('title', 'Admin Galeria')
<div>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 col-6 mt-4">
                <h3>Galeria</h3>
            </div>
            <div class="col-md-4 col-6 mt-3 mt-md-4 text-right">
                <button wire:click="create" class="btn btn-success" data-toggle="modal" data-target="#roleModal"><i
                        class="fas fa-plus-circle mr-2" style="color: white;"></i>Agregar</button>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mt-3 datatable" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">COD</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Título</th>
                            <th scope="col" class="text-center" style="width: 15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filas as $key => $fila)
                            <tr>
                                <th scope="row" class="align-middle">{{ $fila->id }}</th>
                                <td class="align-middle" style="cursor: pointer"
                                    wire:click="openModalImage({{ $fila->id }})"><img
                                        src="{{ asset('storage/galerias/' . $fila->imagen) }}"
                                        alt="{{ $fila->galeria }}" width="40" height="40" />
                                </td>
                                <td class="align-middle">{{ $fila->galeria }}</td>
                                <td class="align-middle">
                                    <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                        <div class="m-1 mt-3">
                                            <livewire:toggle-button :model="$fila" field="estado"
                                                key="{{ $fila->id }}" />
                                        </div>
                                        <button wire:click="edit({{ $fila->id }})"
                                            class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                            data-target="#roleModal" title="Editar"><i class="fa fa-edit"></i></button>
                                        <button wire:click="$emit('alertDelete',{{ $fila->id }})"
                                            class="btn btn-sm btn-danger m-1" title="Eliminar"><i
                                                class="fas fa-trash-alt" style="color: white "></i></button>
                                    </div>
                                </td>
                            </tr>
                            @if ($showModalImage)
                                {{-- Mostrar modal de imagén amliada --}}
                                <x-modal-image image="{{ asset('storage/galerias/' . $currentImage) }}"
                                    title="{{ $currentTitle }}" imageId="{{ $key }}" />
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($modal == 'block')
        <!-- Role Form Modal -->
        @include('livewire.admin.galerias-form')
    @endif

</div>
