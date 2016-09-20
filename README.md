# ImagizerPHP
The official PHP Client for the Imagizer Media Engine

The Imagizer Media Engine accelerates media delivery to your mobile Apps or Webpages by dynamically rescaling, cropping, and compressing images in real time. See all Imagizer features in our doc.

## Installation
### Using Composer
Define the following requirement in your composer.json file
```
{
    "require": {
        "nventify/imagizer-php": "0.1.*"
    }
}
```
Then include the auto loading path in your application
```php
require __DIR__ . '/vendor/autoload.php';
```

## Basic Usage

Using the free to test Imagizer Demo Service
```php
// Initialize the Imagizer Client
$imagizerClient = new Imagizer\Client();

// Since we are using Imagizer Engine Demo Service
// we'll need to specify our Image storage origin
// Imagizer will fetch your images from this endpoint
$imagizerClient->setOriginImageHost("example.com");

// Build a URL with resize and cropping params
// http://example.com/image.jpg?width=400&height=400&crop=fit&dpr=2&hostname=example.com
$imageUrl1 = $imagizerClient->buildUrl("image.jpg", [
    "width" => 400,
    "height" => 500,
    "crop" => "fit"
]);

// Build url with compression
// http://example.com/image.jpg?quality=55&hostname=example.com
$imageUrl2 = $imagizerClient->buildUrl("image.jpg", [
    "quality" => 55
]);
```

Using your own Imagizer Instance
```php
// Initialize the Imagizer Client
$imagizerClient = new Imagizer\Client("your-imagizer-instance.example.com");

// Build a URL with resize and cropping params
// http://your-imagizer-instance.example.com/image.jpg?width=400&height=400&crop=fit&dpr=2
$imageUrl1 = $imagizerClient->buildUrl("image.jpg", [
    "width" => 400,
    "height" => 500,
    "crop" => "fit"
]);

// Build url with compression
// http://your-imagizer-instance.example.com/image.jpg?quality=55
$imageUrl2 = $imagizerClient->buildUrl("image.jpg", [
    "quality" => 55
]);
```

