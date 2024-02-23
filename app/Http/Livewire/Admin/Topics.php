<?php

    namespace App\Http\Livewire\Admin;

    use App\Models\Topic;
    use Livewire\Component;

    class Topics extends Component
    {
        protected $topics;
        protected $listeners = ['delete', 'updateTable'];
        public $preserveInput = ['name', 'nombre'];

        public $showModal = 'none';
        public $topic_id,
            $topic,
            $name,
            $nombre,
            $action,
            $status;

        public function render()
        {
            $this->topics = Topic::all();
            return view('livewire.admin.topics', [
                'topics' => $this->topics
            ])
                ->layout('layouts.adminlte');
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
                    'name' => 'required|unique:topics,name',
                    'nombre' => 'required|unique:topics,nombre',
                ];
            } else {
                return [
                    'name' => 'required|unique:topics,name,' . $this->topic_id,
                    'nombre' => 'required|unique:topics,nombre,' . $this->topic_id,
                ];
            }
        }

        // Mensajes errores de validación
        protected function messages()
        {
            if ($this->action == 'create') {
                return [
                    'name.required' => 'El name es requerido',
                    'name.unique' => 'El name ya existe',
                    'nombre.required' => 'El nombre es requerido',
                    'nombre.unique' => 'El nombre ya existe',
                ];
            } else {
                return [
                    'name.required' => 'El name es requerido',
                    'name.unique' => 'El name ya existe',
                    'nombre.required' => 'El nombre es requerido',
                    'nombre.unique' => 'El nombre ya existe',
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

            $this->topic = Topic::findOrFail($id);

            $this->topic_id = $this->topic->id;
            $this->name = $this->topic->name;
            $this->nombre = $this->topic->nombre;

            $this->openModal();
        }

        // Guardar ó actualizar un registro
        public function store()
        {
            $this->validate();

            Topic::updateOrCreate(
                ['id' => $this->topic_id],
                [
                    'name' => $this->name,
                    'nombre' => $this->nombre,
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
            Topic::find($id)->delete();
            $this->emit('mensajePositivo', ['mensaje' => 'Topic / Tema eliminado correctamente']);
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
            $this->nombre = '';
            $this->status = 1;
            $this->topic_id = 0;
            $this->resetErrorBag();
        }
    }
