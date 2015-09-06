<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CS\HelpDeskBundle\Event;

use CS\HelpDeskBundle\Model\Ticket;
use Symfony\Component\EventDispatcher\Event;

final class TicketEvent extends Event
{
    const PRE_CREATE = 'ticket.pre_create';
    const POST_CREATE = 'ticket.post_create';
    const PRE_UPDATE = 'ticket.pre_update';
    const POST_UPDATE = 'ticket.post_update';

    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * TicketEvent constructor.
     *
     * @param Ticket|null $ticket
     */
    public function __construct(Ticket $ticket = null)
    {
        $this->ticket = $ticket;
    }

    /**
     * @param Ticket $ticket
     *
     * @return TicketEvent
     */
    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
