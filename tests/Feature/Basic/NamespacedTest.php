<?php

namespace Tests\Feature\Basic;

use Tests\Feature\TestCase;

class NamespacedTest extends TestCase
{
    protected function getFastEndpointsConfig(): array
    {
        return [
          'namespaces' => [
              'Tests\Feature\Dist\Basic' => [
                  'throttles' => [
                      [
                          'requests' => 1,
                          'perMinute' => 1,
                      ]
                  ]
              ]
          ]
        ];
    }


    public function test_namespaceConfigShouldNotBeAppliedToRequestMethodsEndpoints()
    {
        $this->get('/test/get')
            ->assertStatus(200);
        $this->post('/test/post')
            ->assertStatus(200);
        $this->delete('/test/delete')
            ->assertStatus(200);
    }

    public function test_namespaceConfigShouldBeAppliedToBasicEndpoints()
    {
        $this->get('/test/basic/defaults/')
            ->assertStatus(200);
        $this->get('/test/basic/echo')
            ->assertTooManyRequests();

        $this->travel(2)->minute();

        $this->get('/test/basic/echo')
            ->assertStatus(200);
        $this->get('/test/basic/defaults')
            ->assertTooManyRequests();
    }

}