<?php

namespace App\Http\Controllers\Product\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller {
    
    public function listCategories(Request $request) {

        return view('app.Category.list');
    }

    public function viewCategory($id) {

        $category = Category::find($id);
        if($category) {

            if($category->license <> Auth::user()->license) {
                return redirect()->back()->with('error', 'Sem permissão para visualizar Categoria!');
            }

            return view('app.Category.view', [
                'category' => $category
            ]);
        }

        return redirect()->back()->with('error', 'Não foram encontrados dados da Categoria!');
    }

    public function createCategory() {

        return view('app.Category.create');
    }

    public function createdCategory(Request $request) {

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->license = $request->license;

        if ($request->hasFile('file')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/categories/images', $imageName);
            $category->photo = $imageName;
        }

        if($category->save()) {
            return redirect()->route('adm.view-category', ['id' => $category->id])->with('success', 'Categoria cadastrada com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível cadastrar a Categoria!');
    }

    public function updatedCategory(Request $request) {

        $category = Category::find($request->id);
        if($category) {

            if(!empty($request->name)) {
                $data['name'] = $request->name;
            }

            if(!empty($request->description)) {
                $data['description'] = $request->description;
            }

            if ($request->hasFile('file')) {
                unlink(public_path('storage/categories/images/' . $category->photo));

                $imageName = time() . '_' . uniqid() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('public/categories/images', $imageName);
                $category->photo = $imageName;
            }

            if($category->update($data)) {
                return redirect()->back()->with('success', 'Produto atualizado com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível atualizar a Categoria, tente novamente mais tarde');
        }

        return redirect()->back()->with('error', 'Não foi possível atualizar a Categoria, tente novamente mais tarde');
    }
    

    public function deletedCategory(Request $request) {

        $category = Category::find($request->id);
        if($category) {

            $filePath = public_path('storage/categories/images/' . $category->photo);
            if($category->delete() && unlink($filePath)) {
                return back()->with('success', 'Categoria excluída com sucesso!');
            }
            
            return back()->with('error', 'Não foram encontrados dados da Categoria!');
        }

        return back()->with('error', 'Não foram encontrados dados da Categoria!');
    }

}
