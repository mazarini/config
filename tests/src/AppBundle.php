<?php

/*
 * Copyright (C) 2024 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/config.
 *
 * mazarini/config is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/config is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App;

use App\Config\Config;
use App\Config\ConfigTrait;
use App\Service\ObjectService;
use Mazarini\Config\Config\ConfigInterface;
use Mazarini\Config\AbstractConfigBundle;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;

class AppBundle extends AbstractConfigBundle
{
    use ConfigTrait;

    protected function loadServices(ServicesConfigurator $services): void
    {
        $services
            ->set(ObjectService::class)
            ->public()
        ;
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->arrayNode('groupe_1')
            ->children()
            ->scalarNode('data_1_1')->defaultValue(null)->end()
            ->scalarNode('data_1_2')->defaultValue(null)->end()
            ->end()
            ->end()
            ->arrayNode('groupe_2')
            ->children()
            ->scalarNode('data-2_1')->defaultValue(null)->end()
            ->scalarNode('data-2_2')->defaultValue(null)->end()
            ->end()
            ->end()
            ->arrayNode('type')
            ->children()
            ->booleanNode('bool')->defaultValue($this->getTypeBool())->end()
            ->scalarNode('string')->defaultValue($this->getTypeString())->end()
            ->integerNode('int')->defaultValue($this->getTypeInt())->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    /**
     * CreateConfig.
     *
     * @param array<mixed> $configArray
     */
    protected function CreateConfig(array $configArray): ConfigInterface
    {
        return new Config($configArray);
    }
}
