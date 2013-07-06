<?php

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

AnnotationDriver::registerAnnotationClasses();

$config = new Configuration();
$config->setProxyDir(__DIR__ . '/../cache');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(__DIR__ . '/../cache');
$config->setHydratorNamespace('Hydrators');
$config->setMetadataDriverImpl(
    AnnotationDriver::create(__DIR__ . '/../src/HH/Document')
);
$config->setDefaultDB('hh');

$dm = DocumentManager::create(new Connection(), $config);
$dm->getSchemaManager()->ensureIndexes();

$criterion = new HH\Document\Criterion('test', 10);
$dm->persist($criterion);

try {
    $dm->flush();
    echo "It is now " . date('m/d/Y H:i:s');
} catch (\MongoCursorException $mce) {
    echo $mce->getMessage();
}
