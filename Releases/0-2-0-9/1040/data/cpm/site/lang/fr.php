<?php
/*
 * PanPlay language file
 *
 * ENCODING: UTF-8 only.
 * Read and save this file as UTF-8. Keep Unicode characters literal.
 * Do not replace them with escaped code points, HTML entities, or Latin-1.
 * After every edit, verify that the integrity line below is still readable.
 *
 * INTEGRITY CHECK: æøå | ñáéíóú | 你好世界 | नमस्ते | مرحبا | äöüß
 */
$cpmSite = array(
    'meta_title' => 'Mécanisme de protection du contenu PanPlay',
    'meta_description' => 'Informations publiques sur PanPlay CPM, ses listes de filtrage locales et centrales, la confidentialité et les responsabilités des opérateurs.',
    'language_label' => 'Langue',
    'language_apply' => 'Appliquer',
    'status_label' => 'Documentation publique',
    'title' => 'Mécanisme de protection du contenu PanPlay',
    'lead' => 'Comment PanPlay vérifie les URL audio directes, utilise des règles locales et centrales facultatives et protège la lecture sans signaler les URL écoutées.',
    'current_title' => 'Liste centrale disponible',
    'current_body' => 'La liste publique CPM peut être utilisée par les instances PanPlay participantes. Chaque opérateur reste libre de participer ou non.',
    'what_title' => 'Qu’est-ce que CPM ?',
    'what_body' => 'CPM est une couche de filtrage pour l’extension Baseaudio de PanPlay. Elle peut bloquer avant la lecture des URL audio directes connues ou interdites localement. Ce n’est ni un DRM ni un jugement juridique sur un site, un utilisateur ou un fichier.',
    'geography_title' => 'Aucune règle géographique',
    'why_title' => 'Pourquoi CPM existe',
    'why_body' => 'CPM donne aux exploitants d’instances PanPlay un moyen technique de répondre aux notifications de titulaires de droits, aux demandes de retrait de type DMCA et aux exigences comparables en matière de droit d’auteur dans l’Union européenne et d’autres juridictions. Ce n’est ni un filtre de téléversement ni une campagne active contre le piratage : il filtre la lecture et le traitement par PanPlay.',
    'effect_title' => 'Effet d’un blocage',
    'effect_body' => 'Une correspondance ne supprime ni ne saisit le fichier source et ne le rend pas inaccessible. PanPlay refuse seulement de le récupérer et de le lire avec Baseaudio. Le contrôle n’envoie aucun avertissement ni signalement à l’utilisateur, au titulaire des droits, à l’hébergeur, aux autorités ou à un autre tiers.',
    'geography_body' => 'La liste centrale ne prend pas de décisions propres à un pays. Si la juridiction ou la politique d’un opérateur exige d’autres règles, il doit désactiver CPM by CDN et maintenir une liste locale adaptée.',
    'flow_title' => 'Déroulement d’une vérification',
    'flow_1' => 'PanPlay reçoit une URL audio directe en mode Baseaudio.',
    'flow_2' => 'L’instance normalise l’URL afin de rendre la comparaison prévisible.',
    'flow_3' => 'Les règles locales sont vérifiées sur le serveur PanPlay.',
    'flow_4' => 'Si cette option est activée, la liste centrale mise en cache localement est également vérifiée.',
    'flow_5' => 'Les exceptions priment sur les blocages. Une correspondance restante arrête la lecture et affiche une erreur 403 neutre.',
    'lists_title' => 'Règles et sources',
    'local_title' => 'Règles locales',
    'local_body' => 'Chaque instance auto-hébergée peut maintenir ses propres règles. Elles s’appliquent indépendamment de la liste centrale et restent sous le contrôle de l’opérateur.',
    'central_title' => 'CPM by CDN',
    'central_body' => 'Les instances participantes téléchargent régulièrement la liste publique PanPlay et la mettent en cache. Les contrôles restent locaux et n’utilisent pas de service de vérification d’URL en direct.',
    'exceptions_title' => 'Exceptions',
    'exceptions_body' => 'Les règles commençant par @@ autorisent explicitement une adresse correspondante et sont prioritaires sur les blocages. Elles permettent de corriger les règles trop larges.',
    'rules_title' => 'Format de la liste',
    'rules_intro' => 'CPM utilise un sous-ensemble documenté de type Adblock : commentaires, domaines, URL exactes, jokers simples, exceptions et directives d’importation PanPlay.',
    'rule_comment' => 'Commentaire',
    'privacy_title' => 'Confidentialité',
    'privacy_body' => 'Avec CPM by CDN, PanPlay télécharge une liste et évalue l’URL demandée sur l’instance locale. L’URL écoutée n’est pas envoyée à Pangom lors des contrôles ordinaires.',
    'operator_title' => 'Responsabilité de l’auto-hébergement',
    'operator_body' => 'L’opérateur décide si CPM et CPM by CDN sont activés. Il est responsable des règles locales, des mentions légales, des coordonnées et du respect du droit applicable.',
    'complaints_title' => 'Corrections et réclamations',
    'complaints_body' => 'Pour un blocage local, contactez l’opérateur de l’instance concernée. Les signalements destinés à la liste partagée peuvent être transmis à PanPlay et sont examinés manuellement.',
    'contact_link' => 'Contacter PanPlay',
    'limits_title' => 'Limites techniques',
    'limits_body' => 'CPM concerne uniquement Baseaudio, pas la lecture laut.fm. Il ne garantit ni une prévention complète du piratage, ni une application géographique, ni la connaissance de toutes les sources interdites.',
    'resources_title' => 'Ressources publiques',
    'filterlist_link' => 'Ouvrir la liste centrale',
    'source_link' => 'Source anti-piratage importée',
    'repository_link' => 'Code source de PanPlay',
    'footer_note' => 'CPM documente les décisions de filtrage ; il ne remplace pas l’examen juridique par l’opérateur d’une instance.',
);
