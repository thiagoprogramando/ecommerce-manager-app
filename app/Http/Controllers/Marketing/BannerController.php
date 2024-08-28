<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller {
    
    public function banners() {

        $banners = Banner::where('license', Auth::user()->api_key)->get();
        return view('app.Marketing.banner', [
            'banners' => $banners
        ]);
    }

    public function createdBanner(Request $request) {

        $maxSize = 10 * 1024 * 1024;
        if ($request->file('file')->getSize() > $maxSize) {
            return back()->with('error', 'Uma ou mais imagens excederam o tamanho máximo permitido de 10MB.');
        }
        
        $banner                 = new Banner();
        $banner->title          = $request->title;
        $banner->description    = $request->description;
        $banner->file           = $request->file('file')->store('banners/images', 'public');
        $banner->url            = $request->url;
        $banner->license        = Auth::user()->api_key;
        if ($banner->save()) {

            return redirect()->back()->with('success', 'Banner criado com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Falha ao criar Banner!');
    }

    public function deletedbanner(Request $request) {

        $banner = Banner::find($request->id);
        if($banner) {

            $filePath = public_path('storage/' . $banner->file);
            if($banner->delete() && unlink($filePath)) {
                return back()->with('success', 'Banner excluído com sucesso!');
            }
            
            return back()->with('error', 'Não foram encontrados dados do Banner!');
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Banner!');
    }
}
