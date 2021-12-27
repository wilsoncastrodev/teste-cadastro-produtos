<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagsCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;

class TagController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(new TagsCollection(Tag::all()), 'Retorna todas as Tags registradas.');
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
            'name' => 'required|string|max:50|unique:tag,name',
        ], [
            'name.unique' => 'O nome desta "Tag" já está sendo utilizada.'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Tag não pode ser cadastrada.', $validator->errors(), 422);
        }

        Tag::create($request->all());

        return $this->sendResponse([], 'Tag cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return $this->sendResponse($tag, 'Retorna a Tag "' . $tag->name . '"');
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
            'name' => 'required|string|max:50|unique:tag,name',
        ], [
            'name.unique' => 'O nome desta "Tag" já está sendo utilizada.'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Tag não pode ser atualizada.', $validator->errors(), 422);
        }

        Tag::where('id', $id)->update($request->except(['_method']));

        return $this->sendResponse([], 'Tag atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);
        return $this->sendResponse([], 'Tag excluída com sucesso.');
    }
}
