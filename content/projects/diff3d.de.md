---
title: "diff3d"
date: 2026-06-01
draft: false
image: ../img/diff3d.jpg
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'Game']
description: "Ein Fehlersuchspiel in 3D, dessen Level algorithmisch aus einem Seed entstehen — ein theoretisch unendlicher Level-Pool, gebaut mit Three.js."
---
Fehlersuche in 3D: zwei Szenen, die sich drehen und zoomen lassen, und ein unendlicher Nachschub an Leveln aus einem Seed.

<!--more-->

![Eine diff3d-Szene: ein toon-schattiertes Gewächshaus, durch die Linse gesehen](../../img/diff3d.jpg#small)

Zwei Szenen stehen nebeneinander — eine im Original, eine still verändert — und teilen sich eine Kamera: Drehen und Zoomen bewegt beide gleichzeitig. Wer einen Unterschied findet, hält ihn gedrückt, und er fügt sich zurück ins Bild.

Das Interessante daran: die Level baut niemand. Jedes Rätsel entsteht aus einem einzigen Seed — eine Grundszene wird verändert, ein Objekt umgefärbt, gedreht, verschoben oder entfernt, unter räumlichen Constraints und Verdeckungsprüfungen, die dafür sorgen, dass jeder Unterschied aus mindestens einem Blickwinkel auffindbar bleibt. Der Generator ist rein und unabhängig von der Render-Engine: dieselben Seeds laufen live im Browser oder werden vorab zu fertigen Leveln gebacken, die ohne Generator ausgeliefert werden.

![Das Detektivbüro, eine der handgebauten Umgebungen](../../img/diff3d-2.jpg#small)

Drumherum liegt das, was daraus ein Spiel macht: Dioramen-Wände, die beim Umkreisen ausblenden, weiche Schatten, ein Toon-Look und eine Reihe handgebauter Umgebungen — Gewächshaus, Bahnsteig, Detektivbüro, antiker Platz, Dachboden —, die der Generator als Rohmaterial nimmt. Geschrieben in striktem TypeScript auf Three.js.

Ein [News-Beitrag](/de/news/diff3d/) erzählt mehr über den Generator.
