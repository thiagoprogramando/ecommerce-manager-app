<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    
    public function profile() {

        return view('app.User.profile');
    }

    public function updateUser(Request $request) {

        $user = User::find($request->id);
        if($user) {

            if(!empty($request->name)) {
                $data['name'] = $request->name;
            }

            if(!empty($request->cpfcnpj)) {
                $data['cpfcnpj'] = $request->cpfcnpj;
            }

            if(!empty($request->description)) {
                $data['description'] = $request->description;
            }

            if(!empty($request->email)) {
                $data['email'] = $request->email;
            }

            if(!empty($request->phone)) {
                $data['phone'] = $request->phone;
            }

            if(!empty($request->type)) {
                $data['type'] = $request->type;
            }

            if(!empty($request->address)) {
                $data['address'] = $request->address;
            }

            if(!empty($request->api_key)) {
                $data['api_key'] = $request->api_key;
            }

            if(!empty($request->wallet)) {
                $data['wallet'] = $request->wallet;
            }

            if(!empty($request->photo)) {

                if ($user->photo) {
                    Storage::delete('public/' . $user->photo);
                }
    
                $path = $request->file('photo')->store('profile-photos', 'public');
                $data['photo'] = $path;
            }

            if($user->update($data)){
                return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
            }

            return redirect()->back()->with('error', 'Não foi possível atualizar os dados!');
        }

        return redirect()->back()->with('error', 'Não foi possível encontrar os dados do Usuário!');
    }

    public function listUsers(Request $request, $type = null) {

        $users = User::where('type', $type)->where('api_key', Auth::user()->api_key)->paginate(30);
        return view('app.User.list', [
            'users' => $users
        ]);
    }

    public function viewUser($id) {

        $user = User::find($id);
        if($user) {

            return view('app.User.view', [
                'user'               => $user,
            ]);
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Usuário!');
    }

    public function createUser() {

        return view('app.User.create');
    }

    public function createdUser(Request $request) {

        $user               = new User();
        $user->name         = $request->name;
        $user->cpfcnpj      = $request->cpfcnpj;
        $user->description  = $request->description;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->address      = $request->address;
        $user->wallet       = $request->wallet;
        $user->api_key      = $request->api_key;
        $user->password     = bcrypt('123456');
        if($user->save()) {
            return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível criar o Usuário!');
    }

    public function deletedUser(Request $request) {

        $user = User::find($request->id);
        if($user->type == 1) {
            return redirect()->back()->with('info', 'Não é possível excluir um usuário Administrador!');
        }

        if($user && $user->delete()) {

            return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Não foram encontrados dados do Usuário!');
    }
}
