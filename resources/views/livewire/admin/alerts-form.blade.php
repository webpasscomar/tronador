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
                    Alertas / Alerts
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Formulario --}}
                <div class="form-group">
                    <label for="titulo">Título</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="titulo"
                        @disabled($preview)>
                    @error('titulo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Title</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                    <input type="text" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="title"
                        @disabled($preview)>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" rows="2" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model='descripcion'
                        @disabled($preview)></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" rows="2" class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model='description'
                        @disabled($preview)></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group"><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <label for="date" class="form-label">Fecha / Hora</label>
                            <span id="file-name"></span>

                            <input type="datetime-local" id="date"
                                class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="date"
                                @disabled($preview)>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="finish" class="form-label">Expira</label><span
                                class="ms-1 text-danger fs-6 fw-semibold">*

                                <input type="datetime-local" id="finish"
                                    class="form-control {{ $preview ? 'nocursor' : '' }}" wire:model="finish"
                                    @disabled($preview)>
                                @error('finish')
                                    <span class="text-danger fw-normal">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="institution_id">Fuente</label><span
                                class="ms-1 text-danger fs-6 fw-semibold">*</span>
                            <select class="form-select {{ $preview ? 'nocursor' : '' }}" wire:model="institution_id"
                                @disabled($preview)>
                                <option value="">Institución</option>
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
