<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\CS\HelpDeskBundle\Event;

use CS\HelpDeskBundle\Model\Ticket;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TicketEventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CS\HelpDeskBundle\Event\TicketEvent');
        $this->shouldBeAnInstanceOf('Symfony\Component\EventDispatcher\Event');
    }

    function it_sets_a_ticket(Ticket $ticket)
    {
        $this->setTicket($ticket);

        $this->getTicket()->shouldReturn($ticket);
    }
}
