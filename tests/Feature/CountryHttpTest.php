<?php

it('should list countries', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->getJson(
        uri: route(
            name: 'api.country',
            parameters: [],
        ),
    );

    $response->assertOk();
});
