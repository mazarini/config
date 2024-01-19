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

namespace App\Config;

use Mazarini\Config\Config\Config as Base;
use Mazarini\Config\Config\ConfigInterface;

/**
 * @method getData() array<string,array<string,string|int|bool>>
 */
class Config extends Base implements ConfigInterface
{
    use ConfigTrait;
    /**
     * @var array<string,mixed>
     */
    protected array $configData = [
        'groupe_1' => [
            'data_1' => '1-1',
            'data_2' => '1-2',
        ],
        'groupe_2' => [
            'data_1' => '2-1',
            'data_2' => '2-2',
        ],
        'type' => [
            'string' => 'text',
            'int' => 12,
            'bool' => true,
        ],
    ];
}
