<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CS\HelpDeskBundle\Manager;

use CS\HelpDeskBundle\Model\Ticket;
use CS\HelpDeskBundle\Repository\TicketRepository;
use Doctrine\Common\Persistence\ObjectManager;

class TicketManager
{
    /**
     * @var ObjectManager
     */
    private $doctrine;

    /**
     * TicketManager constructor.
     *
     * @param ObjectManager $doctrine
     */
    public function __construct(ObjectManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param Ticket $ticket
     *
     * @return bool
     */
    public function save(Ticket $ticket)
    {
        /** @var TicketRepository $repository */
        $repository = $this->doctrine->getRepository('CSHelpDeskBundle:Ticket');

        if (!$ticket->getId()) {
            $ticket->setStatus('open');
        }

        $repository->save($ticket);

        return true;
    }
}
