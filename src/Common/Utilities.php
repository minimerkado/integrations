<?php


namespace Common;


trait Utilities
{
    /**
     * Check if a value is null and return a default value
     *
     * @param mixed $var variable to be checked
     * @param mixed $default default value if $var is null
     * @param callback $transform transform function if $var is not null
     * @return mixed transformed value or $default if $var is null
     */
    protected static function optional($var, $transform = null, $default = [])
    {
        return !is_null($var) ? ($transform ?? fn($v) => $v)($var) : $default;
    }

    /**
     * Call a function if value is not null
     *
     * @param mixed|null $var variable to be checked
     * @param callback|null $callback called when value is not null
     * @param mixed|null $default default value
     * @return mixed|null callback return
     */
    protected static function when($var, $callback, $default = null)
    {
        if (is_null($var) || is_null($callback)) {
            return $default;
        }

        return $callback($var);
    }
}