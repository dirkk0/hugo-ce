---
title: "diff3d: ein Fehlersuchspiel mit unendlich vielen Levels"
date: 2026-06-01T11:00:00+02:00
draft: true
description: "diff3d ist unser Prototyp eines lockeren 3D-Fehlersuchspiels, bei dem jedes Level algorithmisch aus einem Seed generiert wird – ein theoretisch unendlicher Rätselpool, entwickelt mit Three.js."
# image: ../img/diff3d.png   # TODO: add a screenshot or GIF, then uncomment this line and the image below
tags: ['JavaScript', 'ThreeJS', 'Game', 'WebGL']
---

Wir haben einen Prototyp eines lockeren 3D-Spiels entwickelt, das wir **diff3d** nennen: zwei nebeneinanderliegende Szenen, die Sie drehen und zoomen können, um sie zu vergleichen, und anschließend gedrückt halten, um jeden Unterschied wieder „auszuheilen", bis beide Szenen übereinstimmen.

<!--more-->

Das Interessante steckt unter der Haube. Anstatt Levels von Hand zu bauen, wird jedes Rätsel **algorithmisch aus einem einzigen Seed** generiert – eine Basisszene wird unter räumlichen und Verdeckungsbeschränkungen mutiert (ein Objekt wird umgefärbt, gedreht, verschoben oder entfernt). Dadurch ist der Level-Pool theoretisch unendlich, während ein reiner, render-engine-unabhängiger Generator es uns zudem ermöglicht, Levels offline vorzuberechnen, um sie sofort zu laden.

<!-- ![Ein diff3d-Rätsel: zwei 3D-Szenen nebeneinander](../../img/diff3d.png#small) -->

Es gibt dioramaartige „durchsichtige" Wände, die beim Umkreisen ausblenden, weiche Schatten und eine Toon-Shading-Optik über fünf von Hand gestaltete Umgebungen – ein Gewächshaus, ein Bahnhof, das Arbeitszimmer eines Detektivs, ein antiker Platz und ein Dachboden. Es ist ein Experiment mit prozeduralen Inhalten und WebGL-Spielgefühl, das zunächst für lockere Web-Portale gedacht ist.

<!-- Interesse an WebGL, Three.js oder prozeduraler Generierung? [Kontaktieren Sie uns](mailto:info@curious-electric.com?subject=Project%20inquiry). -->
