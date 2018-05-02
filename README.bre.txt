sistem radi sledecim redosledom:

- Prvo skripta ./js/app.js pravi AJAX poziv prema skripti ./includes/action.php, ako trebaju podatci sa stranice pokupi ih sa jQuery-em

- Zatim skripta ./includes/action.php kontrolise koja se funkcija iz CRUD-a poziva i koje podatke ce poslati

- ./includes/action.php prvo zove /includes/data.php koja obavlja konekciju sa bazom sa podacima koji su joj prosledjeni (username, pass itd...) zatim  radi pozive CRUD klasi tj. /includes/crud.php

- U CRUD klasi se konstruise SQL komanda koja se salje bazi i vracaju se podatci skripti ./includes/action.php 

- ./includes/action.php skripta zatim prosledjuje podatke ./js/app.js koja dalje manipulise prikazom na stranici

Tako da je workflow u osnovi

app.js > data.php > actions.php > crud.php > actions.php > app.js

*Napomena

Mislio sam da sam uradio sanitaciju ulaza ali to nazalost nije slucaj tako da su pozivi takoreci nasuvo nema zaštite
Takodje nije uradjen update podataka do kraja, CRUD funkcionalnost je uradjena ali implementacija nije tj. pozivi iz app.js i kontrola u actions.php
