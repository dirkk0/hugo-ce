---
title: "TTL"
date: 2026-08-26
draft: false
image: ../img/ttl.jpg
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'Game']
description: "TTL (Through the Lens) ist ein Noir-Wimmelbildspiel in 3D — eine Linse über einem beleuchteten Diorama legt frei, was es verbirgt — und jede Szene entsteht algorithmisch aus einem Seed. Gebaut mit Three.js, veröffentlicht auf Playgama."
---
**TTL — Through the Lens.** Ein Noir-Wimmelbildspiel in 3D: Man ist die Kamera an einem Fall, und die Linse zeigt, was jeder Raum verbirgt. Veröffentlicht auf [Playgama](https://playgama.com/game/through-the-lens).

<!--more-->

![Eine TTL-Szene: ein toon-schattiertes Gewächshaus, durch die Linse gesehen](../../img/ttl.jpg#small)

Jede Szene ist ein beleuchtetes Diorama zum Umkreisen — Gewächshaus, Bahnsteig, Detektivbüro, antiker Platz, Dachboden, ein Dach über einer schlafenden Stadt. Irgendetwas darin stimmt nicht. Gedrückt halten zeigt eine Linse, die sich über die Szene ziehen lässt, und wo sie vorbeikommt, kommt hoch, was der Raum verborgen hat. Bleibt sie auf dem Objekt liegen, das nicht dazugehört, wird es markiert. Ist die Szene sauber, geht der Fall weiter.

{{< video src="ttl-teaser.mp4" poster="ttl-teaser-poster.jpg" label="Teaser: die Linse fährt über eine Szene und markiert, was nicht dazugehört" >}}

![Das Detektivbüro, eine der handgebauten Umgebungen](../../img/ttl-2.jpg#small)

Was niemand sieht: die Level baut niemand. Jede Szene entsteht aus einem einzigen Seed — eine Grundumgebung wird verändert, ein Objekt umgefärbt, gedreht, verschoben oder entfernt, unter räumlichen Constraints und Verdeckungsprüfungen, die dafür sorgen, dass jede Änderung aus mindestens einem Blickwinkel auffindbar bleibt. Der Generator ist rein und unabhängig von der Render-Engine: dieselben Seeds laufen live im Browser oder werden vorab zu fertigen Leveln gebacken, die ganz ohne Generator ausgeliefert werden.

Angefangen hat es als **diff3d**, ein Prototyp, über den wir [im Juni geschrieben haben](/de/news/diff3d/): zwei Szenen nebeneinander unter einer gemeinsamen Kamera, das klassische Fehlersuch-Layout, mit dem Generator bereits darunter. Zwei Bildhälften zu vergleichen entpuppte sich allerdings eher als Arbeit denn als Spiel. Ersetzt durch eine einzelne Szene und eine Linse, blieb alles Interessante am Generator erhalten — und das Spiel bekam einen Grund, dunkel, still und langsam zu sein. Daher das Noir.

Gebaut mit Three.js, ohne Framework, lauffähig im Browser-Tab, ohne Installation und ohne Konto.

[Auf Playgama spielen](https://playgama.com/game/through-the-lens).
