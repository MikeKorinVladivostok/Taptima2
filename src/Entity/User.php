<?php


namespace App\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use http\Client\Response;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function testUserAction( UserInterface $user )
    {
        $userManipulator = $this->container->get("fos_user.util.user_manipulator");
        $userManipulator->addRole($user,'ROLE_ADMIN');

        return new Response();
    }
}