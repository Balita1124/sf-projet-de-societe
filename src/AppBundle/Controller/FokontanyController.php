<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fokontany;
use AppBundle\Form\FokontanyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity;

class FokontanyController extends Controller
{

    protected $path = "fokontany";

    /**
     * @Route("/fokontanys/", name="list_fokontany")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fokontanys = $em->getRepository('AppBundle:Fokontany')->findAll();
        return $this->render('fokontanys/list.html.twig', [
            'fokontanys' => $fokontanys,
            'value' => $this->path,
            'title' => 'Fokontany | Madagascar',
        ]);
    }

    /**
     * @param Fokontany $fokontany
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/fokontanys/show/{fokontany}", name="show_fokontany")
     */
    public function showAction(Request $request, Fokontany $fokontany)
    {
        if ($fokontany === null) {
            return $this->redirectToRoute('list_fokontany');
        }
        return $this->render('fokontanys/show.html.twig', [
            'fokontany' => $fokontany,
            'value' => $this->path,
            'title' => 'Fokontany | Madagascar',
        ]);
    }

    /**
     * @Route("/fokontanys/create", name="create_fokontany")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {
        $fokontany = new Fokontany();
        $form = $this->createForm(FokontanyType::class, $fokontany);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fokontany = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($fokontany);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_fokontany');

        }
        return $this->render('fokontanys/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Fokontany | Madagascar',
        ]);
    }

    /**
     * @param Fokontany $fokontany
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/fokontanys/edit/{fokontany}", name="edit_fokontany")
     */
    public function editAction(Request $request, Fokontany $fokontany)
    {
        $form = $this->createForm(FokontanyType::class, $fokontany);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_fokontany');
        }
        return $this->render('fokontanys/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Fokontany | Madagascar',
        ]);
    }

    /**
     * @param Request $request
     * @param Fokontany $fokontany
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/fokontanys/delete/{fokontany}", name="delete_fokontany")
     */
    public function deleteAction(Request $request, Fokontany $fokontany)
    {
        if ($fokontany === null) {
            return $this->redirectToRoute('list_fokontany');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($fokontany);
        $em->flush();

        return $this->redirectToRoute('list_fokontany');
    }
}