<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\DaySchedule;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Schedule;
use App\Entity\User;
use App\Form\AppointmentType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Date;

class AppointmentController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/appointment/create", name="create_appointment")
     */
    public function registerToAppointment(Request $request, MailerInterface $mailer){
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment, [
            'action' => $this->generateUrl('create_appointment')
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $email = $this->security->getUser()->getUsername();
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
            $id = $user->getId();
            $patient = $this->getDoctrine()->getRepository(Patient::class)->findOneBy(['user' => $id]);

            $appointment->setPatient($patient);
            $appointment->setDate(new \DateTime($appointment->getDate()));
            $appointment->setTime(new \DateTime($appointment->getTime()));

            $emplid = $appointment->getDoctor();
            $dr = $this->getDoctrine()->getRepository(Doctor::class)->findOneBy(['emplid' => $emplid])->getUser();
            $doctor = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $dr]);


            $email = (new TemplatedEmail())
                ->from('contact@klinika.com')
                ->to($email)
                ->subject('Registracija pas daktarą')
                ->htmlTemplate('emails/appointment.html.twig')
                ->context([
                    'doctor' => $doctor->getFullName(),
                    'date' => $appointment->getDateString(),
                    'time' => $appointment->getTimeString(),
                    'patient' => $user->getFullName()
                ]);

            try {
                $mailer->send($email);

                $em->persist($appointment);
                $em->flush();
                $this->addFlash('success', "Jūs sėkmingai užregistruotas!");


            } catch (TransportExceptionInterface $exception) {
                $this->addFlash('error', "Nepavyko išsiųsti el. laiško!");
            }
            return $this->redirectToRoute('/');

        }

        return $this->render('patient/appointment_register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/appointment/list", name="list_appointments")
     */
    public function checkAppointments(){
        $email = $this->security->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
        $id = $user->getId();
        $doctor = $this->getDoctrine()->getRepository(Doctor::class)->findOneBy(['user' => $id]);

        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->findBy(['doctor' => $doctor]);

        return $this->render('doctor/appointment_list.html.twig', [
            'appointments' => $appointments
        ]);
    }

    /**
     * @Route("/appointment/time", name="getTimes")
     */
    public function getTimes(Request $request){
        $doctor = $request->request->get('doctor');
        $date = new \DateTime($request->request->get('date'));
        $dayOfWeek = $date->format('w');
        if($dayOfWeek == 0){
            $dayOfWeek = 7;
        }

        $schedule = $this->getDoctrine()->getRepository(Schedule::class)
            ->findOneBy(['doctor' => $doctor]);
        $interval = $schedule->getDuration();

        $daySchedule = $this->getDoctrine()->getRepository(DaySchedule::class)->findOneBy([
            'dayOfWeek' => $dayOfWeek,
            'schedule' => $schedule
        ]);

        $otherAppointments = $this->getDoctrine()->getRepository(Appointment::class)->findBy([
            'doctor' => $doctor,
            'date' => $date
        ]);
        $unInterval = $interval-2;
        $unavailableTimes = [];
        foreach($otherAppointments as $appointment){
            $startTime = $appointment->getTime();
            $timeString = $startTime->format("Y-m-d H:i");
            $endTimeString = $timeString.' + '.$unInterval.' minute';
            $endTime = strtotime($endTimeString);
            $unavailableTimes[] = $startTime->format("H:i");
            $unavailableTimes[] = date('H:i', $endTime);
        }

        $resp_data = [
            'interval' => $interval,
            'time_from' => $daySchedule->getTimeFrom()->format("H:i"),
            'time_to' => $daySchedule->getTimeTo()->format("H:i"),
            'unavailable_times' => $unavailableTimes
        ];
        return new JsonResponse($resp_data);
    }

}
