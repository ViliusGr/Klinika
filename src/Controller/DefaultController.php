<?php

namespace App\Controller;

use App\Entity\DayOfWeek;
use App\Entity\DaySchedule;
use App\Entity\Schedule;
use App\Entity\Specialty;
use App\Form\ScheduleType;
use App\Form\SpecialtyType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="/")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    // 1. Panaikinti asmens kodą DONE
    // 2. Pridėti telefono numerį naudotojui DONE
    // 3. Data ir laikas zinutei DONE
    // 4. Duomenu validacija, ilgio nustatymas
    // 5. El. laiško siuntimas DONE
    // 6. Refactorinimas DONE

}
