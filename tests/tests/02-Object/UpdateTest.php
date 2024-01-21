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

use Mazarini\Config\Test\ConfigTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UpdateTest extends KernelTestCase
{
    use ConfigTestTrait;

    public function testModifiyConfig(): void
    {
        $this->setConfig([
            'type' => [
                'string' => 'set',
            ],
        ]);
        $this->assertSame('set', $this->getConfig()->getValue('type.string'));
    }
}
