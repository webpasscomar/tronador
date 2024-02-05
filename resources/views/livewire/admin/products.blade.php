@section('title', 'Admin Productos')
<div>
    {{-- Stop trying to control. --}}
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 col-6 mt-4">
                <h3>Productos</h3>
            </div>
            <div class="col-md-4 col-6 mt-3 mt-md-4 text-right">
                <button wire:click="create" class="btn btn-success" data-toggle="modal" data-target="#roleModal"><i
                        class="fas fa-plus-circle mr-2" style="color: white;"></i>Agregar</button>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mt-3 datatable" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">COD</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Orden</th>
                            <th scope="col" class="text-center" style="width: 15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $key => $row)
                            <tr>
                                <th scope="row" class="align-middle">{{ $row->id }}</th>
                                <td class="align-middle" style="cursor: pointer"
                                    wire:click="openModalImage({{ $row->id }})"><img
                                        src="{{ $row->image ? asset('storage/productos/' . $row->image) : asset('img/no_disponible.png') }}"
                                        alt="{{ $row->title }}" width="40" height="40"></td>

                                <td class="align-middle">{{ $row->title }}</td>
                                <td class="align-middle">{{ $row->category->categoria }}</td>
                                <td class="align-middle">{{ $row->order }}</td>
                                <td class="align-middle">
                                    <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                        <div class="m-1 mt-3">
                                            <livewire:toggle-button :model="$row" field="status"
                                                key="{{ $row->id }}" />
                                        </div>
                                        <button wire:click="edit({{ $row->id }})"
                                            class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                            data-target="#roleModal" title="Editar"><i class="fa fa-edit"></i></button>
                                        <button wire:click="$emit('alertDelete',{{ $row->id }})"
                                            class="btn btn-sm btn-danger m-1" title="Eliminar"><i
                                                class="fas fa-trash-alt" style="color: white "></i></button>
                                    </div>
                                </td>
                            </tr>
                            @if ($showModalImage)
                                {{-- Mostrar modal de imagén amliada --}}
                                <x-modal-image
                                    image="{{ $currentImage ? asset('storage/productos/' . $currentImage) : asset('img/no_disponible.png') }}"
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
        @include('livewire.admin.products-form')
    @endif

</div>
