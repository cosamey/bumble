<?php

test('can see home page', function (): void {
    $response = $this->get(route('home'));

    $response->assertOk();
});
