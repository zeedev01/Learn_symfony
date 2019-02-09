<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/3/2018
 * Time: 11:35 AM
 */

namespace App\Form;


use App\Entity\User;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                    ->add('name',\Symfony\Component\Form\Extension\Core\Type\TextType::class)
                    ->add('email',EmailType::class)
                    ->add('plainpassword',RepeatedType::class,[
                            'type'=> PasswordType::class,
                            'first_options'=> ['label'=>'password'],
                            'second_options'=> ['label'=>'confirm password'],
                        ]);
                   /* ->add('language', ChoiceType::class, array(
                                'choices' => array(
                                'English' => 'en',
                                'german' => 'de',
                                )
                            )
                        );*/

        }
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(['data_class'=> User::class,'csrf_protection' => true,'csrf_field_name' => '_token']);
            //$resolver->setDefaults(['data_class'=> SecurityController::class]);
        }
}