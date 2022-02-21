<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use function back;
use function is_null;
use function redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data, $to = null)
    {
        $data = [
            'status' => 'success',
            'data' => $data,
        ];
        if (request()->wantsJson()) return response()->json($data);
        if (!is_null($to)) return redirect($to)->with($data);
        return back()->with($data);
    }

    public function failure($data = null, $to = null)
    {
        $data = [
            'status' => 'failed',
            'data' => $data,
        ];
        if (request()->wantsJson()) return response()->json($data);
        if (!is_null($to)) return redirect($to)->with($data);
        return back()->with($data);
    }
}
