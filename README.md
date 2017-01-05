APLIKAJCA DO ZARZĄDZANIA SERWISEM MOTOCYKLOWYM

W FOLDERZE service_project znajduje się aktualna wersja aplikacji 
nie jest gotowa 



Front-end zostanie wykonany na bazie SB ADMIN2
Logika Użykownika FOS UserBundle
Logika Dla różnych typów użytkowników PUGXMultiUserBundle

Poniżej opis poszczególnych stron

LISTA STRON APLIKACJI


Użytkownik niezalogowany 

tylko strona logowania - OK działa

--------------------------------
UŻYTKOWNIK 

--Strona główna - OK działa

pasek górny tylko ikona użytkownika -OK działa
zmiana ustawień użytkownika 
wyloguj - OK działa

 w treści strony 
listę wszystkich motocykli - OK działa
listę wszystkich zleceń - OK działa

--strona motocykla 
pozwala zobaczyć zczegóóły motocykla - nie pozwala na ich edycje
wyświetla listę zleceń motocykla

--strona zlecenia wyświetla :
date otwarcia zlecenia
date zamknięcia zlecenia 
imie i nazwisko managera 
imię i nazwisko mechanika
dane motocykla z przebiegiem 
liste czynności serwisowych z cenami 
sumę opłat za czynności serwisowe
lstę części użytych do naprawy z cenami 
sumę opłat za części 
finalną kwotę zlecenia 
uwagi mechanika 


--strona zmiany ustawień użytkownika wyświetla 
wszystkie dane w formulażu do ich edycji 


-------------------------------------------------------
MANAGER

--menu górne
pasek górny tylko ikona użytkownika 
zmiana ustawień użytkownika 
wyloguj 

--menu boczne 
użytkownik 
 -nowy
 - wyświetl wszystkich 
 
motocykl 
 - nowy
 - wyświetl wszystkie
 
zlecenia 
 -nowe
 - wyświetl wyszystkie 
  - kolejna warsta wyświeta zlecenia według statusu

--strona główna 
-ikony z informacją o ilości motocykli 
 -planowanych w ciągu najbliższych 7 dni 
 -przyjętych przy których prace się nie rozpoczęły 
 -przyjętych przy kótych prace się rozpoczęły 
 -przyjętych przy któryh prace się zakończły 
 -przyjętych w trakcie prac (oczekujące)
 -przyjętych zimujących 
 -przyjętych gotowych do odbioru 

 -informację o procentowym udziale mechaników w ilości zleceń 
 -informację o  wypracowanym przez poszczególnych mechaników przychodzie od początku miesiąca
 -listę motocykli planowanych na dany dzień 

--strona użytkowników pozwala wyświetlić wszytkich użytkowników pozwla szukać użytkowników po imieniu lub nazwisku

--strona nowego użytkownika pozwala dodać użytkownika 

--strona użytkownika jak dla użytkownika + link do edycji danych użytkownika + link do tworzenia zlecenia 

--strona motocykli wyświetla wszytskie motocykle pozwala szukać motocykla po nrRej 
--strona nowego motocykla pozwala wybrać użytkownika z listy i przekierowuje na stronę gdzie można dodać motocykl

--strona motocykla jak strona motocykla dla użytkownnika + link do zmiany danych + link do tworzenia zleceia dla motocykla

 

--strona zleceń 
wyświetla wszystkie zlecenia, powala szukać zleceń wg wybranych kryteriów

--strona tworzenia zlecenia - tworzy zlecenie w 6 krokach

 --pozwala wybrać użytkownika z listy lub dodać nowego użytkownika(strona 1)
 
 --pozala wybrać motocykl z listy lub dodać nowy motocykl (strona 2)
 
 --pozwla ustalić : status zlecenia, planowaną datę rozpoczęcia i zakończeia prac, mechanika,   managera, (strona3)
 
 --pozwala dodać czynności serwisowe nazwa + cena ( na bieżąco wyświetla sumę kosztów), (strona 4)
 
 --pozwala dodać części nazwa + cena + ilość (na bierząco wyświetla sumę kosztów),(strona 5)
 
 --wyświetla podsumowanie zlecenia (motocykl, czynności serwisowe, akcje serwisowe) pozwala przejść na stronę edycji czynności oraz części, pozwala dodać komentarz użytkownika i komentarz managera


--strona edycji zlecenia 
 -pozwala edytować zlecenie oprócz użytkownika i motocykla. 

----------------------------------------------------
MECHANIK

--pasek górny 
tylko edycja swoich danych 
wylogowanie

--pasek boczny 

motocykle
 - wyświetl wszystkie
 - wyświetl serwisowane przez mechanika
zlecenia
- wyświetl wszystkie 
- wyświetl tylko zlecenia mechanika
  -- wyświetl zlecenia mechanika wg statusu
dziś
 - zlecenia na dziś
 - motocykle na dziś

--strona motocykli 
jak dla managera bez możliwości edycji

--strona motocykli serwisowanych przez mechanika
jw (tylko motocykle serwisowane przez mechanika)

--zlecenia
wyświetl wszystkie 
jak dla managera

--wyświetl zlecenia mechanika
jw - tylko zlecenia mechanika

---wyświetla zlecenia mechanika wg statusu 
 jw tylko zlecenia mechanika o podanym statusie

--strona zlecenia 
-jeśli zleceie dla mechanika 
pozwala wyświetlić zlecenie, zmieniać jego status, odzaczać wykonane czynności, dodać komentarz mechanika

-jeśli zlecenie jest dla inego mechanika 
pozwala wyśietlic zlecenie bez możliwości edycji 




---
ADMIN

--wszystkie strony jak dla managera

--dodatkowo możliwość stworzenia dowolnego typu użytkownika

























