---
layout: post
title: Two articles accepted to ICASSP
---

In my last year at AIST, I worked on two projects related to nonnegative factorization, and both have been accepted to ICASSP! Even better, each will be delivered at an oral session.

The first one deals with a way to literally "de-compose" a song comprised of loops into source-separated tracks corresponding to each loop, as well as a map of which loops are activated, and when. To accomplish this, we propose a novel reconfiguration of the spectrogram into a "spectral cube", which allows us to use nonnegative tensor factorization to model the song as a combination of note, rhythm and loop templates.

> **Details:** "Nonnegative tensor factorization for source separation of loops in audio." By Jordan B. L. Smith and Masataka Goto. In *Proceedings of the IEEE International Conference on Acoustics, Speech and Signal Processing (ICASSP).* 2018.
>
> **Abstract:** The prevalence of exact repetition in loop-based music makes it an opportune target for source separation. Nonnegative factorization approaches have been used to model the repetition of looped content, and kernel additive modeling has leveraged periodicity within a piece to separate looped background elements. We propose a novel method of leveraging periodicity in a factorization model: we treat the two-dimensional spectrogram as a three-dimensional tensor, and use nonnegative tensor factorization to estimate the component spectral templates, rhythms and loop recurrences in a single step. Testing our method on synthesized loop-based examples, we find that our algorithm mostly exceeds the performance of competing methods, with a reduction in execution cost. We discuss limitations of the algorithm as we demonstrate its potential to analyze larger and more complex songs.

I advised on and helped write the second paper, which concerns a method of structure analysis devised by Tian Cheng. She  decomposes self-similarity matrices (SSMs) in a clever way using non-negative matrix factor 2-D deconvolution (NMF2D). Enhancing the *stripes* of an SSM (which show repeated sequences) is generally easier than enhancing the *blocks* (which show homogenous repeated blocks)---but it is also easier to *interpret* the structure of a song from a block-enhanced SSM. Cheng proposes a way to use NMF2D to model a stripe-enhanced SSM as a set of "blocks" of repetition-types; her method thus combines the clarity of stripe structure and the ready interpretability of block structure.

> **Details:** "Music structure boundary detection and labelling by a deconvolution of path-enhanced self-similarity matrix." By Tian Cheng, Jordan B. L. Smith and Masataka Goto. In *Proceedings of the IEEE International Conference on Acoustics, Speech and Signal Processing (ICASSP).* 2018.
>
> **Abstract:** We propose a music structure analysis method that converts a path-enhanced self-similarity matrix (SSM) into a block-enhanced SSM using non-negative matrix factor 2-D deconvolution (NMF2D). With a non-negative constraint, the deconvolution intuitively corresponds to the repeated stripes in the path-enhanced SSM. Then the block-enhanced SSM is constructed without any clustering technique. We fuse block-enhanced SSMs obtained using different parameters, resulting in better and more robust results. Discussion shows that the proposed method can be a potential tool for analysing music structure at different scales.

We have just submitted the camera-ready versions, and I'm really looking forward to presenting them at my first ICASSP.