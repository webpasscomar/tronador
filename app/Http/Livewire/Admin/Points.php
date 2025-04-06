<?php

namespace App\Http\Livewire\Admin;

use App\Models\Institution;
use App\Models\Point;
use App\Models\Tipo;
use App\Models\Trail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Points extends Component
{
    protected $points;
    protected $trails;
    protected $tipos;
    protected $institutions;
    protected $listeners = ['delete', 'updateTable'];

    public $showModal = 'none';
    public
        $point_id,
        $point,
        $action,
        $changeImg = false,
        $changeFile = false,
        $image,
        $pdf,
        $name,
        $nombre,
        $institution_id,
        $trail_id,
        $tipo_id,
        $lat,
        $lng,
        $descripcion,
        $description,
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
                'description' => 'nullable',
                'descripcion' => 'nullable',
                'image' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
                'pdf' => 'nullable|mimes:pdf|max:2048',
                'tipo_id' => 'required',
                'institution_id' => 'required',
                'trail_id' => 'required',
                'lat' => 'required|decimal:0,10',
                'lng' => 'required|decimal:0,10'
            ];
        } else { // Validaciones al editar registro
            return [
                'nombre' => 'required|min:3',
                'name' => 'required|min:3',
                'image' => $this->changeImg ? 'mimes:jpeg,png,jpg,svg|max:2048' : '',
                'pdf' => $this->changeFile ? 'mimes:pdf|max:2048' : '',
                'tipo_id' => 'required',
                'institution_id' => 'required',
                'trail_id' => 'required',
                'lat' => 'required|decimal:0,10',
                'lng' => 'required|decimal:0,10'
            ];
        }
    }

    protected function messages()
    {
        return [
            'nombre.required' => 'Se debe ingresar un nombre',
            'name.required' => 'Se debe ingresar un nombre',
            'tipo_id.required' => 'Se debe seleccionar un tipo de referencia',
            'trail_id' => 'Se debe seleccionar un sendero',
            'institution_id.required' => 'Se debe seleccionar una institución',
            'image.required' => 'Se debe cargar una imagen',
            'image.mimes' => 'Formatos permitidos: jpeg,png,jpg,svg',
            'image.max' => 'El tamaño maximo es de 2MB',
            'pdf.mimes' => 'Formatos permitidos: pdf',
            'pdf.max' => 'El tamaño maximo es de 2MB',
            'lat.required' => 'Se debe cargar una latitud',
            'lat.decimal' => 'Ingrese un número',
            'lng.required' => 'Se debe cargar una longitud',
            'lng.decimal' => 'Ingrese un número',
        ];
    }

    public function render()
    {
        $this->points = Point::all();
        $this->institutions = Institution::where('status', 1)->get();
        $this->trails = Trail::where('status', 1)->get();
        $this->tipos = Tipo::where('status', 1)->get();


        return view('livewire.admin.points', [
            'points' => $this->points,
            'institutions' => $this->institutions,
            'trails' => $this->trails,
            'tipos' => $this->tipos
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
        $this->point = Point::findOrFail($id);

        //insertar datos
        $this->point_id = $this->point->id;
        $this->nombre = $this->point->nombre;
        $this->name = $this->point->name;
        $this->descripcion = $this->point->descripcion;
        $this->description = $this->point->description;
        $this->image = $this->point->image;
        $this->pdf = $this->point->pdf;
        $this->institution_id = $this->point->institution_id;
        $this->tipo_id = $this->point->tipo_id;
        $this->trail_id = $this->point->trail_id;
        $this->lat = $this->point->lat;
        $this->lng = $this->point->lng;

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
            $point = Point::findOrFail($this->point_id);
            Storage::disk('public')->delete('puntos/' . $point->image);
        }

        // Si se elige una imagen cuando creamos un registro se guarda con su nombre original
        if ($this->changeImg) {
            $image_name = $this->image->getClientOriginalName();
            $this->image->storeAs('puntos', $image_name);
            $this->changeImg = false;
        } else {
            /* En el caso que se este editando y no se elija una imágen nueva se toma la imágen que está guardada*/
            $image_name = $this->image;
        }

        // Si estamos editando y se elige un archivo pdf se borra el anterior para poder guardar el nuevo previamente buscando el registro correspondiente
        if ($this->changeFile && $this->action == 'edit') {
            $point = Point::findOrFail($this->point_id);
            Storage::disk('public')->delete('puntos/' . $point->pdf);
        }

        //si existe un arhivo pdf se guarda en la base de datos
        if ($this->changeFile) {
            $file_name = $this->pdf->getClientOriginalName();
            $this->pdf->storeAs('puntos', $file_name);
            $this->changeFile = false;
        } else {
            // En el caso que se este editando sino se elija un archivo pdf se toma el archivo que está guardado
            $file_name = $this->pdf;
        }

        // Guardamos ó actualizamos los datos , según la coincidencia o no del id
        Point::updateOrCreate(
            ['id' => $this->point_id],
            [
                'nombre' => $this->nombre,
                'name' => $this->name,
                'description' => $this->description,
                'descripcion' => $this->descripcion,
                'image' => $image_name,
                'pdf' => $file_name,
                'lat' => $this->lat,
                'lng' => $this->lng,
                'institution_id' => $this->institution_id,
                'tipo_id' => $this->tipo_id,
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
    //    $point = Point::findOrFail($id);
    //            Storage::disk('public')->delete('puntos/' . $point->image);
    //            // Eliminamos el registro
    //            $point->delete();
    //
    //            $this->emit('mensajePositivo', ['mensaje' => 'Punto eliminado correctamente']);
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
            'lat',
            'lng',
            'institution_id',
            'tipo_id',
            'trail_id',
            'status'
        ]);

        $this->point_id = 0;
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
