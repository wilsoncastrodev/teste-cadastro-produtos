<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ReportController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::select('name')->withCount('products')->orderByDesc('products_count')->get();
        return $this->sendResponse($tags, 'Retorna o Relatório de Relevância de Produtos.');
    }
}
