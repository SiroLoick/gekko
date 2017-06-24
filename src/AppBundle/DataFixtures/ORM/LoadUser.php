<?php 
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser implements FixtureInterface, ContainerAwareInterface {

	private $container;

	/**
	 * {@inheritDoc}
	 * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
	 */
	public function load(ObjectManager $manager) {
		
		$user = new User();
		$user->setUsername('admin');
		$user->setEmail('admin@gekko.fr');
		$encoder = 	$this->container->get('security.password_encoder');
		$password = $encoder-> encodePAssword($user, '123');
		$user->setPassword($password);
		$user->setAdmin('1');
		$manager->persist($user);
		$manager->flush();
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\DependencyInjection\ContainerAwareInterface::setContainer()
	 */
	public function setContainer(ContainerInterface $container = null) {
		
		$this->container = $container;
	}

}