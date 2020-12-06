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

class AdminController extends AbstractController
{

    /**
     * @Route("/specialties/create", name="create_specialty")
     */
    public function createSpecialty(Request $request){
        $specialty = new Specialty();
        $form = $this->createForm(SpecialtyType::class, $specialty, [
            'action' => $this->generateUrl('create_specialty')
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialty);
            $em->flush();

            $this->addFlash('success', "Specialybė sėkmingai pridėta!");

            return $this->redirectToRoute('/');
        }
        return $this->render('admin/specialty_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/schedule/create", name="create_schedule")
     */
    public function createSchedule(Request $request)
    {
        $daysOfWeek = $this->getDoctrine()->getRepository(DayOfWeek::class)->findAll();
        $schedule = new Schedule();
        $days = new ArrayCollection();
        for ($x = 1; $x < 8; $x++) {
            $day = new DaySchedule();
            $day->setDayOfWeek($daysOfWeek[$x-1]);
            $day->setSchedule($schedule);
            $days->add($day);
        }
        $schedule->setDays($days);

        $form = $this->createForm(ScheduleType::class, $schedule, [
            'action' => $this->generateUrl('create_schedule')
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $schedules = $this->getDoctrine()->getRepository(Schedule::class)->findOneBy([
                'doctor' => $schedule->getDoctor()
            ]);
            if(!empty($schedules)){
                $this->addFlash('danger', "Šio daktaro tvarkaraštis jau egzistuoja!");
            }
            else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($schedule);
                $err = false;
                for ($x = 1; $x < 8; $x++) {
                    $timeFrom = $days[$x-1]->getTimeFrom();
                    $timeTo = $days[$x-1]->getTimeTo();
                    if($timeFrom == "0"){
                        $timeFrom = "00:00";
                    }
                    if($timeTo == "0"){
                        $timeTo = "00:00";
                    }
                    $timeFrom = new \DateTime($timeFrom);
                    $timeTo = new \DateTime($timeTo);
                    if($timeFrom > $timeTo){
                        $this->addFlash('danger', "Klaida: pradinis laikas didesnis už galinį!");
                        $err = true;
                        break;
                    }
                    $days[$x-1]->setTimeFrom($timeFrom);
                    $days[$x-1]->setTimeTo($timeTo);
                    $em->persist($days[$x-1]);
                }
                if(!$err){
                    $em->flush();
                    $this->addFlash('success', "Tvarkaraštis sėkmingai pridėtas!");

                    return $this->redirectToRoute('/');
                }
            }

        }

        return $this->render('admin/schedule_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/populateTable", name="populateTable")
     */
    public function populateTable(): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $day = new DayOfWeek();
        $day->setName('Pirmadienis');
        $manager->persist($day);
        $manager->flush();

        $day = new DayOfWeek();
        $day->setName('Antradienis');
        $manager->persist($day);
        $manager->flush();

        $day = new DayOfWeek();
        $day->setName('Trečiadienis');
        $manager->persist($day);
        $manager->flush();

        $day = new DayOfWeek();
        $day->setName('Ketvirtadienis');
        $manager->persist($day);
        $manager->flush();

        $day = new DayOfWeek();
        $day->setName('Penktadienis');
        $manager->persist($day);
        $manager->flush();

        $day = new DayOfWeek();
        $day->setName('Šeštadienis');
        $manager->persist($day);
        $manager->flush();

        $day = new DayOfWeek();
        $day->setName('Sekmadienis');
        $manager->persist($day);
        $manager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
