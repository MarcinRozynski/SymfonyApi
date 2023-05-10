<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\Type\CompanyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends AbstractApiController
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function indexAction(Request $request): Response
    {
        $company = $this->registry->getRepository(Company::class)->findAll();

        return $this->respond($company);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(CompanyType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $company = $form->getData();

        $this->registry->getManager()->persist($company);
        $this->registry->getManager()->flush();

        return $this->respond($company);
    }

    public function deleteAction(Request $request): Response
    {
        $companyId = $request->get("id");

        $company = $this->registry->getRepository(Company::class)->findOneBy([
            "id" => $companyId,
        ]);

        if (!$company) {
            throw new NotFoundHttpException("Company not found");
        }

        $this->registry->getManager()->remove($company);
        $this->registry->getManager()->flush();

        return $this->respond('Company deleted successfully');
    }

    public function updateAction(Request $request): Response
    {
        $companyId = $request->get("id");

        $company = $this->registry->getRepository(Company::class)->findOneBy([
            "id" => $companyId,
        ]);

        if (!$company) {
            throw new NotFoundHttpException('Company not found');
        }

        $form = $this->buildForm(CompanyType::class, $company, [
            'method' => $request->getMethod(),
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $this->registry->getManager()->persist($company);
        $this->registry->getManager()->flush();

        return $this->respond('Company updated successfully');
    }
}