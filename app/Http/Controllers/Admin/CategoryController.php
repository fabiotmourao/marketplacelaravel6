<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
	/**
	 * @var Category
	 */
	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $categories = Category::paginate(10);

	    return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('admin.categories.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CategoryRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(CategoryRequest $request)
    {
	    $data = $request->all();

	    $category = $this->category->create($data);

	    flash('Categoria Criado com Sucesso!')->success();
	    return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $category = Category::findOrFail($id);

	    return view('admin.categories.edit', compact('category'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param CategoryRequest $request
	 * @param  int $category
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(CategoryRequest $request, $id)
    {
	    $data = $request->all();

	    $category = Category::find($id);
	    $category->update($data);

	    flash('Categoria Atualizada com Sucesso!')->success();
	    return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function remover($id)
    {
	    $category = Category::find($id);
	    $category->delete();

        flash('Categoria Removida com Sucesso!')->success();
	    return redirect()->route('admin.categories.index');
    }
}