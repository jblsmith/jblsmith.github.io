---
layout: page
title: Music video classification
permalink: /projects/music-video-classification/
class: project_page
---

[PDF]({{ site.assetsurl }}/smith2017-icme-classifying_derivative_works.pdf), [BIB]({{ site.assetsurl }}/smith2017-icme-classifying_derivative_works.bib), [Poster]({{ site.assetsurl }}/smith2017-icme-classifying_derivative_works-poster.pdf), [Data Repository](https://github.com/jblsmith/icme2017)
:	Smith, J. B. L., M. Hamasaki, and M. Goto. 2017. Classifying derivative works with search, text, audio and video features. *Proceedings of the International Conference on Multimedia and Expo*. Hong Kong, China. 1428--33.

For every video posted by a famous musician on YouTube, you can find thousands of derivative works: cover songs, remixes, clips from live performances, lyric videos, and more. However, YouTube's text-based search isn't perfect: while it's usually possible to deduce the content of a video from its title, some titles are misleading, and some search results don't seem to match the query. So, we developed a system that could discover and classify derivative works automatically.

The algorithm pipeline is shown below. We process each song/artist query separately. After collecting as many potential derivative works as we can find (top), we extract (at left):

- search features (based on the ranks in the different keyword searches)
- text features (the title words filtered through a topic model)
- video features (a bag of standard features for classification, as well as any automatically detectable text)

<div class="project_img"><img src="{{ site.baseurl }}/images/music_video-figure_1.jpg" alt="Algorithm pipeline" style="width: 400px;"/></div>

Using these features, we make an initial guess about the video's audio content (AC) and video content (VC). Then, with a short list of audio exemplars for each category (i.e., our most confidently-labeled examples), we can compute audio features. We propose a novel set of features that express how an audio file is related to others:

<div class="project_img"><img src="{{ site.baseurl }}/images/music_video-figure_2.jpg" alt="Audio feature description" style="width: 400px;"/></div>

With this system in place, we can offer new ways of discovering music to users, such as <a href="http://songrium.jp/">Songrium, "a planetarium of music."</a> In Songrium, each original song is a star, and all of its derivatives are planets orbiting that star. You can explore derivatives according to category, travel between stars related by artist, and watch visualizations of each song along with the music video. [Our updated algorithm is currently being integrated into the <a href="http://yt.songrium.jp/map/">YouTube portion of Songrium</a>.]