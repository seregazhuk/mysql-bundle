<?php

/*
 * This file is part of the Drift Http Kernel
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

declare(strict_types=1);

namespace Drift\Mysql\Tests;

use Drift\Mysql\MysqlBundle;
use Mmoreram\BaseBundle\Kernel\DriftBaseKernel;
use Mmoreram\BaseBundle\Tests\BaseFunctionalTest;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\MySQL\ConnectionInterface;
use React\MySQL\Io\LazyConnection;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class ConfigurationTest.
 */
class ConfigurationTest extends BaseFunctionalTest
{
    /**
     * Get kernel.
     *
     * @return KernelInterface
     */
    protected static function getKernel(): KernelInterface
    {
        return new DriftBaseKernel([
            FrameworkBundle::class,
            MysqlBundle::class,
        ], [
            'parameters' => [
                'kernel.secret' => 'sdhjshjkds',
            ],
            'framework' => [
                'test' => true,
            ],
            'imports' => [
                ['resource' => dirname(__FILE__).'/clients.yml'],
            ],
            'services' => [
                'reactphp.event_loop' => [
                    'class' => LoopInterface::class,
                    'factory' => [
                        Factory::class,
                        'create',
                    ],
                ],
            ],
            'mysql' => [
                'connections' => [
                    'users' => [
                        'host' => '127.0.0.1',
                        'user' => 'user',
                        'password' => '1234',
                        'database' => 'lol',
                    ],
                ],
            ],
        ]);
    }

    /**
     * Test.
     */
    public function testProperConnection()
    {
        $connection = static::get('mysql.users_connection.test');
        $this->assertInstanceOf(ConnectionInterface::class, $connection);
        $this->assertInstanceOf(LazyConnection::class, $connection);
    }
}
