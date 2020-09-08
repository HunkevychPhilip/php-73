<?php

use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{
    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     */
    public function testIntegerKey()
    {
        $arr = [];
        $arr[] = 'a';
        $arr[] = 'b';
        $arr[] = 'c';

        // Which index will have 'c'?
        $this->assertEquals(2, array_key_last($arr));

        $arr[10] = 'd';
        $arr[] = 'e';

        // Which index will have 'e'?
        $this->assertEquals(11, array_key_last($arr));

        $arr['string'] = 'f';
        $arr[] = 'h';

        // Which index will have 'h'?
        $this->assertEquals(12, array_key_last($arr));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     */
    public function testKeyCasting()
    {
        $arr = [];
        $arr[] = 'a';
        $arr["1"] = 'b';
        $arr["01"] = 'c';
        $arr[true] = 'd';
        $arr[0.5] = 'e';
        $arr[false] = 'f';
        $arr[null] = 'g';

        // Which keys will have $arr
        $this->assertEquals([0, 1, '01', ''], array_keys($arr));

        // Which values will have $arr
        $this->assertEquals(['f', 'd', 'c', 'g'], array_values($arr));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     * @see https://www.php.net/manual/en/language.operators.array.php
     * @see https://www.php.net/manual/en/function.array-merge.php
     * @see https://www.php.net/manual/en/function.array-replace.php
     */
    public function testArraysOperations()
    {
        // Union
        $arr1 = ['a', 'b'];
        $arr2 = ['c', 'd', 'e', 'key' => 'value'];
        $this->assertEquals(['a', 'b', 'e', 'key' => 'value'], $arr1 + $arr2);

        // array_merge — Merge one or more arrays
        $arr1 = ['a', 'b', 'key1' => 'value1', 'key2' => 'value2'];
        $arr2 = [1, 'key1' => 'value3', 'key3' => 'value4'];
        $this->assertEquals(['a', 'b', 'key1' => 'value3', 'key2' => 'value2', 1, 'key3' => 'value4'], array_merge($arr1, $arr2));

        // array_replace — Replaces elements from passed arrays into the first array
        $arr1 = ['a', 'b', 'key1' => 'value1', 'key2' => 'value2'];
        $arr2 = [1, 'key1' => 'value3', 'key3' => 'value4'];
        $this->assertEquals([1, 'b', 'key1' => 'value3', 'key2' => 'value2', 'key3' => 'value4'], array_replace($arr1, $arr2));
    }

    /**
     * Uncomment assertions and Replace `?` in asserts with the correct value
     * @see https://www.php.net/manual/en/book.array.php
     */
    public function testArrayFunctions()
    {
        // list - Assign variables as if they were an array
        list( ,, list($var)) = ['a', 'b', ['c', 'd']];
        $this->assertEquals('c', $var);

        // implode — Join array elements with a string
        $var = implode([1, 2, 3, 4]);
        $this->assertEquals('1234', $var);

        // sizeof — Alias of count
        // TODO to be implemented
        $arr = [1, 2, 3, 4, 'five'];
        $this->assertEquals(5, count($arr));

        // unset — Unset a given variable
        $arr = [1, 2, 3, 4];
        unset($arr[0]);
        $this->assertEquals([1, 2, 3], array_keys($arr));

        // isset — Determine if a variable is declared and is different than NULL
        $arr = [1, 2, 'key' => 'value', null];
        $this->assertEquals(1, isset($arr[0]));
        $this->assertEquals(1, isset($arr['key']));
        $this->assertEquals(0, isset($arr[2]));

        // array_key_exists — Checks if the given key or index exists in the array
        $arr = [1, 2, 'key' => 'value', null];
        $this->assertEquals(1, array_key_exists(0, $arr));
        $this->assertEquals(1, array_key_exists('key', $arr));
        $this->assertEquals(1, array_key_exists(2, $arr));

        // in_array — Checks if a value exists in an array
        // TODO to be implemented
        $arr = ['boom'];
        $this->assertEquals(1, in_array('boom', $arr));

        // array_flip — Exchanges all keys with their associated values in an array
        // TODO to be implemented
        $arr = ['one', 'two', 'three'];
        $this->assertEquals(['one' => 0, 'two' => 1, 'three' => 2], array_flip($arr));

        // array_reverse — Return an array with elements in reverse order
        // TODO to be implemented
        $arr = [1, 2, 3];
        $this->assertEquals([3, 2, 1], array_reverse($arr));

        // array_keys — Return all the keys or a subset of the keys of an array
        // TODO to be implemented
        $arr = [87, 56, 65, 23, 'foo' => null];
        $this->assertEquals([0, 1, 2, 3, 'foo'], array_keys($arr));

        // array_values — Return all the values of an array
        // TODO to be implemented
        $arr = [87, 56, 65, 23, 'foo' => null];
        $this->assertEquals([87, 56, 65, 23, null], array_values($arr));

        // array_filter — Filters elements of an array using a callback function
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; //[0 => 1, 2 => 3, 3 => 5, 4=> 7, 5=> 9]
        $this->assertEquals([0 => 1, 2 => 3, 4 => 5, 6 => 7, 8 => 9], array_filter($arr, function ($value) {
            return $value % 2 > 0;
        }));

        // array_map — Applies the callback to the elements of the given arrays
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $this->assertEquals([2, 4, 6 ,8 ,10, 12, 14, 16, 18, 20], array_map(function ($value) {
            return $value * 2;
        }, $arr));

        // sort — Sort an array
        // TODO to be implemented
        $arr = [15, 328, 21, 3529, 35, 659];
        $this->assertEquals(1, sort($arr));
        $this->assertEquals([15, 21, 35, 328, 659, 3529], array_values($arr)); //checking sort function

        // rsort — Sort an array in reverse order
        // TODO to be implemented
        $this->assertEquals(1, rsort($arr));
        $this->assertEquals([3529, 659, 328, 35, 21, 15], array_values($arr)); //checking rsort function

        // ksort — Sort an array by key
        // TODO to be implemented
        $arr = [0 => 15, 1 => 328, 4 => 21, 7 => 3529, 10 =>35,2 => 659];
        $this->assertEquals(1, ksort($arr));
        $this->assertEquals([0, 1, 2, 4, 7, 10], array_keys($arr)); //checking ksort function


        // usort — Sort an array by values using a user-defined comparison function
        // TODO to be implemented
        $arr = [1, 3, 6, 2, 4, 7, 10, 8];
        $this->assertEquals(1, usort($arr, function (int $a, int $b) { return ($a <=> $b); }));
        $this->assertEquals([1, 2, 3, 4, 6, 7, 8, 10], array_values($arr)); //checking usort function

        // array_push — Push one or more elements onto the end of array
        // array_pop — Pop the element off the end of array
        // array_shift — Shift an element off the beginning of array
        // array_unshift — Prepend one or more elements to the beginning of an array
        // TODO to be implemented
        $arr = [1, 2, 3, 4, 5];
        $this->assertEquals(7, array_push($arr, 'softserve', 'epam')); //now there are 7 items
        $this->assertEquals('epam', array_pop($arr)); //now there are 6 items
        $this->assertEquals(1, array_shift($arr)); //now there are 5 items
        $this->assertEquals(6, array_unshift($arr, 'another')); //again 6
    }
}
