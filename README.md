# php-file-cache
Fast key value caching system based on file system (without any databases like Redis or Memcache)

## Installation
This project using composer.
```
$ composer require alirezaashrafi/php-file-cache
```

## Usage
After installation, you can use 'Cache' class in your project

```php
use AlirezaAshrafi\Cache;
```
If class with 'Cache' name already exists you can use AS for rename included class
```php
use AlirezaAshrafi\Cache as FileCache;
```

- Initialization parameters are directory and file name
- First parameter is absolute path of cache directory
- Second parameter is the file you want to save results

```php
$directory = __DIR__ . '/cache-dir';
$file = 'products';

$cache = new Cache($directory , $file);

// OR

$cache = new Cache(__DIR__ . '/cache-dir' , 'products');
```
- Directory hierarchy (path/cache-dir/products)

#### Set
```php
$cache->set("product-1-name", "Iphone 13");
$cache->set("product-1-description", "Iphone 13 pro max 256G");
````

#### Get
```php
$product_name = $cache->get("product-1-name", "default value"); // "Iphone 13"
$product_name = $cache->get("product-2-name", "default value"); // "default value"
````
- If cache exists it will return the value ("Iphone 13 pro max")
- Else if cache not exists default value will return ("default value")

#### Has
```php
$cache->has("product-1-name"); // TRUE
$cache->has("product-2-name"); // FALSE
````
- Has function checks the existence of cache in file and memory
- True or False are return values of has function

#### Delete
```php
$cache->delete("product-1-description"); // TRUE
````


#### Get ALL
```php
$cache->getAll();
```

#### Purge (Delete ALL)
```php
$cache->purgeAll();
```
