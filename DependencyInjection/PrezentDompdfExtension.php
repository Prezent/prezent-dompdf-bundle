<?php

declare(strict_types=1);

namespace Prezent\DompdfBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Load the bundle configuration
 *
 * @author Terry Duivesteijn <terry@loungeroom.nl>
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
final class PrezentDompdfExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (isset($config['config_location'])) {
            $container->setParameter('prezent_dompdf.config_location', $config['config_location']);
        }

    }

    public function getAlias(): string
    {
        return 'prezent_dompdf';
    }
}
