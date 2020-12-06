<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\User;
use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Form\PatientType;
use App\Form\UserType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration/patient", name="registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $patient = new Patient();
        $patient->setUser($user);
        $form = $this->createForm(PatientType::class, $patient, [
            'action' => $this->generateUrl('registration')
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user->addRole('ROLE_PATIENT');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($patient);
            $em->flush();

            $this->addFlash('success', "Paskyra sėkmingai sukurta!");

            return $this->redirectToRoute('/');
        }
        return $this->render('patient/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/registration/doctor", name="registration_doctor")
     */
    public function registerDoctor(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $doctor = new Doctor();
        $doctor->setUser($user);
        $form = $this->createForm(DoctorType::class, $doctor, [
            'action' => $this->generateUrl('registration_doctor')
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user->addRole('ROLE_DOCTOR');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($doctor);
            $em->flush();

            $this->addFlash('success', "Paskyra sėkmingai sukurta!");

            return $this->redirectToRoute('/');
        }
        return $this->render('admin/registration_doctor.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
