<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

            if($product->license <> Auth::user()->api_key) {
                return redirect()->back()->with('error', 'Sem permissão para visualizar Produto!');
            }

            return view('app.Product.view', [
                'product'    => $product,
                'categories' => Category::where('license', Auth::user()->license)->get()
            ]);
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Produto!');
    }

    public function createdProduct(Request $request) {

        if ($request->hasFile('file')) {
            $maxSize = 10 * 1024 * 1024;
            foreach ($request->file('file') as $file) {
                if ($file->getSize() > $maxSize) {
                    return back()->with('error', 'Uma ou mais imagens excederam o tamanho máximo permitido de 10MB.');
                }
            }
        }
        
        $product                = new Product();
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->value         = $this->formatarValor($request->value);
        $product->stock         = $request->stock;
        $product->ean           = $request->ean;
        $product->license       = $request->license;
        if($product->save()) {

            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    if ($file->storeAs('products/images', $imageName, 'public')) {
                        Image::create([
                            'file'       => $imageName,
                            'product_id' => $product->id
                        ]);
                    }
                }
            }

            return redirect()->route('adm.view-product', ['id' => $product->id])->with('success', 'Produto cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível cadastrar o Produto, tente novamente mais tarde');
    }

    public function updatedProduct(Request $request) {
        
        $product = Product::find($request->id);
        if($product) {

            $data['name']           = $request->name ?? '---';
            $data['description']    = $request->description ?? '';
            $data['value']          = $request->value ?? 0;
            $data['stock']          = $request->stock ?? null;
            $data['ean']            = $request->ean ?? null;
            $data['color']          = $request->color ?? null;
            $data['size']           = $request->size ?? null;
            $data['unit']           = $request->unit ?? null;
            $data['mark']           = $request->mark ?? null;
            $data['type']           = $request->type ?? 0;
            $data['status']         = $request->status ?? 2;
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
            $newProduct->stock         = $product->stock;
            $newProduct->ean           = $product->ean;
            $newProduct->color         = $product->color;
            $newProduct->size          = $product->size;
            $newProduct->mark          = $product->mark;
            $newProduct->unit          = $product->unit;
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

    private function formatarValor($valor) {
        
        $valor = preg_replace('/[^0-9,.]/', '', $valor);
        $valor = str_replace(['.', ','], '', $valor);

        return number_format(floatval($valor) / 100, 2, '.', '');
    }
}
