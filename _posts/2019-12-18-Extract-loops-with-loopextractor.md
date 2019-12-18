---
layout: post
title: Extract loops with loopextractor
---

I've just published a new resource: *loopextractor*,
an implementation of an algorithm described in our 2018 ICASSP paper ([details here]({{ site.baseurl }}/projects/nonnegative-tensor-factorization/))
that uses non-negative Tucker decomposition to model the loops in a song.

An [improved and extended version of this work]({{ site.baseurl }}/projects/unmixer/) was recently used to power our website [Unmixer](https://unmixer.ongaaccel.jp/), which was presented at ISMIR last month.

Because the ICASSP paper was written while I was employed at AIST, and the Unmixer website was developed in a later collaboration, I cannot share the code that I wrote for those projects.

But, I have now *rewritten* the algorithm (from the 2018 paper), and I am allowed to make *that* public! It's on Github as [loopextractor](https://github.com/jblsmith/loopextractor).

As the code makes clear, the steps are very straightforward: stripping away the comments and error checks,
it is only about 50 lines of code. Here's a 9-line pseudo-code version:

    # Load audio:
    signal, sample_rate = librosa.load(audio_file, mono=True)
    # Get downbeats from madmom:
    downbeat_times = get_downbeats(signal)
    # Compute spectrum for each downbeat period,
    # and stack into a cube:
    spec_cube = make_spectral_cube(signal, downbeat_times)
    # Get Tucker decomposition with TensorLy:
    core, factors = tensorly.non_negative_tucker(spec_cube,
        n_templates)
    # Reconstruct each loop:
    for i in range(n_loops:
        # Multiply templates to get modeled spectrum of loop:
        spectrum_i = factors[0] * factors[1] * core[:,:,i]
        # Choose the loudest instance of the loop:
        bar_i = find_loudest_bar(factors[2], spectrum_i)
        # Do soft-masking with librosa (to get phase):
        signal_i = mask_spectra(spectrum_i, spec_cube[:,:,bar_i])
        # Write audio:
        librosa.output.write_wav("output%i.wav" % i, signal_i)
