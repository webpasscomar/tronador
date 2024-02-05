<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $showModal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332">
                <h5 class="modal-title" id="roleModalLabel">
                    Servicios
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    @if ($changeImg)
                        @if (gettype($image) === 'object')
                            @if ($image->extension() == 'png' || $image->extension() == 'jpg' || $image->extension() == 'jpeg')
                                <img class="img-fluid img-thumbnail" src="{{ $image->temporaryUrl() }}">
                            @endif
                        @endif
                    @else
                        @if ($action === 'edit')
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage/servicios/' . $image) }}"
                                alt="">
                        @endif
                    @endif
                </div>


                <div class="form-group">
                    <label for="name">Título</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control" wire:model="title">
                    @error('title')
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
                <div class="form-group">
                    <label for="order">Orden</label>
                    <input type="number" class="form-control" wire:model="order" />
                    @error('order')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image" class="custom-file-upload">Imágen</label>
                    <span id="file-name"></span>

                    <input type="file" id="image" class="form-control" wire:model="image"
                        wire:change="cambioImagen" />
                </div>

                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                @if ($action == 'create')
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @elseif($action == 'edit')
                    <button wire:click="store" class="btn btn-primary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
