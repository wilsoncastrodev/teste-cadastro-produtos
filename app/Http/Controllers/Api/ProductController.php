<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductsCollection;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('tags:id,name')->get();
        return $this->sendResponse(new ProductsCollection($products), 'Retorna todas os Produtos registrados.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:product,name',
        ], [
            'name.unique' => 'O nome deste "Produto" já está sendo utilizada.'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Produto não pode ser cadastrado.', $validator->errors(), 422);
        }

        $product = Product::create($request->except(['tags']));

        $product->tags()->attach($request->tags);

        return $this->sendResponse([], 'Produto cadastrado com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->except(['_method']), [
            'name' => 'required|string|max:50|unique:product,name,' . $id,
        ], [
            'name.unique' => 'O nome deste "Produto" já está sendo utilizado.'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Produto não pode ser atualizado.', $validator->errors(), 422);
        }

        $product = tap(Product::where('id', $id))->update($request->except(['_method', 'tags']))->first();

        $product->tags()->sync($request->tags);

        return $this->sendResponse([], 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return $this->sendResponse([], 'Produto excluído com sucesso.');
    }
}
