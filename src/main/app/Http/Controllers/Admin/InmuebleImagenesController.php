<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\InmuebleImagenes;
use App\Http\Requests\CreateInmuebleImagenesRequest;
use App\Http\Requests\UpdateInmuebleImagenesRequest;
use Illuminate\Http\Request;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

use App\Provincias;


class InmuebleImagenesController extends Controller {

	/**
	 * Display a listing search of inmueble_imagenes
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function searchjson($idInmueble)
	{
		$inmueble_imagenesModel = new InmuebleImagenes;
		$inmueble_imagenes = $inmueble_imagenesModel->loadByIdInmueble($idInmueble);
	
		return response()->json($inmueble_imagenes);
	}

	/**
	 * Store a newly created inmueble_imagenes in storage.
	 *
     * @param CreateInmuebleImagenesRequest|Request $request
	 */
	public function store(CreateInmuebleImagenesRequest $request)
	{
		//define the image paths
		
		$destinationFolder = '/public/static/images/inmuebles/' . $request->get('inmueble_id') . '/';
		$destinationThumbnail = '/public/static/images/inmuebles/' . $request->get('inmueble_id') . '/';
		$destinationMobile = '/public/static/images/inmuebles/' . $request->get('inmueble_id') . '/';
		
		if (!file_exists($destinationFolder)) {
			mkdir(getcwd() . $destinationFolder, 0755, true);
		}
		
		$marketingImage = new InmuebleImagenes([
				'image_name'        => $request->file('files')[0]->getClientOriginalName(),
				'image_extension'   => $request->file('files')[0]->getClientOriginalExtension(),
				'mobile_image_name' => $request->file('files')[0]->getClientOriginalName(),
				'mobile_extension'  => $request->file('files')[0]->getClientOriginalExtension(),
				'inmueble_id'      => $request->get('inmueble_id'),
				'is_active'         => false,
				'is_featured'       => false,
				'title'             => $request->file('files')[0]->getClientOriginalName(),
		
		]);
	
	   //assign the image paths to new model, so we can save them to DB
	
	   $marketingImage->image_path = $destinationFolder;
	   $marketingImage->mobile_image_path = $destinationMobile;
	
	   // format checkbox values and save model
	
	   //$this->formatCheckboxValue($marketingImage);
	   $marketingImage->save();
	
	   //parts of the image we will need
	
	   $file = $request->file('files')[0];
	
	   $imageName = $marketingImage->image_name;
	   $extension = $request->file('files')[0]->getClientOriginalExtension();
	
	   //create instance of image from temp upload
	   $image = Image::make($file->getRealPath());
	
	   //save image with thumbnail
	
	   $image->save(public_path() . $destinationFolder . $imageName)
	       ->resize(60, 60)
	       // ->greyscale()
	       ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName);
	
	   // now for mobile
	
	   $mobileFile = $file;
	
	   $mobileImageName = $marketingImage->mobile_image_name;
	   $mobileExtension = $request->file('files')[0]->getClientOriginalExtension();
	
	   //create instance of image from temp upload
	   $mobileImage = Image::make($mobileFile->getRealPath());
	   $mobileImage->save(public_path() . $destinationMobile . 'm-' . $mobileImageName);
	
	
	   // Process the uploaded image, add $model->attribute and folder name
	   
	   return response()->json($marketingImage);
	}

	/**
	 * Update the specified inmueble_imagenes in storage.
     * @param UpdateInmuebleImagenesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateInmuebleImagenesRequest $request)
	{
		$inmueble_imagenes = InmuebleImagenes::findOrFail($id);

		$inmueble_imagenes->update($request->all());

		return response()->json($inmueble_imagenes);
	}

	/**
	 * Remove the specified inmueble_imagenes from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		InmuebleImagenes::destroy($id);

		return response("Eliminado correctamente", 200);
	}

}
