<?php
include './vendor/autoload.php';
$classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__);
$classLoader->register();


class RepoGen extends Doctrine\ORM\Tools\EntityRepositoryGenerator {
    protected static $_template =
'<?php

namespace App\Repository;

use App\Entity\__ENTITY__;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method __ENTITY__|null find($id, $lockMode = null, $lockVersion = null)
 * @method __ENTITY__|null findOneBy(array $criteria, array $orderBy = null)
 * @method __ENTITY__[]    findAll()
 * @method __ENTITY__[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class __ENTITY__Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, __ENTITY__::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder(\'g\')
            ->where(\'g.something = :value\')->setParameter(\'value\', $value)
            ->orderBy(\'g.id\', \'ASC\')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
';	
protected $entity = '__Entity';
	public function generateEntityRepositoryClass($fullClassName) {
		$val = str_replace('__ENTITY__', $this->entity, self::$_template);
		return $val;
	}
	public function setEntityName($name) {
		$this->entity = $name;
	}
}

// config
$config = new \Doctrine\ORM\Configuration();
$config->setMetadataDriverImpl($config->newDefaultAnnotationDriver(__DIR__ . '/Entities'));
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$connectionParams = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'root',
    'password' => '',
    'dbname' => 'hrmamagement',
    'charset' => 'latin1',
);
$em = \Doctrine\ORM\EntityManager::create($connectionParams, $config);
// custom datatypes (not mapped for reverse engineering)
$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('set', 'string');
$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
// fetch metadata
$driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                $em->getConnection()->getSchemaManager()
);
$driver->setNamespace('App\Entity\\');
$em->getConfiguration()->setMetadataDriverImpl($driver);
$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($em);
$cmf->setEntityManager($em);
$classes = $driver->getAllClassNames();
$metadata = $cmf->getAllMetadata();
foreach ($metadata as $md) {
	$md->setCustomRepositoryClass(str_replace('App\Entity\\', 'App\Repository\\', $md->getName().'Repository'));
}
$generator = new Doctrine\ORM\Tools\EntityGenerator();
$generator->setUpdateEntityIfExists(true);
$generator->setGenerateStubMethods(true);
$generator->setGenerateAnnotations(true);
$generator->generate($metadata, __DIR__ . '/Entities');
$repGenerator = new RepoGen();
foreach ($classes as $className) {
	$className = str_replace('App\Entity\\', '', $className);
	$repGenerator->setEntityName($className);
	$repGenerator->writeEntityRepositoryClass($className.'Repository',__DIR__ . '/Repositories');
}
print 'Done!';