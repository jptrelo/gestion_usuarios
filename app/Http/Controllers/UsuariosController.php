<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Http\Traits\ExcelManageTrait;
use Laracasts\Flash\Flash;
use Response;

class UsuariosController extends Controller
{

	use ExcelManageTrait;

    /**
     * Retorna la vista
     */
	public function gestionUsuarios()
	{
		return view('gestionUsuarios');
	}

	/**
     * Obtiene y envia como parametro a la funcion de importacion el archivo a ser exportado, 
     * junto con el nombre de las columnas.
     */
	public function importarUsuarios(Request $request)
	{
		if($request->hasFile('fileExcel')){
			
			$path = $request->file('fileExcel')->getRealPath();

			$this->importExcel($path, 'usuarios');

			flash('Usuarios importados con exito.', 'success')->important();

			return redirect()->route('index');

		}else{

			return 'Porfavor verifique el archivo, algo esta mal.';
		}
		
	}

	/**
     * Consulta 
     */
    public function index($id = null)
    {
        // Validamos id
        //if ($id == null) {
            $usuarios = Usuario::orderBy('id', 'asc')->paginate(15);
        //}else{
            //$usuarios = $this->show($id);
        //}

        return view('usuarios')->with('usuarios', $usuarios);
    }

	/*
    * Guardado de registro
    */
    public function store(Request $request)
    {
        $usuario = new Usuario;
        $usuario->first_name = $request->input('first_name');
        $usuario->last_name = $request->input('last_name');
        $usuario->save();
        return 'Usuario creado con exito, id: ' . $usuario->id;
    }

    /**
     * Mostrar registro
     */
    public function show($id)
    {
        return Usuario::find($id);
    }

    /**
     * Actualizar
     */
    
    public function update(Request $request, $id = null)
    {
    	
    	$listaUsuarios = $request->listaUsuarios;
    	
    	foreach ($listaUsuarios as $row) {
    		$usuario = Usuario::find($row['id']);
	        foreach ($row as $key => $value) {
	        	$usuario[$key] = $value;
	        }
        	$usuario->save();
    	}     

        return Response::json(['message'=>'Usuario/s modificado/s con exito.']);
    }

    /**
     * Eliminar
     */
    public function destroy(Request $request, $id = null)
    {
        //$usuario = Usuario::find($id)->delete();
        if (is_null($id)) {
        	$ids_to_delete = array_map(function($item){ return $item; }, $request->listaUsuarios);
        }else {
        	$ids_to_delete = $id;
        }
        

    	Usuario::whereIn('id', $ids_to_delete)->delete();
        return Response::json(['message'=>'Usuario/s eliminado/s con exito.']);
    }

}
