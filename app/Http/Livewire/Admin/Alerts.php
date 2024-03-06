<?php

namespace App\Http\Livewire\Admin;

use App\Models\Alert;
use App\Models\Institution;
use Livewire\Component;

class Alerts extends Component
{
    protected $alerts;
    protected $institutions;
    protected $listeners = ['delete', 'updateTable'];


    public $showModal = 'none';
    public $preview = false;
    public  $alert_id,
        $alert,
        $action,
        $titulo,
        $title,
        $descripcion,
        $description,
        $date,
        $finish,
        $institution_id,
        $status;


    // Reglas de validación
    protected function rules()
    {
        // Validaciones al crear registro
        if ($this->action == 'create') {
            return [
                'title' => 'required|min:3',
                'titulo' => 'required|min:3',
                'institution_id' => 'required',
                'date' => 'required|date',
                'finish' => 'required|date'
            ];
        } else { // Validaciones al editar registro
            return [
                'title' => 'required|min:3',
                'titulo' => 'required|min:3',
                'institution_id' => 'required',
                'date' => 'required|date',
                'finish' => 'required|date'
            ];
        };
    }


    protected function messages()
    {
        return [
            'titulo.required' => 'Se debe ingresar un titulo',
            'title.required' => 'Se debe ingresar un titulo',
            'institution_id.required' => 'Se debe seleccionar una institución',
            'date.required' => 'Se debe ingresar una fecha',
            'finish.required' => 'Se debe ingresar una fecha',
            'date.date' => 'Formato de fecha incorrecto',
            'finish.date' => 'Formato de fecha incorrecto',
        ];
    }

    // Actualiza el estado de las alertas
    protected function updateStatus()
    {
        $this->alerts = Alert::all(); //trae todas las alertas
        // Si la fecha y hora actual es superior a la de expiracion , el estado pasa a 0
        $this->alerts->each(function ($alert) {
            if (now()->greaterThan($alert->finish)) {
                $alert->status = 0;
                $alert->save();
            };
        });
    }

    public function render()
    {
        $this->updateStatus(); // Llama al método para actualizar el estado de las alertas
        $this->institutions = Institution::where('status', 1)->get();
        return view('livewire.admin.alerts', [
            'alerts' => $this->alerts,
            'institutions' => $this->institutions
        ])->layout('layouts.adminlte');
    }


    public function updateTable()
    {
        $this->emit('table');
    }

    public function create()
    {
        $this->action = 'create';
        $this->preview = false;
        $this->resetInputFields();
        $this->openModal();
    }

    //Editar registo
    public function edit($id, $modo = false)
    {
        //Habilitar o no la vista previa en el modo edición. si es true no se puede editar, si es false si
        if ($modo) {
            $this->preview = true;
        }
        // Modo edición
        $this->action = 'edit';

        // Buscar registo
        $this->alert = Alert::findOrFail($id);
        //insertar datos

        $this->alert_id = $this->alert->id;
        $this->titulo = $this->alert->titulo;
        $this->title = $this->alert->title;
        $this->description = $this->alert->description;
        $this->descripcion = $this->alert->descripcion;
        $this->date = $this->alert->date;
        $this->finish = $this->alert->finish;
        $this->institution_id = $this->alert->institution_id;
        //Abrir modal en modo edición
        $this->openModal();
    }

    public function store()
    {
        //LLamar a rules para validar los campos
        $this->validate();

        // TODO:fhecha de expiración 1 minuto, modo ejemplo. Este dato se tomará de una API

        // Guardamos ó actualizamos los datos , según la coincidencia o no del id
        Alert::updateOrCreate([
            'id' => $this->alert_id
        ], [
            'titulo' => $this->titulo,
            'title' => $this->title,
            'description' => $this->description,
            'descripcion' => $this->descripcion,
            'date' => $this->date,
            'finish' => $this->finish,
            'institution_id' => $this->institution_id,
            'status' => 1
        ]);

        // Mensaje de operación correcta, borrar campos, cerrar modal
        $this->emit('mensajePositivo', ['mensaje' => 'Operación exitosa']);
        $this->resetInputFields();
        $this->closeModal();
    }


    // eLiminar registro TODO:por el momento inhabilitado hasta revisión
    //        public function delete($id)
    //        {
    //            // Buscamos el registro y borramos la imágen asociada a ese registro
    //    $alert = Alert::findOrFail($id);
    //            $alert->delete();
    //
    //            $this->emit('mensajePositivo', ['mensaje' => 'Alerta eliminada correctamente']);
    //            $this->emit('table');
    //        }

    //Borrar datos del registro
    public function resetInputFields()
    {
        $this->reset([
            'titulo',
            'title',
            'descripcion',
            'description',
            'date',
            'finish',
            'institution_id',
            'status'
        ]);

        $this->alert_id = 0;
        $this->resetErrorBag();
    }

    public function openModal()
    {
        $this->showModal = 'block';
        $this->updateTable();
    }

    public function closeModal()
    {
        $this->showModal = 'none';
        $this->updateTable();
        $this->resetInputFields();
        $this->preview = false;
    }

    // Vista preliminar
    public function viewPreview()
    {
        $this->preview = true;
        $this->openModal();
    }
}
