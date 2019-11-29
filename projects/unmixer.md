---
layout: page
title: Unmixer
permalink: /projects/unmixer/
class: project_page
---

<h2 style="margin-top:-15px">An interface for extracting and remixing loops</h2>

<h4 style="text-align: center"><a href="https://unmixer.ongaaccel.jp/">Link to Unmixer</a></h4>

[PDF]({{ site.assetsurl }}/smith2019-ismir-unmixer_interface.pdf), [BIB]({{ site.assetsurl }}/smith2019-ismir-unmixer_interface.bib), [Slides]({{ site.assetsurl }}/smith2019-ismir-unmixer_interface-slides.pdf), [Poster]({{ site.assetsurl }}/smith2019-ismir-unmixer_interface-slides.pdf).
: Smith, J. B. L., Y. Kawasaki, and M. Goto. 2019. Unmixer: An interface for extracting and remixing loops. *Proceedings of the International Society for Music Information Retrieval Conference*. 824--831. Delft, NL.

### Remixing is hard

Have you ever tried to make a remix or mashup of a song? There's a lot of overhead at the start: you need to decide which sounds you want to re-use, find them, cut them out and save as separate files, and load them into the software (called a [DAW](https://en.wikipedia.org/wiki/Digital_audio_workstation)) that you'll use to make the remix.

But in a typical song, all the samples are inextricably mixed: the synth melody you hope to re-use can't easily be separated from the drum loops, bass lines, and other sounds that occur at the same time.

What if there were a way to automatically "de-compose" a song and isolate the ingredients used to compose it? That's what [Unmixer](https://unmixer.ongaaccel.jp/) aims to do!

[Unmixer](https://unmixer.ongaaccel.jp/) gives users a way to extract loops from any song and start remixing and mashing them up with other songs right away.

### Interface

<img src="unmixer-screenshot.png" style="width:60%; display:block; float: right; margin: 0 0 0 2em">

We aimed for a simple interface that anyone would quickly understand.

Casual users can take advantage of the "Quick Start" option that loads up some demo samples extracted from Creative-Commons-licensed music.

Expert users may want more controls like equalizers, but we felt that anyone wanting to produce a remix or mashup would rather download them and treat them offline in their favourite DAW anyway.

That said, we're exploring ways to give users more control, including different-size loops, keyboard controls, and some basic equalization---stay tuned! (If you have any suggestions, feel free to [email us](mailto:unmixer-ml@aist.go.jp).)

### How it works

It's a 4-step process, but about 90% of the magic happens in step 3. Throughout, we use the Daft [Punk song "Doin' it Right" (featuring Panda Bear)](https://www.youtube.com/watch?v=LL-gyhZVvx0) as our test song.

> NB: I don't own the copyright to this song! I am including very short audio excerpts here for educational purposes only.

**Step 1: estimate the downbeats.** If you can count along to a song ("1, 2, 3, 4, 1, 2, ..."), the downbeats are the 1s. It's easy for people to do this, but reliable algorithms for estimating downbeats have only recently become available. We use [madmom](https://madmom.readthedocs.io/en/latest/modules/features/downbeats.html).

<img src="step_1.png" style="width:70%; display:block; margin: 0 auto">

**Step 2: compute the spectrogram and stack into a "spectral cube".** The spectrogram is a 2D representation of the signal that shows frequency vs. time in piece:

<img src="step_2_a.png" style="width:100%; display:block; margin: 0 auto">

We snip the spectrogram at each downbeat boundary (the dotted lines), and then stack these 2D slices into a 3D volume, also called a *tensor*. The tensor has dimensions frequency vs. time *in bar* vs. *bar* in piece.

<img src="step_2_b.png" style="width:80%; display:block; margin: 0 auto">

By the way, we use [librosa](https://librosa.github.io/) for handling the audio.

**Step 3: compute the non-negative Tucker decomposition.** This is the magic part!

A typical technique to compress the information in a matrix or tensor is called [factorization](https://en.wikipedia.org/wiki/Non-negative_matrix_factorization). In the case of a 2D matrix, this amounts to finding a small set of "template" columns that you can copy/paste out to recreate the matrix.

The non-negative Tucker decomposition (NTD) models our 3D tensor (freq. x time x bar) as 3 matrices---sound templates, rhythm templates, and loop templates---and a *core tensor* that tells us how to multiply these templates together.

<img src="step_3.png" style="width:80%; display:block; margin: 0 auto">

This is the slowest part of the algorithm, so we're investigating ways to speed it up. But the compression can be very efficient: in this case, our model is around 1/100th the size of the original spectral cube. We compute the NTD with [TensorLy](http://tensorly.org/stable/index.html).

**Step 4: extract the loops.** This is done by multiplying out the NTD one loop at a time. To see how this works, consider loop template #13, represented by the 13th slice of the core tensor:

<img src="step_3_loop_13.png" style="width:50%; display:block; margin: 0 auto">

This slice is a "recipe" for the loop: it's a matrix where each element (*n,m*) tells us to take the *n-th* sound, have it play with the *m-th* rhythm, and to add the result to the loop.

Multiplying the core tensor slice with the rhythm and sound templates thus generates a spectrum we can listen to: (click the image to hear the sound)
<img src="step_3_loop_13_multiplication.png" style="width:90%; display:block; margin: 0 auto" onClick="document.getElementById('audio_play_12').play(); return false;">

Lastly, the loop template tell us when these loops should occur in the piece. In the case of loop #13, it is repeated for 3 separate spans of the piece, highlighted below:

<img src="step_3_loop_13_activation.png" style="width:60%; display:block; margin: 0 auto">

But we don't actually have to use this information now. We've reconstructed the loop audio, and it's ready to be inserted into the Unmixer interface!

Here's a sound board of all the main loops of "Doin' it Right": clicking any loop triggers that sound, and the stop sign pauses anything.

<audio id="audio_play_0"><source src="./doin_it_right_loops/isolated_loop_mask_0.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_1"><source src="./doin_it_right_loops/isolated_loop_mask_1.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_2"><source src="./doin_it_right_loops/isolated_loop_mask_2.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_3"><source src="./doin_it_right_loops/isolated_loop_mask_3.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_4"><source src="./doin_it_right_loops/isolated_loop_mask_4.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_5"><source src="./doin_it_right_loops/isolated_loop_mask_5.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_6"><source src="./doin_it_right_loops/isolated_loop_mask_6.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_7"><source src="./doin_it_right_loops/isolated_loop_mask_7.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_8"><source src="./doin_it_right_loops/isolated_loop_mask_8.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_9"><source src="./doin_it_right_loops/isolated_loop_mask_9.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_10"><source src="./doin_it_right_loops/isolated_loop_mask_10.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_11"><source src="./doin_it_right_loops/isolated_loop_mask_11.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_12"><source src="./doin_it_right_loops/isolated_loop_mask_12.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_13"><source src="./doin_it_right_loops/isolated_loop_mask_13.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_14"><source src="./doin_it_right_loops/isolated_loop_mask_14.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_15"><source src="./doin_it_right_loops/isolated_loop_mask_15.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_16"><source src="./doin_it_right_loops/isolated_loop_mask_16.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_17"><source src="./doin_it_right_loops/isolated_loop_mask_17.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_18"><source src="./doin_it_right_loops/isolated_loop_mask_18.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_19"><source src="./doin_it_right_loops/isolated_loop_mask_19.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_20"><source src="./doin_it_right_loops/isolated_loop_mask_20.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_21"><source src="./doin_it_right_loops/isolated_loop_mask_21.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_22"><source src="./doin_it_right_loops/isolated_loop_mask_22.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_23"><source src="./doin_it_right_loops/isolated_loop_mask_23.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_24"><source src="./doin_it_right_loops/isolated_loop_mask_24.mp3" type="audio/mpeg" /></audio>
<audio id="audio_play_25"><source src="./doin_it_right_loops/isolated_loop_mask_25.mp3" type="audio/mpeg" /></audio>

<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_0_spectrum.png" onClick="document.getElementById('audio_play_0').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_1_spectrum.png" onClick="document.getElementById('audio_play_1').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_2_spectrum.png" onClick="document.getElementById('audio_play_2').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_3_spectrum.png" onClick="document.getElementById('audio_play_3').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_4_spectrum.png" onClick="document.getElementById('audio_play_4').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_5_spectrum.png" onClick="document.getElementById('audio_play_5').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_6_spectrum.png" onClick="document.getElementById('audio_play_6').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_7_spectrum.png" onClick="document.getElementById('audio_play_7').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_8_spectrum.png" onClick="document.getElementById('audio_play_8').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_9_spectrum.png" onClick="document.getElementById('audio_play_9').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_10_spectrum.png" onClick="document.getElementById('audio_play_10').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_11_spectrum.png" onClick="document.getElementById('audio_play_11').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_12_spectrum.png" onClick="document.getElementById('audio_play_12').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_13_spectrum.png" onClick="document.getElementById('audio_play_13').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_14_spectrum.png" onClick="document.getElementById('audio_play_14').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_15_spectrum.png" onClick="document.getElementById('audio_play_15').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_16_spectrum.png" onClick="document.getElementById('audio_play_16').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_17_spectrum.png" onClick="document.getElementById('audio_play_17').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_18_spectrum.png" onClick="document.getElementById('audio_play_18').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_19_spectrum.png" onClick="document.getElementById('audio_play_19').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_20_spectrum.png" onClick="document.getElementById('audio_play_20').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_21_spectrum.png" onClick="document.getElementById('audio_play_21').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_22_spectrum.png" onClick="document.getElementById('audio_play_22').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_23_spectrum.png" onClick="document.getElementById('audio_play_23').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_24_spectrum.png" onClick="document.getElementById('audio_play_24').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./doin_it_right_loops/loop_25_spectrum.png" onClick="document.getElementById('audio_play_25').play(); return false;" />
<img style="width: 100px; margin-right: 5px; margin-bottom: 5px;" src="./stop_audio_button.png" onClick="document.getElementById('audio_play_0').pause(); document.getElementById('audio_play_1').pause(); document.getElementById('audio_play_2').pause(); document.getElementById('audio_play_3').pause(); document.getElementById('audio_play_4').pause(); document.getElementById('audio_play_5').pause(); document.getElementById('audio_play_6').pause(); document.getElementById('audio_play_7').pause(); document.getElementById('audio_play_8').pause(); document.getElementById('audio_play_9').pause(); document.getElementById('audio_play_10').pause(); document.getElementById('audio_play_11').pause(); document.getElementById('audio_play_12').pause(); document.getElementById('audio_play_13').pause(); document.getElementById('audio_play_14').pause(); document.getElementById('audio_play_15').pause(); document.getElementById('audio_play_16').pause(); document.getElementById('audio_play_17').pause(); document.getElementById('audio_play_18').pause(); document.getElementById('audio_play_19').pause(); document.getElementById('audio_play_20').pause(); document.getElementById('audio_play_21').pause(); document.getElementById('audio_play_22').pause(); document.getElementById('audio_play_23').pause(); document.getElementById('audio_play_24').pause(); document.getElementById('audio_play_25').pause();
return false;" />

That's the gist of it! This explainer leaves out some very important details, like how to use masking techniques to reconstruct the sources from the spectra, how to choose which instance of a loop to extract, and how to adjust the factorization to produce loops that aren't too similar. If you're interested, these details are all explained in our [ISMIR paper]({{ site.assetsurl }}/smith2019-ismir-unmixer_interface.pdf).

And of course, [visit our website to try out the Unmixer](https://unmixer.ongaaccel.jp/) yourself!