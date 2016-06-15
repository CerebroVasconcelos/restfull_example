<?php
namespace Application\Validator;
use Zend\Validator\AbstractValidator;
class ProdutoExiste extends AbstractValidator
{
    private $em = null;
    private $userLogged = null;

    const productNotExist = 'Zica';

    protected $messageTemplates =
    //array("lol");
    array(
        self::productNotExist => "Informe um produto que esteja cadastrado!"
    );


    public function __construct($options)
    {
        parent::__construct();
        if((gettype($options['em']) == "object" && ("Doctrine\ORM\EntityManager" == get_class($options['em']))))
        {
            $this-> setEm($options['em']);
        } else
        {
            throw new \Exception("O Validator não recebeu objeto Doctrine\ORM\EntityManager!");
        }
    }

    public function setEm($em = null)
    {
        $this-> em = $em;
    }

    public function getEm()
    {
        return $this-> em;
    }

    public function isValid($value)
    {
        $this->setValue($value);
        $produto = $this-> em-> getRepository('\Application\Entity\Produto')-> find($this-> value);
        if (!$produto)
        {
            $this-> error(self::productNotExist);
            return false;
        }
        return true;
    }
}
