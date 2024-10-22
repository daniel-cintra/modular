<?php

use Tests\TestCase;

uses(TestCase::class);

test("the site's index page returns a successful response", function () {
    $this->withoutVite();
    $response = $this->get('/');
    $response->assertStatus(200);
});
