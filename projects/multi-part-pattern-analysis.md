---
layout: page
title: Multi-part pattern analysis
permalink: /projects/multi-part-pattern-analysis/
class: project_page
---

[PDF]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis.pdf), [BIB]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis.bib), [Poster]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis-poster.pdf)
: Smith, J. B. L., and M. Goto. 2017. Multi-part pattern analysis: Combining structure analysis and source separation to discover intra-part repeated sequences. *Proceedings of the International Society for Music Information Retrieval Conference*. Suzhou, China. 716--23.

In typical songs, different instrument parts repeat at different times with different patterns. These patterns are evident in the score, but can we discover all of these independent patterns from audio recordings? In this work, we:

- [lay out a framework for this ambitious new problem](#defining-the-problem),
- propose [a method for solving it](#estimating-a-description),
- propose [a method for generating data](#generating-ground-truth),
- and present [a framework for evaluating our performance](#evaluating-performance).

The system does not perform very well yet, but through our efforts we learned a lot about the sparseness of the problem we posed.

###  Defining the problem

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

### Estimating a description

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


### Generating ground truth

There are no large collections of music annotated at this level of detail, labelling every measure in every instrument part. However, we can generate adequate ground truth from collections of scores.

We used multi-channel MIDI files from the [Lakh MIDI dataset](https://colinraffel.com/projects/lmd/), and processed them in the manner below:

<div class="project_img" style="width: 50%"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig4.png"></div>

1. Obtain a MIDI piano roll for each channel.
2. Use annotated measure boundaries to create a measure-indexed SSM.
> The similarity of two measures is the total area of notes in the piano rolls that overlap, normalized to the total note area.
3. Eliminate transitivity errors using the same method from above.
> Cut-offs of 90–95% similarity led to almost zero transitivity errors.

With this procedure, from any MIDI file we chose we could generate ground truth multi-part descriptions, and also synthesize stereo audio to be processed by our algorithm.

### Evaluating performance

<div class="project_img" style="width: 60%; float: right;"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig8.png"></div>

For a given song, we compare each estimated part to each part in the ground truth, and report the score for the best permutation; this is highlighted in the figure at right. Note that since there are 7 ground truth parts (the rows) and only 6 predicted parts (the columns), our method immediately has a performance ceiling lower than 0.857 for this song (still "While My Guitar Gently Weeps"!).

Each pair of parts is compared using a conventional metric: [pairwise retrieval f-measure metric](https://craffel.github.io/mir_eval/#mir_eval.segment.pairwise). The metric treats the live pixels in the binary-valued ground truth SSM as a set of (pairwise) similarity relationship to retrieve, and measures the overlap between the predicted and ground truth sets. In the figure, the live pixels are black.

However, in structure analysis, the pixels on the main diagonal are all guaranteed to be live, and so we exclude them from the analysis. But in our case, the main diagonal can be 0-valued if that instrument isn't playing. So, we have to decide whether to count them or not.

Below, we plot the pairwise f-measure (pwf) as well as precision (pwp) and retrieval (pwr) for the proposed algorithm and three alternative approaches. We plot them for two choices of the metric: ignoring the main diagonal (left) and counting the main diagonal (right).

<div class="project_img" style="width: 60%;"><img src="{{ site.baseurl }}/projects/multi-part-pattern-analysis/fig10.png"></div>

Note that all methods assume 6 parts. Our method (in blue) tries to estimate these parts independently; the other methods just make a single estimate and copy it into 6 parts.

Some observations:

- Comparing off-main-diagonal only (at left) is akin to evaluating "repetition detection" quality.
- Comparing on-main-diagonal (at right) also evaluates "instrument activity detection" quality.
- Our method (in blue) was never the top method for any metric!
- Our method, skipping the source-separation (in green), is the best overall at detecting repetitions (at left).
- Baseline #2 (in red) presumes no repetitions at all, so it fares the worst at detecting them (at left)...
- ... but is the best method if we include the main diagonal (at right).
	- In fact, since it achieves a retrieval (pwr) of almost 50%, we can see that the number of off-diagonal pixels in the ground truth is only about the number of on-diagonal pixels... i.e., the ground truth is incredibly sparse!

We conclude that we ought to search for an alternative approach! Since the chroma-based repetition detection is working well already (method in green), we should focus on improving the source separation quality. We are doing blind source separation, but we ought to do something more targeted---for example: try to detect the instruments in the mixture and separate out each one in a semi-supervised way.
