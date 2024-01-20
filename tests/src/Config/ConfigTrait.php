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

trait ConfigTrait
{
    public function getTypeString(): string
    {
        return (string) $this->getConfig()->getValue('type.string');
    }

    public function getTypeInt(): int
    {
        return (int) $this->getConfig()->getValue('type.int');
    }

    public function getTypeBool(): bool
    {
        return (bool) $this->getConfig()->getValue('type.bool');
    }
}
