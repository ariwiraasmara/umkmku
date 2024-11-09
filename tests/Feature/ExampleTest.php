<?php
use App\Repositories\userRepository;

test('example', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('test repo user', function () {
    $repo = new userRepository();
    
});
