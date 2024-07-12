<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse($message = '', $data = [], $status = 200)
    {
        $body =  [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
        return response()->json($body, $status);
    }

    protected function errorResponse($message = '', $code = 400)
    {
        $body =  [
            'status' => 'fail',
            'message' => $message,
            'data' => null,
        ];

        return response()->json($body, $code);
    }

    protected function successResponseWithAlert($message = 'success save data', $targetUrl = null)
    {

        // Alert::success('success', $message);
        if ($targetUrl == null) {
            return redirect()->back();
        }
        return redirect(route($targetUrl));
    }

    protected function errorResponseWithAlert($message = 'success save data', $param = null, $targetUrl = null)
    {
        // Alert::error('Error', $message);
        if ($targetUrl == null) {
            return redirect()->back();
        }
        return redirect(route($targetUrl, $param));
    }


    protected function generateItem($header, $item)
    {
        return [
            'header' => $header,
            'item' => $item
        ];
    }



    protected function successDataTableResponse($draw, $recordsTotal, $recordsFiltered, $data)
    {
        return response()->json([
            'draw' => (int) $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ], 200);
    }


    protected function errorDataTableResponse($messageError = '')
    {
        return response()->json([
            'draw' => 0,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
            'message_error' => $messageError,
        ], 200);
    }
}
