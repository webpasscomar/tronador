@section('title', 'Admin Senderos')

<div>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 col-6 mt-4">
                <h3>Senderos / Trails</h3>
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
                        <th scope="col">Sendero</th>
                        <th scope="col">Dificultad</th>
                        <th scope="col">Kms</th>
                        <th scope="col">Elevación</th>
                        <th scope="col" class="text-center" style="width: 15%">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($trails as $key => $trail)
                        <tr>
                            <td scope="row" class="align-middle" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-placement="top" data-bs-content="{{ $trail->nombre }}">
                                {{ Str::limit($trail->nombre, 50) }}</td>
                            <td class="align-middle">{{ Str::limit($trail->dificultad, 40) }}</td>
                            <td class="align-middle">
                                {{ $trail->kms }}<span class="ms-1">kms</span>
                            </td>
                            <td class="align-middle">
                                {{ $trail->elevation }} <span class="ms-1">mts</span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                    <div class="m-1 mt-3">
                                        <livewire:toggle-button :model="$trail" field="status"
                                                                key="{{ $trail->id }}"/>
                                    </div>
                                    <button wire:click="edit({{$trail->id}}, {{$modo = true}})" class="btn btn-sm m-1"
                                            title="Vista Previa"><i
                                            class="far fa-eye text-secondary fs-5 mt-1"></i></button>
                                    <button wire:click="edit({{ $trail->id }})"
                                            class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                            data-target="#roleModal" title="Editar"><i class="fa fa-edit"></i></button>
                                    {{-- <button wire:click="$emit('alertDelete',{{ $trail->id }})"
                                        class="btn btn-sm btn-danger m-1" title="Eliminar"><i
                                            class="fas fa-trash-alt" style="color: white "></i></button> --}}
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
        @include('livewire.admin.trails-form');
    @endif

</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('livewire:load', () => {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        });
        document.addEventListener('livewire:update', () => {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        });
    </script>
@endpush


