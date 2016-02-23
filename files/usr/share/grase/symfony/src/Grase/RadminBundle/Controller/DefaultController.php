<?php

namespace Grase\RadminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction($name = "random")
    {
        //$check_repo = $this->getDoctrine()->getManager()->getRepository('Grase\RadminBundle\Entity\Radius\Check');
        //dump($check_repo->findAll()[0]);

        $users_repo = $this->getDoctrine()->getManager()->getRepository('Grase\RadminBundle\Entity\Radius\User');
        dump($users_repo->findAll()[3]->getRadiusAccounting()[1]);

        return $this->render('GraseRadminBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Route("/users/{group}", name="grase_users")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayUsersAction($group = null)
    {
        $users_repo = $this->getDoctrine()->getManager()->getRepository('Grase\RadminBundle\Entity\Radius\User');

        $users = $users_repo->findByGroup($group);

        return $this->render(
            'GraseRadminBundle:Default:users.html.twig',
            [
                'users' => $users
            ]
        );
    }

    /**
     * @Route("/groups/", name="grase_groups")
     */
    public function displayGroups()
    {
        $groups_repo = $this->getDoctrine()->getManager()->getRepository('GraseRadminBundle:Radius\Group');

        $groups = $groups_repo->findAll();

        return $this->render(
            'GraseRadminBundle:Default:groups.html.twig',
            [
                'groups' => $groups
            ]
        );
    }
}