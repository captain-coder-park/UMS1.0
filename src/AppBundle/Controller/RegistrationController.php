<?php
// src/AppBundle/Controller/RegistrationController.php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\UserRegistrationType;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User(); // your Entity class
    
        // create form
        $form = $this->createForm(UserRegistrationType::class, $user);
    
        // handle form request
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            // encode password
            $passwordEncoder = $this->get('security.password_encoder');
            $encodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);
    
            // set status and createdAt
            $user->setStatus(1); // active by default
            $user->setCreatedAt(new \DateTime()); // now
    
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
    
            // add flash message
            $this->addFlash('success', 'Registration successful!');
    
            return $this->redirectToRoute('login'); // redirect to login page after register
        }
    
        return $this->render('registration/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}
