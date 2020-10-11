<?php

namespace App\DI;

use ReflectionObject;
use ReflectionMethod;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionProperty;
use App\Renderer\Renderer;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;

class Container {
    
    /**
     *
     * @var callable[] 
     */
    private $factories = [];
    
    /**
     *
     * @var object[] 
     */
    private $singletones = [];
    
    
    /**
     *
     * @var object[]
     */
    private $dependencyMapping = [];
    
//    public function execute(string $className, string $methodName) {
//
//    }
    
    /**
     * 
     * @param string $className
     * @param array $dependencyMapping
     * @return object
     * @throws ReflectionException
     */
    public function get(string $className, array $dependencyMapping = null) {
            
        if (!is_null($dependencyMapping)) {
                $this->addManyMappings($dependencyMapping);
        }
        
        if (array_key_exists($className, $this->dependencyMapping) && is_object($this->dependencyMapping[$className])) {
            return $this->dependencyMapping[$className];
        }
        
        if ($this->isSingletone($className)) {
            //echo var_dump($className, $this->getSingletone($className)); exit;
            return $this->getSingletone($className);
        }

        return $this->createInstance($className);
    }

    /**
     * @param string $className
     * @param array|null $dependencyMapping
     * @return object|null
     */
    public function getOrNull(string $className, array $dependencyMapping = null)
    {
        try{
            return $this->get($className, $dependencyMapping);
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function factory(string $className, callable $factory) {
        
        $this->factories[$className] = $factory;
        //echo "<pre>";var_dump($factory);"</pre>"; exit;
    }
    
    
    public function singletone(string $className, callable $factory = null) {
       // echo "<pre>";var_dump($className, $factory, !$this->isSingletone($className));"</pre>"; exit;
        
        if (!$this->isSingletone($className)) {
            $this->singletones[$className] = null;
         //echo "<pre>";var_dump($this->singletones[$className]);"</pre>"; exit;  
        }
        if (is_callable($factory)){
            //echo "<pre>";var_dump($factory);"</pre>"; exit;
            $this->factory($className, $factory);
        }
    }
    
    public function isSingletone(string $className) {
        //echo var_dump($className, array_key_exists($className, $this->singletones)); exit;
        return array_key_exists($className, $this->singletones);
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function addOneMapping(string $key, $value)
    {
        if (!is_object($value)) {
            return $this;
        }

        $this->dependencyMapping[$key] = $value;
        return $this;
    }

    /**
     * 
     * @param type $object
     * @param string $methodName
     * @return type
     * @throws \ReflectionException
     */
    public function call($object, string $methodName) {
        if (!is_object($object)) {
            return null;
        }

        $reflectionClass = new ReflectionObject($object);
        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $arguments = $this->getDependencies($reflectionMethod);
//        echo "<pre>"; var_dump($arguments); echo "</pre>"; exit;
        return call_user_func_array([$object, $methodName], $arguments);
    }
    
    /**
     * 
     * @param type $object
     * @param string $propertyName
     * @param type $value
     * @return boolean|null
     * @throws \ReflectionException
     */
    public function setProperty($object, string $propertyName, $value) {
        //echo var_dump($object, $propertyName, $value);
        if (!is_object($object)) {
            return null;
        }
        $reflectionController = new ReflectionObject($object);
            
        $reflectionRenderer = $reflectionController->getProperty($propertyName);
        $reflectionRenderer->setAccessible(true);
        $reflectionRenderer->setValue($object, $value);
       // echo var_dump($object, $value);
        $reflectionRenderer->setAccessible(false);
        
        return true;
    }
    
    /**
     * 
     * @param ReflectionClass|ReflectionFunctionAbstract|ReflectionProperty $target
     * @return array|string[]|null
     */
    public function parseDocComment($target) {
        $isReflectionClass = $target instanceof ReflectionClass;
        $isReflectionFunction = $target instanceof ReflectionFunctionAbstract;
        $isReflectionProperty = $target instanceof ReflectionProperty;
        
        $hasDocComment = $isReflectionClass || $isReflectionFunction || $isReflectionProperty;
        
        if (!$hasDocComment) {
            return null;
        }
        
        $docComment = (string) $target->getDocComment();   
        
        $docComment = trim($docComment);
        $docCommentArray = explode("\n", $docComment);
        
        $docCommentArray = array_map(function($item) {
            $item = trim($item);
            $position = strpos($item, '*');
            if ($position == 0) {
                $item = substr($item, 1);
            }
            return trim($item);
        }, $docCommentArray);
        
        return $docCommentArray;
    }
    
    protected function addManyMappings(array $mapping) {

        foreach ($mapping as $key => $value) {
            $this->addOneMapping($key, $value);
        }

    }
    
    protected function initProtectedAndPrivateProperties($object) {
        $reflectionObject = new ReflectionObject($object);
        $reflectionProperties = $reflectionObject->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
        
        foreach ($reflectionProperties as $reflectionProperty) {
 //           $docComment = $reflectionProperty->getDocComment();
            $docCommentArray = $this->parseDocComment($reflectionProperty);
            
            $isOnInit = false;
            $dependencyClass = null;
            
            foreach ($docCommentArray as $docComment) {
                $onIniPrefix = '@onInit(';
                $isOnInit = strpos($docComment, $onIniPrefix) === 0;
                
                if (!$isOnInit) {
                    continue;
                }
                
                $dependencyClass = str_replace($onIniPrefix, '', $docComment);
                $dependencyClass = substr($dependencyClass, 0, -1);
                
                if (!class_exists($dependencyClass)) {
                    $dependencyClass = null;
                }
                
                break;
            }
            if (is_null($dependencyClass)) {
                continue;
            }
            
            $reflectionProperty->setAccessible(true);
            
            $dependencyClassObject = $this->get($dependencyClass);
            $reflectionProperty->setValue($object, $dependencyClassObject);
            $reflectionProperty->setAccessible(false);
            
            
            
//            echo "<pre>"; var_dump($docCommentArray); echo "</pre>";
        }
    }
    
    protected function getSingletone(string $className) {
        //echo var_dump($className, $this->singletones); exit;
        if (!$this->isSingletone($className)) {
            return null;
        }
        if (is_null($this->singletones[$className])) {
            $this->singletones[$className] = $this->createInstance($className);
        }
        return $this->singletones[$className];
    }
    
    protected function createInstance(string $className) {
        // $className = Renderer;
        //echo var_dump($this->factories[$className], $className); exit;
        if (isset($this->factories[$className])) {
            return $this->factories[$className]($this);
        }
       
        $reflectionClass = new ReflectionClass($className);
       //  echo var_dump($reflectionClass); exit;
        $reflectionConstructor = $reflectionClass->getConstructor();
              //echo var_dump($reflectionConstructor); exit;
        $arguments = null;
        if ($reflectionConstructor instanceof ReflectionMethod) {
        
            $arguments = $this->getDependencies($reflectionConstructor);
            
            $object = $reflectionClass->newInstanceArgs($arguments);
        }
        
        else {
            $object = $reflectionClass->newInstance();
        }
        
        
        $this->initProtectedAndPrivateProperties($object);
        
        return $object;
    }
    
    protected function getDependencies(ReflectionMethod $reflectionMethod) {
        $reflectionParameters = $reflectionMethod->getParameters();

        $arguments = [];

        foreach ($reflectionParameters as $parameter) {

            $parameterName = $parameter->getName();
            $parameterType = $parameter->getType();

            assert($parameterType instanceof \ReflectionNamedType);
            $className = $parameterType->getName();

            if (class_exists($className)) {
                $arguments[$parameterName] = $this->get($className);
            }
        }
        return $arguments;
    }
    
    
    
}
