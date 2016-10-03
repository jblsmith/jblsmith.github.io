---
layout: page
title: Estimating feature relevance
permalink: /projects/feature-relevance/
class: project_page
---

- Published as "Using Quadratic Programming to estimate feature relevance in structural analyses of music" in *Proceedings of the ACM International Conference on Multimedia.*
- Article [PDF]({{ site.assetsurl }}/smith2013-acm-estimating_feature_relevance.pdf), [BIB]({{ site.assetsurl }}/smith2013-acm-estimating_feature_relevance.bib).
- Summary [Video](https://vimeo.com/77448578)

Self-similarity matrices (SSMs) show which portions of a given sequence are similar to each other, and hence are often used to visualize the structure of pieces of music. In particular, sections of a piece of music that are homogenous with respect to some feature (for example, having a consistent, distinct timbre) lead to blocks in SSMs. Researchers interested in estimating musical structure often exploit these blocks to do so. But in this project, we considered the inverse problem. Suppose we already know the structural analysis, as provided by a listener. Can we determine what audio features the listener was paying attention to by figuring out how to reconstruct their analysis using SSMs derived from audio features?

Here's how our approach works. We have a target SSM, the original annotation (see the figure below), which we are trying to build up using a set of SSMs derived from different features (in the figure, there are 5 of these). The segmentation indicated by the listener is provided, and so we can chop these feature-based SSMs into single-segment components. Our goal is to find the optimal sum of these components to reconstruct the target. This is a straightforward optimization problem that is solvable using quadratic programming, so we used that.

<div class="project_img"><img src="{{ site.baseurl }}/images/feature_relevance-figure_1.jpg" alt="Figure 1" style="width: 600px;"/></div>

When you solve it, you get something like the results below. (By the way, the figure above and below are for the Beatles song "Yellow Submarine", using an annotation from the SALAMI database [salami_id 1634].) The chart shows how much each feature's component contributed to the optimal sum for part of the piece. A feature will contribute highly if it explains how a given section is internally homogenous but contrasts more strongly with sections of other types.

<div class="project_img"><img src="{{ site.baseurl }}/images/feature_relevance-figure_2.jpg" alt="Figure 2" style="width: 400px;"/></div>

The results are interesting to parse. In this case, the pitch and loudness features explain most of the piece, but the timbre and tempo features explain two middle sections well. The tempo-heavy section is the sound effect laden "verse" of the song, and so makes a fitting oddball. The third section, which has the lowest height, was evidently not well explained by any feature; indeed, the last bit of this section has a number of sound effects, and so the section has low homogeneity and is not well explained using the "block" approach of the SSMs.

When listeners disagree, our method may point to reasons why they disagree. In the example below ("Garrotin", by Chago Rodrigo [salami_id 842]), there is only one major difference in the annotations, regarding the middle section. The reconstructions give opposing justifications: the first listener's analysis relates more on the consistency in pitch content, whereas the second listener's analysis relates to the contrast in rhythmic content. When listening to the piece, there is indeed a strong rhythmic contrast between the sections (although it's difficult to describe how the pitch is consistent).

<div class="project_img"><img src="{{ site.baseurl }}/images/feature_relevance-figure_3.jpg" alt="Figure 3" style="width: 600px;"/></div>
