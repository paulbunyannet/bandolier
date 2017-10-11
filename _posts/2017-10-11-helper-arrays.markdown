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

Use a default list of attributes and pass in overriding attributes if there is a key from the attributes array in the defaults array.

{% highlight php %}Arrays::defaultAttributes(array $defaults = [], array $attributes = []){% endhighlight %}

### Example

Replace key from defaults with one found in the attributes:

{% highlight php %}
  use \Pbc\Bandolier\Type\Arrays
  $defaults = ["foo" => "bar", "bazz" => "bin"];
  $attributes = ["bazz" => "green"];
  Arrays::defaultAttributes($defaults, $attributes);
  // Returns ["foo" => "bar","bazz" => "green"]
{% endhighlight %}

Key from attributes was not found in defaults so the defaults will be returned:

{% highlight php %}
  use \Pbc\Bandolier\Type\Arrays
  $defaults = ["foo" => "bar", "bazz" => "bin"];
  $attributes = ["some" => "unknown key"];
  Arrays::defaultAttributes($defaults, $attributes);
  // Returns ["foo" => "bar","bazz" => "bin"]
{% endhighlight %}


## getAttribute

Get an value from array by key. if none was found use a default.

{% highlight php %}Arrays::getAttribute(array $data, $attribute = null, $default = null){% endhighlight %}

### Example

Return value from array by key:

{% highlight php %}
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $attribute = "foo"
  Arrays::getAttribute($list, $attribute);
  // Returns "bar"
{% endhighlight %}


Return default value if key is not found:

{% highlight php %}
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $attribute = "red"
  Arrays::getAttribute($list, $attribute, "default");
  // Returns "default"
{% endhighlight %}


## getKey

Get an key from array by value. if none was found use a default.

{% highlight php %}getKey(array $data, $value, $default=null){% endhighlight %}

### Example

Return key from array by value:

{% highlight php %}
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $value = "bar"
  Arrays::getKey($list, $value);
  // Returns "foo"
{% endhighlight %}


Return default value if value is not found:

{% highlight php %}
  use \Pbc\Bandolier\Type\Arrays
  $list = ["foo" => "bar", "bazz" => "bin"];
  $value = "red"
  Arrays::getKey($list, $value, "default");
  // Returns "default"
{% endhighlight %}


<!-- You'll find this post in your `_posts` directory - edit this post and re-build (or run with the `-w` switch) to see your changes!
To add new posts, simply add a file in the `_posts` directory that follows the convention: YYYY-MM-DD-name-of-post.ext.

Jekyll also offers powerful support for code snippets:

{% highlight ruby %}
def print_hi(name)
  puts "Hi, #{name}"
end
print_hi('Tom')
#=> prints 'Hi, Tom' to STDOUT.
{% endhighlight %}

Check out the [Jekyll docs][jekyll] for more info on how to get the most out of Jekyll. File all bugs/feature requests at [Jekyll's GitHub repo][jekyll-gh].

[jekyll-gh]: https://github.com/mojombo/jekyll
[jekyll]:    http://jekyllrb.com -->
