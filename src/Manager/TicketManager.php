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

use CS\HelpDeskBundle\Event\TicketEvent;
use CS\HelpDeskBundle\Model\Ticket;
use CS\HelpDeskBundle\Repository\TicketRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TicketManager
{
    /**
     * @var ObjectManager
     */
    private $doctrine;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * TicketManager constructor.
     *
     * @param ObjectManager            $doctrine
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(ObjectManager $doctrine, EventDispatcherInterface $dispatcher)
    {
        $this->doctrine = $doctrine;
        $this->dispatcher = $dispatcher;
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

        $eventType = 'update';

        if (!$ticket->getId()) {
            $ticket->setStatus('open');
            $eventType = 'create';
        }

        $this->dispatcher->dispatch(
            constant(sprintf('CS\HelpDeskBundle\Event\TicketEvent::PRE_%s', strtoupper($eventType))),
            new TicketEvent($ticket)
        );

        $repository->save($ticket);

        $this->dispatcher->dispatch(
            constant(sprintf('CS\HelpDeskBundle\Event\TicketEvent::POST_%s', strtoupper($eventType))),
            new TicketEvent($ticket)
        );

        return true;
    }

    /**
     * @param array $orderBy
     * @param int   $limit
     * @param int   $offset
     *
     * @return array
     */
    public function findAll(array $orderBy = ['status' => 'DESC'], $limit = null, $offset = null)
    {
        /** @var TicketRepository $repository */
        $repository = $this->doctrine->getRepository('CSHelpDeskBundle:Ticket');

        return $repository->findBy([], $orderBy, $limit, $offset);
    }
}
