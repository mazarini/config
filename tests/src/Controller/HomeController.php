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

namespace App\Controller;

use App\Config\Config;
use App\Config\ConfigTrait;
use App\Service\ObjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    use configTrait;
    private ObjectService $objectService;

    #[Route('', name: 'app_home')]
    public function index(ObjectService $objectService): JsonResponse
    {
        $this->objectService = $objectService;

        return $this->json([
            'config' => $this->getConfig()->getData(),
            'string' => $this->getTypeString(),
            'int' => $this->getTypeInt(),
            'bool' => $this->getTypeBool(),
        ]);
    }

    protected function getConfig(): Config
    {
        return $this->objectService->getConfig();
    }
}
