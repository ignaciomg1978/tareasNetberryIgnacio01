<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\TareaCategoria;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        //$data=TareaCategoria::with(['tarea','categoria'])->orderBy('tarea_id')->get();
        $dataTareas=Tarea::with(['tarea_categorias'])->get();
        $data = new Collection();
        foreach($dataTareas as $item){
            $nombres_categorias = [];
            
            foreach($item->tarea_categorias as $categoria){  
                $var = Categoria::find($categoria->categoria_id);                             
                $nombres_categorias[] = $var->nombre;
            }
            $dato =(object)['id'=>$item->id,'nombre_tarea'=>$item->nombre,'categorias'=>$nombres_categorias];
            $data->push($dato); 
        }
        //$data = Tarea::with('tarea_categorias')->get();
        return Inertia::render('Tareas', ['data' => $data]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nombre' => ['required'],
        ])->validate();
        $form=$request->all();
        $num_registros = 0;
        if($form['php']==true)
            $num_registros++;
        if($form['javascript']==true)
            $num_registros++;
        if($form['css']==true)
            $num_registros++;        
        if($num_registros>0){
            $tarea=Tarea::create($request->all());
            for($i=0;$i<$num_registros;$i++){
                $tareaCategoria = new TareaCategoria();
                $tareaCategoria->tarea_id = $tarea->id;
                $categoriaID =0;
                if($form['php']==true){
                    $categoriaID =1;
                    $form['php']=null;
                }elseif($form['javascript']==true){
                    $categoriaID =2;
                    $form['javascript']=null;
                }elseif($form['css']==true){
                    $categoriaID =3;
                    $form['css']=null;
                }
                    
                $tareaCategoria->categoria_id = $categoriaID;
                $tareaCategoria->save();    
            }
            
      
            return redirect()->back()
                        ->with('message', 'Tarea Creada Correctamente.');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Tarea::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
