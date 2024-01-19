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

namespace App\Tests\ConfigurationPager;

use App\Config\Config;
use App\Config\ConfigTrait;
use Mazarini\Config\Config\ConfigInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValueTest extends KernelTestCase
{
    use ConfigTrait;

    public function testConfigExists(): void
    {
        $config = $this->getContainer()->get(Config::class);
        $this->assertNotNull($config, sprintf('Class "%s" not found in container', Config::class));
        $this->assertInstanceOf(Config::class, $config, sprintf('Bad config class "%s" in container', Config::class));
    }

    /**
     * testConfigValue.
     *
     * Verify each value of config
     *
     * @dataProvider valueProvider
     */
    public function testConfigValue(mixed $method, mixed $value): void
    {
        $this->assertSame($this->$method(), $value);
    }

    /**
     * valueProvider.
     *
     * @return array<array<mixed>>
     */
    public function valueProvider(): array
    {
        return [
            ['getTypeString', 'modified'],
            ['getTypeInt', 123],
            ['getTypeBool', true],
        ];
    }

    public function getConfig(): ConfigInterface
    {
        $config = $this->getContainer()->get(Config::class);
        if ($config instanceof ConfigInterface) {
            return $config;
        }
        throw new \LogicException('Never occurs');
    }
}
