<?php

declare(strict_types=1);

/*
 * This file is part of the Neo4j PHP Client and Driver package.
 *
 * (c) Nagels <https://nagels.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laudis\Neo4j\Enum;

use Bolt\protocol\V3;
use JsonSerializable;
use Laudis\TypedEnum\TypedEnum;

/**
 * Defines the protocol used in a connection.
 *
 * @method static ConnectionProtocol BOLT_V3()
 * @method static ConnectionProtocol BOLT_V40()
 * @method static ConnectionProtocol BOLT_V41()
 * @method static ConnectionProtocol BOLT_V42()
 * @method static ConnectionProtocol BOLT_V43()
 * @method static ConnectionProtocol BOLT_V44()
 * @method static ConnectionProtocol HTTP()
 *
 * @extends TypedEnum<string>
 *
 * @psalm-immutable
 *
 * @psalm-suppress MutableDependency
 */
final class ConnectionProtocol extends TypedEnum implements JsonSerializable
{
    private const BOLT_V3 = '3';
    private const BOLT_V40 = '4';
    private const BOLT_V41 = '4.1';
    private const BOLT_V42 = '4.2';
    private const BOLT_V43 = '4.3';
    private const BOLT_V44 = '4.4';
    private const HTTP = 'http';

    /**
     * @pure
     *
     * @psalm-suppress ImpureMethodCall
     */
    public static function determineBoltVersion(V3 $bolt): self
    {
        $version = self::resolve($bolt->getVersion());

        return $version[0] ?? self::BOLT_V44();
    }

    public function compare(ConnectionProtocol $protocol): int
    {
        $x = 0;
        $y = 0;

        /** @psalm-suppress ImpureMethodCall */
        foreach (array_values(self::getAllInstances()) as $index => $instance) {
            if ($instance === $this) {
                $x = $index;
            }

            if ($instance === $protocol) {
                $y = $index;
            }
        }

        return $x - $y;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): string
    {
        return $this->getValue();
    }
}
