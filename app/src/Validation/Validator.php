<?php

namespace API\Validation;

abstract class Validator
{
    /** @var array $args */
    protected $args;

    /**
     * Validator constructor.
     *
     * @param array $args
     */
    public function __construct(array $args = null)
    {
        $this->args = $args;
    }

    /**
     * Run validation
     *
     * @return void
     * @throws ValidatorException
     */
    public function validate()
    {
        foreach ($this->args as $key => $val) {
            $ruleMethod = $key . 'Rule';
            if (method_exists($this, $ruleMethod)) {
                $v = $this->$ruleMethod();
                if (isset($v) && !$v->validate($this->args[$key])) {
                    throw new ValidatorException($key . ' failed validation');
                }
            }
        }
    }
}
