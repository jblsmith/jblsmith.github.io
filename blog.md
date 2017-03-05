---
layout: default
---

<div class="posts">
  {% for post in site.posts %}
    <article class="post">

      <h1><a href="{{ site.baseurl }}{{ post.url }}">{{ post.title }}</a></h1>
	  <div class="date">
	    {{ post.date | date: "%B %e, %Y" }}
	  </div>

      <div class="entry">
        {{ post.excerpt }}
      </div>

      <a href="{{ site.baseurl }}{{ post.url }}" class="read-more">Read More</a>
    </article>
  {% endfor %}
</div>

# [Tumblr](http://jblsmith.tumblr.com)

For more blogging, check out my [Tumblr feed](http://jblsmith.tumblr.com). It's mostly pictures of food and mildly interesting things. Here's a <a href="http://jblsmith.tumblr.com/post/150523049139/a-few-days-after-visiting-mcdonalds-i-got-a">typical post from September 2016</a> about a burger that's dear to my heart:

<div class="tumblr">
	<img src="http://68.media.tumblr.com/b26b0092ae0c130677f6373f71f95757/tumblr_odmssfK7ST1r1e96ko1_1280.jpg">
	<p>A few days after visiting McDonald’s, I got a much, much, much better tsukimi burger at 0298 Burger. See that gorgeously crisped layer above the cheese? That’s a perfectly fried egg. Simply mouthwatering.</p>
	<p>I feel bad implying that there’s a comparison to be made between the McDonald’s food-like product and this work of art, but so be it.</p>
	<p>I keep expecting the burgers at 0298 Burger to not be as delicious as the last time, but it hasn’t worn off at all. On this visit, I brought a friend and introduced him to the restaurant. His appetite helped drive the point home. After having an avocado cheese burger, he considered the menu again and ordered a blue cheese burger. As he waited for it, he had second thoughts (seconds thoughts?), but then it arrived, and he bit into it, and it was just as delicious as the first burger. He finished it quickly.</p>
	<p>You know how when you’re having a steak, the meat can lose its oomph after a few bites, and you need either a pinch of salt or a swig of red wine to refresh your palette? I’m sure the folks at 0298 recognized and addressed this problem because they sell a perfect burger where every bite is as good as the first.</p>
	<!-- <script type="text/data" src="http://jblsmith.tumblr.com/js?start=0&num=1"></script> -->
</div>