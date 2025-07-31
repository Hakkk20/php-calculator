<?php 

namespace App\Model;

class Calculator {
    public function calculate(string $numericalOperation) : float|int {

        $safe = $this->isSafe($numericalOperation);

        if (!$safe) {
            throw new \InvalidArgumentException("Nieprawidłowe znaki w działaniu.");
        }

        $tokens = $this->parseString($numericalOperation);
        
        return $this->reversePolishNotation($tokens);
    }

    private function isSafe(string $possiblyUnsafeString) : bool {

        if (!preg_match('/^[0-9\+\-\*\/\.\(\) ]+$/', $possiblyUnsafeString)) {
            return false;
        } else {
            return true;
        }

    }

    private function parseString(string $stringToParse): array {
    preg_match_all('/\d+(\.\d+)?|[\+\-\*\/\(\)]/', str_replace(' ', '', $stringToParse), $matches);
    return $matches[0]; //preg-match z uwagi na parsowanie licz wielocyfrowych - trim i strng replace powoduje nie działanie licz wielocyfrowych
    }

    private function reversePolishNotation(array $tokens): float|int
    {
        return $this->evaluateToPostfix(
            $this->parseToPostfix($tokens)
        );
    }

    private function parseToPostfix(array $tokens) : array {

         $postFix = [];
        $stack = [];

        $precedence = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2,
    ];

        foreach ($tokens as $token) {
            
            if (is_float($token) || is_numeric($token)) {
                array_push($postFix, $token);
            } else if ($token === "(") {
                array_push($stack, $token);
            } else if ($token === ")") {
                while (!empty($stack) && end($stack) !== '(') {
                $postFix[] = array_pop($stack);
            }
            array_pop($stack);
            } elseif (isset($precedence[$token])) {
               while (
                !empty($stack) &&
                isset($precedence[end($stack)]) &&
                $precedence[end($stack)] >= $precedence[$token]
            ) {
                $postFix[] = array_pop($stack);
            }
            $stack[] = $token;
            }
        }

        while (!empty($stack)) {
        $postFix[] = array_pop($stack);
    } 

        return $postFix;
    }

    private function evaluateToPostfix(array $postFix) : int|float {

        $precedence = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2,
    ];

        $evaluation = [];

        foreach ($postFix as $element) {
            if (is_float($element) || is_numeric($element)) {
                array_push($evaluation, $element);
            } else if (isset($precedence[$element])) {
                $first_char = array_pop($evaluation);
                $second_char = array_pop($evaluation);

                switch ($element) {
                    case '+':
                        $result = $second_char + $first_char;
                        break;
                    case '-':
                        $result = $second_char - $first_char;
                        break;
                    case '*':
                        $result = $second_char * $first_char;
                        break;
                    case '/':
                        if ($first_char == 0) {
                            throw new \InvalidArgumentException("Dzielenie przez zero.");
                        }
                        $result = $second_char / $first_char;
                        break;
                    default:
                        throw new \Exception("Nieznany operator: $element");
                }

                array_push($evaluation, $result);
            }
        }

        return array_pop($evaluation);
    }
}
?>
