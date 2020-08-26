<?php

namespace App\Http\Middleware;

use Closure;

class checkToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$token = $request->input('token');
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 403);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 403);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent'], 403);
        }

        // add authenticated user to array
        $request->request->add(['user' => $user]); //add request

        return $next($request);
    }
}
