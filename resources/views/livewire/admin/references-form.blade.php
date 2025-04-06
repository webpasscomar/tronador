<style>
    /* Cursor no permitido */
    .nocursor {
        cursor: not-allowed;
    }
</style>

<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $showModal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332">
                <h5 class="modal-title" id="roleModalLabel">
                    Contenido
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
                            @if (file_exists(public_path('storage/referencias/' . $image)))
                                <img class="img-fluid img-thumbnail" src="{{ asset('storage/referencias/' . $image) }}"
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
                    <label for="nombre">Nombre</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="nombre"
                        @disabled($preview)>
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="name"
                        @disabled($preview)>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <textarea id="descripcion" rows="2" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model='descripcion'
                        @disabled($preview)></textarea>
                    @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <textarea id="description" rows="2" class="form-control {{ $preview ? 'nocursor' : '' }}"
                        wire:model='description' @disabled($preview)></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image" class="custom-file-upload">Imágen</label>
                            <span id="file-name"></span>

                            <input type="file" id="image" class="form-control {{ $preview ? 'nocursor' : '' }}"
                                wire:model="image" wire:change="cambioImagen"
                                accept="image/png, image/jpeg, image/svg+xml, image/jpg" @disabled($preview)>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pdf" class="custom-file-upload">Pdf</label>

                            <input type="file" id="pdf" accept="application/pdf"
                                class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="pdf"
                                wire:change="selectFile" @disabled($preview)>
                            @error('pdf')
                                <span class="text-danger fw-normal">{{ $message }}</span>
                            @enderror
                            @if ($changeFile)
                                @if (gettype($pdf) === 'object')
                                    <p class="mt-1 ms-1">
                                        <i class="far fa-file-alt"></i>
                                        <span class="text-secondary" title="{{ $pdf->getClientOriginalName() }}">
                                            {{ Str::limit($pdf->getClientOriginalName(), 20) }}
                                        </span>
                                    </p>
                                @endif
                            @endif
                            @if (gettype($pdf) === 'string')
                                <p class="mt-1 ms-1">
                                    <i class="far fa-file-alt"></i>
                                    <span class="text-secondary" title="{{ $reference->pdf }}">
                                        {{ Str::limit($reference->pdf, 20) }}
                                    </span>
                                </p>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="institution_id">Fuente</label><span
                                class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <select class="form-select {{ $preview ? 'nocursor' : '' }}" wire:model="institution_id"
                                @disabled($preview)>
                                <option value="">Seleccione una institución</option>
                                @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id }}">{{ $institution->initial }}</option>
                                @endforeach
                            </select>
                            @error('institution_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="topic_id">Tema</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <select class="form-select {{ $preview ? 'nocursor' : '' }}" wire:model="topic_id"
                                @disabled($preview)>
                                <option value="">Seleccione el tema</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->nombre }}</option>
                                @endforeach
                            </select>
                            @error('topic_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="trail_id">Sendero</label>
                            <select class="form-select {{ $preview ? 'nocursor' : '' }}" wire:model="trail_id"
                                @disabled($preview)>
                                <option value="">Seleccione el sendero</option>
                                @foreach ($trails as $trail)
                                    <option value="{{ $trail->id }}">{{ $trail->nombre }}</option>
                                @endforeach
                            </select>
                            @error('trail_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Campos obligatorios --}}
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
