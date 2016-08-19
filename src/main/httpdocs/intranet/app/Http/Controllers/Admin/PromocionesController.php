<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Promociones;
use App\Http\Requests\CreatePromocionesRequest;
use App\Http\Requests\UpdatePromocionesRequest;
use Illuminate\Http\Request;

use App\Provincias;
use App\Localidades;
use App\Zonas;
use App\TiposInmuebles;


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
        $promociones = Promociones::with("provincias")->with("localidades")->with("zonas")->with("tiposinmuebles")->get();

		return view('admin.promociones.index', compact('promociones'));
	}

	/**
	 * Show the form for creating a new promociones
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $provincias = Provincias::lists("name", "id")->prepend('Ninguno', '');
$localidades = Localidades::lists("name", "id")->prepend('Ninguno', '');
$zonas = Zonas::lists("name", "id")->prepend('Ninguno', '');
$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');

	    
        $estado = Promociones::$estado;
        $operacion = Promociones::$operacion;

	    return view('admin.promociones.create', compact("provincias", "localidades", "zonas", "tiposinmuebles", "estado", "operacion"));
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
	    $provincias = Provincias::lists("name", "id")->prepend('Ninguno', '');
$localidades = Localidades::lists("name", "id")->prepend('Ninguno', '');
$zonas = Zonas::lists("name", "id")->prepend('Ninguno', '');
$tiposinmuebles = TiposInmuebles::lists("name", "id")->prepend('Ninguno', '');

	    
        $estado = Promociones::$estado;
        $operacion = Promociones::$operacion;

		return view('admin.promociones.edit', compact('promociones', "provincias", "localidades", "zonas", "tiposinmuebles", "estado", "operacion"));
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

		return redirect()->route('admin.promociones.index');
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
