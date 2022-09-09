<?php

declare(strict_types=1);

namespace Prezent\DompdfBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Bundle configuration
 *
 * @author Terry Duivesteijn <terry@loungeroom.nl>
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('prezent_dompdf');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
            ->scalarNode('config_location')
            ->end()
        ;

        return $treeBuilder;
    }
}
