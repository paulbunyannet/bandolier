---
layout:     default
title:      "Collection"
date:       2017-10-11
categories: helpers
---

# Collection

Simple collection class

## Methods

* [addItem](#additem)
* [setItem](#setitem)
* [getItem](#getitem)
* [keys](#keys)
* [length](#length)
* [keyExists](#keyexists)
* [deleteItem](#deleteitem)
* [getItems](#getitems)


## addItem

Add an item to the collection.

{% highlight php %}Collection::addItem($obj, $key = null){% endhighlight %}

### Example

Add an item to the collection:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection');
  $collection->getItems();
  // returns [0 => 'Item in collection']</pre>
</figure>

Add an item to the collection with a specific key:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->getItems();
  // returns ['foo' => 'Item in collection']</pre>
</figure>

## setItem

Update a item in the collection by key.

{% highlight php %}Collection::setItem($obj, $key = null){% endhighlight %}

### Example

Update item in the collection:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->setItem('Update to item in collection', 'foo');
  $collection->getItems();
  // returns ['foo' => 'Update to item in collection']</pre>
</figure>

## getItem

Get an item from the collection by key.

{% highlight php %}Collection::getItem($key){% endhighlight %}

### Example

Get an item from the collection:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->getItem('foo');
  // returns 'Item in collection'</pre>
</figure>

## keys

Get all the keys in the collection

{% highlight php %}Collection::keys(){% endhighlight %}

### Example

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->addItem('Another in collection', 'bar');
  $collection->keys();
  // returns ['foo', 'bar']</pre>
</figure>

## length

Get count of all the items in the collection.

{% highlight php %}Collection::length(){% endhighlight %}

### Example

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->addItem('Another in collection', 'bar');
  $collection->length();
  // returns 2</pre>
</figure>

## keyExists

Checks to see if a key exists in the collection.

{% highlight php %}Collection::keyExists($key){% endhighlight %}

### Example

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->addItem('Another in collection', 'bar');
  $collection->keyExists('foo');
  // returns true
  $collection->keyExists('bazz');
  // returns false</pre>
</figure>

## deleteItem

Delete an item from the collection.

{% highlight php %}Collection::deleteItem($key){% endhighlight %}

### Example

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->addItem('Another in collection', 'bar');
  $collection->deleteItem('foo');
  $collection->getItems();
  // returns ['bar' => 'Another in collection']</pre>
</figure>

## getItems

Get all items from a collection

{% highlight php %}Collection::getItems(){% endhighlight %}

### Example

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Collection

  $collection = new Collection();
  $collection->addItem('Item in collection', 'foo');
  $collection->addItem('Another in collection', 'bar');
  $collection->getItems();
  // returns ['foo' => 'Item in collection', 'bar' => 'Another in collection']</pre>
</figure>
