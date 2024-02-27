<div class="modal fade show" id="roleModalRole" tabindex="-1" role="dialog" aria-labelledby="roleModalRoleLabel"
     aria-hidden="true" style="display: {{ $muestraModalRole }}; background-color:rgba(51,51,51,0.9);">
    {{-- <div class="modal" tabindex="-1" role="dialog" wire:ignore.self> --}}

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">
                    Crear Nuevo Rol
                </h5>
            </div>
            <div class="modal-body">

                <label>Rol <span class="ms-1 text-danger fs-6 fw-semibold">*</span></label>
                <select class="form-select" id="user_rol_id" wire:model="user_rol_id">
                    <option value="">
                        Seleccione un Rol
                    </option>
                    @if ($roles)
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('user_rol_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="me-3 text-end mt-5">
                    <p class="fw-semibold" style="font-size: 12px;"><span class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModalRole" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar
                </button>
                <button wire:click="storeRole" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
