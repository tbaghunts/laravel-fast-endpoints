<?php

namespace Tests\Unit\Commands;

class MakeEndpointCommandTest extends TestCase
{
    public function test_execCommand()
    {
        $this->artisan('make:fast-endpoint', [
            'path' => '/articles',

            '--defaults' => 'id,1',
            '--name' => 'create.article',
//            '--dist' => 'Article\\Create\\ArticlePost',

            '--with-request' => true,
            '--response' => 'App\\Response\\ImportantResponse',

            '--get' => true,

            '--guest' => true,
            '--throttle' => '5,1',
            '--without-throttle' => '5,1',
            '--without-middleware' => 'web',
            '--middleware' => 'api:auth, web',
            '--can' => 'create-article,delete-article',

            '--with-trashed' => true,
            '--scope-bindings' => true,

            '--where-number' => 'id,age',
            '--where-uuid' => 'guid,uuid',
            '--where-alpha' => 'name,surname',
            '--where-ulid' => 'token,transaction_key',
            '--where-alpha-numeric' => 'login,nickname',
        ])->assertExitCode(0);
    }

}