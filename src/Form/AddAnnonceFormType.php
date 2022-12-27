<?php

namespace App\Form;

use App\Entity\Annonce;
use Doctrine\DBAL\Types\DateImmutableType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddAnnonceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array('class' => 'champ_texte'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez remplir ce champ.',
                    ]),
                ],
            ])
            ->add('description', TextType::class, [
                'attr' => array('class' => 'champ_texte'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez remplir ce champ.',
                    ]),
                ],
            ])
            ->add('price', NumberType::class, [
                'attr' => array('class' => 'champ_texte'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez remplir ce champ.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
