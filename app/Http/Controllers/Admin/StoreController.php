<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Store;
use App\User;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;

class StoreController extends Controller
{
    use UploadTrait;
    
    public function __construct() {
        
      //$this->middleware('user.has.store')->only(['create','store']);
    }

    public function index() {
        
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create() {

        $users = User::all(['id','name']);

        return view('admin.stores.create', compact('users'));

    }

    public function store(StoreRequest $request) {


        $data = $request->all();        
        $user = auth()->user();

        if($request->hasFile('logo')) {
            $data['logo']= $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success();

        return redirect()->route('admin.stores.index');

    }

    public function edit($id) {

        $store = Store::find($id);

        return view('admin.stores.edit',compact('store'));

    }

    public function update(StoreRequest $request, $id) {

        $data =$request->all();
        
        $store = Store::find($id);

        if($request->hasFile('logo')) {
            if(Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }
            $data['logo']= $this->imageUpload($request->file('logo'));

        }

        $store->update($data);

        flash('Loja atualizada com sucesso')->success();

        return redirect()->route('admin.stores.index');

    }

    public function remover($id) {

        $store = Store::find($id);
        $store->delete();

        flash('Loja removida com sucesso')->success();

        return redirect()->route('admin.stores.index');

    }
}




























