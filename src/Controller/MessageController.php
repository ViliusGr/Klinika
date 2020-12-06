<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Message;
use App\Entity\Patient;
use App\Entity\User;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MessageController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/message/send/{doctor}/{patient}", name="send_message")
     */
    public function sendMessage(string $doctor, string $patient, Request $request){
        $email = $this->security->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
        $id = $user->getId();
        $doctor_id = $this->getDoctrine()->getRepository(Doctor::class)->findOneBy(['user' => $id])->getId();

        if($doctor != $doctor_id){
            return $this->redirectToRoute('/');
        }

        $message = new Message();
        $params = [ 'doctor' => $doctor, 'patient' => $patient];
        $form = $this->createForm(MessageType::class, $message, [
            'action' => $this->generateUrl('send_message', $params)
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $sender = $this->getDoctrine()->getRepository(Doctor::class)->findOneBy(['emplid' => $doctor]);
            $receiver = $this->getDoctrine()->getRepository(Patient::class)->findOneBy(['id' => $patient]);
            $message->setSender($sender);
            $message->setReceiver($receiver);

            $em->persist($message);
            $em->flush();

            $this->addFlash('success', "Žinutė sėkmingai išsiųsta!");

            return $this->redirectToRoute('/');
        }

        return $this->render('doctor/message_send.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/message/list", name="see_messages")
     */
    public function seeMessages(){
        $email = $this->security->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
        $id = $user->getId();
        $patient = $this->getDoctrine()->getRepository(Patient::class)->findOneBy(['user' => $id]);

        $messages = $this->getDoctrine()->getRepository(Message::class)->findBy(['receiver' => $patient]);

        return $this->render('patient/message_list.html.twig', [
            'messages' => $messages
        ]);
    }
}
