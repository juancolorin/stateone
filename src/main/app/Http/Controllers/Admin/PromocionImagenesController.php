<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\PromocionImagenes;
use App\Http\Requests\CreatePromocionImagenesRequest;
use App\Http\Requests\UpdatePromocionImagenesRequest;
use Illuminate\Http\Request;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

use App\Provincias;


class PromocionImagenesController extends Controller {

	/**
	 * Display a listing search of promocion_imagenes
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\View\View
	 */
	public function searchjson($idPromocion)
	{
		$promocion_imagenesModel = new PromocionImagenes;
		$promocion_imagenes = $promocion_imagenesModel->loadByIdPromocion($idPromocion);
	
		return response()->json($promocion_imagenes);
	}

	/**
	 * Store a newly created promocion_imagenes in storage.
	 *
     * @param CreatePromocionImagenesRequest|Request $request
	 */
	public function store(CreatePromocionImagenesRequest $request)
	{
		//define the image paths
		
		$destinationFolder = '/public/static/images/promociones/' . $request->get('promocion_id') . '/';
		$destinationThumbnail = '/public/static/images/promociones/' . $request->get('promocion_id') . '/';
		$destinationMobile = '/public/static/images/promociones/' . $request->get('promocion_id') . '/';
		
		$marketingImage = new PromocionImagenes([
				'image_name'        => $request->file('files')[0]->getClientOriginalName(),
				'image_extension'   => $request->file('files')[0]->getClientOriginalExtension(),
				'mobile_image_name' => $request->file('files')[0]->getClientOriginalName(),
				'mobile_extension'  => $request->file('files')[0]->getClientOriginalExtension(),
				'promocion_id'      => $request->get('promocion_id'),
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
	 * Update the specified promocion_imagenes in storage.
     * @param UpdatePromocionImagenesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePromocionImagenesRequest $request)
	{
		$promocion_imagenes = PromocionImagenes::findOrFail($id);

		$promocion_imagenes->update($request->all());

		return response()->json($promocion_imagenes);
	}

	/**
	 * Remove the specified promocion_imagenes from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		PromocionImagenes::destroy($id);

		return response("Eliminado correctamente", 200);
	}

}
