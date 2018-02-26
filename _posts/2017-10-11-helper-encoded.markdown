---
layout:     default
title:      "Encoded"
date:       2017-10-11
categories: helpers
---

# Encoded

Handle encoded strings

## Methods

* [getThingThatIsEncoded](#getthingthatisencoded)
* [getEncodeType](#getencodetype)
* [isJson](#isjson)
* [unpackJson](#unpackjson)
* [isSerialized](#isserialized)
* [unpackSerialized](#unpackserialized)
* [isBase64](#isbase64)
* [unpackBase64](#unpackbase64)

## getThingThatIsEncoded

Find a key inside a string that may or may not be encoded.

{% highlight php %}Encoded::getThingThatIsEncoded($strange, $thing){% endhighlight %}

### Example

Find a key in a JSON encoded array:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded
  $string = "{"foo":"bar"}"
  Encoded::getThingThatIsEncoded($string, 'foo')
  // returns "bar"</pre>
</figure>

Find a key in a serialized array:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded
  $string = "a:1:{s:3:"foo";s:3:"bar";}"
  Encoded::getThingThatIsEncoded($string, 'foo')
  // returns "bar"</pre>
</figure>

## getEncodeType

Check for the encoded type of a string.

{% highlight php %}Encoded::getEncodeType($string){% endhighlight %}

### Example

Check to see if string is a JSON array:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "{"foo":"bar"}"
  Encoded::getEncodeType($string);
  // returns "json"</pre>
</figure>

Check to see if string is a serialized array:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "a:1:{s:3:"foo";s:3:"bar";}"
  Encoded::getEncodeType($string)
  // returns "serialized"</pre>
</figure>

## isJson

Check to see if a string is a JSON array.

{% highlight php %}Encoded::isJson($string){% endhighlight %}

### Example

Check to see if string is a JSON array:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "{"foo":"bar"}"
  Encoded::isJson($string);
  // returns true</pre>
</figure>

Check to see if string is a JSON array will return false if not:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "a:1:{s:3:"foo";s:3:"bar";}"
  Encoded::isJson($string);
  // returns false</pre>
</figure>

## unpackJson

Decode a JSON array from string.

{% highlight php %}Encoded::unpackJson($string, $associativeArray = true){% endhighlight %}

### Example

Decode a JSON array:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "{"foo":"bar"}"
  Encoded::unpackJson($string);
  // returns ["foo" => "bar"]</pre>
</figure>


## isSerialized

Checks string is a serialized object.

{% highlight php %}Encoded::isSerialized($string){% endhighlight %}

### Example

Check to see if string is a serialized object:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "a:1:{s:3:"foo";s:3:"bar";}"
  Encoded::isSerialized($string);
  // returns true</pre>
</figure>

Check to see if string is a a serialized object will return false if not:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "{"foo":"bar"}"
  Encoded::isSerialized($string);
  // returns false</pre>
</figure>

## unpackSerialized

Decodes a JSON array from string

{% highlight php %}Encoded::unpackSerialized($string){% endhighlight %}

### Example

Decode a serialized object:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = "a:1:{s:3:"foo";s:3:"bar";}"
  Encoded::unpackSerialized($string);
  // returns ["foo" => "bar"]</pre>
</figure>

## isBase64

Check to see if a string is a base64 encoded string or not. <span class="highlight inline br"><span class="nd">This is experimental!</span></span>

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = base64_encode("a:1:{s:3:"foo";s:3:"bar";}")
  Encoded::isBase64($string);
  // returns true</pre>
</figure>

## unpackBase64

Unpack a base64 encoded string. <span class="highlight inline br"><span class="nd">This is experimental!</span></span>

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Encoded

  $string = base64_encode("hello world")
  Encoded::unpackBase64($string);
  // returns "hello world"</pre>
</figure>
