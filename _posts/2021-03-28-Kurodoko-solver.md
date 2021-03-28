---
layout: post
title: Kurodoko solver
---

I wrote a [**Kurodoko solving program**](https://github.com/jblsmith/kurodoko)! I'm rather pleased with it. Kurodoko is a puzzle genre invented by [Nikoli](https://www.nikoli.co.jp/en/puzzles/).

I have twice attempted to write code to solve Slitherlink puzzles---my favourite Nikoli puzzle type---but never gotten far. This time, I had two advantages:

1. Kurodoko is a much simpler puzzle type than Slitherlink. In Slitherlink, you have to worry about cells *and* edges; in Kurodoko, we only need to think about cells, so the code feels simpler. Also, the 'basic starting deductions' in Slitherlink feel more complex than in Kurodoko.

2. I was recently taught the practice of **Test-Driven Development**! In TDD, you do not write new code until you've written a test for it. This promotes complete test coverage, and, maybe more importantly for me, it encourages you to break the problem down into truly bite-sized requirements.

With these advantages and a fresh dose of enthusiasm (the result of cracking open a new Nikoli puzzle book), I was able to knock out a working Kurodoko solver in one weekend! Version 0.1 was only able to solve simple puzzles since it did not have the ability to search branches of the solution space, but I returned to the project on later weekends: v0.2 was able to make more deductions and could solve the [example puzzle by Cross-Plus-A](http://www.cross-plus-a.com/puzzles.htm#Kuromasu), and v0.3 could solve the [example puzzle on Wikipedia](https://en.wikipedia.org/wiki/Kuromasu) and recognize grids that are infeasible or unconstrained. The fact that I was able to continue development where I left off after weeks away, and make brisk progress, has impressed upon me the value of TDD.

The code can be viewed on the Github page: [Kurodoko Solver](https://github.com/jblsmith/kurodoko).

A few TODOs:

- Print grid images to PDF
- Test it out on a larger set of puzzles
- Make the deduction structure clearer and more efficient
- Genericise the project to handle similar puzzles? (Kurodoko seems almost isomorphic to the [Corral](http://www.cross-plus-a.com/puzzles.htm#Corral) type, and modelling Corral is a clear stepping stone to modelling Slitherlink.)
- Make a web app where users can design grids with an interface and run the solver on them to see if they're solvable?
