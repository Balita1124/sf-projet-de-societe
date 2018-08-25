<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Region;
use AppBundle\Form\RegionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class RegionController extends Controller
{
    protected $path = "region";
    /**
     * @Route("/regions/", name="list_region")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('AppBundle:Region')->findAll();
        return $this->render('regions/list.html.twig', [
            'regions' => $regions,
            'value' => $this->path,
            'title' => 'Régions | Madagascar',
        ]);
    }

    /**
     * @param Region $region
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/regions/show/{region}", name="show_region")
     */
    public function showAction(Request $request, Region $region)
    {
        if ($region === null) {
            return $this->redirectToRoute('list_region');
        }
        return $this->render('regions/show.html.twig', [
            'region' => $region,
            'value' => $this->path,
            'title' => 'Régions | Madagascar',
        ]);
    }

    /**
     * @Route("/regions/create", name="create_region")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request)
    {

        $region = new Region();
        $form = $this->createForm(RegionType::class, $region);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $region = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();

            // for now
            return $this->redirectToRoute('list_region');

        }
        return $this->render('regions/create.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Régions | Madagascar',
        ]);
    }

    /**
     * @param Region $region
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/regions/edit/{region}", name="edit_region")
     */
    public function editAction(Request $request, Region $region)
    {
        $form = $this->createForm(RegionType::class, $region);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // for now
            return $this->redirectToRoute('list_region');
        }
        return $this->render('regions/edit.html.twig', [
            'form' => $form->createView(),
            'value' => $this->path,
            'title' => 'Régions | Madagascar',
        ]);
    }

    /**
     * @param Request $request
     * @param Region $region
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_USER')")
     * @Route("/regions/delete/{region}", name="delete_region")
     */
    public function deleteAction(Request $request, Region $region)
    {
        if ($region === null) {
            return $this->redirectToRoute('list_region');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($region);
        $em->flush();

        return $this->redirectToRoute('list_region');
    }
}