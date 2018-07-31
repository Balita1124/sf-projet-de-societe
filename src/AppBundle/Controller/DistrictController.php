<?php

namespace AppBundle\Controller;

use AppBundle\Entity\District;
use AppBundle\Form\DistrictType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DistrictController extends Controller
{

    protected $path = "district";

    /**
     * @Route("/districts/", name="list_district")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $districts = $em->getRepository('AppBundle:District')->findAll();
        return $this->render('districts/list.html.twig', [
            'districts' => $districts,
            'value' => $this->path,
        ]);
    }

    /**
     * @param District $district
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/districts/show/{district}", name="show_district")
     */
    public function showAction(Request $request, District $district)
    {
        if ($district === null) {
            return $this->redirectToRoute('list_district');
        }
        return $this->render('districts/show.html.twig', [
            'district' => $district,
            'value' => $this->path
        ]);
    }

    /**
     * @Route("/districts/create", name="create_district")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {
        $district = new District();
        $form = $this->createForm(DistrictType::class, $district);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $district = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($district);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_district');

        }
        return $this->render('districts/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path
        ]);
    }

    /**
     * @param District $district
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/districts/edit/{district}", name="edit_district")
     */
    public function editAction(Request $request, District $district)
    {
        $form = $this->createForm(DistrictType::class, $district);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_district');
        }
        return $this->render('districts/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path
        ]);
    }

    /**
     * @param Request $request
     * @param District $district
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/districts/delete/{district}", name="delete_district")
     */
    public function deleteAction(Request $request, District $district)
    {
        if ($district === null) {
            return $this->redirectToRoute('list_district');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($district);
        $em->flush();

        return $this->redirectToRoute('list_district');
    }
}