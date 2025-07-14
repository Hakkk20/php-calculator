<?php 

namespace App\Controller;

use App\Model;
use App\Model\Calculator;

class CalculatorController {
    private Calculator $calculator;
    public int|float|null $result = null;
    public ?string $error = null;

    public function __construct() {
        $this->calculator = new Calculator();
    }
    
    public function handleRequest() {
        if ($_POST) {
            
            $numericalOperation = isset($_POST['query']) ? $_POST['query'] : null;

            if($numericalOperation !== null) {
                $this->result = $this->calculator->calculate($numericalOperation);
            } else {
            $this->error = "Podane wyrażenie jest nieprawidłowe";
            $this->result = 0;
        }
    
        } 
    }

}

?>