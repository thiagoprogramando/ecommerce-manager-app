<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {

    public function listProduct() {

        $products = Product::where('license', Auth::user()->api_key)->paginate(30); 
        return view('app.Product.list', [
            'products' => $products
        ]);
    }

    public function viewProduct($id) {

        $product = Product::find($id);
        if($product) {

            if($product->license <> Auth::user()->license) {
                return redirect()->back()->with('error', 'Sem permissão para visualizar Produto!');
            }

            $images             = Image::where('product_id', $product->id)->get();
            $categoriesProduct  = CategoryProduct::where('product_id', $product->id)->get();
            return view('app.Product.view', [
                'product'               => $product,
                'images'                => $images,
                'categoriesProduct'     => $categoriesProduct
            ]);
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Produto!');
    }
    
    public function createProduct() {

        return view('app.Product.create');
    }

    public function createdProduct(Request $request) {
        
        $product                = new Product();
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->value         = $request->value;
        $product->qtd           = $request->qtd;
        $product->ean           = $request->ean;
        $product->color         = $request->color;
        $product->size          = $request->size;
        $product->type          = $request->type;
        $product->status        = $request->status;
        $product->license       = $request->license;
        if($product->save()) {
            return redirect()->back()->with('success', 'Produto criado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível cadastrar o Produto, tente novamente mais tarde');
    }

    public function updatedProduct(Request $request) {
        
        $product = Product::find($request->id);
        if($product) {

            if(!empty($request->name)) {
                $data['name'] = $request->name;
            }

            if(!empty($request->description)) {
                $data['description'] = $request->description;
            }

            if(!empty($request->value)) {
                $data['value'] = $request->value;
            }

            if(!empty($request->qtd)) {
                $data['qtd'] = $request->qtd;
            }

            if(!empty($request->ean)) {
                $data['ean'] = $request->ean;
            }

            if(!empty($request->color)) {
                $data['color'] = $request->color;
            }

            if(!empty($request->size)) {
                $data['size'] = $request->size;
            }

            if(!empty($request->type)) {
                $data['type'] = $request->type;
            }

            if(!empty($request->status)) {
                $data['status'] = $request->status;
            }

            if($product->update($data)) {
                return redirect()->back()->with('success', 'Produto atualizado com sucesso!');
            }
        }

        return redirect()->back()->with('error', 'Não foi possível atualizar o Produto, tente novamente mais tarde');
    }

    public function deletedProduct(Request $request) {

        $product = Product::find($request->id);
        if($product && $product->delete()) {

            return redirect()->back()->with('success', 'Produto excluído com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Produto!');
    }

    public function copyProduct($id) {

        $product = Product::find($id);
        if($product) {

            $newProduct = new Product();
            $newProduct->name = $product->name;
            $newProduct->description   = $product->description;
            $newProduct->value         = $product->value;
            $newProduct->qtd           = $product->qtd;
            $newProduct->ean           = $product->ean;
            $newProduct->color         = $product->color;
            $newProduct->size          = $product->size;
            $newProduct->type          = $product->type;
            $newProduct->status        = $product->status;
            $newProduct->license       = $product->license;
            $newProduct->group         = $product->id;
            if($newProduct->save()) {
                return redirect()->route('adm.view-product', ['id' => $newProduct->id])->with('success', 'Produto criado com os mesmos dados de '.$product->name);
            }

            return redirect()->back()->with('error', 'Não foi possível criar o Produto com os dados de '.$product->name);
        }

        return redirect()->back()->with('error', 'Não foram encontrados dados do Produto!');
    }
}
