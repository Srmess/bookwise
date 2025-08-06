<?php

class Validation
{

    public $validations = [];

    public static function validate($rule, $data)
    {

        $validation = new self;

        foreach ($rule as $field => $fieldRule) {

            foreach ($fieldRule as $rule) {

                $fieldValue = $data[$field];

                if ($rule == 'confirmed') {

                    $validation->$rule($field, $fieldValue, $data["{$field}_confirmation"]);
                } else if (str_contains($rule, ':')) {

                    $temp = explode(':', $rule);

                    $rule = $temp[0];

                    $ruleAr = $temp[1];

                    $validation->$rule($ruleAr, $field, $fieldValue);
                } else {

                    $validation->$rule($field, $fieldValue);
                }
            }
        }

        return $validation;
    }

    private function required($field, $value)
    {

        if (strlen($value) == 0) {

            $this->validations[] = "$field é obrigatório.";
        }
    }

    private function unique($table, $field, $value)
    {
        if (strlen($value) < 0) {
            return;
        }

        $db = new Database(config('database'));

        $validation =  $db->query(query: "select * from $table where $field = :value", params: ['value' => $value])->fetch();


        if ($validation) {
            $this->validations[] = "O $field já está registrado no sistema.";
        }
    }

    private function email($field, $value)
    {

        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {

            $this->validations[] = "O $field é inválido.";
        }
    }

    private function confirmed($field, $value, $confirmationValue)
    {

        if ($value != $confirmationValue) {

            $this->validations[] = "O $field de confirmação está diferente.";
        }
    }

    private function min($min, $field, $value)
    {

        if (strlen($value) <= $min) {

            $this->validations[] = "O $field precisa ter um mínimo de $min caracteres.";
        }
    }

    private function max($max, $field, $value)
    {

        if (strlen($value) > $max) {

            $this->validations[] = "O $field precisa ter um máximo de $max caracteres.";
        }
    }

    private function strong($field, $value)
    {

        if (! strpbrk($value, "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~")) {

            $this->validations[] = "A $field precisa um caractere especial nela.";
        }
    }

    public function isInvalid($key)
    {

        flash()->push($key, $this->validations);

        return sizeof($this->validations) > 0;
    }
}
