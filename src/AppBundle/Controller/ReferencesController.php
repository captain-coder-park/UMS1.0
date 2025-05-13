<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ureferences;
use AppBundle\Form\UreferencesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReferencesController extends Controller
{
    /**
     * @Route("references", name="references")
    */
    public function references(Request $request)
    {
            // Get Doctrine Entity Manager
            $em = $this->getDoctrine()->getManager();
            
            $user = $this->getUser();
            $references = $this->getDoctrine()
            ->getRepository('AppBundle:Ureferences')
            ->findBy(['user' => $user]);
           // $references = $em->getRepository('AppBundle:Ureferences')->findAll();

            // Pass data to Twig template
            return $this->render('reference/references.html.twig', [
                'references' => $references
            ]);
    }

    /**
     * @Route("/reference/new", name="reference_new")
     */
    public function newAction(Request $request)
    {
        //echo"<pre>";print_r($_POST);die;
        $reference = new Ureferences();

        $form = $this->createForm(UreferencesType::class, $reference);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser(); // currently logged-in user
            $reference->setUser($user); // <-- setUser before persist!

            $em = $this->getDoctrine()->getManager();
            $em->persist($reference);
            $em->flush();

            $this->addFlash('success', 'Reference saved successfully!');
            return $this->redirectToRoute('reference_new');
        }

        return $this->render('reference/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


/**
 * @Route("/reference/edit/{id}", name="reference_edit")
 */
public function editReferenceAction(Request $request, $id)
{
    $em = $this->getDoctrine()->getManager();
    $reference = $em->getRepository('AppBundle:Ureferences')->find($id);

    if (!$reference) {
        throw $this->createNotFoundException('Reference not found.');
    }

    $form = $this->createForm(UreferencesType::class, $reference);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush(); // Only flush, because entity is already managed!

        $this->addFlash('success', 'Reference updated successfully!');

        return $this->redirectToRoute('references');
    }

    return $this->render('reference/edit.html.twig', [
        'form' => $form->createView(),
        'reference' => $reference,
    ]);
}

/**
 * @Route("/reference/delete/{id}", name="reference_delete")
 */
public function deleteReferenceAction($id)
{
    $em = $this->getDoctrine()->getManager();
    $reference = $em->getRepository('AppBundle:Ureferences')->find($id);

    if (!$reference) {
        throw $this->createNotFoundException('Reference not found.');
    }

    $em->remove($reference);
    $em->flush();

    $this->addFlash('success', 'Reference deleted successfully!');

    return $this->redirectToRoute('references');
} 

}
