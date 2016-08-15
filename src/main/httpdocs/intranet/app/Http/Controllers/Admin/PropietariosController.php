<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Propietarios;
use App\Http\Requests\CreatePropietariosRequest;
use App\Http\Requests\UpdatePropietariosRequest;
use Illuminate\Http\Request;

use App\User;


class PropietariosController extends Controller {

	/**
	 * Display a listing of propietarios
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $propietarios = Propietarios::with("user")->get();

		return view('admin.propietarios.index', compact('propietarios'));
	}

	/**
	 * Show the form for creating a new propietarios
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $user = User::lists("name", "id")->prepend('Ninguno', '');

	    
        $medio_captacion = Propietarios::$medio_captacion;

	    return view('admin.propietarios.create', compact("user", "medio_captacion"));
	}

	/**
	 * Store a newly created propietarios in storage.
	 *
     * @param CreatePropietariosRequest|Request $request
	 */
	public function store(CreatePropietariosRequest $request)
	{
	    
		Propietarios::create($request->all());

		return redirect()->route('admin.propietarios.index');
	}

	/**
	 * Show the form for editing the specified propietarios.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$propietarios = Propietarios::find($id);
	    $user = User::lists("name", "id")->prepend('Ninguno', '');

	    
        $medio_captacion = Propietarios::$medio_captacion;

		return view('admin.propietarios.edit', compact('propietarios', "user", "medio_captacion"));
	}

	/**
	 * Update the specified propietarios in storage.
     * @param UpdatePropietariosRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePropietariosRequest $request)
	{
		$propietarios = Propietarios::findOrFail($id);

        

		$propietarios->update($request->all());

		return redirect()->route('admin.propietarios.index');
	}

	/**
	 * Remove the specified propietarios from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Propietarios::destroy($id);

		return redirect()->route('admin.propietarios.index');
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
            Propietarios::destroy($toDelete);
        } else {
            Propietarios::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.propietarios.index');
    }

}
