<?php

declare(strict_types=1);

use Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(
    TestCase::class,
    LazilyRefreshDatabase::class,
)->in('Feature');

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});