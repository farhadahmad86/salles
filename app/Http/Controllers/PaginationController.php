<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaginationController extends Controller
{
    function index()
    {
        $data = DB::table('post')->orderBy('id', 'asc')->paginate(5);
        return view('pagination.pagination', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('post')
                ->where('id', 'like', '%'.$query.'%')
                ->orWhere('post_title', 'like', '%'.$query.'%')
                ->orWhere('post_description', 'like', '%'.$query.'%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(5);
            return view('pagination.pagination_data', compact('data'))->render();
//            return view('pagination.pagination', compact('data'));
        }
    }
}
