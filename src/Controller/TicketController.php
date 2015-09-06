<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CS\HelpDeskBundle\Controller;

use CS\HelpDeskBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    /**
     * @return Response
     */
    public function listAction()
    {
        $tickets = $this->get('helpdesk.manager.ticket_manager')->findAll();

        return $this->render('CSHelpDeskBundle:Ticket:list.html.twig', ['tickets' => $tickets]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->get('helpdesk.handler.ticket_handler')->handle($request, new Ticket());

        if ($form->isValid()) {
            $translator = $this->get('translator');
            $this->get('session')->getFlashBag()->add(
                'success',
                $translator->trans('helpdesk.ticket.create.success', [], 'CSHelpDesk')
            );
        }

        return $this->render('CSHelpDeskBundle:Ticket:create.html.twig', ['form' => $form->createView()]);
    }
}
