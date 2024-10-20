<?php 

namespace App\Traits;

trait ApiResponse{
 public function success(string $message, array $dataArray=[], $statusCode=200){
  $response = [
   'message' => $message,
  ];
  foreach ($dataArray as $key => $value) {
   if($key && $value){
    $response[$key] = $value;
   }
  }
  return response()->json($response, $statusCode);
 }

 public function error($message, $statusCode=400){
  return response()->json([
   'message' => $message
  ], $statusCode);
 }
}