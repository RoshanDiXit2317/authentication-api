<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ResponseTrait;
use App\Constants\ResponseConstants;

class ApiController extends Controller
{
    use ResponseTrait;

    public function respondWithNotFound($message = ResponseConstants::NOT_FOUND)
    {
        return $this->errorResponse(message: $message, statusCode: Response::HTTP_NOT_FOUND);
    }

    public function respondWithInternalError($message = ResponseConstants::INTERNAL_SERVER_ERROR)
    {
        return $this->errorResponse(message: $message, statusCode: Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function respondWithUnauthorized($message = ResponseConstants::UNAUTHORIZED)
    {
        return $this->errorResponse(message: $message, statusCode: Response::HTTP_UNAUTHORIZED);
    }

    public function respondWithForbidden($message = ResponseConstants::FORBIDDEN)
    {
        return $this->errorResponse(message: $message, statusCode: Response::HTTP_FORBIDDEN);
    }
}
