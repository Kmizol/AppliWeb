<?php

namespace App\Form;

use App\Entity\Lignefraishorsforfait;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormView;

class LignefraishorsforfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('idVisiteur', EntityType::class, 
        array('class' => 'App\Entity\Visiteur', 
               'label' => 'idvisiteur :',
                'choice_label' => function($id){
                   return $id->getId();
               }))
    ->add('mois')
   ->add('libelle')
   ->add('montant')
   ->add('date')
   ->add('Fichier',FileType::class)
   ->add('save',SubmitType::class)
;
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lignefraishorsforfait::class,
        ]);
    }
}
