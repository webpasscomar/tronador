<?php

    namespace App\Http\Livewire\Admin;

    use App\Models\Institution;
    use Livewire\Component;

    class Institutions extends Component
    {
        protected $institutions;
        protected $listeners = ['delete', 'updateTable'];
        public $preserveInput = ['name', 'initial'];

        public $showModal = 'none';
        public $institution_id,
            $institution,
            $name,
            $action,
            $initial,
            $status;

        public function render()
        {
            $this->institutions = Institution::all();
            return view('livewire.admin.institutions', [
                'institutions' => $this->institutions
            ])->layout('layouts.adminlte');
        }

        // Actualizar datos del dataTables para la paginación y estilos de la tabla
        public function updateTable()
        {
            $this->emit('table');
        }

        //Validar campos de formulario
        protected function rules()
        {
            if ($this->action == 'create') {
                return [
                    'name' => 'required|unique:institutions,name',
                    'initial' => 'required|max:10|unique:institutions,initial',
                ];
            } else {
                return [
                    'name' => 'required|unique:institutions,name,' . $this->institution_id,
                    'initial' => 'required|max:10|unique:institutions,initial,' . $this->institution_id,
                ];
            }
        }

        // Mensajes errores de validación
        protected function messages()
        {
            if ($this->action == 'create') {
                return [
                    'name.required' => 'El nombre es requerido',
                    'name.unique' => 'El nombre ya existe',
                    'initial.required' => 'La sigla es requerida',
                    'initial.max' => 'Debe ser menor a 10 caracteres',
                    'initial.unique' => 'La sigla ya existe',
                ];
            } else {
                return [
                    'name.required' => 'El nombre es requerido',
                    'name.unique' => 'El nombre ya existe',
                    'initial.required' => 'La sigla es requerida',
                    'initial.max' => 'Debe ser menor a 10 caracteres',
                    'initial.unique' => 'La sigla ya existe',
                ];
            }
        }

        // Crear un nuevo registro abriendo el modal del formulario
        public function create()
        {
            $this->action = 'create';
            $this->resetInputField();
            $this->openModal();
        }

        // Editar un registro
        public function edit($id)
        {
            $this->action = 'edit';

            $this->institution = Institution::findOrFail($id);

            $this->institution_id = $this->institution->id;
            $this->name = $this->institution->name;
            $this->initial = $this->institution->initial;

            $this->openModal();
        }

        // Guardar ó actualizar un registro
        public function store()
        {
            $this->validate();

            Institution::updateOrCreate(
                ['id' => $this->institution_id],
                [
                    'name' => $this->name,
                    'initial' => $this->initial,
                    'status' => 1,
                ]
            );
            $this->emit('mensajePositivo', ['mensaje' => 'Operación exitosa']);
            $this->resetInputField();
            $this->closeModal();
        }

        // Borrar un registro
        public function delete($id)
        {
            Institution::find($id)->delete();
            $this->emit('mensajePositivo', ['mensaje' => 'Institución eliminada correctamente']);
            $this->emit('table');
        }

        // Abrir el modal del formulario
        public function openModal()
        {
            $this->emit('table');
            $this->showModal = 'block';
        }

        // Cerrar el modal del formulario
        public function closeModal()
        {
            $this->emit('table');
            $this->showModal = 'none';
            $this->resetInputField();
        }

        private function resetInputField()
        {
            $this->name = '';
            $this->initial = '';
            $this->status = 1;
            $this->institution_id = 0;
            $this->resetErrorBag();
        }
    }

