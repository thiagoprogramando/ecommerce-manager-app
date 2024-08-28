<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller {
    
    public function links() {

        $link = Link::where('license', Auth::user()->api_key)->first();
        return view('app.Marketing.link', [
            'link' => $link
        ]);
    }

    public function createdLink(Request $request) {

        $link = Link::where('license', Auth::user()->api_key)->first();
        if($link) {

            $link->url_whatsapp     = $request->url_whatsapp;
            $link->url_instagram    = $request->url_instagram;
            $link->url_maps         = $request->url_maps;
            if($link->save()) {
                return redirect()->back()->with('success', 'Links atualizados com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível concluir essa operação!');
        } else {

            $link                   = new Link();
            $link->license          = Auth::user()->api_key;
            $link->url_whatsapp     = $request->url_whatsapp;
            $link->url_instagram    = $request->url_instagram;
            $link->url_maps         = $request->url_maps;
            if($link->save()) {

                return redirect()->back()->with('success', 'Links criados com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível concluir essa operação!');
        }

        return redirect()->back()->with('error', 'Não foi possível concluir essa operação!');
    }
}
