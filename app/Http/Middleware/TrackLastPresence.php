<?php

namespace App\Http\Middleware;

use App\Models\Concerns\TracksLastPresence;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLastPresence
{
    /** @param  \Closure(Request): (Response)  $next */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && in_array(TracksLastPresence::class, class_uses($user), true)) {
            \Illuminate\Support\defer(function () use ($user): void {
                $user->markAsActive();
            });
        }

        return $next($request);
    }
}
