<?php

namespace GlobalLogic\UnitConversion\Test\Integration;

use PhpParser\Node\Expr\Cast\Object_;
use Magento\TestFramework\ObjectManager;
use Magento\Framework\ObjectManager\ConfigInterface as OMConfig;

class UnitConversionDiConfigTest extends \PHPUnit\Framework\TestCase
{

    private $configType = \GloabalLogic\UnitConversion\Model\Config\UnitConversion\Virtual::class;
    private $readerType = \GloabalLogic\UnitConversion\Model\Config\UnitConversion\Reader\Virtual::class;
    private $schemaLocatorType = \GlobalLogic\UnitConversion\Model\Config\UnitConversion\SchemaLocator\Virtual::class;

    private function getDiConfig()
    {
        return ObjectManager::getInstance()->get(OMConfig::class);
    }


    private function assertVirtualType($expectedType, $type)
    {
        $this->assertSame($expectedType, $this->getDiConfig()->getInstanceType($type));
    }

    private function assertDiArgumentSame($expeted, $type, $argumentName)
    {
        $arguments = $this->getDiConfig()->getArguments($type);
        if (!isset($arguments[$argumentName])) {
            $this->fail(sprintf('No arguments "%s" configured for "%s"', $argumentName, $type));
        }

        $this->assertSame($expeted, $arguments[$argumentName]);
    }

    private function assertDiArgumentType($expectedType, $type, $argumentName)
    {
        $arguments = $this->getDiConfig()->getArguments($type);
        if (!isset($arguments[$argumentName])) {
            $this->fail(sprintf('No arguments "%s" configured for "%s"', $argumentName, $type));
        }

        if (!isset($arguments[$argumentName]['instance'])) {
            $this->fail(sprintf('Argument "%s" for "%s" is not xsi:type="object"', $argumentName, $type));
        }

        $this->assertSame($expectedType, $arguments[$argumentName]['instance']);
    }

    public function testUnitCoversionDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\Data::class, $this->configType);
        $this->assertDiArgumentSame('gl_unitmap_config', $this->configType, 'cacheId');
        $this->assertDiArgumentType($this->readerType, $this->configType, 'reader');
    }

    public function testUnitConversionReaderDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\GenericSchemaLocator::class, $this->schemaLocatorType);
        $this->assertDiArgumentSame('GlobalLogic_UnitConversion', $this->schemaLocatorType, 'moduleName');
        $this->assertDiArgumentSame('unit_conversion.xsd', $this->schemaLocatorType, 'schema');
    }

    public function testUnitConversionConfigReaderDiConfig()
    {
        $this->assertVirtualType(\Magento\Framework\Config\Reader\Filesystem::class, $this->readerType);
        $this->assertDiArgumentSame('unit_conversion.xml', $this->readerType, 'fileName');
        $this->assertDiArgumentType($this->schemaLocatorType, $this->readerType, 'schemaLocator');
    }

    public function testUnitConversionDataCanBeAccessed()
    {
        $unitConversionConfig = ObjectManager::getInstance()->create($this->configType);
        $configData = $unitConversionConfig->get(null);

        $this->assertIsArray($configData);
        $this->assertNotEmpty($configData);
    }
}
