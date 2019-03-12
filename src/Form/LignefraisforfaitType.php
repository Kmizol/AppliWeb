<?php

namespace App\Form;

use App\Entity\Lignefraisforfait;
use App\Entity\FraisForfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class LignefraisforfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		    ->add('idVisiteur', EntityType::class, 
                 array('class' => 'App\Entity\Visiteur', 
                        'label' => 'idVisiteur :',
                         'choice_label' => function($id){
                            return $id->getId();
                        }))
			 ->add('mois')
			 ->add('idfraisforfait', EntityType::class, 
            array('class' => 'App\Entity\Fraisforfait', 
                   'label' => 'idfraisforfait :',
                    'choice_label' => function($idfraisforfait){
                       return $idfraisforfait->getId();
                    
                   },
                  'choice_value' => function (FraisForfait $f = null) {
                    return $f ? $f->getMontant() : '';
                    },
                   'placeholder' => 'Choississez ...'))
            ->add('quantite')
            ->add('montant')
            ->add('save',SubmitType::class)
        ;
        
      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lignefraisforfait::class,
        ]);
    }
}