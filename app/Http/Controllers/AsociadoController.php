<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asociado;
use Illuminate\Validation\ValidationException;

class AsociadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // traer solo numerodepadron, nombres, apellidopaterno, apellidomaterno, dni, estadodepago, estado
        $asociados = Asociado::select('id','numerodepadron', 'nombres', 'apellidopaterno', 'apellidomaterno', 'dni', 'estadodepago', 'estado')->get();
        
        $stands = "1-2-3";
        $asociados = $asociados->map(function ($asociado) use ($stands) {
            $asociado->stands = $stands;
            return $asociado;
        });
        
        return response()->json($asociados, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombres' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚüñÑ ]{3,30}$/',
            'apellidopaterno' => 'required|regex:/^[a-zA-ZáéíóÁÉÍÓÚúüñÑ ]{3,30}$/',
            'apellidomaterno' => 'required|regex:/^[a-zA-ZáéíóÁÉÍÓÚúüñÑ ]{3,30}$/|nullable',
            'dni' => 'required|numeric|digits:8',
            'numerodepadron' => 'required|numeric|digits:4',
            'estadodepago' => 'required|alpha|max:15',
            'estado' => 'required|alpha|max:15'
        ]);
        try {
            $asociado = new Asociado();
            $asociado->nombres = $request->nombres;
            $asociado->apellidopaterno = $request->apellidopaterno;
            $asociado->apellidomaterno = $request->apellidomaterno;
            $asociado->dni = $request->dni;
            $asociado->numerodepadron = $request->numerodepadron;
            $asociado->estadodepago = $request->estadodepago;
            $asociado->estado = $request->estado;
          
            $asociado->save();
        } catch (\Exception $e) {
            return ([
                'success' => false,
                'message' => "Ocurrio un error al crear el usuario <b>{$request->nombres}</b> <br> {$e->getMessage()}"
            ]);
        }

        return ([
            'success' => true,
            'message' => "El Usuario <b>{$request->nombre}</b> se creo correctamente"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ ]{3,30}$/',
            'apellidopaterno' => 'required|regex:/^[a-zA-ZáéíóÁÉÍÓÚÜúüñÑ ]{3,30}$/',
            'apellidomaterno' => 'required|regex:/^[a-zA-ZáéíóÁÉÍÓÚÜúüñÑ ]{3,30}$/|nullable',
            'dni' => 'required|numeric|digits:8',
            'numerodepadron' => 'required|numeric|digits:4',
            'estadodepago' => 'required|alpha|max:15',
            'estado' => 'required|alpha|max:15'
        ]);

        try {
            $asociado = Asociado::find($id);
            $asociado->nombres = $request->nombres;
            $asociado->apellidopaterno = $request->apellidopaterno;
            $asociado->apellidomaterno = $request->apellidomaterno;
            $asociado->dni = $request->dni;
            $asociado->numerodepadron = $request->numerodepadron;
            $asociado->estadodepago = $request->estadodepago;
            $asociado->estado = $request->estado;

            $asociado->save();
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'name' => "Error al actualizar el usuario <b>{$id} {$request->nombres} </b>
                              <br> {$e->getMessage()}"
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error al actualizar el usuario <b>{$id} {$request->nombres}</b>
                              <br> {$e->getMessage()}"
                ],
                422
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => "El Usuario <b>{$id} {$request->name}</b> se actualizo correctamente"
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $asociado = Asociado::find($id);
            $asociado->delete();
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error al eliminar el usuario <b>{$id} {$asociado->nombres}</b>
                              <br> {$e->getMessage()}"
                ],
                422
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => "El Usuario <b>{$id} {$asociado->nombres}</b> se eliminó permanentemente"
            ],
            200
        );
    }
}
