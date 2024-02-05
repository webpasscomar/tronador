<div class="modal fade show" id="{{ $imageId }}" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
    aria-hidden="true" style="display: block; background-color:rgb(51,51,51);">

    <div class="modal-dialog modal-lg modal-dialog-centered mh-75" role="document">
        <div class="modal-content border-0" style="box-shadow: 1px 1px 5px 1px #4b4b4b;">
            <div class="modal-header" style="background-color: #3332">
                <h5 class="modal-title" id="roleModalLabel">
                    {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click="closeModalImage">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">

                <img src="{{ $image }}" class="object-fit-contain w-100" height="500"
                    alt="{{ 'imagen ' . $title }}">

            </div>
        </div>
    </div>
</div>
