<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TransformOutput
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
        /** @var Response $response */
        $response = $next($request);

        $parsedResponse = json_decode($response->getContent(), true);
        $content = is_array($parsedResponse) ?
            json_encode(array_map([$this, 'replaceToCamel'], $parsedResponse)) :
            $parsedResponse;

        $response->setContent($content);

        return $response;
    }

    protected function replaceToCamel($item)
    {
        if (!is_array($item)) {
            return Str::camel($item);
        }
        foreach ($item as $property => $value) {
            $camelCased = Str::camel($property);
            $item[$camelCased] = is_array($value) ? $this->replaceToCamel($value) : $value;
            if ((string)$camelCased !== (string)$property) {
                unset($item[$property]);
            }
        }
        return $item;
    }
}
