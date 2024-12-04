<?php
namespace Modules\Core\Config;

use Exception;

class Validation extends \Config\Validation
{
    /**
     * @throws Exception
     */
    public function getRuleMatch(string $property, string $name): string
    {
        if (! property_exists($this, $property))
        {
            throw new Exception('Property ' . $property . ' does not exist.');
        }
        elseif (! isset($this->{$property}[$name]))
        {
            throw new Exception('Name ' . $name . ' does not exist.');
        }

        $match = '';
        $rule = $this->{$property}[$name];
        if (preg_match('/regex_match\[\/\^?\[(?<match>[^$\/]+)\].?\$?\/\]/', $rule, $matches))
        {
            if (preg_match('/\]\[/', $matches['match']))
            {
                $match = '[' . $matches['match'] . ']';
            }
            else
            {
                $arrRule = [];
                $length = mb_strlen($matches['match']);
                for ($i = 0; $i < $length; $i++)
                {
                    $chr = mb_substr($matches['match'], $i, 1);
                    if (mb_substr($matches['match'], $i + 1, 1) === '-')
                    {
                        $range = mb_substr($matches['match'], $i, 3);
                        if (mb_strlen($range) === 3)
                        {
                            $arrRule[] = $range;
                            $i += 2;
                        }
                        else
                        {
                            $arrRule[] = $chr;
                        }
                    }
                    else
                    {
                        $arrRule[] = $chr;
                    }
                }

                $match = implode(', ', $arrRule);
            }
        }

        if ($match)
        {
            $match = '(' . $match . ')';
        }

        return $match;
    }

    /**
     * @throws Exception
     */
    public function getRuleMaxLength(string $property, string $name): int
    {
        if (! property_exists($this, $property))
        {
            throw new Exception('Property ' . $property . ' does not exist.');
        }
        elseif (! isset($this->{$property}[$name]))
        {
            throw new Exception('Name ' . $name . ' does not exist.');
        }

        $maxLength = 0;
        $rule = $this->{$property}[$name];
        if (preg_match('/max_length\[(?<length>[0-9]+)\]/', $rule, $matches))
        {
            $maxLength = $matches['length'];
        }

        return $maxLength;
    }

    /**
     * @throws Exception
     */
    public function getRuleMinLength(string $property, string $name): int
    {
        if (! property_exists($this, $property))
        {
            throw new Exception('Property ' . $property . ' does not exist.');
        }
        elseif (! isset($this->{$property}[$name]))
        {
            throw new Exception('Name ' . $name . ' does not exist.');
        }

        $minLength = 0;
        $rule = $this->{$property}[$name];
        if (preg_match('/min_length\[(?<length>[0-9]+)\]/', $rule, $matches))
        {
            $minLength = $matches['length'];
        }

        return $minLength;
    }
}
