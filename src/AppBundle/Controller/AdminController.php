<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ethnic;
use AppBundle\Entity\Liability;
use AppBundle\Entity\Morphology;
use AppBundle\Entity\Particularity;
use AppBundle\Entity\Personality;
use AppBundle\Entity\Universe;
use AppBundle\Form\Type\EthnicType;
use AppBundle\Form\Type\LiabilityType;
use AppBundle\Form\Type\MorphologyType;
use AppBundle\Form\Type\ParticularityType;
use AppBundle\Form\Type\PersonalityType;
use AppBundle\Form\Type\UniverseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')")
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route()
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/configuration/outils")
     */
    public function toolsIndexAction()
    {
        return $this->render('admin/tools/index.html.twig');
    }

    /**
     * @Route("/configuration/outils/ethnie")
     */
    public function toolsEthnicAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Ethnic::class);
        $datas = $repository->findAll();

        return $this->render('admin/tools/config.html.twig', [
            'section' => 'ethnic',
            'subject' => 'ethnie',
            'ratio' => true,
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/configuration/outils/ethnie/création", options = { "utf8": true })
     */
    public function toolsEthnicCreateAction(Request $request)
    {

        $subject = "ethnie";
        $section = "ethnic";

        $data = new Ethnic();
        $form = $this->createForm(EthnicType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'L\'ethnie "' . $data->getName() . '" a bien été créé.');

            return $this->redirectToRoute('app_admin_toolsethnic');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $data
        ]);
    }

    /**
     * @Route("/configuration/outils/ethnie/modification/{id}")
     */
    public function toolsEthnicUpdateAction(Request $request, Ethnic $ethnic) //
    {
        $subject = "ethnie";
        $section = "ethnic";

        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(EthnicType::class, $ethnic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ethnic);
            $em->flush();

            $this->addFlash('success', 'L\'ethnie "' . $ethnic->getName() . '" a bien été modifiée.');

            return $this->redirectToRoute('app_admin_toolsethnic');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $ethnic
        ]);
    }

    /**
     * @Route("/configuration/outils/ethnie/suppression/{id}")
     */
    public function toolsEthnicDeleteAction(Request $request, Ethnic $ethnic) //
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($ethnic);
        $em->flush();

        $this->addFlash('success', 'L\'ethnie a bien été supprimée.');

        return $this->redirectToRoute('app_admin_toolsethnic');
    }

    /**
     * @Route("/configuration/outils/handicap")
     */
    public function toolsLiabilityAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Liability::class);
        $datas = $repository->findAll();

        return $this->render('admin/tools/config.html.twig', [
            'section' => 'liability',
            'subject' => 'handicap',
            'ratio' => true,
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/configuration/outils/handicap/création", options = { "utf8": true })
     */
    public function toolsLiabilityCreateAction(Request $request)
    {

        $subject = "handicap";
        $section = "liability";

        $data = new Liability();
        $form = $this->createForm(LiabilityType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'L\'handicap "' . $data->getName() . '" a bien été créé.');

            return $this->redirectToRoute('app_admin_toolsliability');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $data
        ]);
    }

    /**
     * @Route("/configuration/outils/handicap/modification/{id}")
     */
    public function toolsLiabilityUpdateAction(Request $request, Liability $liability) //
    {
        $subject = "handicap";
        $section = "liability";

        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(LiabilityType::class, $liability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($liability);
            $em->flush();

            $this->addFlash('success', 'L\'handicap "' . $liability->getName() . '" a bien été modifié.');

            return $this->redirectToRoute('app_admin_toolsliability');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $liability
        ]);
    }

    /**
     * @Route("/configuration/outils/handicap/suppression/{id}")
     */
    public function toolsLiabilityDeleteAction(Request $request, Liability $liability) //
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($liability);
        $em->flush();

        $this->addFlash('success', 'L\'handicap a bien été supprimée.');

        return $this->redirectToRoute('app_admin_toolsliability');
    }

    /**
     * @Route("/configuration/outils/morphologie")
     */
    public function toolsMorphologyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Morphology::class);
        $datas = $repository->findAll();

        return $this->render('admin/tools/config.html.twig', [
            'section' => 'morphology',
            'subject' => 'morphologie',
            'ratio' => true,
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/configuration/outils/morphologie/création", options = { "utf8": true })
     */
    public function toolsMorphologyCreateAction(Request $request)
    {

        $subject = "morphologie";
        $section = "morphology";

        $data = new Morphology();
        $form = $this->createForm(MorphologyType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'La morphologie "' . $data->getName() . '" a bien été créée.');

            return $this->redirectToRoute('app_admin_toolsmorphology');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $data
        ]);
    }

    /**
     * @Route("/configuration/outils/morphologie/modification/{id}")
     */
    public function toolsMorphologyUpdateAction(Request $request, Morphology $morphology) //
    {
        $subject = "morphologie";
        $section = "morphology";

        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(MorphologyType::class, $morphology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($morphology);
            $em->flush();

            $this->addFlash('success', 'La morphologie "' . $morphology->getName() . '" a bien été modifiée.');

            return $this->redirectToRoute('app_admin_toolsmorphology');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $morphology
        ]);
    }

    /**
     * @Route("/configuration/outils/morphologie/suppression/{id}")
     */
    public function toolsMorphologyDeleteAction(Request $request, Morphology $morphology) //
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($morphology);
        $em->flush();

        $this->addFlash('success', 'La morphologie a bien été supprimée.');

        return $this->redirectToRoute('app_admin_toolsmorphology');
    }

    /**
     * @Route("/configuration/outils/particularité", options = { "utf8": true })
     */
    public function toolsParticularityAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Particularity::class);
        $datas = $repository->findAll();

        return $this->render('admin/tools/config.html.twig', [
            'section' => 'particularity',
            'subject' => 'particularité',
            'ratio' => true,
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/configuration/outils/particularité/création", options = { "utf8": true })
     */
    public function toolsParticularityCreateAction(Request $request)
    {

        $subject = "particularité";
        $section = "particularity";

        $data = new Particularity();
        $form = $this->createForm(ParticularityType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'La particularité "' . $data->getName() . '" a bien été créée.');

            return $this->redirectToRoute('app_admin_toolsparticularity');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $data
        ]);
    }

    /**
     * @Route("/configuration/outils/particularité/modification/{id}", options = { "utf8": true })
     */
    public function toolsParticularityUpdateAction(Request $request, Particularity $particularity) //
    {
        $subject = "particularité";
        $section = "particularity";

        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(EthnicType::class, $particularity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($particularity);
            $em->flush();

            $this->addFlash('success', 'La particularité "' . $particularity->getName() . '" a bien été modifiée.');

            return $this->redirectToRoute('app_admin_toolsparticularity');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $particularity
        ]);
    }

    /**
     * @Route("/configuration/outils/particularité/suppression/{id}", options = { "utf8": true })
     */
    public function toolsParticularityDeleteAction(Request $request, Particularity $particularity) //
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($particularity);
        $em->flush();

        $this->addFlash('success', 'La particularité a bien été supprimée.');

        return $this->redirectToRoute('app_admin_toolsparticularity');
    }

    /**
     * @Route("/configuration/outils/personnalité", options = { "utf8": true })
     */
    public function toolsPersonalityAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Personality::class);
        $datas = $repository->findAll();

        return $this->render('admin/tools/config.html.twig', [
            'section' => 'personality',
            'subject' => 'personnalité',
            'ratio' => true,
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/configuration/outils/personnalité/création", options = { "utf8": true })
     */
    public function toolsPersonalityCreateAction(Request $request)
    {

        $subject = "personnalité";
        $section = "personality";

        $data = new Personality();
        $form = $this->createForm(PersonalityType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'La personnalité "' . $data->getName() . '" a bien été créée.');

            return $this->redirectToRoute('app_admin_toolspersonality');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $data
        ]);
    }

    /**
     * @Route("/configuration/outils/personalité/modification/{id}", options = { "utf8": true })
     */
    public function toolsPersonalityUpdateAction(Request $request, Personality $personality) //
    {
        $subject = "personnalité";
        $section = "personality";

        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(PersonalityType::class, $personality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personality);
            $em->flush();

            $this->addFlash('success', 'La personnalité "' . $personality->getName() . '" a bien été modifiée.');

            return $this->redirectToRoute('app_admin_toolspersonality');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => true,
            'data' => $personality
        ]);
    }

    /**
     * @Route("/configuration/outils/personalité/suppression/{id}", options = { "utf8": true })
     */
    public function toolsPersonalityDeleteAction(Request $request, Personality $personality) //
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($personality);
        $em->flush();

        $this->addFlash('success', 'La personnalité a bien été supprimée.');

        return $this->redirectToRoute('app_admin_toolspersonality');
    }

    /**
     * @Route("/configuration/outils/univers")
     */
    public function toolsUniverseAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Universe::class);
        $datas = $repository->findAll();

        return $this->render('admin/tools/config.html.twig', [
            'section' => 'universe',
            'subject' => 'univers',
            'ratio' => false,
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/configuration/outils/univers/création", options = { "utf8": true })
     */
    public function toolsUniverseCreateAction(Request $request)
    {

        $subject = "univers";
        $section = "universe";

        $data = new Universe();
        $form = $this->createForm(UniverseType::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'L\'univers "' . $data->getName() . '" a bien été créé.');

            return $this->redirectToRoute('app_admin_toolsuniverse');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => false,
            'data' => $data
        ]);
    }

    /**
     * @Route("/configuration/outils/univers/modification/{id}")
     */
    public function toolsUniverseUpdateAction(Request $request, Universe $universe) //
    {
        $subject = "univers";
        $section = "universe";

        $this->isTokenValid($request->query->get('token'));

        $form = $this->createForm(UniverseType::class, $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($universe);
            $em->flush();

            $this->addFlash('success', 'L\'univers "' . $universe->getName() . '" a bien été modifié.');

            return $this->redirectToRoute('app_admin_toolsuniverse');
        }

        return $this->render('admin/tools/create.html.twig', [
            'form' => $form->createView(),
            'section' => $section,
            'subject' => $subject,
            'ratio' => false,
            'data' => $universe
        ]);
    }

    /**
     * @Route("/configuration/outils/univers/suppression/{id}")
     */
    public function toolsUniverseDeleteAction(Request $request, Universe $universe) //
    {
        $this->isTokenValid($request->query->get('token'));

        $em = $this->getDoctrine()->getManager();
        $em->remove($universe);
        $em->flush();

        $this->addFlash('success', 'L\'univers a bien été supprimé.');

        return $this->redirectToRoute('app_admin_toolsuniverse');
    }

    public function isTokenValid($token)
    {
        if ($token === null) {
            throw $this->createNotFoundException();
        }

        if (!$this->isCsrfTokenValid('masuperintensiondelamortquituelaviememeapreslamort', $token)) {
            throw $this->createNotFoundException();
        }
    }

}