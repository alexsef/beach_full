<?php

namespace App\Http\Controllers;

use App\Page;
use DB;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function getGallery() {
        $data = DB::select("SELECT * FROM `api_gallery`");
        $links = [];
        foreach ($data as $d) {
            $links[] = 'http://api.plyazhspb.ru/uploads/'.$d->path;
            $links[] = $d->album_name;
        }
        return response()->json($links);
    }

    public function getPageData(Request $request) {
        $this->validate($request, [
            'page_id' => 'required|integer'
        ]);

        $page = Page::where('page_id', $request->page_id)->first();
        return response()->json([
            'page' => $page
        ]);
    }
}
