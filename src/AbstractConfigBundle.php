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

namespace Mazarini\Config;

use Mazarini\Config\Config\ConfigInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

abstract class AbstractConfigBundle extends AbstractBundle
{
    private ConfigInterface $defaultConfig;

    abstract protected function loadServices(ServicesConfigurator $services): void;

    /**
     * CreateConfig.
     *
     * @param array<mixed> $configArray
     */
    abstract protected function CreateConfig(array $configArray): ConfigInterface;

    protected function getConfig(): ConfigInterface
    {
        if (!isset($this->defaultConfig)) {
            $this->defaultConfig = $this->CreateConfig([]);
        }

        return $this->defaultConfig;
    }

    /**
     * loadExtension.
     *
     * @param array<mixed> $configArray
     */
    public function loadExtension(array $configArray, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $services = $containerConfigurator->services();
        $this->initExtension($services);
        $this->loadConfig($services, $configArray);
        $this->loadServices($services);
    }

    protected function initExtension(ServicesConfigurator $services): void
    {
        $services
            ->defaults()
            ->autowire()
            ->autoconfigure()
        ;
    }

    /**
     * loadConfig.
     *
     * @param array<mixed> $configArray
     */
    protected function loadConfig(ServicesConfigurator $services, array $configArray): void
    {
        $config = $this->CreateConfig($configArray);
        $services
            ->set($config::class)
            ->arg('$configData', $config->getData())
            ->public()
            ->alias(ConfigInterface::class, $config::class);
    }
}
