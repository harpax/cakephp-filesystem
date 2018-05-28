<?php
namespace Josbeir\Filesystem;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Josbeir\Filesystem\FilesystemRegistry;

class FilesystemRegistryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test FilesystemRegistry::get
     *
     * @return void
     */
    public function testGet()
    {
        $defaultFs = FilesystemRegistry::get();
        $this->assertInstanceOf('\Josbeir\Filesystem\Filesystem', $defaultFs);
    }

    /**
     * Test custom config key
     *
     * @return void
     */
    public function testCustomConfig()
    {
        Configure::write('Filesystem.myfs', [
            'formatter' => 'Entity'
        ]);

        $fs = FilesystemRegistry::get('myfs');

        $this->assertInstanceOf('\Josbeir\Filesystem\Formatter\EntityFormatter', $fs->getFormatter());
    }

    /**
     * Test exception when undefined config key is used
     *
     * @return void
     */
    public function testUndefinedConfig()
    {
        $this->expectException('\Josbeir\Filesystem\Exception\FilesystemException');
        $undefinedFs = FilesystemRegistry::get('idontexist');
    }
}