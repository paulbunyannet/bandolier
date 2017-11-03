---
layout:     default
title:      "Numbers"
date:       2017-11-03
categories: helpers
---

# Numbers

* [divisible](#divisible)
* [toFloat](#tofloat)
* [toWord](#toword)


## divisible

Checks to see if two a number is divisible by another

{% highlight php %}Numbers::divisible($number, $divisibleBy){% endhighlight %}

### Example

Check if number is divisible by another

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Numbers
  Numbers::divisible(100, 2);
  // Returns TRUE</pre>
</figure>

Check if number is not divisible by another

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Numbers
  Numbers::divisible(10, 3);
  // Returns FALSE</pre>
</figure>


## toFloat

Convert a string number into a float

{% highlight php %}Numbers::toFloat($num){% endhighlight %}

### Example

Get value from array by key:

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Arrays
  $num = '1.999,369€';
  var_dump(Numbers::toFloat($num)); // float(1999.369)
  $otherNum = '126,564,789.33 m²';
  var_dump(Numbers::toFloat($otherNum)); // float(126564789.33)</pre>
</figure>

## toWord

Convert a number into a word

{% highlight php %}Numbers::toWord($number){% endhighlight %}

### Example

Convert a number to words

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Numbers
    echo Numbers::toWord(123456789);
    // Returns one hundred and twenty-three million, four hundred and
    // fifty-six thousand, seven hundred and eighty-nine
    echo Numbers::toWord(123456789.123);
    // Returns one hundred and twenty-three million, four hundred and
    // fifty-six thousand, seven hundred and eighty-nine point one two three
    echo Numbers::toWord(-1922685.477);
    // Returns negative one million, nine hundred and twenty-two
    // thousand, six hundred and eighty-five point four seven seven

</pre>
</figure>

Float rounding can be avoided by passing the number as a string
<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Numbers
    echo Numbers::toWord(123456789123.12345); // rounds the fractional part
    // Returns one hundred and twenty-three billion, four hundred and
    // fifty-six million, seven hundred and eighty-nine thousand,
    // one hundred and twenty-three point one two
    echo Numbers::toWord('123456789123.12345'); // does not round
    // Returns one hundred and twenty-three billion, four hundred and
    // fifty-six million, seven hundred and eighty-nine thousand,
    // one hundred and twenty-three point one two three four five
    </pre>