<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Product;
use App\Models\Store;
use App\Models\Category;
use App\Models\ProductPhoto;
use App\Traits\UploadTrait;

use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{

    use UploadTrait;


    private $product;

    public function __construct(Product $product) {

        $this->$product = $product;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $userStore = auth()->user()->store;
        $products = $userStore->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $categories = Category::all(['id','name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) {
        
        $data = $request->all();
        $categories = $request->get('categories',null);

        $store = auth()->user()->store;
        $product = $store->products()->create($data);
        $product->categories()->sync($categories);

        if($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);
        }

        flash('Produto criado com sucesso!')->success();
        return redirect()->route('/admin.products.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $product = Product::findOrFail($id);
        $categories = Category::all(['id','name']);
       
        return view('admin.products.edit', compact('product','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id) { 
        
        $data = $request->all();
        $categories = $request->get('categories',null);


        $product = Product::find($id);
        $product->update($data);

        if(!is_null($categories))
            $product->categories()->sync($categories);

        if($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);
        }
        
        flash('Produto atualizado com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remover($id) {
        
        $product = Product::find($id);
        $product->delete();
        
        flash('Produto removido com sucesso')->success();

        return redirect()->route('admin.products.index');
    }
}
