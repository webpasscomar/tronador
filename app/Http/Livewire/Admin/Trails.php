<?php

    namespace App\Http\Livewire\Admin;

    use App\Models\Trail;
    use Illuminate\Support\Facades\Storage;
    use Livewire\Component;
    use Livewire\WithFileUploads;

    class Trails extends Component
    {
        protected $trails;
        protected $listeners = ['delete', 'updateTable'];

        public $showModal = 'none';
        public
            $trail_id,
            $trail,
            $action,
            $changeImg = false,
            $changeFile = false,
            $image,
            $name,
            $nombre,
            $resumen,
            $summary,
            $order,
            $periodo,
            $period,
            $geom,
            $duracion,
            $duration,
            $dificultad,
            $difficulty,
            $elevation,
            $kms,
            $status,
            $preview = false;


        use WithFileUploads;

        // Reglas de validación
        protected function rules()
        {
            // Validaciones al crear registro
            if ($this->action == 'create') {
                return [
                    'nombre' => 'required|min:3',
                    'name' => 'required|min:3',
                    'resumen' => 'required',
                    'summary' => 'required',
                    'kms' => 'required|decimal:0,2',
                    'elevation' => 'required|decimal:0,2',
                    'order' => 'required|integer|min:0',
                    'image' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
                    'geom' => 'required',
                    'duration' => 'required',
                    'duracion' => 'required',
                    'dificultad' => 'required',
                    'difficulty' => 'required',
                    'duration' => 'required',
                    'duracion' => 'required',
                    'period' => 'required',
                    'periodo' => 'required',
                ];
            } else { // Validaciones al editar registro
                return [
                    'nombre' => 'required|min:3',
                    'name' => 'required|min:3',
                    'resumen' => 'required',
                    'summary' => 'required',
                    'kms' => 'required|integer|min:0',
                    'elevation' => 'required|integer|min:0',
                    'order' => 'required|integer|min:0',
                    'image' => $this->changeImg ? 'mimes:jpeg,png,jpg,svg|max:2048' : '',
                    'duration' => 'required',
                    'duracion' => 'required',
                    'dificultad' => 'required',
                    'difficulty' => 'required',
                    'duration' => 'required',
                    'duracion' => 'required',
                    'period' => 'required',
                    'periodo' => 'required',
                ];
            }
        }

        public function messages()
        {
            return [
                'kms.integer' => 'Se debe ingresar un número',
                'kms.min' => 'El número no puede ser negativo',
                'elevation.min' => 'El número no puede ser negativo',
                'elevation.integer' => 'Se debe ingresar un número',
                'order.integer' => 'Se debe ingresar un número',
                'order.min' => 'El número no puede ser negativo'
            ];
        }

        public function render()
        {
            $this->trails = Trail::all();

            return view('livewire.admin.trails', [
                'trails' => $this->trails
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
            $this->trail = Trail::findOrFail($id);
            //insertar datos
            $this->trail_id = $this->trail->id;
            $this->nombre = $this->trail->nombre;
            $this->name = $this->trail->name;
            $this->resumen = $this->trail->resumen;
            $this->summary = $this->trail->summary;
            $this->kms = $this->trail->kms;
            $this->elevation = $this->trail->elevation;
            $this->order = $this->trail->order;
            $this->image = $this->trail->image;
            $this->geom = $this->trail->geom;
            $this->dificultad = $this->trail->dificultad;
            $this->difficulty = $this->trail->difficulty;
            $this->duracion = $this->trail->duracion;
            $this->duration = $this->trail->duration;
            $this->periodo = $this->trail->periodo;
            $this->period = $this->trail->period;

            //Abrir modal en modo edición
            $this->openModal();
        }

        public function store()
        {
            //LLamar a rules para validar los campos
            $this->validate();
            // si se cambia la imagen cuando editamos el registro, borramos la imagen anterior y guardamos la nueva.
            if ($this->changeImg && $this->action == 'edit') {
                //eliminamos la imagen anterior buscando primero el registro que contiene esa imágen
                $trail = Trail::findOrFail($this->trail_id);
                Storage::disk('public')->delete('senderos/' . $trail->image);
            }

            // Si se elige una imagen cuando creamos un registro se guarda con su nombre original
            if ($this->changeImg) {
                $image_name = $this->image->getClientOriginalName();
                $this->image->storeAs('senderos', $image_name);
                $this->changeImg = false;
            } else {
                /* En el caso que se este editando y no se elija una imágen nueva se toma la imágen que está guardada*/
                $image_name = $this->image;
            }

            //si existe un arhivo recorrido se guarda en la base de datos el nombre TODO:modo provisorio
            if ($this->changeFile) {
                $file_name = $this->geom->getClientOriginalName();
                $this->changeFile = false;
            } else {
                $file_name = $this->geom;
            }

            // Guardamos ó actualizamos los datos , según la coincidencia o no del id
            Trail::updateOrCreate(
                ['id' => $this->trail_id],
                [
                    'nombre' => $this->nombre,
                    'name' => $this->name,
                    'resumen' => $this->resumen,
                    'summary' => $this->summary,
                    'image' => $image_name,
                    'dificultad' => $this->dificultad,
                    'difficulty' => $this->difficulty,
                    'kms' => $this->kms,
                    'elevation' => $this->elevation,
                    'duracion' => $this->duracion,
                    'duration' => $this->duration,
                    'period' => $this->period,
                    'periodo' => $this->periodo,
                    'geom' => $file_name,
                    'order' => $this->order,
                    'status' => 1
                ]
            );
            // Mensaje de operación correcta, borrar campos, cerrar modal
            $this->emit('mensajePositivo', ['mensaje' => 'Operación exitosa']);
            $this->resetInputFields();
            $this->closeModal();
        }


        // eLiminar registro TODO:por el momento inhabilitado hasta revisión
        //        public function delete($id)
        //        {
        //            // Buscamos el registro y borramos la imágen asociada a ese registro
        //            $trail = Trail::findOrFail($id);
        //            Storage::disk('public')->delete('senderos/' . $trail->image);
        //            // Eliminamos el registro
        //            $trail->delete();
        //
        //            $this->emit('mensajePositivo', ['mensaje' => 'Tipo eliminado correctamente']);
        //            $this->emit('table');
        //        }

        //Borrar datos del registro
        public function resetInputFields()
        {
            $this->reset([
                'nombre',
                'name',
                'resumen',
                'summary',
                'kms',
                'elevation',
                'order',
                'image',
                'dificultad',
                'difficulty',
                'duracion',
                'duration',
                'period',
                'geom',
                'periodo',
                'status'
            ]);
            $this->trail_id = 0;
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

        public function cambioImagen()
        {
            $this->changeImg = true;
        }

        public function selectFile()
        {
            $this->changeFile = true;
        }

        public function viewPreview()
        {
            $this->preview = true;
            $this->openModal();
        }
    }
