<?php

use Carbon\CarbonImmutable;
use spkm\Topdesk\Query\Filter;
use spkm\Topdesk\Query\Operator;
use spkm\Topdesk\Query\Query;

enum ExampleFilterStatus: string
{
    case FirstLine = 'firstLine';
}

enum ExampleFilterLevel: int
{
    case High = 3;
}

it('writes a plain value as it is, and quotes one with spaces or FIQL\'s own characters in it', function () {
    expect(Filter::value('Service Desk'))->toBe('"Service Desk"')
        ->and(Filter::value('SMITHJ'))->toBe('SMITHJ')
        ->and(Filter::value('a1b2c3d4-0000-4e5f-8a9b-1234567890ab'))->toBe('a1b2c3d4-0000-4e5f-8a9b-1234567890ab')
        ->and(Filter::value('jo@example.test'))->toBe('jo@example.test')
        ->and(Filter::value('Lab*'))->toBe('Lab*')
        ->and(Filter::value('a;b'))->toBe('"a;b"')
        ->and(Filter::value('(x)'))->toBe('"(x)"')
        ->and(Filter::value('say "hi"'))->toBe('"say \"hi\""')
        ->and(Filter::value("it's"))->toBe('"it\'s"')
        ->and(Filter::value('C:\\Lab'))->toBe('"C:\\\\Lab"')
        ->and(Filter::value('a,b'))->toBe('"a,b"')
        ->and(Filter::value('x==y'))->toBe('"x==y"')
        ->and(Filter::value(''))->toBe('""');
});

it('writes numbers, booleans and null as they are', function () {
    expect(Filter::value(5))->toBe('5')
        ->and(Filter::value(1.5))->toBe('1.5')
        ->and(Filter::value(true))->toBe('true')
        ->and(Filter::value(false))->toBe('false')
        ->and(Filter::value(null))->toBe('null');
});

it('writes an enum by its value, a date in UTC as TOPdesk compares them, and a Stringable as text', function () {
    $stringable = new class implements Stringable
    {
        public function __toString(): string
        {
            return 'Lab A';
        }
    };

    expect(Filter::value(ExampleFilterStatus::FirstLine))->toBe('firstLine')
        ->and(Filter::value(ExampleFilterLevel::High))->toBe('3')
        ->and(Filter::value(CarbonImmutable::parse('2026-01-02T03:04:05+01:00')))->toBe('2026-01-02T02:04:05Z')
        ->and(Filter::value($stringable))->toBe('"Lab A"');
});

it('refuses a value that has no place in a filter', function (mixed $value) {
    Filter::value($value);
})->with([
    'array' => [[1, 2]],
    'object' => [new stdClass],
])->throws(InvalidArgumentException::class);

it('takes field names with dots for nested fields', function () {
    expect(Filter::field('id'))->toBe('id')
        ->and(Filter::field('operatorGroup.id'))->toBe('operatorGroup.id')
        ->and(Filter::field('optionalFields1.boolean1'))->toBe('optionalFields1.boolean1')
        ->and(Filter::field('serial-number'))->toBe('serial-number')
        ->and(Filter::field('_private_1'))->toBe('_private_1');
});

it('refuses a field name that could change the filter', function (string $field) {
    Filter::field($field);
})->with([
    'empty' => [''],
    'a quote' => ['name"'],
    'an operator' => ['name==x'],
    'a separator' => ['name;id'],
    'a comma' => ['name,id'],
    'a bracket' => ['name)'],
    'a space' => ['caller name'],
    'a leading dot' => ['.name'],
    'a trailing dot' => ['name.'],
    'a leading digit' => ['1name'],
])->throws(InvalidArgumentException::class);

it('reads the operators FIQL and Eloquent write', function (string $written, Operator $operator) {
    expect(Operator::fromString($written))->toBe($operator);
})->with([
    ['=', Operator::Equal], ['==', Operator::Equal], ['=eq=', Operator::Equal],
    ['!=', Operator::NotEqual], ['<>', Operator::NotEqual], ['=ne=', Operator::NotEqual],
    ['<', Operator::LessThan], ['=lt=', Operator::LessThan],
    ['<=', Operator::LessOrEqual], ['=le=', Operator::LessOrEqual],
    ['>', Operator::GreaterThan], ['=gt=', Operator::GreaterThan],
    ['>=', Operator::GreaterOrEqual], ['=ge=', Operator::GreaterOrEqual],
    ['in', Operator::In], ['=in=', Operator::In], [' IN ', Operator::In],
    ['not in', Operator::NotIn], ['=out=', Operator::NotIn],
    ['=sw=', Operator::StartsWith], ['starts with', Operator::StartsWith],
    ['=phone=', Operator::Phone],
]);

it('writes each operator as TOPdesk reads it', function () {
    expect(array_map(fn (Operator $operator) => $operator->value, Operator::cases()))
        ->toBe(['==', '!=', '=lt=', '=le=', '=gt=', '=ge=', '=in=', '=out=', '=sw=', '=phone=']);
});

it('refuses an operator TOPdesk does not take', function () {
    Operator::fromString('like');
})->throws(InvalidArgumentException::class, '"like" is not an operator');

it('knows which operators take a list', function () {
    expect(Operator::In->takesList())->toBeTrue()
        ->and(Operator::NotIn->takesList())->toBeTrue()
        ->and(Operator::Equal->takesList())->toBeFalse()
        ->and(Operator::GreaterThan->takesList())->toBeFalse();
});

it('writes a list comparison with its values in brackets, and a single value as a list of one', function () {
    expect(Filter::comparison('id', Operator::In, [1, 2, 3]))->toBe('id=in=(1,2,3)')
        ->and(Filter::comparison('processingStatus.name', Operator::NotIn, ['Closed', 'On hold']))->toBe('processingStatus.name=out=(Closed,"On hold")')
        ->and(Filter::comparison('id', Operator::In, 7))->toBe('id=in=(7)')
        ->and(Filter::comparison('id', Operator::In, new ArrayIterator([4, 5])))->toBe('id=in=(4,5)');
});

it('refuses a list comparison without values', function () {
    Filter::comparison('id', Operator::In, []);
})->throws(InvalidArgumentException::class, 'needs at least one value');

it('compares with null for a field that is empty or not', function () {
    expect(Filter::make()->where('operator', '=', null)->toString())->toBe('operator==null')
        ->and(Filter::make()->where('operator', '!=', null)->toString())->toBe('operator!=null');
});

it('joins comparisons with ; for AND and , for OR', function () {
    $filter = Filter::make()->where('operatorGroup.id', '==', 'abc')->where('closed', '==', false);

    expect($filter->toString())->toBe('operatorGroup.id==abc;closed==false')
        ->and((string) Filter::make()->where('number', '=', 1)->or('number==2', 'number==3'))->toBe('number==1,number==2,number==3');
});

it('brackets a group that joins differently from its parent', function () {
    $either = Filter::make()->where('number', '=', 1)->or(Filter::make()->where('number', '=', 2));
    $filter = Filter::make()->where('closed', '=', false)->and($either);

    expect($filter->toString())->toBe('closed==false;(number==1,number==2)')
        ->and(Filter::make()->where('a', '=', 1)->where('b', '=', 2)->or('c==3')->toString())->toBe('(a==1;b==2),c==3');
});

it('ignores empty parts and is empty until given one', function () {
    $filter = Filter::make()->and('', Filter::make())->or(Filter::make());

    expect($filter->isEmpty())->toBeTrue()
        ->and($filter->toString())->toBe('')
        ->and(Filter::make()->and(Filter::make()->where('id', '=', 1))->toString())->toBe('id==1');
});

it('is immutable', function () {
    $base = Filter::make()->where('id', '=', 1);
    $base->where('id', '=', 2);
    $base->or('id==3');

    expect($base->toString())->toBe('id==1');
});

it('gives the query parameters an endpoint reads, under the names it takes', function () {
    $query = Query::make()
        ->with('dateFormat', 'iso8601')
        ->where('closed', '=', false)
        ->select(['id', 'number', 'caller'])
        ->orderBy('callDate')
        ->orderBy('number', 'DESC')
        ->offset(20)
        ->limit(10);

    expect($query->toArray())->toBe([
        'dateFormat' => 'iso8601',
        'query' => 'closed==false',
        'fields' => 'id,number,caller',
        'sort' => 'callDate:asc,number:desc',
        'pageStart' => 20,
        'pageSize' => 10,
    ])
        ->and($query->toArray(filter: 'query', fields: '$fields', sort: null, offset: 'start', size: 'page_size'))->toBe([
            'dateFormat' => 'iso8601',
            'query' => 'closed==false',
            '$fields' => 'id,number,caller',
            'start' => 20,
            'page_size' => 10,
        ])
        ->and($query->getSort())->toBe(['callDate:asc', 'number:desc'])
        ->and($query->getFields())->toBe(['id', 'number', 'caller'])
        ->and($query->getOffset())->toBe(20)
        ->and($query->getLimit())->toBe(10);
});

it('leaves out what was not asked for', function () {
    expect(Query::make()->toArray())->toBe([])
        ->and(Query::make()->offset(10)->limit(10)->withoutPaging()->toArray())->toBe([]);
});

it('refuses a negative offset, a limit below one, an unknown sort direction and a bad field', function (Closure $build) {
    $build();
})->with([
    'negative offset' => [fn () => Query::make()->offset(-1)],
    'zero limit' => [fn () => Query::make()->limit(0)],
    'sideways sort' => [fn () => Query::make()->orderBy('id', 'sideways')],
    'bad sort field' => [fn () => Query::make()->orderBy('id;drop')],
    'bad selected field' => [fn () => Query::make()->select(['id,caller'])],
])->throws(InvalidArgumentException::class);

it('reads as a plain query string', function () {
    $query = Query::make()->where('operatorGroup.name', '=', 'Service Desk')->limit(5);

    expect((string) $query)->toBe('query=operatorGroup.name=="Service Desk"&pageSize=5');
});

it('builds a new query each time rather than changing the one it was given', function () {
    $base = Query::make();
    $base->where('id', '=', 1);
    $base->orderBy('id');
    $base->offset(1);
    $base->select(['id']);

    expect($base->toArray())->toBe([]);
});
