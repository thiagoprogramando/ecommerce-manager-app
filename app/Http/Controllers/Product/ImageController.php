<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller {
    
    public function createdImage(Request $request) {

        if ($request->hasFile('file')) {

            $maxSize = 10 * 1024 * 1024;
            foreach ($request->file('file') as $file) {
                if ($file->getSize() > $maxSize) {
                    return back()->with('error', 'Uma ou mais imagens excederam o tamanho máximo permitido de 10MB.');
                }
            }

            foreach ($request->file('file') as $file) {
               
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                if($file->storeAs('public/products/images', $imageName)) {
                    Image::create([
                        'file' => $imageName,
                        'product_id' => $request->id
                    ]);
                }
            }
        }

        return back()->with('success', 'Imagens cadastradas com sucesso!');
    }

    public function deletedImage(Request $request) {

        $image = Image::find($request->id);
        if($image) {

            $filePath = public_path('storage/products/images/' . $image->file);
            if($image->delete() && unlink($filePath)) {
                return back()->with('success', 'Imagens excluída com sucesso!');
            }
            
            return back()->with('error', 'Não foram encontrados dados da Imagem!');
        }

        return back()->with('error', 'Não foram encontrados dados da Imagem!');
    }
 }
