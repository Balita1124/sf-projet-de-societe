<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Promesse;
use AppBundle\Form\PromesseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PromesseController extends Controller
{
    protected $path = "promesse";
    /**
     * @Route("/promesses/", name="list_promesse")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $promesses = $em->getRepository('AppBundle:Promesse')->findAll();
        return $this->render('promesses/list.html.twig', [
            'promesses' => $promesses,
            'value' => $this->path
        ]);
    }

    /**
     * @param Promesse $promesse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/promesses/show/{promesse}", name="show_promesse")
     */
    public function showAction(Request $request, Promesse $promesse)
    {
        if ($promesse === null) {
            return $this->redirectToRoute('list_promesse');
        }
        return $this->render('promesses/show.html.twig', [
            'promesse' => $promesse,
            'value' => $this->path
        ]);
    }

    /**
     * @Route("/promesses/create", name="create_promesse")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {
        $promesse = new Promesse();
        $form = $this->createForm(PromesseType::class, $promesse);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $promesse = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($promesse);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_promesse');

        }
        return $this->render('promesses/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path
        ]);
    }

    /**
     * @param Promesse $promesse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/promesses/edit/{promesse}", name="edit_promesse")
     */
    public function editAction(Request $request, Promesse $promesse)
    {
        $form = $this->createForm(PromesseType::class, $promesse);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_promesse');
        }
        return $this->render('promesses/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path
        ]);
    }

    /**
     * @param Request $request
     * @param Promesse $promesse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/promesses/delete/{promesse}", name="delete_promesse")
     */
    public function deleteAction(Request $request, Promesse $promesse)
    {
        if ($promesse === null) {
            return $this->redirectToRoute('list_promesse');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($promesse);
        $em->flush();

        return $this->redirectToRoute('list_promesse');
    }

    /**
     * @param Request $request
     * @param Promesse $promesse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/promesses/do/{promesse}", name="do_promesse")
     */
    public function doPromesseAction(Request $request, Promesse $promesse)
    {
        if ($promesse === null) {
            return $this->redirectToRoute('list_promesse');
        }

        $em = $this->getDoctrine()->getManager();
        $promesse->setEtat(true);
//        $em->refresh($promesse);
        $em->flush();

        return $this->redirectToRoute('list_promesse');
    }
}