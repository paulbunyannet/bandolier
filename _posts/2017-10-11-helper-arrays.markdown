---
layout:     default
title:      "Arrays"
date:       2017-10-11
categories: helpers
---

# Arrays

* [defaultAttributes](#defaultattributes)
* [getAttribute](#getattribute)
* [getKey](#getkey)


## defaultAttributes

Use a default array and pass in overriding keys if there is a key from the attributes array in the defaults array.

{% highlight php %}Arrays::defaultAttributes(array $defaults = [], array $attributes = []){% endhighlight %}

### Example

Replace key from defaults with one found in the attributes:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $defaults = ["foo" => "bar", "bazz" => "bin"];
  $attributes = ["bazz" => "green"];
  Arrays::defaultAttributes($defaults, $attributes);
  // Returns ["foo" => "bar","bazz" => "green"]</pre>
</figure>

Key from attributes was not found in defaults so the defaults will be returned:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $defaults = ["foo" => "bar", "bazz" => "bin"];
  $attributes = ["some" => "unknown key"];
  Arrays::defaultAttributes($defaults, $attributes);
  // Returns ["foo" => "bar","bazz" => "bin"]</pre>
</figure>


## getAttribute

Get an value from array by key. If none was found use a default.

{% highlight php %}Arrays::getAttribute(array $data, $attribute = null, $default = null){% endhighlight %}

### Example

Get value from array by key:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $attribute = "foo"
  Arrays::getAttribute($list, $attribute);
  // Returns "bar"</pre>
</figure>


A default value value is returned if key is not found:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $attribute = "red"
  Arrays::getAttribute($list, $attribute, "default");
  // Returns "default"</pre>
</figure>


## getKey

Get an key from array by value. if none was found use a default.

{% highlight php %}getKey(array $data, $value, $default=null){% endhighlight %}

### Example

Get a key from array by value:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $value = "bar"
  Arrays::getKey($list, $value);
  // Returns "foo"</pre>
</figure>

A default key value is returned if value is not found:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $value = "red"
  Arrays::getKey($list, $value, "default");
  // Returns "default"</pre>
</figure>
