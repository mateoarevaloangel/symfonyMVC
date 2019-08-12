<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class,[
                'attr' => [
                    'class'=>'tform-control',
                    'type'=>'text'
                ]
            ])
            ->add('Email',EmailType::class,[
                'attr' => [
                    'class'=>'tform-control',
                    'type'=>'email'
                ]
            ])
            ->add('Message',TextareaType::class,[
                'attr' => [
                    'class'=>'tform-control',
                    'type'=>'text'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
