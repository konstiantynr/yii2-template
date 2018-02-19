<?php

namespace tests\unit;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * Base class for the test cases.
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = \yii\console\Application::class)
    {
        new $appClass(ArrayHelper::merge(
            require dirname(dirname(__DIR__)) . '/config/main.php',
            [
                'id' => 'testapp',
                'basePath' => dirname(dirname(__DIR__)),
                'vendorPath' => $this->getVendorPath(),
                'components' => [
                    'i18n' => [
                        'translations' => [
                            '*' => [
                                'class' => \yii\i18n\PhpMessageSource::class,
                                'forceTranslation' => false,
                            ],
                        ],
                    ],
                ],
            ],
            $config
        ));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
    }

    /**
     * Invokes object method, even if it is private or protected.
     * @param object $object object.
     * @param string $method method name.
     * @param array $args method arguments
     * @return mixed method result
     */
    protected function invoke($object, $method, array $args = [])
    {
        $classReflection = new \ReflectionClass(get_class($object));
        $methodReflection = $classReflection->getMethod($method);
        $methodReflection->setAccessible(true);
        $result = $methodReflection->invokeArgs($object, $args);
        $methodReflection->setAccessible(false);
        return $result;
    }
}
