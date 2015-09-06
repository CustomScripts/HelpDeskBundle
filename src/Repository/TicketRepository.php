<?php

/*
 * This file is part of CustomScripts HelpDesk project.
 *
 * (c) 2015 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CS\HelpDeskBundle\Repository;

use CS\HelpDeskBundle\Model\Ticket;
use Doctrine\ORM\EntityRepository;

class TicketRepository extends EntityRepository
{
    /**
     * @param Ticket $ticket
     *
     * @return bool
     */
    public function save(Ticket $ticket)
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($ticket);
        $entityManager->flush();

        return true;
    }
}
