<?php

namespace App\Utils;

use App\Exceptions\IllegalArgumentException;
use BadMethodCallException;
use ReflectionClass;
use UnexpectedValueException;

use function array_key_exists;

abstract class BaseEnum
{
    private static $constCacheArray = null;
    private $value;

    public function __construct($value)
    {
        if ($value instanceof static) {
            $value = $value->getValue();
        }
        if (!self::isValidValue($value)) {
            throw new UnexpectedValueException("Value '$value' is not part of the enum " . static::class);
        }
        $this->value = $value;
    }

    public static function __callStatic($name, $arguments)
    {
        if (!self::isValidName($name)) {
            throw  new IllegalArgumentException('e');
        }
        $array = self::getConstants();
        if (isset($array[$name]) || array_key_exists($name, $array)) {
            return new static($array[$name]);
        }
        throw new BadMethodCallException("No static method or enum constant '$name' in class " . static::class);
    }

    public static function getConstants()
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();
        if ($strict) {
            return array_key_exists($name, $constants);
        }
        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
