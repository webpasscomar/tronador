<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $modal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">Categorías</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="cerrarModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        @if ($cambioImg)
                            @if (gettype($imagen) === 'object')
                                @if ($imagen->extension() == 'png' || $imagen->extension() == 'jpg' || $imagen->extension() == 'jpeg')
                                    <img class="img-fluid img-thumbnail" src="{{ $imagen->temporaryUrl() }}">
                                @endif
                            @endif
                        @else
                            @if ($accion === 'editar')
                                <img class="img-fluid img-thumbnail" src="{{ asset('storage/categorias/' . $imagen) }}"
                                    alt="">
                            @endif
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="categoria">Nombre:</label><span
                                class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <input type="text" class="form-control" id="categoria" wire:model.inmediate="categoria"
                                wire:keyup='changeSlug'>

                            @error('categoria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slug">Slug:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <input type="text" class="form-control" id="slug" wire:model.inmediate="slug">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="categoriaPadre_id">Categoría
                                padre:</label>
                            <select class="form-select" wire:model="categoriaPadre_id">
                                <option value="0">Sin categoría padre</option>
                                @foreach ($categoriasAnt as $item)
                                    <option value="{{ $item->id }}">{{ $item->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="orden">Orden:</label>
                            <input type="number" class="form-control" id="orden" wire:model="orden">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea rows="2" class="form-control" id="descripcion" wire:model="descripcion" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen" class="custom-file-upload ">
                            Imagen
                        </label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <span id="file-name"></span>
                        <input type="file" id="imagen" wire:model="imagen" wire:change="cambioImagen"
                            class="form-control">
                        @error('imagen')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-group col-2">
                                <label for="menu">Menú</label><br>
                                <select class="form-control" wire:model="menu">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>

                                </select>
                            </div> --}}
                    {{-- Mensaje de campos obligatorios en el formulario --}}
                    <div class="me-3 text-end">
                        <p class="fw-semibold" style="font-size: 12px;"><span
                                class="text-danger fs-6 fw-semibold">*</span>
                            Campos Obligatorios</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="cerrarModal" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                @if ($accion === 'crear')
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @elseif ($accion === 'editar')
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
