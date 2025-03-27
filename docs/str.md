<h1 style="font-size: 50px; text-align: center;">Str Class</h1>

## Table of Contents
1. [Overview](#overview)
2. [after](#after)
3. [ascii](#ascii)
4. [base64Encode](#base64encode)
5. [base64Decode](#base64decode)
6. [before](#before)
7. [between](#between)
8. [camel](#camel)
9. [chunk](#chunk)
10. [compare](#compare)
11. [contains](#contains)
12. [crc32](#crc32)
13. [endsWith](#endswith)
14. [excerpt](#excerpt)
15. [finish](#finish)
16. [headline](#headline)
17. [isAscii](#isascii)
18. [isEmpty](#isempty)
19. [isJson](#isjson)
20. [isUuid](#isuuid)
21. [kebab](#kebab)
22. [lastPosition](#lastposition)
23. [lcfirst](#lcfirst)
24. [length](#length)
25. [levenshtein](#levenshtein)
26. [limit](#limit)
27. [lower](#lower)
28. [mask](#mask)
29. [md5](#md5)
30. [numberFormat](#numberformat)
31. [padLeft](#padleft)
32. [padRight](#padright)
33. [pascal](#pascal)
34. [plural](#plural)
35. [position](#position)
36. [random](#random)
37. [repeat](#repeat)
38. [replace](#replace)
39. [replaceArray](#replacearray)
40. [replaceFirst](#replacefirst)
41. [replaceLast](#replacelast)
42. [replaceMultiple](#replacemultiple)
43. [reverse](#reverse)
44. [sha1](#sha1)
45. [shuffle](#shuffle)
46. [similarity](#similarity)
47. [snake](#snake)
48. [slug](#slug)
49. [squish](#squish)
50. [startsWith](#startswith)
51. [stripWhitespace](#stripwhitespace)
52. [studly](#studly)
53. [substr](#substr)
54. [substrCount](#substrcount)
55. [swapKeyValue](#swapkeyvalue)
56. [title](#title)
57. [toArray](#toarray)
58. [ucfirst](#ucfirst)
59. [ucwords](#ucwords)
60. [upper](#upper)
61. [uuid](#uuid)
62. [wordCount](#wordcount)
63. [words](#words)
64. [wrap](#wrap)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Overview of the Str utility class providing various methods for string manipulation and checks.
<br>

## 2. after <a id="after"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`after(string $subject, string $search): string`

Returns the portion of the string after the first occurrence of a given substring.
```php
Str::after('hello world', 'hello'); // ' world'
```
<br>

## 3. ascii <a id="ascii"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`ascii(string $value): string`

Converts a string to its ASCII representation.
```php
Str::ascii('ü'); // 'u'
```
<br>

## 4. base64Encode <a id="base64encode"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`base64Encode(string $value): string`

Encodes a string using base64.
```php
Str::base64Encode('hello'); // 'aGVsbG8='
```
<br>

## 5. base64Decode <a id="base64decode"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`base64Decode(string $value): string`

Decodes a base64 encoded string.
```php
Str::base64Decode('aGVsbG8='); // 'hello'
```
<br>

## 6. before <a id="before"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`before(string $subject, string $search): string`

Returns the portion of the string before the first occurrence of a given substring.
```php
Str::before('hello world', 'world'); // 'hello '
```
<br>

## 7. between <a id="between"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`between(string $value, string $start, string $end): string`

Returns the substring between two substrings.
```php
Str::between('[a] b [c]', '[', ']'); // 'a'
```
<br>

## 8. camel <a id="camel"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`camel(string $value): string`

Converts a string to camelCase.
```php
Str::camel('hello_world'); // 'helloWorld'
```
<br>

## 9. chunk <a id="chunk"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`chunk(string $value, int $length = 1): array`

Splits a string into chunks.
```php
Str::chunk('hello', 2); // ['he', 'll', 'o']
```
<br>

## 10. compare <a id="compare"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`compare(string $string1, string $string2): int`

Compares two strings.
```php
Str::compare('abc', 'abc'); // 0
Str::compare('abc', 'xyz'); // negative integer
```
<br>

## 11. contains <a id="contains"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`contains(string $haystack, string $needle): bool`

Determines if a string contains a given substring.
```php
Str::contains('hello world', 'world'); // true
```
<br>

## 12. crc32 <a id="crc32"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`crc32(string $value): int`

Calculates the CRC32 hash of a string.
```php
Str::crc32('hello'); // e.g., 907060870
```
<br>

## 13. endsWith <a id="endswith"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`endsWith(string $haystack, string $needle): bool`

Checks if a string ends with a given substring.
```php
Str::endsWith('hello world', 'world'); // true
```
<br>

## 14. excerpt <a id="excerpt"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`excerpt(string $text, string $phrase, int $radius = 100): string`

Creates an excerpt around a phrase.
```php
Str::excerpt('This is a long sentence.', 'long', 5); // 'is a long sente'
```
<br>

## 15. finish <a id="finish"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`finish(string $value, string $cap): string`

Ensures a string ends with a given value.
```php
Str::finish('hello', '!'); // 'hello!'
```
<br>

## 16. headline <a id="headline"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`headline(string $value): string`

Converts a string to headline case.
```php
Str::headline('hello_world'); // 'Hello World'
```
<br>

## 17. isAscii <a id="isascii"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`isAscii(string $value): bool`

Checks if the string contains only ASCII characters.
```php
Str::isAscii('abc'); // true
Str::isAscii('ü'); // false
```
<br>

## 18. isEmpty <a id="isempty"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`isEmpty(string $value): bool`

Determines if a string is empty.
```php
Str::isEmpty(''); // true
Str::isEmpty(' '); // true
```
<br>

## 19. isJson <a id="isjson"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`isJson(string $value): bool`

Checks if a string is valid JSON.
```php
Str::isJson('{"key":"value"}'); // true
```
<br>

## 20. isUuid <a id="isuuid"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`isUuid(string $value): bool`

Determines if the given string is a valid UUID.
```php
Str::isUuid('550e8400-e29b-41d4-a716-446655440000'); // true
```
<br>

## 21.kebab <a id="kebab"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`kebab(string $value): string`  

Converts a string to kebab-case.
```php
Str::kebab('Hello World'); // 'hello-world'
```
<br>

## 22. lastPosition <a id="lastposition"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`lastPosition(string $haystack, string $needle): int|false`

Finds the position of the last occurrence of a substring.
```php
Str::lastPosition('Hello World', 'o'); // 7
```
<br>

## 23. lcfirst <a id="lcfirst"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`lcfirst(string $value): string`

Converts the first character of a string to lowercase.
```php
Str::lcfirst('Hello'); // 'hello'
```
<br>

## 24. length <a id="length"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`length(string $value): int`

Returns the length of a string.
```php
Str::length('Hello'); // 5
```
<br>

## 25. levenshtein <a id="levenshtein"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`levenshtein(string $string1, string $string2): int`

Calculates the Levenshtein distance between two strings.
```php
Str::levenshtein('kitten', 'sitting'); // 3
```
<br>

## 26. limit <a id="limit"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`limit(string $value, int $limit = 100, string $end = '...'): string`

Limits the number of characters in a string.
```php
Str::limit('Hello World', 5); // 'Hello...'
```
<br>

## 27. lower <a id="lower"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`lower(string $value): string`

Converts a string to lowercase.
```php
Str::lower('Hello'); // 'hello'
```
<br>

## 28. mask <a id="mask"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`mask(string $string, string $character = '*', int $start = 0, ?int $length = null): string`

Masks portions of a string with a given character.
```php
Str::mask('1234567890', '*', 2, 5); // '12*****890'
```
<br>

## 29. md5 <a id="md5"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`md5(string $value): string`

Generates the MD5 hash of a string.
```php
Str::md5('hello'); // '5d41402abc4b2a76b9719d911017c592'
```
<br>

## 30. numberFormat <a id="numberformat"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`numberFormat(float $number, int $decimals = 0, string $decimalSeparator = '.', string $thousandSeparator = ','): string`

Formats a number with grouped thousands.
```php
Str::numberFormat(12345.678, 2); // '12,345.68'
```
<br>

## 31. padLeft <a id="padleft"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`padLeft(string $value, int $length, string $pad = ' '): string`

Pads the left side of a string to a specified length with a given character.
```php
Str::padLeft('hello', 8, '_'); // '___hello'
```
<br>

## 32. padRight <a id="padright"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`padRight(string $value, int $length, string $pad = ' '): string`

Pads the right side of a string to a specified length with a given character.
```php
Str::padRight('Hello', 10, '-'); // 'Hello-----'
```
<br>

## 33. pascal <a id="pascal"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`pascal(string $value): string`

Converts a string to PascalCase.
```php
Str::pascal('hello world'); // 'HelloWorld'
```
<br>

## 34. plural <a id="plural"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`plural(string $word, int $count = 2): string`

Pluralizes a given word based on the count.
```php
Str::plural('apple', 1); // 'apple'
Str::plural('apple', 2); // 'apples'
```
<br>

## 35. position <a id="position"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`position(string $haystack, string $needle): int|false`

Finds the position of the first occurrence of a substring.
```php
Str::position('Hello World', 'World'); // 6
```
<br>

## 36. random <a id="random"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`random(int $length = 16): string`

Generates a random string of specified length.
```php
Str::random(8); // e.g., '4f9d2c8a'
```
<br>

## 37. repeat <a id="repeat"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`repeat(string $value, int $times): string`

Repeats a given string a specified number of times.
```php
Str::repeat('abc', 3); // 'abcabcabc'
```
<br>

## 38. replace <a id="replace"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`replace(string|array $search, string|array $replace, string $subject): string`

Replaces all occurrences of the search string(s) with the given replacement(s) in the subject string.
```php
Str::replace('apple', 'orange', 'apple pie'); 
// 'orange pie'

Str::replace(['a', 'e'], ['A', 'E'], 'banana'); 
// 'bAnAnA'
```
<br>

## 39. replaceArray <a id="replacearray"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`replaceArray(string $search, array $replace, string $subject): string`

Sequentially replaces placeholders with values from an array.
```php
Str::replaceArray('?', ['one', 'two'], '? ?'); // 'one two'
```
<br>

## 40. replaceFirst <a id="replacefirst"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`replaceFirst(string $search, string $replace, string $subject): string`

Replaces the first occurrence of a substring.
```php
Str::replaceFirst('cat', 'dog', 'cat cat'); // 'cat dog'
```
<br>

## 41. replaceLast <a id="replacelast"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`replaceLast(string $search, string $replace, string $subject): string`

Replaces the last occurrence of a substring.
```php
Str::replaceLast('apple', 'orange', 'apple pie, apple pie'); // 'apple pie, orange pie'
```
<br>

## 42. replaceMultiple <a id="replacemultiple"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`replaceMultiple(array $replacements, string $subject): string`

Replaces multiple substrings simultaneously.
```php
Str::replaceMultiple(['cat' => 'dog', 'blue' => 'red'], 'cat and dog'); // 'cat dog'
```
<br>

## 43. reverse <a id="reverse"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`reverse(string $value): string`

Reverses the given string.
```php
Str::reverse('hello'); // 'olleh'
```
<br>

## 44. sha1 <a id="sha1"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`sha1(string $value): string`

Returns the SHA1 hash of a string.
```php
Str::sha1('hello'); // 'f7ff9e8b7bb2e09b70935d20b8a76a62cbd30d2f'
```
<br>

## 45. shuffle <a id="shuffle"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`shuffle(string $value): string`

Randomly shuffles the characters in a string.
```php
Str::shuffle('hello'); // e.g., 'eholl'
```
<br>

## 46. similarity <a id="similarity"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`similarity(string $string1, string $string2): int`

Calculates similarity percentage between two strings.
```php
Str::similarity('hello', 'hallo'); // e.g., 80
```
<br>

## 47. snake <a id="snake"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`snake(string $value, string $delimiter = '_'): string`

Converts a string to snake_case.
```php
Str::snake('Hello World'); // 'hello_world'
```
<br>

## 48. slug <a id="slug"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`slug(string $title, string $separator = '-'): string`

Creates a URL-friendly slug from a given string.
```php
Str::slug('Hello World!'); // 'hello-world'
```
<br>

## 49. squish <a id="squish"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`squish(string $value): string`

Removes excessive whitespace from a string.
```php
Str::squish('  Hello    World  '); // 'Hello World'
```
<br>

## 50. startsWith <a id="startswith"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`startsWith(string $haystack, string $needle): bool`

Determines if a string starts with a given substring.
```php
Str::startsWith('Hello World', 'Hello'); // true
```
<br>

## 51. stripWhitespace <a id="stripwhitespace"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`stripWhitespace(string $value): string`

Removes all whitespace from a given string.
```php
Str::stripWhitespace('Hello World'); // 'HelloWorld'
```
<br>

## 52. studly <a id="studly"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`studly(string $value): string`

Converts a string to StudlyCase (PascalCase).
```php
Str::studly('hello_world'); // 'HelloWorld'
```
<br>

## 53. substr <a id="substr"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`substr(string $value, int $start, ?int $length = null): string`

Extracts a substring from a given string.
```php
Str::substr('Hello World', 0, 5); // 'Hello'
```
<br>

## 54. substrCount <a id="substrcount"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`substrCount(string $haystack, string $needle): int`

Counts the number of occurrences of a substring within a string.
```php
Str::substrCount('apple pie apple', 'apple'); // 2
```
<br>

## 55. swapKeyValue <a id="swapkeyvalue"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`swapKeyValue(array $array): string`

Swaps keys with values in an array and returns a formatted string.
```php
Str::swapKeyValue(['a' => 1, 'b' => 2]); // '1 => a, 2 => b'
```
<br>

## 56. title <a id="title"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`title(string $value): string`

Converts a string to title case.
```php
Str::title('hello world'); // 'Hello World'
```
<br>

## 57. toArray <a id="toarray"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`toArray(string $value): array`

Splits a string into an array of characters.
```php
Str::toArray('Hello'); // ['H', 'e', 'l', 'l', 'o']
```
<br>

## 58. ucfirst <a id="ucfirst"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`ucfirst(string $value): string`

Capitalizes the first character of a string.
```php
Str::ucfirst('hello'); // 'Hello'
```
<br>

## 59. ucwords <a id="ucwords"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`ucwords(string $value): string`
Capitalizes the first letter of each word in the string, preserving the original casing of other characters.
```php
Str::ucwords('hello world');         // 'Hello World'
Str::ucwords('hELLO tHeRE frIEnd');  // 'HELLO THeRE FrIEnd'
```
<br>

## 60. upper <a id="upper"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`upper(string $value): string`

Converts a string to uppercase.
```php
Str::upper('hello'); // 'HELLO'
```
<br>

## 61. uuid <a id="uuid"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`uuid(): string`

Generates a UUID (Universally Unique Identifier).
```php
Str::uuid(); // '550e8400-e29b-41d4-a716-446655440000'
```
<br>

## 62. wordCount <a id="wordcount"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`wordCount(string $value): int`

Counts the number of words in a string.
```php
Str::wordCount('Hello world'); // 2
```
<br>

## 63. words <a id="words"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`words(string $value, int $words = 10, string $end = '...'): string`

Limits a string to a certain number of words.
```php
Str::words('Hello world of PHP', 2); // 'Hello world...'
```
<br>

## 64. wrap <a id="wrap"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
`wrap(string $value, string $wrapWith): string`

Wraps a string with a given value.
```php
Str::wrap('hello', '*'); // '*hello*'
```