<?php


namespace App\Helpers;


class Filter
{
    private $value;
    private $parameter;
    private $sign;

    public function __construct($newValue, $newParameter, $newSign)
    {
        $this->value = $newValue;
        $this->parameter = $newParameter;
        switch ($newSign) {
            case 'lte':
                $this->sign = '<';
                break;
            case 'gte':
                $this->sign = '>';
                break;
            default:
                $this->sign = $newSign;
        }
    }

    public function getSign()
    {
        return $this->sign;
    }

    public function getParameter()
    {
        return $this->parameter;
    }

    public function getValue()
    {
        return $this->sign === 'like' ? "%$this->value%": $this->value;
    }
}