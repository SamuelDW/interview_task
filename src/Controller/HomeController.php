<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\SubstanceSearchType;
use App\Repository\SubstanceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController
{
    /**
     * @Route("/", name="home")
     *
     * @param SubstanceRepository $substanceRepository
     *
     * @return Response
     */
    public function homeFormAction(SubstanceRepository $substanceRepository): Response
    {
        $allSubstances = $substanceRepository->findAll();

        $formData = [
            'substances' => $allSubstances,
        ];

        $form = $this->createForm(SubstanceSearchType::class, $formData);

        return $this->render('Forms/substance_search_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param SubstanceRepository $substanceRepository
     *
     * @return RedirectResponse
     */
    public function homeAction(Request $request, SubstanceRepository $substanceRepository): RedirectResponse
    {
        $formData = $request;

        $substance = $formData['substance'];

        return $this->redirect('');
    }

    /**
     * @param int $uniqueIdentifier
     * @param SubstanceRepository $substanceRepository
     *
     * @return JsonResponse
     */
    public function ajaxGetSubstancesByNumberAction (
        int $uniqueIdentifier,
        SubstanceRepository $substanceRepository
    ): JsonResponse {
        $substance = $substanceRepository
            ? $substanceRepository->getSubstanceByCASNumber($uniqueIdentifier)
            : $substanceRepository->getSubstanceByECNumber($uniqueIdentifier);

        if($substance) {

            return new JsonResponse([
                'substance' => $substance,
                'regulations' => $substanceRepository->getRegulationsApplicableToSubstance($substance),
                ]);
        }

        return new JsonResponse([]);
    }

    /**
     * @param string $substanceName
     * @param SubstanceRepository $substanceRepository
     *
     * @return JsonResponse
     */
    public function ajaxGetSubstancesByNameAction(
        string $substanceName,
        SubstanceRepository $substanceRepository
    ): JsonResponse {
        $substance =  $substanceRepository
            ? $substanceRepository->getSubstancesByName($substanceName, false)
            : null;

        if($substance) {

            return new JsonResponse([
                'substance' => $substance,
                'regulations' => $substanceRepository->getRegulationsApplicableToSubstance($substance),
                'articles' => $substanceRepository->getArticlesApplicableToSubstance($substance),
            ]);
        }
        return new JsonResponse([]);
    }
}