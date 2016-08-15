<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Provincias;
use App\Http\Requests\CreateProvinciasRequest;
use App\Http\Requests\UpdateProvinciasRequest;
use Illuminate\Http\Request;



class ProvinciasController extends Controller {

	/**
	 * Display a listing of provincias
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $provincias = Provincias::all();

		return view('admin.provincias.index', compact('provincias'));
	}

	/**
	 * Show the form for creating a new provincias
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.provincias.create');
	}

	/**
	 * Store a newly created provincias in storage.
	 *
     * @param CreateProvinciasRequest|Request $request
	 */
	public function store(CreateProvinciasRequest $request)
	{
	    
		Provincias::create($request->all());

		return redirect()->route('admin.provincias.index');
	}

	/**
	 * Show the form for editing the specified provincias.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$provincias = Provincias::find($id);
	    
	    
		return view('admin.provincias.edit', compact('provincias'));
	}

	/**
	 * Update the specified provincias in storage.
     * @param UpdateProvinciasRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateProvinciasRequest $request)
	{
		$provincias = Provincias::findOrFail($id);

        

		$provincias->update($request->all());

		return redirect()->route('admin.provincias.index');
	}

	/**
	 * Remove the specified provincias from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Provincias::destroy($id);

		return redirect()->route('admin.provincias.index');
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
            Provincias::destroy($toDelete);
        } else {
            Provincias::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.provincias.index');
    }

}
