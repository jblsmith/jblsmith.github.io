---
layout: post
title: "Towards richer descriptions of structure: two new articles accepted to ISMIR"
---

Earlier this summer, both articles I worked on were accepted to this year's ISMIR conference. Last weekend I submitted the camera-ready copies for both of them, which I'm sharing now.

They are very different papers, but they both start with the same problem: structural annotations do not capture the richness of music.

In the first paper, we estimate richer descriptions of music by analyzing the repetition structure of individual instrument parts within a song. This requires combining structure analysis with source separation.

> **Details:** "Multi-part pattern analysis: Combining structure analysis and source separation to discover intra-part repeated sequences." By Jordan B. L. Smith and Masataka Goto. To appear in *Proceedings of the International Society for Music Information Retrieval Conference*. 2017. [PDF]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis.pdf), [BIB]({{ site.assetsurl }}/smith2017-ismir-multi_part_pattern_analysis.bib)
>
> **Abstract:** Structure is usually estimated as a single-level phenomenon with full-texture repeats and homogeneous sections. However, structure is actually multi-dimensional: in a typical piece of music, individual instrument parts can repeat themselves in independent ways, and sections can be homogeneous with respect to several parts or only one part. We propose a novel MIR task, multi-part pattern analysis, that requires the discovery of repeated patterns within instrument parts. To discover repeated patterns in individual voices, we propose an algorithm that applies source separation and then tailors the structure analysis to each estimated source, using a novel technique to resolve transitivity errors. Creating ground truth for this task by hand would be infeasible for a large corpus, so we generate a synthetic corpus from MIDI files. We synthesize audio and produce measure-by-measure descriptions of which instruments are active and which repeat themselves exactly. Lastly, we present a set of appropriate evaluation metrics, and use them to compare our approach to a set of baselines.

In the second paper, the goal is to take a structural analysis by a listener and gain some extra insight into it:
did they indicate a given section break because of a change in harmony, or rhythm, instrumentation?
We validate a technique for estimating this information.

> **Details:** "Automatic interpretation of music structure analyses: A validated technique for post-hoc estimation of the rationale for an annotation." By Jordan B. L. Smith and Elaine Chew. To appear in *Proceedings of the International Society for Music Information Retrieval Conference*. 2017. [PDF]({{ site.assetsurl }}/smith2017-ismir-automatic_interpretation_of_music.pdf), [BIB]({{ site.assetsurl }}/smith2017-ismir-automatic_interpretation_of_music.bib)
>
> **Abstract:** Annotations of musical structure usually provide a low level of detail: they include boundary locations and section labels, but do not indicate what makes the sections similar or distinct, or what changes in the music at each boundary. For those studying annotated corpora, it would be useful to know the rationale for each annotation, but collecting this information from listeners is burdensome and difficult. We propose a new algorithm for estimating which musical features formed the basis for each part of an annotation. To evaluate our approach, we use a synthetic dataset of music clips, all designed to have ambiguous structure, that was previously used and validated in a psychology experiment. We find that, compared to a previous optimization-based algorithm, our correlation-based approach is better able to predict the rationale for an analysis. Using the best version of our algorithm, we process examples from the SALAMI dataset and demonstrate how we can augment the structure annotation data with estimated rationales, inviting new ways to research and use the data.

