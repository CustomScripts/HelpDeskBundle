<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\CS\HelpDeskBundle\Handler;

use CS\HelpDeskBundle\Entity\Ticket;
use CS\HelpDeskBundle\Form\Type\TicketType;
use CS\HelpDeskBundle\Manager\TicketManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class TicketHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CS\HelpDeskBundle\Handler\TicketHandler');
        $this->shouldImplement('CS\HelpDeskBundle\Handler\HandlerInterface');
    }

    function let(FormFactoryInterface $factory, TicketManager $manager)
    {
        $factory->create(new TicketType())->willReturn('Symfony\Component\Form\FormInterface');

        $this->beConstructedWith($factory, $manager);
    }

    function it_creates_a_new_form(FormInterface $form, $factory)
    {
        $factory->create(new TicketType(), null)->willReturn($form);

        $form->handleRequest(null)->shouldBeCalled();
        $form->isValid()->shouldBeCalled();

        $this->handle()->shouldReturn($form);
    }

    function it_creates_a_form_with_an_existing_entity(FormInterface $form, $factory)
    {
        $entity = new Ticket();

        $factory->create(new TicketType(), $entity)->willReturn($form);

        $form->handleRequest(null)->shouldBeCalled();
        $form->isValid()->shouldBeCalled();

        $this->handle(null, $entity)->shouldReturn($form);
    }

    function it_saves_the_ticket(FormInterface $form, $factory, $manager)
    {
        $entity = new Ticket();

        $factory->create(new TicketType(), $entity)->willReturn($form);

        $form->handleRequest(null)->shouldBeCalled();
        $form->isValid()->shouldBeCalled()->willReturn(true);

        $this->handle(null, $entity)->shouldReturn($form);

        $manager->save($entity)->shouldHaveBeenCalled();
    }
}
