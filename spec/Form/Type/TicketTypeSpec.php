<?php

namespace spec\CS\HelpDeskBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CS\HelpDeskBundle\Form\Type\TicketType');
    }

    function it_builds_the_form(FormBuilderInterface $builder)
    {
        $builder
            ->add('title')
            ->shouldBeCalled();

        $builder
            ->add('description')
            ->shouldBeCalled();

        $this->buildForm($builder, []);
    }
g
    function it_configures_the_form(OptionsResolver $optionsResolver)
    {
        $optionsResolver
            ->setDefaults([
                'entity_class' => 'CS\HelpDeskBundle\Model\Ticket',
            ])
            ->shouldBeCalled();

        $this->setDefaultOptions($optionsResolver);
    }
}
