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

namespace Drift\Mysql\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class MysqlConfiguration.
 */
class MysqlConfiguration extends BaseConfiguration
{
    /**
     * Configure the root node.
     *
     * @param ArrayNodeDefinition $rootNode Root node
     */
    protected function setupTree(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('connections')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('host')
                                ->isRequired()
                            ->end()
                            ->integerNode('port')
                                ->defaultValue(3306)
                            ->end()
                            ->scalarNode('database')
                                ->isRequired()
                            ->end()

                            ->scalarNode('user')
                                ->isRequired()
                            ->end()

                            ->scalarNode('password')
                                ->isRequired()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
