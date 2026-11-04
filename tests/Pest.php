<?php

use Saloon\Config;
use spkm\Topdesk\Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| Every test boots the package in Testbench with an array cache. No request may reach a real TOPdesk: anything sent
| without a mock client throws a StrayRequestException. Fake TOPdesk with Tests\Helpers\FakeTopdesk.
|
*/

Config::preventStrayRequests();

pest()->extend(TestCase::class)->in('Feature', 'Spec');
