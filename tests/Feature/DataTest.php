<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use spkm\Topdesk\Tests\Fixtures\ExampleChild;
use spkm\Topdesk\Tests\Fixtures\ExampleData;
use spkm\Topdesk\Tests\Fixtures\ExampleRequiredData;

it('casts TOPdesk\'s values to the types of the model\'s properties', function () {
    $model = ExampleData::from(['id' => 61, 'name' => 'iPad 1', 'count' => '12', 'ratio' => '1.5', 'managed' => 'true', 'tags' => ['a', 'b']]);

    expect($model->id)->toBe('61')
        ->and($model->name)->toBe('iPad 1')
        ->and($model->count)->toBe(12)
        ->and($model->ratio)->toBe(1.5)
        ->and($model->managed)->toBeTrue()
        ->and($model->tags)->toBe(['a', 'b']);
});

it('leaves out a value that cannot be cast', function () {
    $model = ExampleData::from(['count' => 'many', 'ratio' => 'half', 'managed' => 'perhaps', 'name' => ['not' => 'text'], 'tags' => 'a']);

    expect($model->count)->toBeNull()
        ->and($model->ratio)->toBeNull()
        ->and($model->managed)->toBeNull()
        ->and($model->name)->toBeNull()
        ->and($model->tags)->toBeNull();
});

it('builds nested models and lists of models', function () {
    $model = ExampleData::from(['general' => ['name' => 'Lab', 'size' => '3'], 'children' => [['name' => 'a'], ['name' => 'b', 'size' => 2]]]);

    expect($model->general)->toBeInstanceOf(ExampleChild::class)
        ->and($model->general->size)->toBe(3)
        ->and($model->children)->toBeInstanceOf(Collection::class)
        ->and($model->children)->toHaveCount(2)
        ->and($model->children->every(fn ($child) => $child instanceof ExampleChild))->toBeTrue()
        ->and($model->children[1]->size)->toBe(2);
});

it('reads and writes a field whose name is not a PHP identifier under its alias', function () {
    $model = ExampleData::from(['asset-tag' => 'A123']);

    expect($model->assetTag)->toBe('A123')
        ->and($model->toArray())->toBe(['asset-tag' => 'A123'])
        ->and($model->extra)->toBe([]);
});

it('keeps fields the model has no property for and sends them back at the top level', function () {
    $model = ExampleData::from(['id' => '1', 'newField' => ['x' => 1], 'other' => 'kept']);

    expect($model->extra)->toBe(['newField' => ['x' => 1], 'other' => 'kept'])
        ->and($model->toArray())->toBe(['newField' => ['x' => 1], 'other' => 'kept', 'id' => '1']);
});

it('prefers a declared property to a field of the same name in extra', function () {
    $model = new ExampleData(id: '2', extra: ['id' => '1', 'other' => 'x']);

    expect($model->toArray())->toBe(['id' => '2', 'other' => 'x']);
});

it('leaves secrets out of toArray() and JSON unless asked for them', function () {
    $model = ExampleData::from(['name' => 'admin', 'password' => 'hunter2']);

    expect($model->password)->toBe('hunter2')
        ->and($model->toArray())->toBe(['name' => 'admin'])
        ->and(json_encode($model))->toBe('{"name":"admin"}')
        ->and($model->toArray(true))->toBe(['name' => 'admin', 'password' => 'hunter2'])
        ->and(ExampleData::hidden())->toBe(['password']);
});

it('leaves out what is null', function () {
    expect(ExampleData::from(['id' => '1', 'name' => null])->toArray())->toBe(['id' => '1'])
        ->and(ExampleData::from([])->toArray())->toBe([]);
});

it('reads dates as TOPdesk writes them and sends them back as TOPdesk reads them, in UTC', function (mixed $value, string $expected) {
    $model = ExampleData::from(['lastContact' => $value]);

    expect($model->lastContact)->toBeInstanceOf(CarbonImmutable::class)
        ->and($model->toArray()['lastContact'])->toBe($expected);
})->with([
    'TOPdesk\'s own form' => ['2026-02-15T23:03:19.954+0000', '2026-02-15T23:03:19.954+0000'],
    'TOPdesk\'s own form with an offset, sent back in UTC' => ['2026-06-15T09:30:00.000+0100', '2026-06-15T08:30:00.000+0000'],
    'ISO 8601 with a Z' => ['2026-02-15T23:03:19Z', '2026-02-15T23:03:19.000+0000'],
    'ISO 8601 with an offset' => ['2026-02-15T23:03:19+01:00', '2026-02-15T22:03:19.000+0000'],
    'a date alone' => ['2026-02-15', '2026-02-15T00:00:00.000+0000'],
    'milliseconds' => [1771196599954, '2026-02-15T23:03:19.954+0000'],
    'seconds' => [1771196599, '2026-02-15T23:03:19.000+0000'],
]);

it('reads no date from zero, an empty string, or something that is not a date', function (mixed $value) {
    expect(ExampleData::from(['lastContact' => $value])->lastContact)->toBeNull();
})->with([[0], [''], ['   '], ['not a date'], [['an' => 'array']]]);

it('builds a collection of models', function () {
    $models = ExampleData::collect([['id' => '1'], ['id' => '2']]);

    expect($models)->toBeInstanceOf(Collection::class)
        ->and($models->pluck('id')->all())->toBe(['1', '2'])
        ->and(ExampleData::collect(null))->toHaveCount(0);
});

it('serialises nested models and lists of models', function () {
    $model = ExampleData::from(['general' => ['name' => 'Lab'], 'children' => [['name' => 'a', 'extraThing' => 1]]]);

    expect($model->toArray())->toBe(['general' => ['name' => 'Lab'], 'children' => [['extraThing' => 1, 'name' => 'a']]]);
});

it('says which value a model cannot be built without', function () {
    ExampleRequiredData::from(['name' => 'x']);
})->throws(InvalidArgumentException::class, 'ExampleRequiredData needs a value for "id".');

it('keeps no extra fields when the model says not to', function () {
    expect(ExampleRequiredData::from(['id' => '1', 'other' => 'x'])->toArray())->toBe(['id' => '1']);
});
