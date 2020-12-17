<?php

declare(strict_types=1);

/*
 * This file is part of the Laudis Neo4j package.
 *
 * (c) Laudis technologies <http://laudis.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laudis\Neo4j\Databags;

use Ds\Map;

final class Statement
{
    private string $text;
    /** @var array<string, scalar|iterable|null> */
    private array $parameters;

    /**
     * @param iterable<string, scalar|iterable|null> $parameters
     */
    public function __construct(string $text, iterable $parameters)
    {
        $this->text = $text;
        $this->parameters = (new Map($parameters))->toArray();
    }

    /**
     * @param iterable<string, scalar|iterable|null>|null $parameters
     */
    public static function create(string $text, ?iterable $parameters = null): Statement
    {
        return new self($text, $parameters ?? []);
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return iterable<string, scalar|iterable|null>
     */
    public function getParameters(): iterable
    {
        return $this->parameters;
    }
}
