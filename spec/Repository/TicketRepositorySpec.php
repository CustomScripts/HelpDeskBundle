<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\CS\HelpDeskBundle\Repository;

use CS\HelpDeskBundle\Entity\Ticket;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Doctrine\ORM\Mapping\ClassMetadata;

class TicketRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CS\HelpDeskBundle\Repository\TicketRepository');
        $this->shouldImplement('Doctrine\Common\Persistence\ObjectRepository');
    }

    function let(EntityManager $em, ClassMetadata $metadata)
    {
        $this->beConstructedWith($em, $metadata);
    }

    function it_saves_a_ticket($em)
    {
        $ticket = new Ticket();

        $this->save($ticket)->shouldReturn(true);

        $em->persist($ticket)->shouldHaveBeenCalled();
        $em->flush()->shouldHaveBeenCalled();
    }
}
