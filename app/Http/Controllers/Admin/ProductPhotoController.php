<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductPhoto;


class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request) {

        $image = $request->get('image');

        if(Storage::disk('public')->exists($image)){
            Storage::disk('public')->delete($image);
        }

        $removePhoto = ProductPhoto::where('image', $image);
        $productId = $removePhoto->first()->product_id;
        $removePhoto->delete();

        flash('Imagem removida com sucesso')->success();

        return redirect()->back();
    }

}
