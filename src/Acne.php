<?php
/**
 * Acne
 *
 * Simple DI container for PHP < 5.2
 *
 * @author Yuya Takeyama
 */
class Acne implements ArrayAccess
{
    /**
     * @var array
     */
    private $values;

    /**
     * Constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        $this->values = $values;
    }

    /**
     * Sets a value.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * Gets a value.
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function offsetGet($key)
    {
        if (!array_key_exists($key, $this->values)) {
            throw new InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $key));
        }
        return $this->values[$key];
    }

    /**
     * Whether the key exists in the container.
     *
     * @param  string
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->values);
    }

    /**
     * Remove a value with key.
     *
     * @param  string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->values[$key]);
    }
}
