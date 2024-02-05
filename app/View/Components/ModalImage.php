<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalImage extends Component
{
    public $image, $title, $imageId;
    /**
     * Create a new component instance.
     */
    public function __construct($image, $title, $imageId)
    {
        $this->image = $image;
        $this->title = $title;
        $this->imageId = $imageId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-image');
    }
}
