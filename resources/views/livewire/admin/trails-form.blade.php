<style>
    /* Cursor no permitido */
    .nocursor {
        cursor: not-allowed;
    }
</style>

<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
     aria-hidden="true"
     style="display: {{ $showModal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332">
                <h5 class="modal-title" id="roleModalLabel">
                    Senderos / Trails
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Vista previa de imágen --}}
                <div class="form-group">
                    @if ($changeImg)
                        @if (gettype($image) === 'object')
                            @if (
                                $image->extension() == 'png' ||
                                    $image->extension() == 'svg' ||
                                    $image->extension() == 'jpg' ||
                                    $image->extension() == 'jpeg')
                                <img class="img-fluid img-thumbnail" src="{{ $image->temporaryUrl() }}"
                                     alt="image_preview">
                            @endif
                        @endif
                    @else
                        @if ($action === 'edit')
                            @if (file_exists(public_path('storage/senderos/' . $image)))
                                <img class="img-fluid img-thumbnail" src="{{ asset('storage/senderos/' . $image) }}"
                                     alt="">
                            @else
                                <img class="img-fluid img-thumbnail" src="{{ asset('img/no_disponible.png') }}"
                                     alt="no_disponible">
                            @endif
                        @endif
                    @endif
                </div>

                {{-- Formulario --}}
                <div class="form-group">
                    <label for="nombre">Nombre</label><span
                        class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="nombre" @disabled($preview)>
                    @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="name" @disabled($preview)>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="resumen">Resumen</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <textarea id="resumen" rows="2" class="form-control {{$preview ? 'nocursor' : ''}}"
                              wire:model='resumen' @disabled($preview)></textarea>
                    @error('resumen')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summary">Summary</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <textarea id="summary" rows="2" class="form-control {{$preview ? 'nocursor' : ''}}"
                              wire:model='summary' @disabled($preview)></textarea>
                    @error('summary')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kms">Kms</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <input type="number" id="kms" class="form-control {{$preview ? 'nocursor' : ''}}"
                                   wire:model='kms' min="0"
                                @disabled($preview)>
                            @error('kms')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="elevation">Elevación</label><span
                                class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <input type="number" id="elevation" class="form-control {{$preview ? 'nocursor' : ''}}"
                                   wire:model='elevation' min="0"
                                @disabled($preview)>
                            @error('elevation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="order">Orden</label>
                            <input type="number" id="order" class="form-control {{$preview ? 'nocursor' : ''}}"
                                   wire:model='order' min="0"
                                @disabled($preview)>
                            @error('order')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <label for="image" class="custom-file-upload">Imágen</label>
                            <span id="file-name"></span>

                            <input type="file" id="image" class="form-control {{$preview ? 'nocursor' : ''}}"
                                   wire:model="image"
                                   wire:change="cambioImagen" accept="image/png, image/jpeg, image/svg+xml, image/jpg"
                                @disabled($preview)>
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <label for="geom" class="custom-file-upload">Recorrido</label>
                            <span id="file-name"></span>

                            <input type="file" id="geom" class="form-control {{$preview ? 'nocursor' : ''}}"
                                   wire:model="geom" wire:change="selectFile"
                                @disabled($preview)>
                            @error('geom')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if ($geom)
                                <p class="mt-1 ms-1">
                                    <i class="far fa-file-alt"></i>
                                    <span class="text-secondary"
                                          title="{{ $geom }}">{{ Str::limit($geom, 20) }}</span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dificultad">Dificultad</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="dificultad" @disabled($preview)>
                    @error('dificultad')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="difficulty">Difficulty</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="difficulty" @disabled($preview)>
                    @error('difficulty')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duracion">Duración</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="duracion" @disabled($preview)>
                    @error('duracion')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="duration" @disabled($preview)>
                    @error('duration')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="periodo">Periodo</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="periodo" @disabled($preview)>
                    @error('periodo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="period">Period</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{$preview ? 'nocursor' : ''}}"
                           wire:model="period" @disabled($preview)>
                    @error('period')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span
                            class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-dismiss="modal">Cerrar
                </button>
                @if ($action == 'create')
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @elseif($action == 'edit' && !$preview)
                    <button wire:click="store" class="btn btn-primary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>
</div>
