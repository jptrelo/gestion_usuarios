<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use Excel;


class UsuariosController extends Controller
{
    /**
     * Retorna la vista
     *
     * @var array
     */
	public function gestionUsuarios()
	{
		return view('gestionUsuarios');
	}

	/**
     * Obtiene y envia como parametro a la funcion de importacion el archivo a ser exportado, 
     * junto con el nombre de las columnas.
     *
     * @var array
     */
	public function importarUsuarios(Request $request)
	{
		if($request->hasFile('import_file')){

		}

		return back()->with('error','Porfavor veirfique el archivo, algo esta mal.');
	}

}
