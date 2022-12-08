<?php

it('can run modular:install command', function () {
    $this->artisan('modular:install')->assertSuccessful();
});

it('can run modular:make-module command', function () {
    $this->artisan('modular:make-module myModuleName')->assertSuccessful();
});
