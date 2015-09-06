<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CS\HelpDeskBundle\Handler;

use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * This function creates a new form and handles the request, validation and saving of entities for the form.
     *
     * @param Request|null $request
     * @param mixed        $entity
     *
     * @return mixed
     */
    public function handle(Request $request = null, $entity = null);
}
