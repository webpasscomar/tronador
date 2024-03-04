<?php

namespace App\Http\Livewire\Admin;

use App\Models\Reference;
use App\Models\Institution;
use App\Models\Topic;
use App\Models\Trail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class References extends Component
{
    protected $references;
    protected $institutions;
    protected $trails;
    protected $topics;
    protected $listeners = ['delete', 'updateTable'];

    public $showModal = 'none';
    public
        $reference_id,
        $reference,
        $action,
        $changeImg = false,
        $changeFile = false,
        $image,
        $pdf,
        $name,
        $nombre,
        $topic_id,
        $institution_id,
        $trail_id,
        $descripcion,
        $description,
        $status,
        $newFile,
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
                'description' => 'required',
                'descripcion' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
                'pdf' => 'required|mimes:pdf|max:2048',
                'topic_id' => 'required',
                'institution_id' => 'required',
            ];
        } else { // Validaciones al editar registro
            return [
                'nombre' => 'required|min:3',
                'name' => 'required|min:3',
                'description' => 'required',
                'image' => $this->changeImg ? 'mimes:jpeg,png,jpg,svg|max:2048' : '',
                'pdf' => $this->changeFile ? 'mimes:pdf|max:2048' : '',
                'descripcion' => 'required',
                'topic_id' => 'required',
                'institution_id' => 'required',
                'trail_id' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Se debe ingresar un nombre',
            'name.required' => 'Se debe ingresar un nombre',
            'description.required' => 'Se debe ingresar una descripción',
            'descripcion.required' => 'Se debe ingresar una descripción',
            'topic_id.required' => 'Se debe seleccionar un tema',
            'institution_id.required' => 'Se debe seleccionar una institución',
            'image.required' => 'Se debe cargar una imagen',
            'image.mimes' => 'Formatos permitidos: jpeg,png,jpg,svg',
            'image.max' => 'El tamaño maximo es de 2MB',
            'pdf.mimes' => 'Formatos permitidos: pdf',
            'pdf.max' => 'El tamaño maximo es de 2MB',
            'pdf.required' => 'Se debe cargar un archivo',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'kms.integer' => 'Se debe ingresar un número',
    //         'kms.min' => 'El número no puede ser negativo',
    //         'elevation.min' => 'El número no puede ser negativo',
    //         'elevation.integer' => 'Se debe ingresar un número',
    //         'order.integer' => 'Se debe ingresar un número',
    //         'order.min' => 'El número no puede ser negativo'
    //     ];
    // }


    public function render()
    {
        $this->references = Reference::all();
        $this->institutions = Institution::where('status', 1)->get();
        $this->trails = Trail::where('status', 1)->get();
        $this->topics = Topic::where('status', 1)->get();

        return view('livewire.admin.references', [
            'references' => $this->references,
            'institutions' => $this->institutions,
            'trails' => $this->trails,
            'topics' => $this->topics
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
        $this->reference = Reference::findOrFail($id);

        //insertar datos
        $this->reference_id = $this->reference->id;
        $this->nombre = $this->reference->nombre;
        $this->name = $this->reference->name;
        $this->descripcion = $this->reference->descripcion;
        $this->description = $this->reference->description;
        $this->image = $this->reference->image;
        $this->pdf = $this->reference->pdf;
        $this->institution_id = $this->reference->institution_id;
        $this->trail_id = $this->reference->trail_id;
        $this->topic_id = $this->reference->topic_id;

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
            $reference = Reference::findOrFail($this->reference_id);
            Storage::disk('public')->delete('referencias/' . $reference->image);
        }

        // Si se elige una imagen cuando creamos un registro se guarda con su nombre original
        if ($this->changeImg) {
            $image_name = $this->image->getClientOriginalName();
            $this->image->storeAs('referencias', $image_name);
            $this->changeImg = false;
        } else {
            /* En el caso que se este editando y no se elija una imágen nueva se toma la imágen que está guardada*/
            $image_name = $this->image;
        }

        // Si estamos editando y se elige un archivo pdf se borra el anterior para poder guardar el nuevo previamente buscando el registro correspondiente
        if ($this->changeFile && $this->action == 'edit') {
            $reference = Reference::findOrFail($this->reference_id);
            Storage::disk('public')->delete('referencias/' . $reference->pdf);
        }

        //si existe un arhivo pdf se guarda en la base de datos
        if ($this->changeFile) {
            $file_name = $this->pdf->getClientOriginalName();
            $this->pdf->storeAs('referencias', $file_name);
            $this->changeFile = false;
        } else {
            // En el caso que se este editando sino se elija un archivo pdf se toma el archivo que está guardado
            $file_name = $this->pdf;
        }

        // Guardamos ó actualizamos los datos , según la coincidencia o no del id
        Reference::updateOrCreate(
            ['id' => $this->reference_id],
            [
                'nombre' => $this->nombre,
                'name' => $this->name,
                'description' => $this->description,
                'descripcion' => $this->descripcion,
                'image' => $image_name,
                'pdf' => $file_name,
                'institution_id' => $this->institution_id,
                'topic_id' => $this->topic_id,
                'trail_id' => $this->trail_id,
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
    //    $reference = Reference::findOrFail($id);
    //            Storage::disk('public')->delete('referencias/' . $reference->image);
    //            // Eliminamos el registro
    //            $reference->delete();
    //
    //            $this->emit('mensajePositivo', ['mensaje' => 'Referencia eliminada correctamente']);
    //            $this->emit('table');
    //        }

    //Borrar datos del registro
    public function resetInputFields()
    {
        $this->reset([
            'nombre',
            'name',
            'description',
            'descripcion',
            'image',
            'pdf',
            'institution_id',
            'topic_id',
            'trail_id',
            'status'
        ]);

        $this->reference_id = 0;
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
