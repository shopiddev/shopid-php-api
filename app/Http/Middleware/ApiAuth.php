<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;

class ApiAuth implements AuthenticatesRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
	protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
	
    public function handle($request, Closure $next)
    {
		
        $this->authenticate($request);

        return $next($request);
		
		
    }
	
	protected function authenticate($request)
    {

            if ($this->auth->guard("api")->check()) {
                return $this->auth->shouldUse("api");
            }
			
			$this->unauthenticated($request, array("api"));

    }
	
	
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            '401', $guards, $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //
    }
	
}
