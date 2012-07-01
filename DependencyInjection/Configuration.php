<?php

namespace THemming\HttpCaptureBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $extension = new HttpCaptureExtension();
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($extension->getAlias());

        // The enabled parameters is 0 or 1 in the parameters.ini/config.yml
        // but it will be converted to boolean by the bundle extension.
        // The reason is that the parameters.ini file cannot handle boolean true/false
        $rootNode->children()
            ->scalarNode('enabled')->defaultValue(0)->end()
            ->scalarNode('max_length')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
