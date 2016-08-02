<?php
/**
 * Copyright 2016 Alexandru Guzinschi <alex@gentle.ro>.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */
namespace Gentle\Embeddable\Date;

use Gentle\Embeddable\EmbeddableInterface;

/**
 * @author Alexandru Guzinschi <alex@gentle.ro>
 */
final class Year implements EmbeddableInterface
{
    /** @var string */
    private $value;

    /**
     * @param string|int $year
     *
     * @throws \InvalidArgumentException
     * @throws \LengthException
     */
    public function __construct($year)
    {
        if (is_int($year)) {
            $year = (string)$year;
        }

        if (!is_string($year) || !ctype_digit($year)) {
            throw new \InvalidArgumentException(sprintf('Expected string or integer and got %s', gettype($year)));
        }

        if (4 !== mb_strlen($year)) {
            throw new \LengthException('Expected a full numeric representation of a year.');
        }

        $this->value = $year;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(EmbeddableInterface $object)
    {
        return get_class($object) === 'Gentle\Embeddable\Date\Year' && $this->value === (string)$object;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
}
