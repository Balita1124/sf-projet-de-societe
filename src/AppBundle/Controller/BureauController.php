<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bureau;
use AppBundle\Form\BureauType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity;

class BureauController extends Controller
{

    protected $path = "bv";

    /**
     * @Route("/bvs/", name="list_bv")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bvs = $em->getRepository('AppBundle:Bureau')->findAll();
        return $this->render('bvs/list.html.twig', [
            'bvs' => $bvs,
            'value' => $this->path,
            'title' => 'Bureau | Madagascar',
        ]);
    }

    /**
     * @param Bureau $bv
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/bvs/show/{bv}", name="show_bv")
     */
    public function showAction(Request $request, Bureau $bv)
    {
        if ($bv === null) {
            return $this->redirectToRoute('list_bv');
        }
        return $this->render('bvs/show.html.twig', [
            'bv' => $bv,
            'value' => $this->path,
            'title' => 'Bureau | Madagascar',
        ]);
    }

    /**
     * @Route("/bvs/create", name="create_bv")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {
        $bv = new Bureau();
        $form = $this->createForm(BureauType::class, $bv);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bv = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($bv);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_bv');

        }
        return $this->render('bvs/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Bureau | Madagascar',
        ]);
    }

    /**
     * @param Bureau $bv
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/bvs/edit/{bv}", name="edit_bv")
     */
    public function editAction(Request $request, Bureau $bv)
    {
        $form = $this->createForm(BureauType::class, $bv);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_bv');
        }
        return $this->render('bvs/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Bureau | Madagascar',
        ]);
    }

    /**
     * @param Request $request
     * @param Bureau $bv
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/bvs/delete/{bv}", name="delete_bv")
     */
    public function deleteAction(Request $request, Bureau $bv)
    {
        if ($bv === null) {
            return $this->redirectToRoute('list_bv');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($bv);
        $em->flush();

        return $this->redirectToRoute('list_bv');
    }
}