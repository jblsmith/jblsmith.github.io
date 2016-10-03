---
layout: page
title: Boundaries and novelty
permalink: /projects/boundaries-novelty/
class: project_page
---

- Published as "Audio properties of perceived boundaries in music" in *IEEE Transactions on Multimedia.*
- [PDF (pre-print)]({{ site.assetsurl }}/smith2014-ieee-audio_properties.pdf), [BIB]({{ site.assetsurl }}/smith2014-ieee-audio_properties.bib). Published version available at [IEEE Xplore](http://ieeexplore.ieee.org/xpl/articleDetails.jsp?arnumber=6762890).
- A version of this work was also presented at DMRN ([Slides]({{ site.assetsurl }}/smith2012-dmrn-boundaries_and_novelty-slides.pdf)).

Structural annotations of music are commonly viewed as two separate layers of information: a set of boundary locations that define a sequence of timespans, and a set of labels to describe these timespans. Algorithms that predict structure often rely on a novelty-based model: they take one or more audio features, compute a sort of derivative (the amount of change occuring as a function of time), and pick the points where the greatest changes occurred. But although the association between novelty and boundaries is well-founded in the music perception literature, does novelty in fact correlate with structural changes?

This paper reports on an evaluation that set out to determine how well novelty and boundaries correlate. We took a large set of audio features, computed very basic rate-of-change features (giving us "novelty functions"), and using a large portion of the SALAMI dataset, tested how well the peaks in the novelty functions correlated with the actual boundaries. The method we used was deliberately straightforward: given a novelty function, we picked the 10 highest peaks, with the single heuristic that two peaks should not be closer than 6 seconds. Many more heuristics could be added, but we wanted to test the relationship between novelty and boundary perception as directly as possible.

We first asked very basic questions: were the boundaries more novel than the non-boundaries? As you can see below, yes, somewhat. The simple algorithm achieved a median boundary f-measure of 0.32 (bottom bar). But if we used the same novelty-based algorithm to try to predict a completely random set of points that were not labelled as boundaries, the median f-measure was 0.18 (2nd from the bottom). (That's using a grading theshold of 3 seconds; if you cut that down to 0.5 seconds, both rates drop; see upper bars.)

<div class="project_img"><a href="{{ site.baseurl }}/images/boundaries_novelty-figure_1.png"><img src="{{ site.baseurl }}/images/boundaries_novelty-figure_1.png" alt="Figure 1" style="width: 400px;"/></a></div>

This means that, according to our evaluation method, novelty points to boundaries only about twice as effectively as random points.

Does the effectiveness of novelty depend on any attributes of the annotation itself? We tested whether this increase in effectiveness (from 0.18 to 0.32) varied significantly among annotators or genres of music. Among the 9 SALAMI annotators there was little difference; the relationship between novelty and boundary indications does not seem to depend on the person. However, there are relatively large differences in genre: while novelty was a good boundary indicator in popular music, it was a much worse indicator in classical music.

<div class="project_img">
	<a href="{{ site.baseurl }}/images/boundaries_novelty-figure_2c.png"><img src="{{ site.baseurl }}/images/boundaries_novelty-figure_2a.png" alt="Figure 2a" style="width: 330px;"/></a>
	<a href="{{ site.baseurl }}/images/boundaries_novelty-figure_2d.png"><img src="{{ site.baseurl }}/images/boundaries_novelty-figure_2b.png" alt="Figure 2b" style="width: 330px;"/></a>
</div>

This means that, according to our evaluation method, novelty points to boundaries only about twice as effectively as random points.

Does the effectiveness of novelty depend on any attributes of the annotation itself? We tested whether this increase in effectiveness (from 0.18 to 0.32) varied significantly among annotators or genres of music. Among the 9 SALAMI annotators there was little difference; the relationship between novelty and boundary indications does not seem to depend on the person. However, there are relatively large differences in genre: while novelty was a good boundary indicator in popular music, it was a much worse indicator in classical music.

<div class="project_img">
	<a href="{{ site.baseurl }}/images/boundaries_novelty-figure_2c.png"><img src="{{ site.baseurl }}/images/boundaries_novelty-figure_2c.png" alt="Figure 2c" style="width: 330px;"/></a>
	<a href="{{ site.baseurl }}/images/boundaries_novelty-figure_2d.png"><img src="{{ site.baseurl }}/images/boundaries_novelty-figure_2d.png" alt="Figure 2d" style="width: 330px;"/></a>
</div>

Are there any boundaires that don't match any novelty peaks at all? It turns out, yes: about 7% of the boundaries didn't match any of the 35 novelty functions. (This drops to about 4% if we disregard "symmetric" boundaries, those that lie between sections with identical labels; e.g., the "boundary" between two sections both labelled as "chorus.") By comparison, nearly a quarter of all non-boundaries failed to match any novelty function. However, if a point coincides with only one or two novelty peaks, that point is still unlikely to be a boundary. It's only when 10 or more novelty peaks coincide that it becomes more likely than not that the point is a boundary. The more strong peaks that coincide, the more these odds increase: nearly all points that match at least 20 of the 35 novelty functions were not boundaries.

<div class="project_img"><a href="{{ site.baseurl }}/images/boundaries_novelty-figure_3.png"><img src="{{ site.baseurl }}/images/boundaries_novelty-figure_3.png" alt="Figure 3" style="width: 400px;"/></a></div>

Based on this result, we may conclude that acoustic novelty is a necessary (roughly 95% of the time) but insufficient (roughly 50% of the time) condition to consider a point in a time a structural boundary.

This finding may be a heartening confirmation for those whose structure estimation algorithms use novelty functions to estimate a set of candidate boundary points that is assumed to be a superset of all boundaries. But it is also interesting because it seems to extend some previous findings: Bruderer, McKinney and Kohlrausch (2009, Musicae Scientae) found that boundary salience tended to correlate with boundary indications, and we have found that boundary indications tend to correlate with acoustic novelty. Hence, it seems likely that novelty correlates with salience as well.