<?php

use Closure;
use Illuminate\Contracts\Routing\TerminableMiddleware;
use Illuminate\Support\Facades\Log;

class LogAfterRequest implements TerminableMiddleware {

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $logFile = 'log.txt';
        Log::useDailyFiles(storage_path().'/logs/'.$logFile);
        Log::info('app.requests', ['request' => $request->all(), 'response' => $response->getContent()]);
    }

}
