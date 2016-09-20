<?php

require __DIR__ . '/../vendor/autoload.php';

use Imagizer\Client;

/**
 * Created by IntelliJ IDEA.
 * User: nick
 * Date: 9/20/16
 * Time: 10:51 AM
 */
class ImagizerClientTest extends PHPUnit_Framework_TestCase
{
    public function testBuildUrl()
    {
        $client = new Client();
        $url = $client->buildUrl("image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithSlash()
    {
        $client = new Client();
        $url = $client->buildUrl("/image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithSpecifiedImagizerHost()
    {
        $client = new Client("my.image.imagizer.example.com");
        $url = $client->buildUrl("/image.jpg");
        $expected = "http://my.image.imagizer.example.com/image.jpg";
        $this->assertEquals($expected, $url);
    }


    public function testBuildUrlWithSpecifiedImagizerHostWithHttps()
    {
        $client = new Client("my.image.imagizer.example.com", true);
        $url = $client->buildUrl("/image.jpg");
        $expected = "https://my.image.imagizer.example.com/image.jpg";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithMultipleSlash()
    {
        $client = new Client();
        $url = $client->buildUrl("this/images/image.jpg");
        $expected = "http://demo.imagizercdn.com/this/images/image.jpg";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithParams()
    {
        $client = new Client();
        $url = $client->buildUrl("image.jpg", [
            "width" => 200,
            "height" => 300,
            "crop" => "fit"
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?width=200&height=300&crop=fit";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithQuality()
    {
        $client = new Client();
        $url = $client->buildUrl("image.jpg", [
            "quality" => 60
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?quality=60";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalQuality()
    {
        $client = new Client();
        $client->setQuality(60);
        $url = $client->buildUrl("image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg?quality=60";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalQualityOverride()
    {
        $client = new Client();
        $client->setQuality(60);
        $url = $client->buildUrl("image.jpg", [
            "quality" => 55
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?quality=55";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithDpr()
    {
        $client = new Client();
        $url = $client->buildUrl("image.jpg", [
            "dpr" => 2
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?dpr=2";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalDpr()
    {
        $client = new Client();
        $client->setDpr(2);
        $url = $client->buildUrl("image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg?dpr=2";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalDprOverride()
    {
        $client = new Client();
        $client->setDpr(2);
        $url = $client->buildUrl("image.jpg", [
            "dpr" => 3
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?dpr=3";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithDefaultDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $url = $client->buildUrl("image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg?hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithParamsAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");

        $url = $client->buildUrl("image.jpg", [
            "width" => 200,
            "height" => 300,
            "crop" => "fit"
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?width=200&height=300&crop=fit&hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithQualityAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $url = $client->buildUrl("image.jpg", [
            "quality" => 60
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?quality=60&hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalQualityAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $client->setQuality(60);
        $url = $client->buildUrl("image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg?quality=60&hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalQualityOverrideAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $client->setQuality(60);
        $url = $client->buildUrl("image.jpg", [
            "quality" => 55
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?quality=55&hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithDprAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $url = $client->buildUrl("image.jpg", [
            "dpr" => 2
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?dpr=2&hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalDprAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $client->setDpr(2);
        $url = $client->buildUrl("image.jpg");
        $expected = "http://demo.imagizercdn.com/image.jpg?dpr=2&hostname=example.com";
        $this->assertEquals($expected, $url);
    }

    public function testBuildUrlWithGlobalDprOverrideAndDemoHostAndOriginHostSpecified()
    {
        $client = new Client();
        $client->setOriginImageHost("example.com");
        $client->setDpr(2);
        $url = $client->buildUrl("image.jpg", [
            "dpr" => 3
        ]);
        $expected = "http://demo.imagizercdn.com/image.jpg?dpr=3&hostname=example.com";
        $this->assertEquals($expected, $url);
    }
}