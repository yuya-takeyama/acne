<?php
/**
 * Container for Acne.
 *
 * Simple DI container for PHP < 5.2
 *
 * @author Yuya Takeyama
 */
class Acne_Container implements ArrayAccess
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
        $value = $this->values[$key];
        return Acne::isServiceProvider($value) ? call_user_func($value, $this) : $value;
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

    /**
     * Sets shared service provider.
     *
     * @param  callable $provider
     * @throws InvalidArgumentException
     */
    public function share()
    {
        $argCount = func_num_args();
        if ($argCount === 1) {
            $provider = func_get_arg(0);
            return array(new Acne_SharedServiceProvider($provider), 'call');
        } else if ($argCount === 2) {
            $key = func_get_arg(0);
            $provider = func_get_arg(1);
            $this[$key] = $this->share($provider);
        } else {
            throw new InvalidArgumentException(__METHOD__ . ' expects 1 or 2 arguments.');
        }
    }
}
