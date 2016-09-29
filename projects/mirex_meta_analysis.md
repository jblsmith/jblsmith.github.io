---
layout: page
title: MIREX Meta-analysis
permalink: /projects/mirex_meta_analysis/
class: project_page
---

- Published as "A meta-analysis of the MIREX Structural Segmentation task" in *Proceedings of the International Society for Music Information Retrieval Conference.*
- Article [PDF]({{ site.assetsurl }}/smith2013-ismir-mirex_meta_analysis.pdf), [BIB]({{ site.assetsurl }}/smith2013-ismir-mirex_meta_analysis.bib), [Poster]({{ site.assetsurl }}/smith2013-ismir-mirex_meta_analysis-poster.pdf)
- [Code Repository](https://github.com/jblsmith/mirex-meta-analysis)

The [Music Information Retrieval Evaluation eXchange (MIREX)](http://www.music-ir.org/mirex/) is a competitive benchmark test that runs every year in association with ISMIR. The datasets are kept anonymous to preserve their usefulness as test data, but when parts of it are made public (as was the case with the Structural Segmentation task in 2012), we can learn a lot about algorithm performance.

In the Structural Segmentation task, algorithms take songs as input, estimate where segment boundaries are (e.g., the borders between the verses and choruses), and try to group the segments correctly (e.g., label all the choruses the same).

Structural segmentations are evaluated using a host of metrics, summarized well by [Lukashevich](http://ismir2008.ismir.net/papers/ISMIR2008_219.pdf), but many are designed to measure the same thing. The first question we can ask is: do the metrics behave as expected? In the figure below, we see the average correlation between a set of metrics that are supposed to measure three different things. Assuming they do, we expect the values within the boxes to be high. Instead, we can observe that the metric "Rand", in the first group, behaves more like the metrics in the third group. From this and other similar plots in the article, we confirmed the redundancy of some metrics and cast suspicion on the stability of others.

<div class="project_img"><img src="{{ site.baseurl }}/images/mirex_meta-figure_1.png" alt="Figure 1" style="width: 400px;"/></div>

By correlating these metrics with properties of the ground truth, we can address a second question: does the success of an algorithm depend on any properties of the annotation or the music? Among other observations, we found that song length and segment length were correlated for annotations (i.e., longer songs have longer segments), but not for algorithms' estimates. It seems that listeners tend to interpret a roughly equal number of sections per song, whereas algorithms tend to give segments a consistent length across songs.

<div class="project_img"><img src="{{ site.baseurl }}/images/mirex_meta-figure_2.png" alt="Figure 2" style="width: 400px;"/></div>

Finally, one of the more contentious questions we could address with this data is: are some datasets harder to analyze than others? We found that performance was higher on the Beatles dataset than on others. The Beatles dataset is one of the most oft-used datasets in structural segmentation research, so this finding is evidence that the community may be tailoring their research too much to suit the Fab Four.

<div class="project_img"><img src="{{ site.baseurl }}/images/mirex_meta-figure_3.png" alt="Figure 3" style="width: 400px;"/></div>

In the spirit of open data and open research, a repository of the all of the scripts used to produce these results are [available to download here](https://github.com/jblsmith/mirex-meta-analysis). Running that code should reproduce the figures in the article exactly.