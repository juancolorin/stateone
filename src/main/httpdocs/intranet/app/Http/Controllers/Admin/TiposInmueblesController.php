<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\TiposInmuebles;
use App\Http\Requests\CreateTiposInmueblesRequest;
use App\Http\Requests\UpdateTiposInmueblesRequest;
use Illuminate\Http\Request;



class TiposInmueblesController extends Controller {

	/**
	 * Display a listing of tiposinmuebles
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $tiposinmuebles = TiposInmuebles::all();

		return view('admin.tiposinmuebles.index', compact('tiposinmuebles'));
	}

	/**
	 * Show the form for creating a new tiposinmuebles
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.tiposinmuebles.create');
	}

	/**
	 * Store a newly created tiposinmuebles in storage.
	 *
     * @param CreateTiposInmueblesRequest|Request $request
	 */
	public function store(CreateTiposInmueblesRequest $request)
	{
	    
		TiposInmuebles::create($request->all());

		return redirect()->route('admin.tiposinmuebles.index');
	}

	/**
	 * Show the form for editing the specified tiposinmuebles.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$tiposinmuebles = TiposInmuebles::find($id);
	    
	    
		return view('admin.tiposinmuebles.edit', compact('tiposinmuebles'));
	}

	/**
	 * Update the specified tiposinmuebles in storage.
     * @param UpdateTiposInmueblesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTiposInmueblesRequest $request)
	{
		$tiposinmuebles = TiposInmuebles::findOrFail($id);

        

		$tiposinmuebles->update($request->all());

		return redirect()->route('admin.tiposinmuebles.index');
	}

	/**
	 * Remove the specified tiposinmuebles from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		TiposInmuebles::destroy($id);

		return redirect()->route('admin.tiposinmuebles.index');
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
            TiposInmuebles::destroy($toDelete);
        } else {
            TiposInmuebles::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.tiposinmuebles.index');
    }

}
