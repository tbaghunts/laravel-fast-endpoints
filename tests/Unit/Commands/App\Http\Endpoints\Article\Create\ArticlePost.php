<?php

namespace App\Http\Endpoints\Article\Create;

use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoint\Attributes{Name,
Route,
Can,
Guest,
Throttle,
Middleware,
WithoutThrottle,
WithoutMiddleware,
WithTrashed,
ScopeBindings,
WhereUuid,
WhereUlid,
WhereAlpha,
WhereNumber,
WhereAlphaNumeric};
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Illuminate\Http\Request;
use App\Response\ImportantResponse;

/**
 * Handle the incoming request for the endpoint with path "/articles."
 *
 * @class ArticlePost
 * @param Request $request
 * @return ImportantResponse
 */
#[Name('create.article')]
#[Route('/articles', EnumEndpointMethod::GET, EnumEndpointMethod::HEAD)]
#[Can('create-article', 'delete-article')]
#[Guest]
#[Throttle(5,1)]
#[Middleware('api:auth', 'web')]
#[WithoutThrottle(5,1)]
#[WithoutMiddleware('web')]
#[WithTrashed]
#[ScopeBindings]
#[WhereUuid('guid','uuid')]
#[WhereUlid('token','transaction_key')]
#[WhereAlpha('name','surname')]
#[WhereNumber('id','age')]
#[WhereAlphaNumeric('login','nickname')]
class ArticlePost extends Endpoint
{
    public function __invoke(Request $request): ImportantResponse
    {
        return new ImportantResponse($request->safe());
    }
}
