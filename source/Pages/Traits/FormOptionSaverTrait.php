<?php
namespace Korobochkin\WPKit\Pages\Traits;

use Symfony\Component\Form\FormInterface;

trait FormOptionSaverTrait
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var object An object (instance) which holds this form data.
     */
    protected $formEntity;

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param FormInterface $form
     *
     * @return $this For chain calls.
     */
    public function setForm(FormInterface $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return object
     */
    public function getFormEntity()
    {
        return $this->formEntity;
    }

    /**
     * @param object $formEntity
     *
     * @return $this For chain calls.
     */
    public function setFormEntity($formEntity)
    {
        $this->formEntity = $formEntity;
        return $this;
    }

    /**
     * Be sure to call it only from $this->lateConstruct()
     * to prevent illegal access to the page handling.
     */
    public function handleRequest()
    {
    }
}
