---
layout: post
title: Getting SALAMI from YouTube
---

In 2011, a team of us at McGill released the [SALAMI dataset](https://github.com/DDMAL/salami-data-public) of structural annotations of lots of music; it was the largest dataset of its kind at the time, and still is.
Unfortunately, it has never been easy for other researchers to obtain the audio data: we can provide all the metadata required to identify the tracks, but we don't own the music so we can't sell it.

However, this year at ISMIR, after chatting with yet another industry researcher who hoped I could share the audio, a workaround occurred to me: why not let YouTube share the audio?
If I could confirm which SALAMI tracks were available in which YouTube videos, then others could download the audio themselves.

Over the past two weeks I have put together a quick project to do exactly that. It's still in progress, but with a few simple searches and fingerprinting efforts, I managed to find matches for at least half the audio in SALAMI.

[Visit the project repository on GitHub here.](https://github.com/jblsmith/matching-salami)

Some notes on how it works:

### Step 1: Fingerprinting

I used [Dan Ellis' audfprint package](https://github.com/dpwe/audfprint) using the default settings to do the fingerprinting.

Using audfprint, I made a database of all the public SALAMI tracks (which is currently 7/8ths of the total annotated set). [This database is part of the repo](https://github.com/jblsmith/matching-salami/blob/master/salami_public_fpdb.pklz), so anyone can check an audio file in their possession against it using audfprint to confirm that they have the correct audio.

- audfprint uses the standard Shazam algorithm, which I knew would miss versions that had been time-stretched or pitch-shifted to avoid YouTube's copyright detection algorithms. For example, it did not detect that [this song](https://www.youtube.com/watch?v=bXvMJzgP1OQ) sounds like a perfect match for SALAMI song 20.
- I briefly tested Joren Six's Panako package, which promised to detect matches despite changes in tempo or pitch, but it did not appear to work as such out of the box.

### Step 2: Querying YouTube

I used the [YouTube API library for python](https://developers.google.com/youtube/v3/quickstart/python) to query YouTube using the artist, composer and title for every track. (For some tracks, "artist" or "composer" were unavailable.)

Then I used [youtube-dl](https://rg3.github.io/youtube-dl/) to download the first search result whose length roughly matched the length of the audio file in the database (±20%).

- I first used [pytube](https://github.com/nficano/pytube) to download youtube files, which is definitely lightweight and simple, but it ran into lots of errors downloading some files.
- A nice advantage of youtube-dl is that it allowed me to specify a consistent post-processing routine; in my case, converting all the videos to 192kbps mp3 using ffmpeg.
- To get the length of a local mp3 file, I used [mutagen](https://mutagen.readthedocs.io/en/latest/), which was very simple to use and which seems to not run into any errors due to variable bit rates --- that wasn't an issue for the audio on YouTube, but was for some of the local SALAMI audio files!
- I guess I forgot that librosa has a [get_duration method](https://librosa.github.io/librosa/generated/librosa.core.get_duration.html)!

### Step 3: Matching audio

All that remains is to use audfprint to query the database with the downloaded audio, and interpret the output to decide if the audio matches.

- This step might have been simpler if I had stuck with using [dataset](https://dataset.readthedocs.io/en/latest/) to manage my list of downloaded youtube files, but I scrapped that, opting instead for a plaintext CSV file. Writing your own in-out routines leaves plenty of room for error --- like accidentally overwriting all your work! --- but has the advantage of dead-simple human editing. I wanted that, so that I could add YouTube IDs by hand for the system to download and check later.

### Results

After these 3 steps, I found matching audio on YouTube for:

- 452 / 833 tracks from [Codaich](http://jmir.sourceforge.net/index_Codaich.html)
- 29 / 49 tracks from [Isophonics](http://isophonics.net/datasets)
- 0 / 100 tracks from [RWC](https://staff.aist.go.jp/m.goto/RWC-MDB/)

I didn't expect to find any of the RWC audio, and anyway, that's [available for purchase directly from AIST](https://staff.aist.go.jp/m.goto/RWC-MDB/#how_to_use).

Matches were found for 3/5ths of the Isophonics data, but that is also easily purchased since it all derives from the Beatles catalogue and another 4 albums (comprising 7 discs).

Most importantly, the system found 54% of the Codaich audio, which I was pleased with for a first pass! I only had high hopes for finding the popular music, but actually there were plenty of matches in each genre class:

- 158 / 210 popular tracks
- 138 / 205 jazz tracks
- 56 / 217 classical tracks
- 100 / 201 world music tracks

### Future steps

The information is [up on GitHub](https://github.com/jblsmith/matching-salami) as of today for anyone to use, but I have a few obvious next steps to take before I can call this project finished:

1. Find the rest of the audio --- perhaps by re-running the system but using additional metadata fields, like album title.
2. Add convenience scripts for others, to:
	1. Download the audio from YouTube
	2. Zero-pad / crop the audio to fit the timing of the SALAMI annotations.
