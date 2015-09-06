<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\CS\HelpDeskBundle\Manager;

use CS\HelpDeskBundle\Model\Ticket;
use CS\HelpDeskBundle\Repository\TicketRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;

class TicketManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CS\HelpDeskBundle\Manager\TicketManager');
    }

    function let(ObjectManager $doctrine)
    {
        $this->beConstructedWith($doctrine);
    }

    function it_saves_a_new_ticket(Ticket $ticket, TicketRepository $repository, $doctrine)
    {
        $ticket->getId()->shouldBeCalled()->willReturn(null);
        $ticket->setStatus('open')->shouldBeCalled();
        $doctrine->getRepository('CSHelpDeskBundle:Ticket')->shouldBeCalled()->willReturn($repository);
        $repository->save($ticket)->shouldBeCalled();

        $this->save($ticket)->shouldReturn(true);
    }

    function it_returns_all_tickets(TicketRepository $repository, $doctrine)
    {
        $ticket = new \CS\HelpDeskBundle\Entity\Ticket();
        $ticket->setTitle('Ticket Title');
        $ticket->setDescription('Ticket Description');
        $ticket->setStatus('open');

        $tickets = [$ticket];

        $doctrine->getRepository('CSHelpDeskBundle:Ticket')->shouldBeCalled()->willReturn($repository);
        $repository->findBy([], ['status' => 'DESC'], null, null)->shouldBeCalled()->willReturn($tickets);

        $this->findAll()->shouldReturn($tickets);
    }
}
