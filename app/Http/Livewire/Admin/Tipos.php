<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tipo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tipos extends Component
{
    protected $tipos;
    protected $listeners = ['delete', 'updateTable'];

    public $showModal = 'none';
    public $showModalImage = false;
    public $changeImg = false;
    public $tipo_id,
        $tipo,
        $currentImage,
        $currentTitle,
        $action,
        $icon,
        $name,
        $nombre,
        $status,
        $image_name;

    use WithFileUploads;

    public function render()
    {
        $this->tipos = Tipo::all();
        return view('livewire.admin.tipos', [
            'tipos' => $this->tipos
        ])->layout('layouts.adminlte');
    }

    public function updateTable()
    {
        $this->emit('table');
    }

    protected function rules()
    {
        // cuando editamos un registro y no se modifica la imágen
        if ($this->changeImg == false && $this->action == 'edit') {
            return [
                'nombre' => 'required|unique:tipos,nombre,' . $this->tipo_id,
                'name' => 'required|unique:tipos,name,' . $this->tipo_id,
            ];
        }
        //Cuando creamos un registro y se modifica la imágen
        if ($this->action == 'create') {
            return [
                'nombre' => 'required|unique:tipos,nombre',
                'name' => 'required|unique:tipos,name',
                'icon' => 'required|mimes:png,ico,svg|max:1024',
            ];
        } else { // cuando editamos un registro y se modifica la imágen
            return [
                'nombre' => 'required|unique:tipos,nombre,' . $this->tipo_id,
                'name' => 'required|unique:tipos,name,' . $this->tipo_id,
                'icon' => 'required|mimes:png,ico,svg|max:1024',
            ];
        }
    }

    protected function messages()
    {
        if ($this->action == 'create') {
            return [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya existe',
                'name.required' => 'El name es requerido',
                'name.unique' => 'El name ya existe',
                'icon.required' => 'El icono es requerido',
                'icon.mimes' => 'El icono debe ser png, ico, svg',
                'icon.max' => 'El icono no puede ocupar mas de 1mb',
            ];
        } else {
            return [
                'nombre.required' => 'El nombre es requerido',
                'nombre.unique' => 'El nombre ya existe',
                'name.required' => 'El name es requerido',
                'name.unique' => 'El name ya existe',
                'icon.required' => 'El icono es requerido',
                'icon.mimes' => 'El icono debe ser png, ico, svg',
                'icon.max' => 'El icono no puede ocupar mas de 1mb',
            ];
        }
    }

    public function create()
    {
        $this->action = 'create';
        $this->resetInputField();
        $this->openModal();
    }

    public function edit($id)
    {
        $this->action = 'edit';

        $this->tipo = Tipo::findOrFail($id);
        $this->tipo_id = $this->tipo->id;
        $this->nombre = $this->tipo->nombre;
        $this->name = $this->tipo->name;
        $this->icon = $this->tipo->icon;

        $this->openModal();
    }

    public function store()
    {
        //LLamar a rules para validar los campos
        $this->validate();

        // si se cambia la imagen cuando editamos el registro, borramos la imagen anterior y guardamos la nueva.
        if ($this->changeImg && $this->action == 'edit') {
            //eliminamos la imagen anterior buscando primero el registro que contiene esa imágen
            $tipo = Tipo::findOrFail($this->tipo_id);
            Storage::disk('public')->delete('iconos/' . $tipo->icon);
        }

        // Si se elige una imagen cuando creamos un registro se guarda con su nombre original
        if ($this->changeImg) {
            $image_name = $this->icon->getClientOriginalName();
            $this->icon->storeAs('iconos', $image_name);
            $this->changeImg = false;
        } else {
            /* En el caso que se este editando y no se elija una imágen nueva se toma la imágen que está guardada*/
            $image_name = $this->icon;
        }

        Tipo::updateOrCreate(
            ['id' => $this->tipo_id],
            [
                'nombre' => $this->nombre,
                'name' => $this->name,
                'icon' => $image_name,
                'status' => 1
            ]
        );
        $this->emit('mensajePositivo', ['mensaje' => 'Operación exitosa']);
        $this->resetInputField();
        $this->closeModal();
    }

    public function delete($id)
    {
        // Buscamos el registro y borramos la imágen asociada a ese registro
        $tipo = Tipo::find($id);
        Storage::disk('public')->delete('iconos/' . $tipo->icon);
        // Eliminamos el registro
        $tipo->delete();

        $this->emit('mensajePositivo', ['mensaje' => 'Tipo eliminado correctamente']);
        $this->emit('table');
    }

    public function openModal()
    {
        $this->emit('table');
        $this->showModal = 'block';
    }

    public function closeModal()
    {
        $this->emit('table');
        $this->showModal = 'none';
        $this->changeImg = false;
        $this->resetInputField();
    }

    public function cambioImagen()
    {
        $this->changeImg = true;
    }

    private function resetInputField()
    {
        $this->nombre = '';
        $this->name = '';
        $this->icon = '';
        $this->status = '';
        $this->tipo_id = 0;
        $this->resetErrorBag();
    }

    public function openModalImage($id)
    {
        $this->currentImage = Tipo::find($id)->icon;
        $nombreModal = Tipo::find($id)->nombre;
        $nameModal = Tipo::find($id)->name;
        $this->currentTitle = $nombreModal . ' / ' . $nameModal;

        $this->emit('table');
        $this->showModalImage = true;
    }

    public function closeModalImage()
    {
        $this->emit('table');
        $this->showModalImage = false;
    }
}
