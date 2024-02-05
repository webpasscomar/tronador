<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $muestraModalPass }}; background-color:rgba(51,51,51,0.9);">
    {{-- <div class="modal" tabindex="-1" role="dialog" wire:ignore.self> --}}

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">
                    Cambia Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click="closeModalPass">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="password">Nueva Password</label>
                    <input type="password" class="form-control" wire:model="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModalPass" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button wire:click="cambiapass" class="btn btn-primary">Cambiar Password</button>
                </div>
            </div>
        </div>
    </div>
