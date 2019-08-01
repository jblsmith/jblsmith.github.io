---
layout: post
title: Street View Movie Maker
---

I finished another hobby project last week: a Google Street View Movie Maker! I have long thought that it would be nifty to be able to preview any route on Google Maps as a video. It would be easy to accomplish by concatenating Street View images; the main challenge is to acquire said images automatically.

Here's an example of what I wanted:

<iframe width="560" height="315" src="https://www.youtube.com/embed/puzhsLtn8AQ" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

It's the output of my system when asked to drive along Copacabana beach. For fun, I added the opening bars of Senor Coconut's "Neon Lights (Cha Cha Cha)".

## Project origin

I was inspired to work on this project as a way to give back to the band [Hollerado](http://hollerado.com),
who wrote a song just for me (and for the other 110 folks who bought the deluxe album package).
Since my song was centred on a driving metaphor, I thought a Street-View-generated "road movie" would make a good music video.

I first attempted to solve the problem in 2017. The main steps were straightforward:

1. Compute the route and get GPS points.
2. For each point, compute the heading (compass direction) to the next point.
3. Download the corresponding Street View images.
4. Concatenate images into a video.

Steps 1, 3 and 4 were easily coded, but I got bogged down trying to get step 2 working well. It was an important but finnicky problem. I hacked together an ugly solution that seemed good enough, and put the project on the shelf for a while.

When Hollerado announced this year that they were retiring, I revisited the project. With fresh eyes (and fresh StackOverflow searches), I finally found the formula to compute the heading exactly; the resulting videos were much straighter, and could be made faster.

I also prevented the system from downloading errant non-Street View images by specifying source attributes. Images had to be:

- taken outdoors (no shop interiors!);
- taken by Google (no user-uploaded panoramas!);
- taken within 10 meters of the specified GPS point, instead of the default 50 (no images slightly down side streets!).

The new output can still be disjointed---when the route goes under a bridge, for example, the system is liable to shuffle together images from above and below---but it's much cleaner than before. Here's an example of an old video I made along Santa Monica boulevard, and a new one from the same route, shown together:

<iframe width="560" height="315" src="https://www.youtube.com/embed/Li9-ntnLo8g?rel=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

The newer version has eliminated lots of the errant images that made the original so disjointed, so it ends earlier.

## Next steps

There are lots of features I'm eager to add:

**Make turns smoother.** When the route turns a corner, there's a hard cut in the video since the images don't align at all. One simple way to mitigate this: instead of pointing the camera to the next step on the route, we can point it a few steps ahead, so the camera will anticipate the turn. Another option: at each corner in the route, manually "rotate" the camera.

**Allow camera instructions.** If the goal is to generate a music video, we may occasionally want expressive camera movements: e.g., pan upwards for a while, or rotate, or anything else.

**Smooth the video.** At 24 fps and with unique Street View images located roughly 10 metres apart, there isn't a simple way to take videos at less than 864 km/hr. Can we make the video slower by smoothing it out with intermediate images? I spend a while trying to figure out how to do this by zooming into one image while fading into the next, but it was hacky and ugly. Video smoothing algorithms exist, but they may not work for images as different as these can be. The choppiness may be unavoidable, given that adjacent images are often taken on different days, in different seasons or from different lanes.

But most importantly: I need to make that video for Hollerado!

<blockquote class="twitter-tweet"><p lang="und" dir="ltr">Yes!</p>&mdash; Hollerado (@hollerado) <a href="https://twitter.com/hollerado/status/1155483361193930758?ref_src=twsrc%5Etfw">July 28, 2019</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
