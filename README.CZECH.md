alcoma-mp-cacti-template
========================
#########################################################################
/   file readme.txt for CACTI projects			                #
/									#
/   part of "Alcoma MP CACTI Template"  				#
/									#
/   created by Patrik Majer (Kacer Huhu) - www.patrik-majer.net		#
/									#
/   version 0.2 - 2011-05-12						#
/									#
#########################################################################

I. Uvod
----------------------------------------------------
zde davam k dispozici soubor skriptu a sablony pro bezdratove spoje Alcoma - MP
do systemu CACTI
zatim je to prvni pre-release, tj. muzou se vyskytovat chyby, nepresnosti atd.

----------------------------------------------------
II. Obsah
----------------------------------------------------

pack obsahuje "obycejne" sablony (tj. nepotrebujou podpurne skripty/soubory, staci
 jen import do cacti) a to:

!!! Alcoma - MP - ODU Temperature !!! (Teplota venkovni jednotky)

!!! Alcoma - MP - Quality of signal !!! (kvalita signalu, v procentech)

!!! Alcoma - MP - RX signal level !!!

plus !!! DUAL !!! sablony (RX Signal level DUAL mozna bude bugla, spatne se vykresluje druha hodnota)

DUAL sablony zobrazuji jednu velicinu ve 2 zarizenich (idealne jeden spoj)
u DUAL sablon je nutno prvne vytvorit "obyc" graf, protoze DUAL sablony nevytvari DataSource
( ale maze asociovan�).
PO vytvoreni obyc variant dan� veliciny se vytvori DUAL a bud je nutno graf vytvares
 pres "Graph Management" - "Add" , bez vybran� "Host"a, nebo "Host"a zmenit na "None",
pot� vybrat prisluste datasource a hotovo :)

D�le po nakopirovani 2 souboru do cacti je mozno grafovat statistiky Interfac� (dvou :) ).
Hlavn� "sablona" ma jmeno "Alcoma - SNMP - Interface Statistics" a mus� se p�idat k "Device"
 v casti "Associated Data Queries".
Pak u "device" - "Create Graphs for this Host" se zobrazi v�pis rozhran�,
a je mozno grafovat:

 !!! Alcoma - MP - Interface - Errors/Collision !!! (nem�m ozkouseno, mam bezchybn� iface asi :) )

 !!! Alcoma - MP - Traffic !!!
 
 !!! Alcoma - MP - Packets !!! (zatim to dela Peaky, ale mozna je tu "feature")

------------------------------------------------------
III. Instalace
------------------------------------------------------

 a, nakopirovat do slozky _cacti_path/scripts soubor "query_alcoma_interfaces.php"
 b, nakopirovat do slozky _cacti_path/resource\script_queries soubor "alcoma_interface.xml"  
 c, do CACTI naimportovat vsechny soubory ze slozky "templates"

 d, k zarizeni pridat vsecko co ma prefix "Alcoma"

 HOTOVO :)

-------------------------------------------------------
IV. verze Cacti
-------------------------------------------------------

sablony jsou delane pro/na verzi Version 0.8.7g
jak to bude chodit na jin�ch verz�ch CACTI tot otazka :-)

-------------------------------------------------------
V. verze sablon
-------------------------------------------------------

aktualn�: v0.2 - pre-lease

 -- tj. muze obsahovat chyby/preklepy atd.
    na pripadne nepresnosti/bugy mi prosim upozornete

v0.1 - initial pre-lease

--------------------------------------------------------
VI. changelog
--------------------------------------------------------

v0.2 - opravena sablona RX signal level DUAL, plus opraveny chybne vazby na 1aerial sablonu
     - do archivu pridan export data_query pro alcomu (bez toho nesli grafovat interface)

     - ADD - pridana "HOST" sablona

 
   v budoucnu se nove verze budou objevovat na: http://patrik-majer.net/

-------------------------------------------------------
VII. Licence 
-------------------------------------------------------
  -- muzete volne sirit v kompletni podobe


#########################################################
#							#
#    created by Patrik Majer (Kacer Huhu) 		#
#							#
#    website: www.patrik-majer.net                      #
#							#
#    email: patrik.majer@atlas.cz			#
#							#
#	ENJOY IT >]					#
#							#
#########################################################
