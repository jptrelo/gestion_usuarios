<?php

namespace App\Http\Traits;

use DB;
use Excel;
use Carbon;

trait ExcelManageTrait{

	/**
	 * [importExcel funcion para importar archivos de excel]
	 * @param  $path      [Archivo a ser importado]
	 * @param  $tableName [nombre de la tabla]
	 */
  	public function importExcel($path, $tableName){ 

		$data = Excel::load($path, function($reader) { $reader->ignoreEmpty(); })->get();

		if(!empty($data) && $data->count()){
			$index = 0;
			$now = date('Y-m-d H:i:s');
			foreach ($data->toArray() as $key => $value) {
				if(!empty($value)){
					foreach ($value as $keyVal => $v) {
						
							$insert[$index][$keyVal] = $v;				

					}

					$insert[$index]['created_at'] =  $now;
					$insert[$index]['updated_at'] =  $now;
				}
				$index++;
			}

			
			if(!empty($insert)){
				DB::table($tableName)->insert($insert);
				return back()->with('success','Insert Record successfully.');
			}

		}
		
	}

}