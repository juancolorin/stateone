<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Promociones;
use App\Http\Requests\CreatePromocionesRequest;
use App\Http\Requests\UpdatePromocionesRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use DB;
use App\Provincias;
use App\Localidades;
use App\Zonas;
use App\TiposInmuebles;
use App\Propietarios;


class PromocionesController extends Controller {

	/**
	 * Display a listing of promociones
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');
        $estado = Promociones::$estado;
        $operacion = Promociones::$operacion;

		return view('admin.promociones.index', compact("tiposinmuebles", "estado", "operacion"));
	}
	
	/**
	 * Display a searching of promociones
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function datatables(Request $request)
	{
		$response = Promociones::query()
		->leftJoin('provincias', 'provincias.id', '=', 'promociones.provincias_id')
		->leftJoin('localidades', 'localidades.id', '=', 'promociones.localidades_id')
		->leftJoin('zonas', 'zonas.id', '=', 'promociones.zonas_id')
		->leftJoin('tiposinmuebles', 'tiposinmuebles.id', '=', 'promociones.tiposinmuebles_id')
		->select(
			'promociones.id as id',
			'promociones.estado as estado',
			'promociones.operacion as operacion',
			'promociones.nombre as nombre',
			'promociones.publicado as publicado',
			'provincias.name as provincia_name',
			'localidades.name as localidad_name',
			'zonas.name as zona_name',
			'tiposinmuebles.name as tipo_inmueble_name'
		)
		->get();
		
		$response = collect($response);
		
		return Datatables::of($response)->make(true);
	}

	/**
	 * Show the form for creating a new promociones
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
		$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');
        $estado = Promociones::$estado;
        $operacion = Promociones::$operacion;

	    return view('admin.promociones.create', compact("tiposinmuebles", "estado", "operacion"));
	}

	/**
	 * Store a newly created promociones in storage.
	 *
     * @param CreatePromocionesRequest|Request $request
	 */
	public function store(CreatePromocionesRequest $request)
	{
		Promociones::create($request->all());

		return redirect()->route('admin.promociones.index');
	}

	/**
	 * Show the form for editing the specified promociones.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$promociones = Promociones::find($id);
	    $provincias = Provincias::lists("name", "id")->prepend('Ninguna', '');
		$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');
		$propietarios = Propietarios::lists("name", "id")->prepend('Ninguno', '');
        $estado = Promociones::$estado;
        $operacion = Promociones::$operacion;

		return view('admin.promociones.edit', compact('promociones', "provincias", "tiposinmuebles", "estado", "operacion", "propietarios"));
	}

	/**
	 * Update the specified promociones in storage.
     * @param UpdatePromocionesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePromocionesRequest $request)
	{
		$promociones = Promociones::findOrFail($id);
		$promociones->update($request->all());
		
		return redirect()->route('admin.promociones.edit', ['id' => $id])->with('success', 'La operación se ha realizado correctamente.');
	}

	/**
	 * Remove the specified promociones from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Promociones::destroy($id);

		return redirect()->route('admin.promociones.index');
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
            Promociones::destroy($toDelete);
        } else {
            Promociones::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.promociones.index');
    }

}
