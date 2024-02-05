<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $modal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">Galería</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="cerrarModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="bg-white">
                        <div class="form-group">
                            @if ($cambioImg)
                                @if (gettype($imagen) === 'object')
                                    @if ($imagen->extension() == 'png' || $imagen->extension() == 'jpg' || $imagen->extension() == 'jpeg')
                                        <img class="img-fluid img-thumbnail" src="{{ $imagen->temporaryUrl() }}">
                                    @endif
                                @endif
                            @else
                                @if ($accion === 'editar')
                                    <img class="img-fluid img-thumbnail"
                                        src="{{ asset('storage/galerias/' . $imagen) }}" alt="">
                                @endif
                            @endif
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="galeria">Título:</label>
                                <input type="text" class="form-control" id="galeria" wire:model="galeria">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="imagen" class="custom-file-upload ">
                                    Imagen
                                </label>
                                <span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                                <span id="file-name"></span>
                                <input type="file" id="imagen" wire:model="imagen" wire:change="cambioImagen"
                                    class="form-control">

                                @error('imagen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>
                </form>
                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click="cerrarModal" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button wire:click="store" class="btn btn-primary">Guardar</button>
            </div>

        </div>

    </div>


</div>
