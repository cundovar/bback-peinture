<?php

namespace App\Controller\Api;

use App\Entity\Like;
use App\Entity\Oeuvre;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class LikeOeuvreController
{
    public function __invoke(
        Oeuvre $oeuvre,
        Request $request,
        EntityManagerInterface $entityManager,
        LikeRepository $likeRepository,
    ): JsonResponse {
        $like = (new Like())
            ->setOeuvre($oeuvre)
            ->setIp($request->getClientIp());

        $entityManager->persist($like);
        $entityManager->flush();

        return new JsonResponse([
            'id' => $like->getId(),
            'message' => 'Oeuvre liked',
            'likesCount' => $likeRepository->countForOeuvre($oeuvre),
        ]);
    }
}
