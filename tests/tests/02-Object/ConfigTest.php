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
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ConfigTest extends KernelTestCase
{
    /**
     * @var array<mixed>
     */
    private array $configData = [
        'groupe_1' => [
            'data_1' => 'A',
            'data_2' => 'B',
        ],
        'groupe_2' => [
            'data_1' => 'C',
            'data_2' => 'D',
        ],
        'type' => [
            'bool' => true,
            'string' => '1',
            'int' => 2,
        ],
    ];

    private Config $config;

    protected function setup(): void
    {
        $this->config = new Config($this->configData);
    }

    public function testGetConfig(): void
    {
        $this->assertSame($this->config, $this->config->getConfig());
    }

    /**
     * testArray1.
     */
    public function testArray1(): void
    {
        $this->testArraySame($this->config->getData(), $this->configData);
    }

    /**
     * testArray2.
     */
    public function testArray2(): void
    {
        $this->testArraySame($this->configData, $this->config->getData());
    }

    /**
     * testGetArray.
     */
    public function testGetArray(): void
    {
        $this->AssertTrue($this->config->getArray('type')['bool']);
    }

    public function testBadKey(): void
    {
        $this->expectException(\LogicException::class);
        $this->config->getArray('KO');
    }

    public function testBadTypeArray(): void
    {
        $this->expectException(\LogicException::class);
        $this->config->getArray('type.bool');
    }

    public function testBadTypeValue(): void
    {
        $this->expectException(\LogicException::class);
        $this->config->getValue('type');
    }

    /**
     * testArraySame.
     *
     * @param array<mixed> $a1
     * @param array<mixed> $a2
     */
    protected function testArraySame(array $a1, array $a2): void
    {
        foreach ($a1 as $key => $val1) {
            $this->assertArrayHasKey($key, $a2);
            $val2 = $a2[$key];
            if (\is_array($val1) && \is_array($val2)) {
                $this->testArraySame($val1, $val2);

                return;
            }
            $this->assertSame($val1, $val2);
        }
    }
}
