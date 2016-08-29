<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Localidades;
use App\Http\Requests\CreateLocalidadesRequest;
use App\Http\Requests\UpdateLocalidadesRequest;
use Illuminate\Http\Request;

use App\Provincias;


class LocalidadesController extends Controller {

	/**
	 * Display a listing of localidades
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $localidades = Localidades::with("provincias")->get();

		return view('admin.localidades.index', compact('localidades'));
	}
	
	/**
	 * Display a listing search of localidades
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function search($idProvincia)
	{
		$localidadesModel = new Localidades;
		$localidades = $localidadesModel->loadByIdProvincia($idProvincia);
		
		$provincia = Provincias::find($idProvincia);
		
		return view('admin.localidades.index')->with(array(
			'localidades' => $localidades,
			'provincia' => $provincia
		));
	}
	
	/**
	 * Display a listing search of localidades
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function searchjson($idProvincia)
	{
		$localidadesModel = new Localidades;
		$localidades = $localidadesModel->loadByIdProvincia($idProvincia);
	
		return response()->json($localidades);
	}

	/**
	 * Show the form for creating a new localidades
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $provincias = Provincias::lists("name", "id")->prepend('Ninguno', '');

	    
	    return view('admin.localidades.create', compact("provincias"));
	}

	/**
	 * Store a newly created localidades in storage.
	 *
     * @param CreateLocalidadesRequest|Request $request
	 */
	public function store(CreateLocalidadesRequest $request)
	{
	    
		Localidades::create($request->all());

		return redirect()->route('admin.localidades.index');
	}

	/**
	 * Show the form for editing the specified localidades.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$localidades = Localidades::find($id);
	    $provincias = Provincias::lists("name", "id")->prepend('Ninguno', '');

	    
		return view('admin.localidades.edit', compact('localidades', "provincias"));
	}

	/**
	 * Update the specified localidades in storage.
     * @param UpdateLocalidadesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateLocalidadesRequest $request)
	{
		$localidades = Localidades::findOrFail($id);

        

		$localidades->update($request->all());

		return redirect()->route('admin.localidades.index');
	}

	/**
	 * Remove the specified localidades from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Localidades::destroy($id);

		return redirect()->route('admin.localidades.index');
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
            Localidades::destroy($toDelete);
        } else {
            Localidades::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.localidades.index');
    }

}
