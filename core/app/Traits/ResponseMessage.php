<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseMessage
{
  /**
   * Generate success type response.
   *
   * Returns the success data and message if there is any error
   *
   * @param object $data
   * @param string $message
   * @param integer $code
   * @return JsonResponse
   */
  public function responseSuccess($data, $message = "Successful", $code = JsonResponse::HTTP_OK): JsonResponse
  {
    return response()->json([
      'status'  => 'success',
      'message' => $message,
      'errors'  => null,
      'data'    => $data,
    ], $code);
  }

  /**
   * Generate Error response.
   *
   * Returns the errors data if there is any error
   *
   * @param object $errors
   * @return JsonResponse
   */
  public function responseError($errors, $message = 'Data is invalid', $code = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
  {
    return response()->json([
      'status'  => 'error',
      'message' => $message,
      'errors'  => $errors,
      'data'    => null,
    ], $code);
  }
}
