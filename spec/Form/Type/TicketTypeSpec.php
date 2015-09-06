<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\CS\HelpDeskBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TicketTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CS\HelpDeskBundle\Form\Type\TicketType');
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function it_builds_the_form(FormBuilderInterface $builder)
    {
        $builder
            ->add('title', null, ['constraints' => [new NotBlank(), new Length(['max' => '125'])]])
            ->shouldBeCalled();

        $builder
            ->add('description', 'textarea')
            ->shouldBeCalled();

        $this->buildForm($builder, []);
    }

    function it_configures_the_form(OptionsResolver $optionsResolver)
    {
        $optionsResolver
            ->setDefaults([
                'data_class' => 'CS\HelpDeskBundle\Model\Ticket',
            ])
            ->shouldBeCalled();

        $this->setDefaultOptions($optionsResolver);
    }
}
