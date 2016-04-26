<?php

 define('LOCAL_LANG', 'fr');                  // Modification de la langue (EN ou FR)
  define('TIME_CHECK_UPDATE', -1);             // Temps entre chaque vérification de mise à jour (0 = force la MàJ; -1 = désactive)
  define('EDITMODE_ENABLE', TRUE);             // Active ou désactive la fonction d'EDITMODE
  define('SEEN_MODE_ENABLE', TRUE);            // Active ou désactive la fonction de marquage des episodes comme vu
  define('DISPLAY_HIDDEN_FILESDIRS', FALSE);   // Affiche ou ignore les fichiers cachés
  define('IGNORE_CHMOD', FALSE);               // Active ou ignore la vérification des CHMOD sur /data et /downloads
  define('LOCAL_DL_PATH', 'downloads');        // Modifie le dossier que surveille Cakebox
  define('DOWNLOAD_LINK', "http://".$identity_inLink);  // Modifie l'URL de stream des fichiers
  $excludeFiles = array(".", "..", ".htaccess", "");  // Liste des fichiers ignorés dans le listing de Cakebox
  define('SEEN_SPAN', '<span style="border-bottom:2px dotted #fb0000;">');// Modifie le style du module vu/non vu
  /* Options Divx Web Player*/
  define('USE_DIVX', TRUE);                            // On choisi le lecteur DivX Web Player par défaut
  define('DIVX_AUTOPLAY', 'TRUE');                    // Option autoplay (démarrage de la lecture automatique)
  define('DIVX_WIDTH', '1000');                        // Option de la largeur
  define('DIVX_HEIGTH', '600');                       // Option de la hauteur
  define('LAST_ADD', TRUE);                               // Affiche l'icone NEW
  define('TIME_LAST_ADD', '120');                           // Durée de la nouveauté (en heure)