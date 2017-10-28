<?php
namespace Korobochkin\WPKit\AlmostControllers;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;

interface ActionInterface
{

    /**
     * @return bool
     */
    public function isEnabledForLoggedIn();

    public function setEnabledForLoggedIn($enabledForLoggedIn);

    public function isEnabledForNotLoggedIn();

    public function setEnabledForNotLoggedIn($enabledForNotLoggedIn);

    public function getName();

    public function setName($name);

    /**
     * @return StackInterface
     */
    public function getApi();

    /**
     * @param StackInterface $api
     *
     * @return $this For chain calls.
     */
    public function setApi(StackInterface $api);

    public function getRequest();

    public function getResponse();

    /**
     * @return ConstraintViolationList
     */
    public function getViolationList();

    /**
     * @param ConstraintViolationList $violationList
     */
    public function setViolationList($violationList);

    public function addViolation(ConstraintViolationInterface $violation);

    public function handleRequest();
}
