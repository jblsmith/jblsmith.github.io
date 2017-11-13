---
layout: page
title: Projects
permalink: /projects/
---

<style type="text/css">
  blockquote {
    font-style: normal;
	padding-top: 5px;
	padding-bottom: 5px;
  }
</style>

### Multi-dimensional views of music structure (2017)
Music structure is typically viewed as a one-dimensional phenomenon: each point in time is assigned a single label, which tells you which other points in the music are similar and which are different. However, musical structure is richer than that: different instrument parts can set up independent patterns of repetition; and different musical attributes, like melody, harmony and timbre, can be salient at different times. The following research projects explore these broader views of music structure.

> ### [Multi-part pattern analysis (2017)]({{ site.baseurl }}/projects/multi-part-pattern-analysis/)
> <a class="project_icon" href="{{ site.baseurl }}/projects/multi-part-pattern-analysis/"><img src="{{ site.baseurl }}/images/thumbnail_multipart.png" /></a>
> In typical songs, different instrument parts repeat at different times with different patterns. These patterns are evident in the score, but can we discover all of these independent patterns from audio recordings? We lay out a framework for this ambitious new problem, including methods for solving it, generating data, and evaluating our performance. The results so far are underwhelming, but through our efforts we learned a lot about the sparseness of the problem we posed.
>
> ### [Estimating feature relevance, updated (2017)]({{ site.baseurl }}/projects/automatic-interpretation/)
> <a class="project_icon" href="{{ site.baseurl }}/projects/automatic-interpretation/"><img src="{{ site.baseurl }}/images/thumbnail_validating.png" /></a>
> We [previously proposed a method]({{ site.baseurl }}/projects/feature-relevance/) for estimating what musical attributes someone was paying attention to when they analyzed a piece of music. We make several improvements to that algorithm, validate it using the sound examples from the <a href="{{ site.baseurl }}/projects/attention-grouping/">Attention and Grouping project</a>, and present a novel way to visualize the results.

### [Music video classification (2017)]({{ site.baseurl }}/projects/music-video-classification/)
<a class="project_icon" href="{{ site.baseurl }}/projects/music-video-classification/"><img src="{{ site.baseurl }}/images/thumbnail_musicvideo.png" /></a>
We present a method of classifying videos found online according to what type of derivative work they are: covers, remixes, dance performances, lyric videos, and so on. By combining search, text, audio and video features, we are able to classify videos more accurately than a method based on YouTube search results alone.

### [CrossSong puzzle (2015)](https://staff.aist.go.jp/jun.kato/CrossSong/)
<a class="project_icon" href="https://staff.aist.go.jp/jun.kato/CrossSong/"><img src="{{ site.baseurl }}/images/thumbnail_crosssong.png" /></a>
Combining the fun of mash-ups with the challenge of logic puzzles, we present CrossSong: a music-based puzzle game in which the goal is to recognize the component parts of mash-ups. The player sees a grid of tiles, each containing a mash-up between two songs, and  must rearrange them so that the tiles in each row and each column contain parts of the same song. The goal of the project was to make a fun game, but our research contributions include an algorithm for finding an optimal combination of mashups, and a user evaluation. Project page includes a link to the playable game!

### [PhD thesis (2014)]({{ site.baseurl }}/projects/phd-thesis/)
<a class="project_icon" href="{{ site.baseurl }}/projects/phd-thesis/"><img src="{{ site.baseurl }}/images/thumbnail_phd.png" /></a>
My PhD thesis considered listener disagreements in the analysis of musical structure, and looked at the issue from a number of viewpoints in different disciplines: music information retrieval, music theory and music perception and cognition. The following four projects comprised the main chapters:

> #### [Attention and grouping (2014)]({{ site.baseurl }}/projects/attention-grouping/)
> <a class="project_icon" href="{{ site.baseurl }}/projects/attention-grouping/"><img src="{{ site.baseurl }}/images/thumbnail_attention.png" /></a>
> We tested whether the focus of a listener could affect their perception of structure. In an online listening study, we found that by manipulating someone's attention, whether overtly or obliquely, we could influence the salience of boundaries and the structural groupings they prefered.
> 
> #### [Estimating feature relevance (2013)]({{ site.baseurl }}/projects/feature-relevance/)
> <a class="project_icon" href="{{ site.baseurl }}/projects/feature_relevance/"><img src="{{ site.baseurl }}/images/thumbnail_relevance.png" /></a>
> We propose a method for estimating what musical attributes someone was paying attention to when they analyzed a piece of music. The goal is to find a correlation between a recording and a listener's annotation of it. We used a simple quadratic programming algorithm and obtained some interesting section-by-section maps of pieces.
> 
> #### [Boundaries and novelty (2012)]({{ site.baseurl }}/projects/boundaries-novelty/)
> <a class="project_icon" href="{{ site.baseurl }}/projects/boundaries-novelty/"><img src="{{ site.baseurl }}/images/thumbnail_boundaries.png" /></a>
> How well does acoustic novelty account for boundary indications in an annotated corpus? We looked at how peaks in novelty (at various timescales and in various musical features) correlated with boundary indications. We found that novelty is a necessary but not sufficient condition for being a boundary.
> 
> #### [Listener disagreements (2012)]({{ site.baseurl }}/projects/listener-disagreements/)
> <a class="project_icon" href="{{ site.baseurl }}/projects/listener-disagreements/"><img src="{{ site.baseurl }}/images/thumbnail_listeners.png" /></a>
> How can two people listen to the same music, but disagree about its structure? In this case study co-authored by Isaac Schankler, we tried to trace the evolution of analytical disagreements to understand their origin. We analyzed the same pieces of music, and then thoroughly compared our justifications for our analyses when they disagreed. The disagreements seemed to boil down to differences in attention, prior knowledge and expectation. We published the article in *Music Theory Online*, which meant we could include all the relevant audio files, videos and illustrations.

### [MIREX meta-analysis (2013)]({{ site.baseurl }}/projects/mirex-meta-analysis/)
<a class="project_icon" href="{{ site.baseurl }}/projects/mirex-meta-analysis/"><img src="{{ site.baseurl }}/images/thumbnail_mirexmeta.png" /></a>
After several years of running the evaluations of structural analysis at MIREX, what can we learn about which evaluation metrics are useful, which are redundant, and which songs are hardest to analyze? This ISMIR paper focused on these questions. The work was published as "[open research](https://en.wikipedia.org/wiki/Open_research)", meaning that all the tools and data used to produce the article are provided in a public repository.

### [Master's thesis (2010)]({{ site.baseurl }}/projects/masters-thesis/)
<a class="project_icon" href="{{ site.baseurl }}/projects/masters-thesis/"><img src="{{ site.baseurl }}/images/thumbnail_masters.png" /></a>
For my Master's thesis, submitted in August 2010, I conducted a comparative evaluation of a handful of algorithms that produce formal analyses of music on a diverse set of corpora, including a new corpus of public domain music.

### [SALAMI (2010)](http://ddmal.music.mcgill.ca/research/salami/)
<a class="project_icon" href="http://ddmal.music.mcgill.ca/research/salami/"><img src="{{ site.baseurl }}/images/thumbnail_salami.png" /></a>
The Structural Analysis of Large Amounts of Music Information (SALAMI) project is a multi-national effort to produce a corpus of analyses of hundreds of thousands of pieces of music. I oversaw the first phase of this project: the creation of a huge ground truth dataset. As part of my work, I developed and tested a novel annotation format, evaluated and hired annotators, oversaw months of data collection and presented the data at ISMIR 2011. I continue to manage and develop the dataset, which was released to the public in February 2012. It's [available now on GitHub](https://github.com/DDMAL/salami-data-public).
