<?php
/**
 * Shared service provider for Acne.
 *
 * @author Yuya Takeyama
 */
class Acne_SharedServiceProvider
{
    /**
     * Service provider.
     *
     * @var callable
     */
    private $provider;

    private $value;

    public function __construct($provider)
    {
        if (!Acne_Util::isServiceProvider($provider)) {
            throw new InvalidArgumentException('Service provider should be callable but string.');
        }
        $this->provider = $provider;
    }

    public function call($c)
    {
        if (!isset($this->value)) {
            $this->value = call_user_func($this->provider, $c);
        }
        return $this->value;
    }
}
