<?php

namespace App\Admin;

use App\Entity\Author;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AuthorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('last_name', TextType::class, [
                'label' => 'Фамилия'
            ])
            ->add('name', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('middle_name', TextType::class, [
                'label' => 'Отчество'
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('fullName', TextType::class, [
                'label' => 'ФИО'
            ])
            ->add('books', null, [
                'label' => 'Книги'
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('fullName', null, [
                'label' => 'ФИО'
            ])
            ->add('books', null, [
                'label' => 'Книги'
            ]);
    }

    public function toString(object $object): string
    {
        return $object instanceof Author ? $object->getFullName() : 'Author';
    }
}