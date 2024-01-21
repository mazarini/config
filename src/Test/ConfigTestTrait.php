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

namespace Mazarini\Config\Test;

use Mazarini\Config\Config\ConfigInterface;

trait ConfigTestTrait
{
    public function getConfig(): ConfigInterface
    {
        $config = $this->getContainer()->get(ConfigInterface::class);
        if ($config instanceof ConfigInterface) {
            return $config;
        }
        throw new \LogicException(sprintf('Container don\'t contain "%s"', ConfigInterface::class));
    }

    /**
     * setConfig.
     *
     * @param array<string,mixed> $data
     */
    public function setConfig(array $data): static
    {
        $config = $this->getConfig();
        (new \ReflectionClass($config::class))
            ->getProperty('configData')
            ->setValue($config, array_merge($config->getData(), $data))
        ;

        return $this;
    }
}
