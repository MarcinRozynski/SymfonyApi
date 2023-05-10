<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\Type\EmployeeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeeController extends AbstractApiController
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function indexAction(Request $request): Response
    {
        $employees = $this->registry->getRepository(Employee::class)->findAll();

        return $this->respond($employees);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(EmployeeType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $employee = $form->getData();

        $this->registry->getManager()->persist($employee);
        $this->registry->getManager()->flush();

        return $this->respond($employee);
    }

    public function deleteAction(Request $request): Response
    {
        $employeeId = $request->get("id");

        $employee = $this->registry->getRepository(Employee::class)->findOneBy([
            "id" => $employeeId,
        ]);

        if (!$employee) {
            throw new NotFoundHttpException("Employee not found");
        }

        $this->registry->getManager()->remove($employee);
        $this->registry->getManager()->flush();

        return $this->respond('Employee deleted successfully');
    }

    public function updateAction(Request $request): Response
    {
        $employeeId = $request->get("id");

        $employee = $this->registry->getRepository(Employee::class)->findOneBy([
            "id" => $employeeId,
        ]);

        if (!$employee) {
            throw new NotFoundHttpException('Employee not found');
        }

        $form = $this->buildForm(EmployeeType::class, $employee, [
            'method' => $request->getMethod(),
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $this->registry->getManager()->persist($employee);
        $this->registry->getManager()->flush();

        return $this->respond('Employee updated successfully');
    }
}