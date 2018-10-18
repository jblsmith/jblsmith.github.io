---
layout: page
title: Loop extraction with nonnegative tensor factorization
permalink: /projects/nonnegative-tensor-factorization/
class: project_page
---

[PDF]({{ site.assetsurl }}/smith2018-icassp-nonnegative_tensor_factorization.pdf), [BIB]({{ site.assetsurl }}/smith2018-icassp-nonnegative_tensor_factorization.bib), [Slides]({{ site.assetsurl }}/smith2018-icassp-nonnegative_tensor_factorization-slides.pdf)
: Smith, J. B. L., and M. Goto. 2018. Nonnegative tensor factorization for source separation of loops in audio. *Proceedings of the IEEE International Conference on Acoustics, Speech and Signal Processing*. Calgary, AB, Canada. 171--5.

Lots of music --- especially pop and electronic music --- is based around loops. We propose a way to identify and extract the loops that occur in a song, and to provide a map of the piece, all in a single optimization! To do so, we use nonnegative tensor factorization.

The main steps of the procedure are:

1. Convert the spectrogram for a song into a tensor that we call the "spectral cube".
2. Find the Tucker decomposition of the tensor; this gives the layout of the song.
3. Unfold the tensor one slice at a time to reconstruct the separate sources.

### 1. Building the spectral cube

We start by computing the spectrogram for a song. Below is the spectrogram for the song [El Pico by Ratatat](https://www.youtube.com/watch?v=IchOgSt_I3I).

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig1.png"></div>

Instead of factorizing the spectrogram directly, which is the typical approach, we first estimate the downbeats of the song (using [Madmom](https://github.com/CPJKU/madmom)), and divide the song into separate bars.

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig2.png"></div>

Now we can stack the windows in a third dimension:

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig3.png" height="200px"></div>

Now we have a solid 3D volume---a "spectral cube"---and we can factorize *this* to analyze the song.

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig4.png" height="200px"></div>

Why would it benefit us to factorize the spectral cube instead of the spectrogram? Factorization is all about discovering redundancies in the signal and using them to compress it. E.g., steady-state notes can be expressed more compactly as a single note template repeating in time; that's what basic [nonnegative matrix factorization (NMF)](https://en.wikipedia.org/wiki/Non-negative_matrix_factorization) takes advantage of. Some notes may have similar templates, but shifted in frequency; that's what shift-invariant NMF aims to exploit.

In our case, we note that musical signals repeat not just by arbitrary shifts in time and frequency (the dimensions of the spectrogram), but in a deliberately periodic way with respect to the beats and downbeats---i.e., the third dimension of our spectral cube. By factorizing the spectral cube, we can exploit these redundancies.

#### Visualizing the cube

To understand the spectral cube, it helps to visualize it more fully.

How can we visualize a 3D volume? To look inside a person's head, radiologists might use a CAT scan, capturing many 2D cross-sections of the head and concatenating them into a video.

These slices can be taken along any dimension; below are CAT scans taken (1) back to front, (2) left to right, and (3) bottom to top.

<img src="{{ site.baseurl }}/projects/ntf/cat_scan_backtofront.gif" width="30%"> <img src="{{ site.baseurl }}/projects/ntf/cat_scan_lefttoright.gif" width="30%"> <img src="{{ site.baseurl }}/projects/ntf/cat_scan_bottomtotop.gif" width="30%">

Similarly, we can look at cross sections of our spectral cube along any dimension. Below are three views of El Pico, taken:

1. From start to finish of piece (from bar 1 to the end of the piece)
2. From start to finish of a bar (from beat 1 to the end of the bar)
3. From low to high frequency (from the lowest C on a piano, [CQT](https://librosa.github.io/librosa/generated/librosa.core.cqt.html) bin 1, to the highest B, CQT bin 84)

<img src="{{ site.baseurl }}/projects/ntf/elpico_X_db.gif" width="30%"> <img src="{{ site.baseurl }}/projects/ntf/elpico_Y_db.gif" width="30%"> <img src="{{ site.baseurl }}/projects/ntf/elpico_Z_db.gif" width="30%">


### 2. Tensor factorization


<!-- In basic NMF for audio source separation, the signal spectogram *X* is decomposed into *W*, a set of spectral templates (notes), and *H*, a set of activation functions (to indicate when in the piece each note occurs).

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig5.png"></div> -->

The [Tucker decomposition](https://en.wikipedia.org/wiki/Tucker_decomposition) is a way to compress a 3D dataset. As seen in the diagram below, it decomposes the spectral cube (of dimension *M*x*N*x*Q*) into three separate sets of 2D templates (*W, H* and *D*), and a small "core tensor" (*C*). Taking the outer product of the core tensor with each of the templates returns an approximation of the original spectral cube. To estimate the Tucker decomposition, we use [TensorLy](https://github.com/tensorly/tensorly).

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig6.png"></div>

What's nice about this approach is that all the templates *W*, *H* and *D* have intuitive musical meanings.

- *W*: Each column represents the spectrum of a note, just as with regular NMF.
- *H*: Each row shows when a note is active within a bar---i.e., it's a single rhythm.
- *D*: Each row is a pattern of loop activations---i.e., when in the piece each loop plays.

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig7.png"></div>

Thus, *D* is a direct estimate of the structural layout of a piece, showing when each loop of each type appears. This is seen in the example above, where *D* clearly matches the original layout, shown in colour.

What are the "types" of loops? That's what the core tensor is for: it has one row per note, one column per rhythm, and one layer per loop type (see example below). Thus, each layer is a kind of loop "recipe", showing what notes to include with what rhythms.

<div class="project_img"><img src="{{ site.baseurl }}/projects/ntf/fig8.png"></div>

This is different from typical NMF, which estimates a signal in terms of note templates *W* and activation functions *H*, but where each column of *W* is paired with a single row of *H*. The core tensor is a kind of "mixing cube" that allows the loops to share note and rhythm patterns. This is important because it is not the rhythms and notes that are unique to each loop, but the way they are combined.


### 3. Source separation

Once the Tucker decomposition has been estimated, we already have a layout of the piece. To actually separate out the individual tracks, we simply multiply the estimated templates together with the core tensor---but only keeping the layer of the core tensor we want to use---and then re-arrange the spectral cube back into a 2D spectrogram. Then we can convert that estimated spectrum back into an audio signal.

Here is an example of a set of source loops and versions of them automatically separated from a mixture:
	
- Bass: <a href="{{ site.baseurl }}/projects/ntf/125_acid_bass.mp3">original</a>, <a href="{{ site.baseurl }}/projects/ntf/acid_est_bass.mp3">estimated</a>
- Melody: <a href="{{ site.baseurl }}/projects/ntf/125_acid_melody.mp3">original</a>, <a href="{{ site.baseurl }}/projects/ntf/acid_est_melody.mp3">estimated</a>
- Drums: <a href="{{ site.baseurl }}/projects/ntf/125_acid_drums.mp3">original</a>, <a href="{{ site.baseurl }}/projects/ntf/acid_est_drums.mp3">estimated</a>
- FX: <a href="{{ site.baseurl }}/projects/ntf/125_acid_fx.mp3">original</a>, <a href="{{ site.baseurl }}/projects/ntf/acid_est_fx.mp3">estimated</a>

This is an example of mixed success: the first three estimated loops match the bass, melody and drums quite well, but the fourth estimated loop is more like an amalgam of the bass, melody and FX.

The audio examples are borrowed from [a paper by Patricio López-Serrano](https://www.audiolabs-erlangen.de/resources/MIR/2016-ISMIR-EMLoop).


<!--convert cat_scan_backtofront_tmp.gif -crop 472x472+14+0 +repage -coalesce -resize 200x200 -fuzz 2% +dither -layers Optimize +map cat_scan_backtofront.gif
convert cat_scan_bottomtotop_tmp.gif -coalesce -resize 200x200 -fuzz 2% +dither -layers Optimize +map cat_scan_bottomtotop.gif
convert cat_scan_lefttoright_tmp.gif -coalesce -resize 200x200 -fuzz 2% +dither -layers Optimize +map cat_scan_lefttoright.gif

convert elpico_X_db_tmp.gif -coalesce -fuzz 2% +dither -layers Optimize +map elpico_X_db.gif
convert elpico_Y_db_tmp.gif -coalesce -fuzz 2% +dither -layers Optimize +map elpico_Y_db.gif
convert elpico_Z_db_tmp.gif -coalesce -fuzz 2% +dither -layers Optimize +map elpico_Z_db.gif -->
