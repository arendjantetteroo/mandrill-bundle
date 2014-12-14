<?php

namespace Shareworks\Bundle\MandrillBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Bundle configuration.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $config = $builder->root('shareworks_mandrill')->children();
        $config->scalarNode('api_key')->isRequired()->cannotBeEmpty();

        return $builder;
    }
}
