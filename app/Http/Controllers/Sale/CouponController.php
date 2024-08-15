<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller {
    
    public function listCoupons(Request $request) {

        $coupons = Coupon::where('license', Auth::user()->api_key)->paginate(30);
        return view('app.Coupon.list', [
            'coupons' => $coupons
        ]);
    }

    public function viewCoupon($id) {

        $coupon = Coupon::find($id);
        if($coupon) {

            if($coupon->license <> Auth::user()->license) {
                return redirect()->back()->with('error', 'Sem permissão para visualizar Cupom!');
            }

            return view('app.Coupon.view', [
                'coupon' => $coupon,
            ]);
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Cupom!');
    }

    public function createCoupon() {

        return view('app.Coupon.create');
    }

    public function createdCoupon(Request $request) {

        $coupon                 = new Coupon();
        $coupon->name           = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $request->name));
        $coupon->description    = $request->description;
        $coupon->percentage     = $request->percentage;
        $coupon->qtd            = $request->qtd;
        $coupon->license        = Auth::user()->api_key;
        if($coupon->save()) {
            return redirect()->route('adm.view-coupon', ['id' => $coupon->id])->with('success', 'Cupom cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível cadastrar o Cupom');
    }

    public function updatedCoupon(Request $request) {
        
        $coupon = Coupon::find($request->id);
        if($coupon) {

            if(!empty($request->name)) {
                $data['name'] = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $request->name));
            }

            if(!empty($request->description)) {
                $data['description'] = $request->description;
            }

            if(!empty($request->percentage)) {
                $data['percentage'] = $request->percentage;
            }

            if(!empty($request->qtd)) {
                $data['qtd'] = $request->qtd;
            }

            if($coupon->update($data)) {
                return redirect()->back()->with('success', 'Cupom atualizado com sucesso!');
            }
        }

        return redirect()->back()->with('error', 'Não foi possível atualizar o Cupom, tente novamente mais tarde');
    }

    public function deletedCoupon(Request $request) {

        $coupon = Coupon::find($request->id);
        if($coupon && $coupon->delete()) {

            return redirect()->back()->with('success', 'Cupom excluído com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Cupom!');
    }
}
