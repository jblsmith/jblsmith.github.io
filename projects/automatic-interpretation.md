---
layout: page
title: Automatic interpretation of structural analyses
permalink: /projects/automatic-interpretation/
class: project_page
---

[PDF]({{ site.assetsurl }}/smith2017-ismir-automatic_interpretation_of_music.pdf), [BIB]({{ site.assetsurl }}/smith2017-ismir-automatic_interpretation_of_music.bib), [Poster]({{ site.assetsurl }}/smith2017-ismir-automatic_interpretation_of_music-poster.pdf)
: Smith, J. B. L., and E. Chew. 2017. Automatic interpretation of music structure analyses: A validated technique for post-hoc estimation of the rationale for an annotation. *Proceedings of the International Society for Music Information Retrieval Conference*. Suzhou, China. 435--41.

### Motivation

Structural descriptions are usually single-dimensional, or perhaps hierarchical. Here is a two-level analysis of "Hello, Goodbye" by The Beatles:

<div class="center project_img" style="width: 80%">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig1.png">
</div>

This annotation tells us that sections <span style="color: red">**A**</span> and <span style="color: lime">**B**</span> are different—but what makes them different? Do listeners think <span style="color: lime">**B**</span> is defined by a harmonic or melodic progression, or by a timbre? What was the listener’s **rationale** when they decided on this interpretation?

Collecting this information from listeners is onerous, and the introspection required is difficult. Instead, we aim to **automatically interpret existing annotations** by comparing them to the audio.

If successful, we could visualize structure to see which musical attributes characterize each section, like so:

<div class="center project_img" style="width: 70%; horizontal-align=middle">"Hello, Goodbye" analysis<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig2.png"></div>

In the above figure, the *x*-axis is time (in seconds), and each row plots the importance of a given feature to the label of each section. Cells get brighter when a feature is:

1. homogenous throughout that section;
2. similar in other sections with the same label;
3. different in other sections with different labels.

### Data

Finding appropriate data is not trivial! To validate the algorithm, we need structural annotations **paired** with listener rationales.

We obtained the data in a [music perception study]({{ site.baseurl }}/projects/attention-grouping/): we composed stimuli with *intended* forms, each suited to *intended* rationales:

<div class="center project_img" style="width: 70%; horizontal-align=middle">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig3.png">
</div>

We also confirmed that listeners perceived these structure with the same rationales:

<div class="center project_img" style="width: 70%; horizontal-align=middle">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig4.png">
</div>

We have a large number of stimuli, in three styles, with either 3 parts (**<span style="color:blue">AA</span><span style="color:red">B</span>** vs. **<span style="color:blue">A</span><span style="color:red">BB</span>**) or 4 parts (**<span style="color:blue">AA</span><span style="color:red">BB</span>** vs. **<span style="color:blue">A</span><span style="color:red">B</span><span style="color:blue">A</span><span style="color:red">B</span>** vs. **<span style="color:blue">A</span><span style="color:red">BB</span><span style="color:blue">A</span>**).

### Algorithm

We compute self-similarity matrices (SSMs) from several **audio features**, each of which is assumed to correlate with a relevant musical attribute.

We generate **masked SSM segments**, each revealing the relationship of a segment to the rest of the piece.

Then, a **quadratic program** (QP) estimates coefficients to recreate the ground truth SSM from the masked segments. E.g.:

<div class="center project_img" style="width: 50%; horizontal-align=middle">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig5.png">
</div>

The example above has structure:

- **<span style="color:blue">A</span><span style="color:red">BB</span><span style="color:blue">A</span>** justified by timbre
- **<span style="color:blue">AA</span><span style="color:red">BB</span>** justified by rhythm
- **<span style="color:blue">A</span><span style="color:red">B</span><span style="color:blue">A</span><span style="color:red">B</span>** justified by harmony

The QP reconstructs the **<span style="color:blue">A</span><span style="color:red">B</span><span style="color:blue">A</span><span style="color:red">B</span>** interpretation (represented in the top left square) using only bass chroma.

The QP approach has clear limitations:

- If two musical attributes explain a section equally, the QP might only point to one. Instead, we can measure **correlation**.
- Sequences that are repeated but non-homogenous may be overlooked in a point-wise SSM comparison. Instead, we can use **segment-indexed** SSMs, or apply additional **stripe masking**.

<div class="center project_img" style="width: 80%; horizontal-align=middle">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig6.png">
</div>


### Validation

The suggested improvements all had a positive impact: the best algorithm used the stripe-masked SSMs, indexing by segment, and correlation instead of the QP output.

<div class="center project_img" style="width: 50%; horizontal-align=middle">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig7.png">
</div>

But accuracy varied among musical styles and features, as these confusion plots show:


<div class="center project_img" style="width: 90%; horizontal-align=middle">
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig8.png">
</div>

### Application

We can use the validated approach to analyze SALAMI annotations:

<div class="project_img" style="width: 100%">
	Analysis of "We Are The Champions" by Queen
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig9.png">
</div>

- <span style="color: red">**A**</span>: Harmonies stable, orchestration builds up &rarr; harmonies in a and b are unique across the piece.
- <span style="color: lime">**B**</span>: Complex chord sequence, stable timbre &rarr; timbre cannot explain individuated subsections.

Some analyses have prime markers. If we consider primed sections to be similar or different changes the interpretation.

<div class="project_img" style="width: 100%">
	Analysis of “Another One Bites The Dust”, by Queen:
	<img src="{{ site.baseurl }}/projects/automatic-interpretation/fig10.png">
</div>

- if **d**=**d&prime;**: Stable, stripped-down harmony throughout.
- if **d**≠**d&prime;**: Sections feature odd, varying sound effects.

### Previous work

This project follows up work previously published at two previous workshops:

[Slides]({{ site.assetsurl }}/smith2016-cogmir-validating_technique-slides.pdf)
:	Smith, J. B. L., and E. Chew. 12 August 2016. "Validating a technique for post-hoc estimation of a listener's focus in music structure analysis." Oral presentation at [CogMIR](http://www.cogmir.org/) (Cognitively Based Music Informatics Research), satellite event of the International Society for Music Information Retrieval Conference, New York, NY.

[Poster]({{ site.assetsurl }}/smith2015-mathemusical-validating-poster.pdf)
:	Smith, J. B. L., and E. Chew. 13 October 2015. "Validating an Optimisation Technique for Estimating the Focus of a Listener." Poster presentation at [Mathemusical Conversations](https://sites.google.com/site/mathemusicalconversations/program/poster-abstracts), Singapore.
