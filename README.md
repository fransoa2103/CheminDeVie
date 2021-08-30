# CheminDeVie
I'm training to reproduce this website https://www.bracelet-chemin-de-vie.fr/
with PHP and POO. i code only algorithmic not the design front-end. 
The goal is not the design but the logic.

#1 the formulaire
First i want the entries in the register form to be strict. Because the calcul of the results strictly needs it.
i use REGEX line code 
/ utf8_decode($var) / preg_match_all('/[\/\\\&~"#{([`_^@)°%=}+$£¤¨%µ*§!:;.,?0-9\'\]]/',$var)
characters only accept : [a-z] and [àâäéèêëîïìôöùûü]
