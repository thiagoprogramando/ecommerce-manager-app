<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    
    public function createdCategory(Request $request) {

        $category               = new CategoryProduct();
        $category->product_id   = $request->product_id;
        $category->category_id  = $request->category_id;
        if($category->save()) {

            return redirect()->back()->with('success', 'Categoria associada com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível associar Categoria!');
    }

    public function deletedCategory(Request $request) {

        $category = CategoryProduct::find($request->id);
        if($category && $category->delete()) {

            return redirect()->back()->with('success', 'Categoria excluída com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível excluir Categoria!');
    }
}
