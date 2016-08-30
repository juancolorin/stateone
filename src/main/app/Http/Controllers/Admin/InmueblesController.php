<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Inmuebles;
use App\Http\Requests\CreateInmueblesRequest;
use App\Http\Requests\UpdateInmueblesRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use DB;
use App\Provincias;
use App\Localidades;
use App\Zonas;
use App\TiposInmuebles;
use App\Promociones;
use App\Propietarios;


class InmueblesController extends Controller {

	/**
	 * Display a listing of inmuebles
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
		$provincias = Provincias::lists("name", "id")->prepend('Ninguna', '');
		$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');
		$promociones = Promociones::lists("nombre", "id")->prepend('Ninguna', '');
		$propietarios = Propietarios::lists("name", "id")->prepend('Ninguno', '');
		$estado = Inmuebles::$estado;
		$operacion = Inmuebles::$operacion;
		
		return view('admin.inmuebles.index', compact("provincias", "tiposinmuebles", "estado", "operacion", "operacion", "promociones", "propietarios"));
	}
	
	/**
	 * Display a searching of inmuebles
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function datatables(Request $request)
	{
		$response = Inmuebles::query()
		->leftJoin('provincias', 'provincias.id', '=', 'inmuebles.provincias_id')
		->leftJoin('localidades', 'localidades.id', '=', 'inmuebles.localidades_id')
		->leftJoin('zonas', 'zonas.id', '=', 'inmuebles.zonas_id')
		->leftJoin('tiposinmuebles', 'tiposinmuebles.id', '=', 'inmuebles.tiposinmuebles_id')
		->select(
			'inmuebles.id as id',
			'inmuebles.estado as estado',
			'inmuebles.operacion as operacion',
			'inmuebles.direccion as direccion',
			'inmuebles.precio as precio',
			'inmuebles.dormitorios as dormitorios',
			'inmuebles.banos as banos',
			'inmuebles.aseos as aseos',
			'inmuebles.publicado as publicado',
			'provincias.name as provincia_name',
			'localidades.name as localidad_name',
			'zonas.name as zona_name',
			'tiposinmuebles.name as tipo_inmueble_name'
		)
		->where(function ($query) use ($request) {
			if (isset($request)) {
				
				if (($request->has('pvp_min') && $request->has('pvp_min') != "") && ($request->has('pvp_max') && $request->has('pvp_max') != "")) {
					$query
						->where('inmuebles.precio', '>=', $request->get('pvp_min'))
						->where('inmuebles.precio', '<=', $request->get('pvp_max'));
				} else if ($request->has('pvp_min') && $request->has('pvp_min') != "") {
					$query->where('inmuebles.precio', '>=', $request->get('pvp_min'));
				} else if ($request->has('pvp_max') && $request->has('pvp_max') != "") {
					$query->where('inmuebles.precio', '<=', $request->get('pvp_max'));
				}
				
				if ($request->has('id') && $request->get('id') != "") {
					$query->where('inmuebles.id', '=', $request->get('id'));
				}
				
				if ($request->has('estado') && $request->get('estado') != "") {
					$query->where('inmuebles.estado', '=', $request->get('estado'));
				}
				
				if ($request->has('operacion') && $request->get('operacion') != "") {
					$query->where('inmuebles.operacion', '=', $request->get('operacion'));
				}
				
				if ($request->has('propietarios_id') && $request->get('propietarios_id') != "") {
					$query->where('inmuebles.propietarios_id', '=', $request->get('propietarios_id'));
				}
				
				if ($request->has('propietarios_id') && $request->get('propietarios_id') != "") {
					$query->where('inmuebles.propietarios_id', '=', $request->get('propietarios_id'));
				}
				
				if ($request->has('publicado') && $request->get('publicado') != "false") {
					$query->where('inmuebles.publicado', '=', 1);
				}
				
				if ($request->has('promociones_id') && $request->get('promociones_id') != "") {
					$query->where('inmuebles.promociones_id', '=', $request->get('promociones_id'));
				}
				
				if ($request->has('provincias_id') && $request->get('provincias_id') != "") {
					$query->where('inmuebles.provincias_id', '=', $request->get('provincias_id'));
				}
				
				if ($request->has('direccion') && $request->has('direccion') != "") {
					$query->where('inmuebles.direccion', 'like', '%' . $request->get('direccion') . '%');
				}
				
				if ($request->has('cp') && $request->get('cp') != "") {
					$query->where('inmuebles.cp', '=', $request->get('cp'));
				}
				
				if ($request->has('tiposinmuebles_id') && $request->get('tiposinmuebles_id') != "") {
					$query->where('inmuebles.tiposinmuebles_id', '=', $request->get('tiposinmuebles_id'));
				}
				
				if ($request->has('dormitorios') && $request->get('dormitorios') != "") {
					$query->where('inmuebles.dormitorios', '=', $request->get('dormitorios'));
				}
				
				if ($request->has('banos') && $request->get('banos') != "") {
					$query->where('inmuebles.banos', '=', $request->get('banos'));
				}
				
				if ($request->has('aseos') && $request->get('aseos') != "") {
					$query->where('inmuebles.aseos', '=', $request->get('aseos'));
				}
				
			}
			
		})
		->get();
		
		$response = collect($response);
		
		return Datatables::of($response)->make(true);
	}

	/**
	 * Show the form for creating a new inmuebles
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
		$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');
        $estado = Inmuebles::$estado;
        $operacion = Inmuebles::$operacion;

	    return view('admin.inmuebles.create', compact("tiposinmuebles", "estado", "operacion"));
	}

	/**
	 * Store a newly created inmuebles in storage.
	 *
     * @param CreateInmueblesRequest|Request $request
	 */
	public function store(CreateInmueblesRequest $request)
	{
		Inmuebles::create($request->all());

		return redirect()->route('admin.inmuebles.index');
	}

	/**
	 * Show the form for editing the specified inmuebles.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$inmuebles = Inmuebles::find($id);
	    $provincias = Provincias::lists("name", "id")->prepend('Ninguna', '');
		$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');
		$promociones = Promociones::lists("nombre", "id")->prepend('Ninguna', '');
		$propietarios = Propietarios::lists("name", "id")->prepend('Ninguno', '');
        $estado = Inmuebles::$estado;
        $operacion = Inmuebles::$operacion;

		return view('admin.inmuebles.edit', compact('inmuebles', "provincias", "tiposinmuebles", "estado", "operacion", "operacion", "promociones", "propietarios"));
	}

	/**
	 * Update the specified inmuebles in storage.
     * @param UpdateInmueblesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateInmueblesRequest $request)
	{
		$inmuebles = Inmuebles::findOrFail($id);
		$inmuebles->update($request->all());
		
		return redirect()->route('admin.inmuebles.edit', ['id' => $id])->with('success', 'La operación se ha realizado correctamente.');
	}

	/**
	 * Remove the specified inmuebles from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Inmuebles::destroy($id);

		return redirect()->route('admin.inmuebles.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Inmuebles::destroy($toDelete);
        } else {
            Inmuebles::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.inmuebles.index');
    }

}
