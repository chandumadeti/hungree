<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;

use Exception;
use Request;

class authJWT

{

    public function handle($request, Closure $next)

    {
        ///Try Catch block for exception handling 
        try {
            ///If token is valid get user information by parsing token and authenticating
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            ///Handle invalid token
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                return response()->json(['error'=>'Token is Invalid']);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                ///Handle expired token 
                return response()->json(['error'=>'Token is Expired']);

            }else{

                return response()->json(['error'=>'Something is wrong','request' => $request]);

            }

        }

        return $next($request);

    }

}