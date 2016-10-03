---
layout: page
title: Master's thesis
permalink: /projects/masters-thesis/
class: project_page
---

## A comparison and evaluation of approaches to the automatic formal analysis of musical audio

- [Full text PDF]({{ site.baseurl }}/documents/smith2010-masters_thesis.pdf), [BIB]({{ site.baseurl }}/documents/smith2010-masters_thesis.bib)
- Presented as a poster to the joint AMS/SMT 2010 Annual Meeting. [Poster PDF]({{ site.baseurl }}/documents/smith2010-smt-comparison_and_evaluation-poster.pdf).

I conducted a comparative evaluation of a handful of algorithms that produce formal analyses of music on a diverse set of corpora, including a new corpus of public domain music. In the same spirit, all of the evaluation data (including the full output of each algorithm) is available too.

### Abstract

Analyzing the form or structure of pieces of music is a fundamental task for music theorists. Several algorithms have been developed to automatically produce formal analyses of music. However, comparing these algorithms to one another and judging their relative merits has been very difficult, principally because the algorithms are usually evaluated on separate data sets, consisting of different songs or representing wholly different genres of music, and methods of evaluating the performance of these algorithms have varied significantly. As a result, there has been little benchmarking of performance in this area of research. This work aims to address this by directly comparing several music structure analysis algorithms.

Five structure analysis algorithms representing a variety of approaches have been executed on three corpora of music, one of which was newly assembled from freely distributable music. The performance of each algorithm on each corpus has been measured using each of an extensive list of performance metrics.

### Audio and annotation data

The evaluation used:

- The Beatles dataset, a standard collection of all the band's album recordings, with structural annotations by [TUT](http://www.cs.tut.fi/sgn/arg/paulus/structure.html), [UPF](http://www.dtic.upf.edu/~perfe/annotations/sections/license.html) and [QMUL](http://www.isophonics.net/content/reference-annotations-beatles), all based on [annotations by Allan Pollack](http://www.icce.rug.nl/~soundscapes/DATABASES/AWP/awp-notes_on.shtml);
- The [Popular Music Database](https://staff.aist.go.jp/m.goto/RWC-MDB/rwc-mdb-p.html) of the [RWC collection](http://staff.aist.go.jp/m.goto/RWC-MDB/), with [annotations](http://staff.aist.go.jp/m.goto/RWC-MDB/AIST-Annotation/) also created by RWC;
- Two new sets of jazz and classical music assembled and annotated for this thesis.

This last corpus contains entirely public domain (and hence freely shareable) pieces downloaded from the [Internet Archive](http://www.archive.org/details/audio). The audio and annotations can both be  [accessed on GitHub](https://github.com/jblsmith/ma-thesis).

### Evaluation data

The output of the five algorithms on all of the audio files in the above corpora are also available to downnload at [the same GitHub link](https://github.com/jblsmith/ma-thesis).
