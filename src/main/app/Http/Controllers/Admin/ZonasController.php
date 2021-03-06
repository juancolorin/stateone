<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Zonas;
use App\Http\Requests\CreateZonasRequest;
use App\Http\Requests\UpdateZonasRequest;
use Illuminate\Http\Request;

use App\Localidades;


class ZonasController extends Controller {

	/**
	 * Display a listing of zonas
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $zonas = Zonas::with("localidades")->get();

		return view('admin.zonas.index', compact('zonas'));
	}
	
	/**
	 * Display a listing search of zonas
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function search($idLocalidad)
	{
		$zonasModel = new Zonas;
		$zonas = $zonasModel->loadByIdLocalidad($idLocalidad);
	
		$localidad = Localidades::find($idLocalidad);
	
		return view('admin.zonas.index')->with(array(
				'zonas' => $zonas,
				'localidad' => $localidad
		));
	}

	/**
	 * Show the form for creating a new zonas
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $localidades = Localidades::lists("name", "id")->prepend('Ninguno', '');

	    
	    return view('admin.zonas.create', compact("localidades"));
	}

	/**
	 * Store a newly created zonas in storage.
	 *
     * @param CreateZonasRequest|Request $request
	 */
	public function store(CreateZonasRequest $request)
	{
	    
		Zonas::create($request->all());

		return redirect()->route('admin.zonas.index');
	}

	/**
	 * Show the form for editing the specified zonas.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$zonas = Zonas::find($id);
	    $localidades = Localidades::lists("name", "id")->prepend('Ninguno', '');

	    
		return view('admin.zonas.edit', compact('zonas', "localidades"));
	}

	/**
	 * Update the specified zonas in storage.
     * @param UpdateZonasRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateZonasRequest $request)
	{
		$zonas = Zonas::findOrFail($id);

        

		$zonas->update($request->all());

		return redirect()->route('admin.zonas.index');
	}

	/**
	 * Remove the specified zonas from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Zonas::destroy($id);

		return redirect()->route('admin.zonas.index');
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
            Zonas::destroy($toDelete);
        } else {
            Zonas::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.zonas.index');
    }

}
