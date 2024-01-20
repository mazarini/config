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

namespace Mazarini\Config\Config;

class Config implements ConfigInterface
{
    /**
     * @var array<string,mixed>
     */
    protected array $configData;

    /**
     * __construct.
     *
     * @param array<string,mixed> $configData
     *
     * @return void
     */
    public function __construct(array $configData = [])
    {
        $this->configData = array_merge($this->configData, $configData);
    }

    public function getConfig(): static
    {
        return $this;
    }

    /**
     * getData.
     *
     * @return array<string,mixed>
     */
    public function getData(): array
    {
        return $this->getConfig()->configData;
    }

    /**
     * getNode.
     */
    private function getNode(string $concatkeys): mixed
    {
        $keys = explode('.', $concatkeys);
        $array = $this->configData;
        foreach ($keys as $key) {
            if (\is_array($array) && isset($array[$key])) {
                $array = $array[$key];
            } else {
                throw new \LogicException('Wrong key : $config["'.$concatkeys.'"]');
            }
        }

        return $array;
    }

    /**
     * getArray.
     *
     * @return array<mixed>
     */
    public function getArray(string $key): array
    {
        $array = $this->getNode($key);
        if (\is_array($array)) {
            return $array;
        }
        throw new \LogicException('Wrong type : $config['.$key.'"]');
    }

    /**
     * getValue.
     *
     * @return scalar
     */
    public function getValue(string $key): bool|int|float|string
    {
        $value = $this->getNode($key);
        if (\is_scalar($value)) {
            return $value;
        }
        throw new \LogicException('Wrong type : $config["'.$key.'"]');
    }
}
