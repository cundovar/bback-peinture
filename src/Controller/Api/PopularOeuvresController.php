<?php

namespace App\Controller\Api;

use App\Repository\OeuvreRepository;
use App\Repository\LikeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class PopularOeuvresController extends AbstractController
{
    public function __invoke(
        Request $request,
        OeuvreRepository $repository,
        LikeRepository $likeRepository,
    ): JsonResponse {
        $limit = max(1, min(50, $request->query->getInt('limit', 6)));
        $data = [];

        foreach ($repository->findPopular($limit) as $oeuvre) {
            $likesCount = $likeRepository->countForOeuvre($oeuvre);

            $data[] = [
                'id' => $oeuvre->getId(),
                'name' => $oeuvre->getName(),
                'image' => $oeuvre->getImage(),
                'description' => $oeuvre->getDescription(),
                'categorie' => $oeuvre->getCategorie() ? '/api/categories/'.$oeuvre->getCategorie()->getId() : null,
                'theme' => $oeuvre->getTheme() ? '/api/themes/'.$oeuvre->getTheme()->getId() : null,
                'likes' => $likesCount,
                'likesCount' => $likesCount,
            ];
        }

        return new JsonResponse($data);
    }
}
