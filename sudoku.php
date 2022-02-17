<?php

function checkAnswer(array $answer)
{
    /**
     * Checking these items:
     * * check the sum on each row
     * * check the sum on each column
     * * check for sum on each box
     * * check for duplicate numbers on each row
     * * check for duplicate numbers on each column
     * * check for duplicate numbers on each box
     */

     // check answer count is valid
    if (count($answer) < 9) {
        die("invalid answer");
    }
    foreach ($answer as $value) {
        if (count($value) < 9) {
            die("invalid answer");
        }
    }

    // check for duplicate numbers on each row
    foreach ($answer as $value) {
        if (count(array_unique($value)) != count($value)) {
            die("wrong");
        }
    }

    // check for duplicate numbers on each column
    for ($i = 0; $i < count($answer); $i++) {
        $perColumn = [];
        foreach ($answer as $value) {
            $perColumn[count($perColumn)] = $value[$i];
        }
        if (count(array_unique($perColumn)) != count($perColumn)) {
            die("wrong");
        }
    }

    // check for sum on each box
    // each box line
    $eachBox1 = []; // line 1,4,7
    $eachBox2 = []; // line 2,5,8
    $eachBox3 = []; // line 3,6,9
    // counters
    $k = -1;
    $b = -1;
    $c = -1;

    foreach ($answer as $key => $value) {
        if ($key % 3 === 0) {
            for ($i = 0; $i < count($value); $i++) {
                if ($i % 3 === 0) {
                    $k++;
                    $eachBox1[$k] = [];
                }
                array_push($eachBox1[$k], $value[$i]);
            }
        } elseif ($key % 2 === 0) {
            for ($i = 0; $i < count($value); $i++) {
                if ($i % 3 === 0) {
                    $b++;
                    $eachBox2[$b] = [];
                }
                array_push($eachBox2[$b], $value[$i]);
            }
        } elseif ($key % 1 === 0) {
            for ($i = 0; $i < count($value); $i++) {
                if ($i % 3 === 0) {
                    $c++;
                    $eachBox3[$c] = [];
                }
                array_push($eachBox3[$c], $value[$i]);
            }
        }
    }

    //merge three arrays together to have each boxes as an array
    $eachBox = array();
    foreach ($eachBox1 as $key => $val) {
        $eachBox[$key] = array($eachBox1[$key], $eachBox3[$key], $eachBox2[$key]);
    }

    //finally check for sum
    foreach ($eachBox as $results) {
        $sum = 0;
        foreach ($results as $result) {
            foreach ($result as $number) {
                $sum += $number;
            }
        }
        if ($sum != 45) {
            die("wrong");
        }
    }

    //check for duplicate numbers on each box

    foreach ($eachBox as $results) {
        $arrayNumbers = [];
        foreach ($results as $result) {
            foreach ($result as $number) {
                if (in_array($number, $arrayNumbers)) {
                    die("wrong");
                } else {
                    array_push($arrayNumbers, $number);
                }
            }
        }
    }

    //check the sum on each row
    foreach ($answer as $numbers) {
        $sum = 0;
        foreach ($numbers as $number) {
            $sum += $number;
        }
        if ($sum != 45) {
            die("wrong");
        }
    }

    //check the sum on each column
    for ($i = 0; $i < count($answer); $i++) {
        $sum = 0;
        foreach ($answer as $value) {
            $sum += $value[$i];
        }
        if ($sum != 45) {
            die("wrong");
        }
    }

    //show message
    echo "everything is OK!";
}

// ? call function (valid answer)

// 1 =>
// checkAnswer([
//     0 => [7, 9, 2, 1, 5, 4, 3, 8, 6],
//     1 => [6, 4, 3, 8, 2, 7, 1, 5, 9],
//     2 => [8, 5, 1, 3, 9, 6, 7, 2, 4],
//     3 => [2, 6, 5, 9, 7, 3, 8, 4, 1],
//     4 => [4, 8, 9, 5, 6, 1, 2, 7, 3],
//     5 => [3, 1, 7, 4, 8, 2, 9, 6, 5],
//     6 => [1, 3, 6, 7, 4, 8, 5, 9, 2],
//     7 => [9, 7, 4, 2, 1, 5, 6, 3, 8],
//     8 => [5, 2, 8, 6, 3, 9, 4, 1, 7],
// ]);

// 2 =>
checkAnswer([
    0 => [5, 3, 4, 6, 7, 8, 9, 1, 2],
    1 => [6, 7, 2, 1, 9, 5, 3, 4, 8],
    2 => [1, 9, 8, 3, 4, 2, 5, 6, 7],
    3 => [8, 5, 9, 7, 6, 1, 4, 2, 3],
    4 => [4, 2, 6, 8, 5, 3, 7, 9, 1],
    5 => [7, 1, 3, 9, 2, 4, 8, 5, 6],
    6 => [9, 6, 1, 5, 3, 7, 2, 8, 4],
    7 => [2, 8, 7, 4, 1, 9, 6, 3, 5],
    8 => [3, 4, 5, 2, 8, 6, 1, 7, 9],
]);

//Mahdi Sanaeifar