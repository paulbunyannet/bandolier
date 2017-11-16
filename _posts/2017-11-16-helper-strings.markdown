---
layout:     default
title:      "Strings"
date:       2017-11-16
categories: helpers
---

# Strings

* [wordsToNumber](#wordstonumber)

## wordsToNumber

Convert words to numbers

{% highlight php %}Strings::wordsToNumber($string){% endhighlight %}

### Example

Convert "one million one hundred thousand one hundred and one" to a number

<figure class="highlight">
  <pre class="prettyprint lang-php linenums">
  use \Pbc\Bandolier\Type\Strings
  Strings::wordsToNumber("one million one hundred thousand one hundred and one");
  // Returns 1100101.0</pre>
</figure>