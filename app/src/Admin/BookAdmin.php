<?php

namespace App\Admin;

use App\Entity\Author;
use App\Entity\Book;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Object\Metadata;
use Sonata\AdminBundle\Object\MetadataInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class BookAdmin extends AbstractAdmin
{
    public function getObjectMetadata(object $object): MetadataInterface
    {
        $url = $object->getImage() ? '/uploads/' . $object->getImage() : null;
        return new Metadata($object->getTitle(), $object->getFullName(), $url);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title', TextType::class, [
                'label' => 'Название'
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Год'
            ])
            ->add('isbn', IntegerType::class, [
                'label' => 'ISBN'
            ])
            ->add('pages', IntegerType::class, [
                'label' => 'Количество страниц'
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Обложка (jpeg/png)',
                'required' => false
            ])
            ->add('authors', EntityType::class, [
                'label' => 'Авторы',
                'class' => Author::class,
                'choice_label' => 'name',
                'multiple' => true,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('title')
            ->add('year')
            ->add('isbn')
            ->add('pages')
            ->add('authors', null, [
                'field_type' => EntityType::class,
                'field_options' => [
                    'class' => Author::class,
                    'choice_label' => 'name',
                ],
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('title', TextType::class, [
                'label' => 'Название'
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Год'
            ])
            ->add('isbn', IntegerType::class, [
                'label' => 'ISBN'
            ])
            ->add('pages', IntegerType::class, [
                'label' => 'Количество страниц'
            ])
            ->add('image', FileType::class, [
                'label' => 'Обложка'
            ])
            ->add('authors', EntityType::class, [
                'label' => 'Авторы'
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('title', null, [
                'label' => 'Название'
            ])
            ->add('year', null, [
                'label' => 'Год'
            ])
            ->add('isbn', null, [
                'label' => 'ISBN'
            ])
            ->add('pages', null, [
                'label' => 'Количество страниц'
            ])
            ->add('image', null, [
                'label' => 'Обложка'
            ])
            ->add('authors', null, [
                'label' => 'Авторы'
            ]);
    }

    public function toString(object $object): string
    {
        return $object instanceof Book ? $object->getTitle() : 'Book';
    }
}