<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class UserController extends Controller
{
    private $baseurl = "http://127.0.0.1:8000";

    public function index()
    {
        try {
            $limit = 10;
            $offset = 0;
            $data = Http::get($this->baseurl . "/user/" . $limit . "/" . $offset)->json();
            $count = Http::get($this->baseurl . "/all-user-count")->json();
            $visible_pages = 10;
            return view("home", [
                "data" => $data,
                "limit" => $limit,
                "offset" => $offset,
                "total_pages" => \ceil($count / $visible_pages)
            ]);
        } catch (Throwable $t) {
            return \response()->json([
                "error" => true,
                "message" => $t->getMessage()
            ]);
        }
    }

    public function create()
    {
        return view("create-user", ["baseurl" => $this->baseurl]);
    }

    public function store(Request $request)
    {
        $result = Http::post($this->baseurl, [])->body();

        return \response()->json([$result]);
    }

    public function getUsers(Request $request)
    {
        $limit = $request->limit;
        $offset = $request->offset;
        $data = Http::get($this->baseurl . "/user/" . $limit . "/" . $offset)->json();
        $count = Http::get($this->baseurl . "/all-user-count")->json();
        $visible_pages = 10;
        return \response()->json([
            "data" => $data,
            "limit" => $limit,
            "offset" => $offset,
            "total_pages" => \ceil($count / $visible_pages)
        ], \http_response_code());
    }
}