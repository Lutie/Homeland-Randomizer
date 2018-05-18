<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Character;
use AppBundle\Entity\Ethnic;
use AppBundle\Entity\Liability;
use AppBundle\Entity\Morphology;
use AppBundle\Entity\Particularity;
use AppBundle\Entity\Personality;
use AppBundle\Form\Type\CharacterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/outils/personnage")
 */
class CharacterController extends Controller
{

    /**
     * @Route("/personnage")
     */
    public function indexAction()
    {
        return $this->render('tools/character/index.html.twig');
    }

    /**
     * @Route("/liste")
     */
    public function configAction()
    {
        return $this->render('tools/character/config.html.twig');
    }

    /**
     * @Route("/création", options = { "utf8": true })
     */
    public function createAction(Request $request)
    {
        $character = new Character();
        $character->setAuthor($this->getUser());

        $form = $this->createForm(CharacterType::class, $character);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();

            $this->addFlash('success', 'Le personnage "' . $character->getFirstname() . '" "' . $character->getLastname() . '" a bien été créé.');

            return $this->redirectToRoute('app_character_index');
        }

        return $this->render('tools/character/create.html.twig', [
            'form' => $form->createView(),
            'character' => $character
        ]);
    }

    /**
     * @Route("/modification/{id}")
     */
    public function updateAction(Request $request, Character $character)
    {
        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $em->flush();

            $this->addFlash('success', 'Le personnage "' . $character->getFirstname() . '" "' . $character->getLastname() . '" a bien été modifié.');

            return $this->redirectToRoute('app_character_config');
        }

        return $this->render('tools/character/create.html.twig', [
            'form' => $form->createView(),
            'character' => $character
        ]);
    }

    /**
     * @Route("/suppression/{id}")
     */
    public function deleteAction(Request $request, Character $character)
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($character);
        $em->flush();

        $this->addFlash('success', 'Le personnage a bien été supprimé.');

        return $this->redirectToRoute('app_character_config');
    }

    private function getRandom($class)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($class);
        $list = $repository->findBy([], ['ratio' => 'DESC']);
        $table = [];
        foreach ($list as $option) {
            $table[] = $option->getRatio();
        }
        $rand = rand(0, array_sum($table));
        foreach ($list as $option) {
            $rand -= $option->getRatio();
            if ($rand <= 0) {
                $proprety = $option;
                break;
            }
        }

        return $proprety->getId();
    }

    /**
     * Search
     *
     * @param Request $request
     *
     * @return Response
     * @Route("/rechercher")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $characters = $em->getRepository(Character::class)->search($request->query->get('search'));
        return $this->render('tools/character/table.html.twig', [
            'datas' => $characters,
        ]);
    }

    /**
     * Random
     * @param Request $request
     * @return Response
     * @Route("/aléatoire", options = { "utf8": true })
     */
    public function randomAction(Request $request)
    {

        $data = null;

        $age = rand(17, 77);
        $morphology = null;
        $personality = null;
        $particularities[] = null;
        $liabilities[] = null;
        $ethnic = null;
        $sex = rand(0, 1);

        $subject = $request->query->get('subject');

        if ($subject == 'morphology' || 'all') $morphology = $this->getRandom(Morphology::class);
        if ($subject == 'personality' || 'all') $personality = $this->getRandom(Personality::class);
        if ($subject == 'ethnic' || 'all') $ethnic = $this->getRandom(Ethnic::class);

        if ($subject == 'particularities' || 'all') {
            if (rand(0, 100) < 66) $particularities[] = $this->getRandom(Particularity::class);
            if (rand(0, 100) < 33) $particularities[] = $this->getRandom(Particularity::class);
        }
        if ($subject == 'liabilities' || 'all') {
            if (rand(0, 100) < 66) $liabilities[] = $this->getRandom(Liability::class);
            if (rand(0, 100) < 33) $liabilities[] = $this->getRandom(Liability::class);
        }

        $data = [
            'age' => $age,
            'morphology' => $morphology,
            'personality' => $personality,
            'particularities' => $particularities,
            'liabilities' => $liabilities,
            'data' => $data,
            'ethnic' => $ethnic,
            'sex' => $sex
        ];

        return new JsonResponse($data);

    }

    public function isTokenValid($token)
    {
        if ($token === null) {
            throw $this->createNotFoundException();
        }

        if (!$this->isCsrfTokenValid('CHARACTER_TOKEN', $token)) {
            throw $this->createNotFoundException();
        }
    }

}