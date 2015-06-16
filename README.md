# ViewValue Plugin for CakePHP

This plugin let your CakePHP application secure against XSS injection by escaping View variables automatically.

## Requirements

* PHP >= 5.5
* CakePHP >= 2.6

## Setup

In `Config/bootstrap.php`:

```php
#Load ViewValue plugin
CakePlugin::load('ViewValue');
```

and in `Controller/AppController.php`:

```php
public $viewClass = 'ViewValue.ViewValue';
```

#### notice

If variables are already escaped by using `h()` helper in your view file, you should remove `h()`.  
They might to be cause of double escaping.

## Description

This plugin convert View variable whose type is `String`/`Array`/`Object` into instance of `StringViewValue`/`ArrayViewValue`/`ObjectViewValue`.  
They act as their original variable type.  
If need arise, you can get raw value by calling `raw()` method in view file.  
Or, add the line `$this->escapeFlag = false;` in your controller, this plugin's event dispatcher will not work.

## Sample code

`StringViewValue` act as string.
```php
#Controller/SampleController.php
public function index() {
	$this->set('xssstr', '<script>alert(0)</script>');
}
```
```html
<!-- View/Smaple/index.ctp -->
<?php echo $xssstr; ?> <!-- &lt;script&gt;alert(0)&lt;/script&gt; (display correctly in browser) -->
<?php echo $xssstr->raw(); ?> <!-- <script>alert(0)</script> (script is triggered) -->
```

and `ArrayViewValue` act as array.
```php
#Controller/SampleController.php
public function index() {
	$this->set('arr', array('<script>alert(0)</script>', 'hoge', array('fuga', array('hoge', 'fuga'))));
}
```
```html
<!-- View/Smaple/index.ctp -->
<?php echo $arr[0]; ?> <!-- &lt;script&gt;alert(0)&lt;/script&gt; (display correctly in browser) -->
<?php var_dump($arr instanceof ArrayViewValue) ?> <!-- true -->
<?php var_dump($arr[0] instanceof StringViewValue) ?> <!-- true -->
<!-- `$arr[0]` is converted to `StringViewValue`. -->
<?php var_dump($arr[2][1] instanceof ArrayViewValue) ?> <!-- true -->
<!-- The value of any hierarchy will be converted into BaseViewValue inheritance. -->

<!-- off course you can use foreach -->
<?php
foreach ($arr as $val) {
	echo $val;
}
?>
```
