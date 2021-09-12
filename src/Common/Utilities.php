<?php


namespace Common;


use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

trait Utilities
{
    /**
     * Format a money value by decimal
     *
     * @param Money $value money value
     * @param bool $int_amount format as integer
     * @param bool $show_currency show currency on format eg: 12.50 USD or 300 BRL
     * @return string formatted value
     */
    protected static function formatByDecimal(Money $value, bool $int_amount = false, bool $show_currency = false): string
    {
        $currencies = new ISOCurrencies();
        $formatter = new DecimalMoneyFormatter($currencies);
        $code = $value->getCurrency()->getCode();

        $result = $int_amount ? $value->getAmount() : $formatter->format($value);

        if ($show_currency)
            $result .= " $code";

        return $result;
    }
    /**
     * Format a float value
     *
     * @param float|int $value value to be formatted
     * @param int $decimals number of decimal places
     * @return string formatted value
     */
    protected static function format(float|int $value, int $decimals = 2): string
    {
        return number_format($value, $decimals, '.', '');
    }

    /**
     * Check if a value is null and return a default value
     *
     * @param mixed $var variable to be checked
     * @param mixed $default default value if $var is null
     * @param callback|null $transform transform function if $var is not null
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
        if (empty($var) || is_null($callback)) {
            return $default;
        }

        return $callback($var);
    }

    /**
     * Recursively remove null values from array
     *
     * @param array $array input array
     * @return array array without null values
     */
    protected static function not_null(array $array): array
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = self::not_null($value);
            }
            if ($value === null || $value === []) {
                unset($array[$key]);
            }
        }

        return array_filter($array, fn ($var) => !is_null($var));
    }

    /**
     * Replace all non digits chars from a string
     *
     * @param string|null $value base string
     * @return string|null new string with only digits
     */
    protected static function digits(?string $value): ?string
    {
        if ($value === null) return null;

        return preg_replace('/[^0-9]/', '', $value);
    }
}