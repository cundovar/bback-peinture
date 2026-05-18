<?php

namespace App\Controller\Api;

use App\Entity\Oeuvre;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class UnlikeOeuvreController
{
    public function __invoke(
        Oeuvre $oeuvre,
        EntityManagerInterface $entityManager,
        LikeRepository $likeRepository,
    ): JsonResponse {
        $like = $likeRepository->findOneBy(['oeuvre' => $oeuvre]);

        if ($like !== null) {
            $entityManager->remove($like);
            $entityManager->flush();
        }

        return new JsonResponse([
            'message' => 'Like removed',
            'likesCount' => $likeRepository->countForOeuvre($oeuvre),
        ]);
    }
}
