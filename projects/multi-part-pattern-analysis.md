---
layout: page
title: Multi-part pattern analysis
permalink: /projects/multi-part-pattern-analysis/
class: project_page
---

[PDF]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis.pdf), [BIB]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis.bib), [Poster]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis-poster.pdf)
: Smith, J. B. L., and M. Goto. 2017. Multi-part pattern analysis: Combining structure analysis and source separation to discover intra-part repeated sequences. *Proceedings of the International Society for Music Information Retrieval Conference*. Suzhou, China. 716--23.

In typical songs, different instrument parts repeat at different times with different patterns. These patterns are evident in the score, but can we discover all of these independent patterns from audio recordings? We lay out a framework for this ambitious new problem, including methods for solving it, generating data, and evaluating our performance. The system does not perform very well yet, but through our efforts we learned a lot about the sparseness of the problem we posed.

###  Multi-dimensional structure

Given a piece of music, what is its structure? What in it is repeated, and how is it organized? Many people in music information retrieval (MIR) would like to be able to answer this algorithmically.

However, although structure is complex, it is usually studied in a very simplified way. For example, below is [the annotation](https://github.com/DDMAL/salami-data-public/blob/master/annotations/1652/textfile1.txt) for The Beatles' song, "While My Guitar Gently Weeps".

<div class="project_img" style="width: 80%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig1a.png"></div>

The song has two section types---A and B---but the meaning of these labels is not clear. We know that the A and B sections are different from each other, but *how*? They could be different in terms of melody, harmony, instrumentation, function, etc. Similarly, there are many reasons why the A sections could be grouped together. Because there are so many dimensions to similarity, structure estimation is truly a multi-dimensional problem. 

As an example, here are four more descriptions of the same song above, illustrating different dimensions:

- At a shorter timescale:
<div class="project_img" style="width: 80%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig1b.png"></div>
- In terms of section function:
<div class="project_img" style="width: 80%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig1c.png"></div>
- In terms of leading instrument
<div class="project_img" style="width: 80%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig1d.png"></div>
- In terms of the repetitions that occur within each instrument part:
<div class="project_img" style="width: 80%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig3.png"></div>

This last aspect of structure is was what we aimed to estimate in this project: **multi-part pattern repetition**.

To explain the diagram further:

- Each row corresponds to a part played by a single instrument in the ensemble.
- Each measure has a letter label; two measures that are identical (or nearly so) get the same letter.
- Colours are assigned such that every letter gets a unique colour...
	- ...but, two labels X and Y get the same colour if Y *always* follows X and *only* follows X.
- Blank areas indicate when an instrument does not play; these have no label.

This information is derived from a MIDI file for the same song ("While My Guitar Gently Weeps") from the [Lakh MIDI dataset](https://colinraffel.com/projects/lmd/), which explains the unusual instrumentation (no, there's no shakuhachi in the original recording).

As this example shows, the multi-part pattern description of a piece is very complex, and much harder to estimate than a one-dimensional structure analysis. So, how can we do it?

### Estimating the description

Here is the basic pipeline for our algorithm:

<div class="project_img" style="width: 50%; float: right;"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig5.png" alt="System pipeline overview diagram, completely described in text"></div>

1. The system accepts stereo (2-channel) audio as input.
2. It performs left/right/centre channel source separation to obtain a 3-channel version fo the audio.
3. It performs harmonic-percussive source separation on each channel to obtain a 6-channel version.
> Why do this? Although this risks splitting individual instruments into two channels (e.g., by splitting up the percussive piano onsets from the sustained notes), we hope to do more good than harm in this step, separating chiefly-harmonic parts (violin, trumpet) from chiefly- or distinctly-percussive parts (drums, piano)
4. For each channel, we compute chroma features and from them a self-similarity matrix (SSM).
5. We threshold the SSMs to eliminate transitivity errors (i.e., situations where we estimate that X=Y and Y=Z but X≠Z).
6. A set of SSMs with no transitivity errors can be directly transformed into a multi-part description.

To do step 5, we introduced a novel method of enforcing transitivity: using *lexical sorting*, we transform repeating sequences (which appear in the SSM as diagonal lines) into blocks. This exposes transitivity errors as off-digaonal elements, which makes them easy to remove:

<div class="project_img" style="width: 60%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig6.png"></div>

To choose the best smoothing parameter and similarity threshold for each SSM, we try all possible paramter sets and choose the one that gives us the greatest coverage (observed similarity pairs) and the smallest strain (number of transitivity errors).

<div class="project_img" style="width: 60%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig7.png"></div>


### Defining the ground truth

There are no large collections of music annotated at this level of detail, labelling every measure in every instrument part. However, we can generate adequate ground truth from collections of scores.

We used multi-channel MIDI files from the [Lakh MIDI dataset](https://colinraffel.com/projects/lmd/), and processed them in the manner below:

<div class="project_img" style="width: 50%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig4.png"></div>

1. Obtain a MIDI piano roll for each channel.
2. Use annotated measure boundaries to create a measure-indexed SSM.
> The similarity of two measures is the total area of notes in the piano rolls that overlap, normalized to the total note area.
3. Eliminate transitivity errors using the same method from above.
> Cut-offs of 90–95% similarity led to almost zero transitivity errors.

With this procedure, from any MIDI file we chose we could generate ground truth multi-part descriptions, and also synthesize stereo audio to be processed by our algorithm.
