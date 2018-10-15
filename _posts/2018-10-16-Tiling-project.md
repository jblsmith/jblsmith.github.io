---
layout: post
title: Tiling project
---

I recently updated a hobby project of mine to Github. The goal was to make an image feed where all the images would have matching edges, but where these edges could evolve over time. I'd still like to tweak it and add new types of designs, but a version of it is finished!

As an exmple, here's the beginning of the blog. All the edges between tiles have an alternating black/white pattern, but the blog starts off with all-white edges along the bottom and bottom-right edges.

<img src="{{ site.baseurl }}/images/blog_excerpt_beginning.png/" alt="Poster showing the Tokyo 2020 Games logos, designed by Asao Tokolo" />

New images are added to the top left of the feed, shifting all the other tiles along in a 3-column format, just like a certain popular photo-sharing social network---but since that service doesn't have an API that allows robo-posting, I put the project on Tumblr instead! Please visit [random-tiles.tumblr.com](https://random-tiles.tumblr.com/).

I was inspired to work on this project when I learned about [Asao Tokolo](http://tokolo.com/)'s work on tiling. Tokolo [designed the winning pair of logos](http://www.spoon-tamago.com/2016/04/26/who-is-asao-tokolo-the-designer-behind-tokyos-2020-olympic-emblem/) for the Tokyo 2020 Olympic and Paralympic Games, but he is also known for creating a fun set of interlocking patterns which have appeared on [ceramic tiles, fridge magnets, and more](https://tmagazine.blogs.nytimes.com/2009/01/09/the-post-materialist-a-patterns-math-magic/). My hope is that some of the fun and beauty of Tokolo's arabesque design is captured by my blog.

In the future, I would like to achieve a look closer to Tokolo's designs by drawing actual arcs across each image instead of generating the images out of basic tiles, but, as [the sketch atop Tokolo's homepage](http://tokolo.com/img/RespectForCompass.gif) suggests, the simple, elegant look of his tiles hides lots of careful and subtle engineering and design work.

Links:

- [visit the blog](https://random-tiles.tumblr.com/) to see the images;
- [visit Github](https://github.com/jblsmith/tiling) to view the code and to get a sense of how it was made.
