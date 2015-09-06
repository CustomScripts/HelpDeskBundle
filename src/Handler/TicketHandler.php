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

use CS\HelpDeskBundle\Form\Type\TicketCreateType;
use CS\HelpDeskBundle\Manager\TicketManager;
use CS\HelpDeskBundle\Model\Ticket;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class TicketHandler implements HandlerInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var TicketManager
     */
    private $manager;

    /**
     * Ticket constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param TicketManager        $manager
     */
    public function __construct(FormFactoryInterface $formFactory, TicketManager $manager)
    {
        $this->formFactory = $formFactory;
        $this->manager = $manager;
    }

    /**
     * @param Request|null $request
     * @param Ticket       $ticket
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function handle(Request $request = null, $ticket = null)
    {
        $form = $this->formFactory->create(new TicketCreateType(), $ticket);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->manager->save($ticket);
        }

        return $form;
    }
}
