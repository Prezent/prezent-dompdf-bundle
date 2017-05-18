<?php

namespace LoungeRoom\DompdfBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Load the bundle configuration
 *
 * @see Extension
 *
 * @author Terry Duivesteijn <terry@loungeroom.nl>
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class LoungeRoomDompdfExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }

    public function getAlias()
    {
        return 'loungeroom_dompdf';
    }
}
