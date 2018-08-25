<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commune;
use AppBundle\Form\CommuneType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CommuneController extends Controller
{

    protected $path = "commune";

    /**
     * @Route("/communes/", name="list_commune")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communes = $em->getRepository('AppBundle:Commune')->findAll();
        return $this->render('communes/list.html.twig', [
            'communes' => $communes,
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }

    /**
     * @Route("/communes1/", name="list_commune1")
     * @Security("has_role('ROLE_USER')")
     */
    public function list1Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communes = $em->getRepository('AppBundle:Commune')->findBy(array('tvm' => true, 'rnm' => true));
        return $this->render('communes/list1.html.twig', [
            'communes' => $communes,
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }
    /**
     * @Route("/communes2/", name="list_commune2")
     * @Security("has_role('ROLE_USER')")
     */
    public function list2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communes = $em->getRepository('AppBundle:Commune')->findBy(array('tvm' => true, 'rnm' => false));
        return $this->render('communes/list2.html.twig', [
            'communes' => $communes,
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }
    /**
     * @Route("/communes3/", name="list_commune3")
     * @Security("has_role('ROLE_USER')")
     */
    public function list3Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communes = $em->getRepository('AppBundle:Commune')->findBy(array('tvm' => false, 'rnm' => true));
        return $this->render('communes/list3.html.twig', [
            'communes' => $communes,
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }
    /**
     * @Route("/communes4/", name="list_commune4")
     * @Security("has_role('ROLE_USER')")
     */
    public function list4Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communes = $em->getRepository('AppBundle:Commune')->findBy(array('tvm' => false, 'rnm' => false));
        return $this->render('communes/list4.html.twig', [
            'communes' => $communes,
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }

    /**
     * @param Commune $commune
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/communes/show/{commune}", name="show_commune")
     */
    public function showAction(Request $request, Commune $commune)
    {
        if ($commune === null) {
            return $this->redirectToRoute('list_commune');
        }
        return $this->render('communes/show.html.twig', [
            'commune' => $commune,
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }

    /**
     * @Route("/communes/create", name="create_commune")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {
        $commune = new Commune();
        $form = $this->createForm(CommuneType::class, $commune);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commune = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($commune);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_commune');

        }
        return $this->render('communes/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }

    /**
     * @param Commune $commune
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/communes/edit/{commune}", name="edit_commune")
     */
    public function editAction(Request $request, Commune $commune)
    {
        $form = $this->createForm(CommuneType::class, $commune);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_commune');
        }
        return $this->render('communes/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Communes | Madagascar',
        ]);
    }

    /**
     * @param Request $request
     * @param Commune $commune
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/communes/delete/{commune}", name="delete_commune")
     */
    public function deleteAction(Request $request, Commune $commune)
    {
        if ($commune === null) {
            return $this->redirectToRoute('list_commune');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($commune);
        $em->flush();

        return $this->redirectToRoute('list_commune');
    }
}