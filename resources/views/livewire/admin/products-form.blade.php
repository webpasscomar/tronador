<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $modal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="bg-white">
                        <div class="form-group">
                            @if ($cambioImg)
                                @if (gettype($image) === 'object')
                                    @if ($image->extension() == 'png' || $image->extension() == 'jpg' || $image->extension() == 'jpeg')
                                        <img class="img-fluid img-thumbnail" src="{{ $image->temporaryUrl() }}">
                                    @endif
                                @endif
                            @else
                                @if ($accion === 'editar')
                                    <img class="img-fluid img-thumbnail"
                                        src="{{ asset('storage/productos/' . $image) }}" alt="">
                                @endif
                            @endif
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="category_id">Categoría:<span
                                        class="ms-1 text-danger fs-6 fw-semibold">*</span></label>
                                <select class="form-select" wire:model="category_id">

                                    <option value="0">Seleccione la categoría</option>
                                    @foreach ($categorias as $item)
                                        <option value="{{ $item->id }}">{{ $item->rutaCompleta }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="title">Nombre:<span
                                        class="ms-1 text-danger fs-6 fw-semibold">*</span></label>
                                <input type="text" class="form-control" id="title" wire:model="title">

                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea rows="2" class="form-control" id="description" wire:model="description"></textarea>
                        </div>

                        <div class="row">

                            <div class="form-group">
                                <label for="order">Orden:</label>
                                <input type="number" class="form-control" id="order" wire:model="order">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="image">Foto:</label>
                            <input type="file" id="image" wire:model="image" wire:change="changeImage"
                                class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                </form>
                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button wire:click="store" class="btn btn-primary">Guardar</button>
            </div>

        </div>

    </div>

</div>
