<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ResponseTrait
{

  protected function nullResponse($statusCode = Response::HTTP_NO_CONTENT)
  {
    return response()->json(null,$statusCode);
  }

  protected function successResponse($data = null, $message =null, $statusCode = Response::HTTP_OK)
  {
    $response['success'] = true;

    ( $message !== null ) ?? $response['message'] = $message;
    ( $data !== null ) ?? $response['data'] = $data;

    return response()->json($response, $statusCode);
  }

  protected function errorResponse($data = null, $message = null, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
  {
    $response['success'] = false;

    ( $message !== null ) ?? $response['message'] = $message;
    ( $data !== null ) ?? $response['data'] = $data;

    return response()->json($response, $statusCode);
  }
}
