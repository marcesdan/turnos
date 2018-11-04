<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function notFound()
    {
        return response()->json(['error' => 'Not found'], 404);
    }

    protected function ok()
    {
        response()->json(['success' => 'success'], 200);
    }

    protected function noContent()
    {
        return response()->json([], 204);
    }
}
