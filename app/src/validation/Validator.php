<?php

namespace API\Validation;

abstract class Validator
{
    /** @var array $args */
    protected $args;

    /** @var array $params */
    protected $params = [];

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
        foreach ($this->params as $key => $val) {
            if (!array_key_exists($key, $this->args)) {
                return null;
            }

            $rules = self::getRules($val);

            foreach ($rules as $rule) {
                if ($args = self::extractRuleArgs($rule)) {
                    $v = call_user_func_array("Respect\Validation\Validator::" . $rule, $args);
                } else {
                    $v = call_user_func("Respect\Validation\Validator::" . $rule);
                }

                if (!$v->validate($this->args[$key])) {
                    throw new ValidatorException($key . ' failed ' . $rule . ' validation');
                }
            }
        }
    }

    /**
     * Get rules from param array
     *
     * @param string $rules
     * @return array
     */
    private static function getRules($rules)
    {
        return explode('|', $rules);
    }

    /**
     * Get arguments for rules from param array
     *
     * @param string $rule
     * @return array|null
     */
    private static function extractRuleArgs($rule)
    {
        if (strpos($rule, ':')) {
            return explode(',', str_after($rule, ':'));
        } else {
            return null;
        }
    }
}
