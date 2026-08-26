---
title: "TTL — Through the Lens ist da"
date: 2026-08-28T10:00:00+02:00
draft: false
description: "Unser Noir-Wimmelbildspiel TTL — Through the Lens ist auf Playgama live. Linse heben, finden, was der Raum verbirgt, und das Foto machen."
image: ../img/ttl-3.jpg
tags: ['JavaScript', 'ThreeJS', 'Game', 'WebGL']
---

**TTL — Through the Lens** ist live. Es ist unser erstes Spiel auf einem Portal und ab sofort auf [Playgama](https://playgama.com/game/through-the-lens) spielbar.

<!--more-->

![Ein Dach bei Nacht unter tiefem Mond, die Linse offen über einem Wasserturm](../../img/ttl-3.jpg#small)

Man ist die Kamera an einem Fall. Jede Szene ist ein beleuchtetes Diorama, das sich umkreisen lässt — ein Gewächshaus, ein Detektivbüro, ein Dach über einer schlafenden Stadt — und irgendetwas darin stimmt nicht. Gedrückt halten hebt die Linse, ziehen bewegt sie über die Szene, und sie zeigt, was der Raum verborgen hat. Bleibt sie auf dem Ding liegen, das nicht dazugehört, wird es markiert. Sind alle gefunden, entsteht das Foto.

Die Linse läuft auf einer Ladung, die sich im geöffneten Zustand leert und im geschlossenen wieder füllt. Den Raum einfach abzufahren funktioniert also nicht — man muss sich entscheiden, wo man hinsieht.

Darunter arbeitet der Generator, über den wir [im Juni geschrieben haben](/de/news/diff3d/): Jede Szene entsteht aus einem einzigen Seed, Objekte werden umgefärbt, gedreht, verschoben oder entfernt, unter Constraints, die jeden Fund auffindbar halten. Der Prototyp war ein Vergleichsspiel mit zwei Szenen; die Linse hat das ersetzt, und das Spiel ist dadurch deutlich besser geworden.

Gebaut in striktem TypeScript auf Three.js, lauffähig im Browser-Tab — ohne Installation, ohne Konto.

[Auf Playgama spielen](https://playgama.com/game/through-the-lens) oder auf der [Projektseite](/de/projects/ttl/) nachlesen, wie es entstanden ist.
