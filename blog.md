---
layout: default
---

<div class="posts">
  {% for post in site.posts %}
    <article class="post">

      <h1><a href="{{ site.baseurl }}{{ post.url }}">{{ post.title }}</a></h1>

      <div class="entry">
        {{ post.excerpt }}
      </div>

      <a href="{{ site.baseurl }}{{ post.url }}" class="read-more">Read More</a>
    </article>
  {% endfor %}
</div>

# [Tumblr](http://jblsmith.tumblr.com)

For more blogging, check out my [Tumblr feed](http://jblsmith.tumblr.com). It's mostly pictures of food and mildly interesting things. Here's an example post:

<div class="tumblr">
	<script type="text/javascript" src="http://jblsmith.tumblr.com/js?start=0&num=1"></script>
</div>