<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Province;
use AppBundle\Form\ProvinceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ProvinceController extends Controller
{
    protected $path = "province";

    /**
     * @Route("/provinces/", name="list_province")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $provinces = $em->getRepository('AppBundle:Province')->findAll();
        return $this->render('provinces/list.html.twig', [
            'provinces' => $provinces,
            'value' => $this->path
        ]);
    }

    /**
     * @Route("/provinces/create", name="create_province")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {
        $province = new Province();
        $form = $this->createForm(ProvinceType::class, $province);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $province = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($province);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_province');

        }
        return $this->render('provinces/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path
        ]);
    }

    /**
     * @param Province $province
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/provinces/edit/{province}", name="edit_province")
     */
    public function editAction(Request $request, Province $province)
    {
        $form = $this->createForm(ProvinceType::class, $province);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_province');
        }
        return $this->render('provinces/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path
        ]);
    }

    /**
     * @param Province $province
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/provinces/show/{province}", name="show_province")
     */
    public function showAction(Request $request, Province $province)
    {
        if ($province === null) {
            return $this->redirectToRoute('list_province');
        }
        return $this->render('provinces/show.html.twig', [
            'province' => $province,
            'value' => $this->path
        ]);
    }

    /**
     * @param Request $request
     * @param Province $province
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/provinces/delete/{province}", name="delete_province")
     */
    public function deleteAction(Request $request, Province $province)
    {

        if ($province === null) {
            return $this->redirectToRoute('list_province');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($province);
        $em->flush();

        return $this->redirectToRoute('list_province');
    }
}