# Preserving test cases when removing the tested classes

## Scenario

There is a class `\App\Example1\Formatter` with a single public method `format(string)`. This
method receives a string, reverses the sequence if its words, and in the resulting set of words appends an increasing
natural number to each word.

For example:

| Input         | Output         
| ------------- |:--------------:|
| a b c         | c1 b2 a3       |
| foo bar baz   | baz1 bar2 foo3 |

This method is unit-tested, see `\App\Example1\Tests\Unit\FormatterTest`. It tests that the method correctly transforms
the text as in the table above:

```php
# FormatterTestCase
self::assertSame('c1 b2 a3', $formatter->format('a b c'));
self::assertSame('baz1 bar2 foo3', $formatter->format('foo bar baz'));
```

We now want to refactor the two actions of the method (word sequence reversal and numbering) into two separate 
services. We do this in namespace `Example2`: we create `WordReverser` and `WordNumberer` services. We unit-test them.

The test cases for `WordReverser`:
```php
# WordReverserTestCase
self::assertSame('c b a', (new WordReverser())->reverseWords('a b c'));
self::assertSame('Carl Bob Ann', (new WordReverser())->reverseWords('Ann Bob Carl'));
```

The test cases for `WordNumberer`:
```php
# WordNumbererTestCase
self::assertSame('a1 b2 c3', (new WordNumberer())->numberWords('a b c'));
self::assertSame('Ann1 Bob2 Carl3', (new WordNumberer())->numberWords('Ann Bob Carl'));
```

## The problem

We refactored the service `Formatter`, we unit-tested the newly created services `WordNumberer` and `WordReverser`. Is
it enough testing? Definitely not. We lost the testing we had in `FormatterTestCase`. There, we ensured that word
sequence reversal and numbering were **both** performed and that they were performed in **the correct order**: first the
ordering, then the numbering. Let's call these *formatting requirements*. Now the responsibility to correctly call
the new services lies with whoever was calling `Formatter` - in our case it is `\App\Example2\Controller`. We need to
keep the `FormatterTestCase` valid even after refactoring.

## Solution 1 - testing the argument to WordNumberer

The solution to ensure that the `formatting requirements` are still followed by `\App\Example2\Controller`, we should 
ensure that `WordNumberer` (the second to be called) is called with the reversed order of words. We do this in 
`\App\Example2\Tests\Unit\ControllerTest::testDisplayText`:
```php
$wordNumberer = self::createMock(WordNumberer::class);
$wordNumberer
    ->expects(self::any())
    ->method('numberWords')
    ->with('there hello') # this ensures that the result of WordReverser is passed to WordNumberer
    ->willReturn('there1 hello2')
;
```

## Solution 2 - an integration test

Integration tests instead of testing how a class performs in isolation, also test how it interacts with its dependencies 
(other classes). In these tests we can catch bugs such as an incorrect order of calls to services - which is exactly
what we need to ensure that the `Controller` adheres to the `formatting requirements`.

We created such an integration test in Example3: `\App\Example3\Tests\Integration\ControllerTest`. The
  test case is as follows:
```php
$controller = new Controller(new WordReverser(), new WordNumberer(), 'hello there');
self::assertSame('there1 hello2', $controller->getDisplayText());
```

Here, we see for certain that the functionality is intact after refactoring, without needing to test for the value of 
the argument to `WordNumberer::numberWords` as we did in Solution 1.

## Final words

I have run into a lot of cases where I removed old methods and/or classes, created new methods and/or classes that were
to be used instead of the old ones, and simply testing the new ones was not enough. By refactoring sometimes you lose
 tests that test the bigger picture/the interaction of classes. Unit testing as in Solution 1 can help, but I much more
prefer to cover the code by integration tests as in Solution 2.
