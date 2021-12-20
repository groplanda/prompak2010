<?php
return [
    'plugin' => [
        'name' => 'Mapa stránok',
        'description' => 'Generuje súbor sitemap.xml pre vaše stránky.',
        'permissions' => [
            'access_settings' => 'Prístup k nastaveniam konfigurácie mapy stránok',
            'access_definitions' => 'Prístup k stránke s definíciami mapy stránok',
        ],
    ],
    'item' => [
        'location' => 'Umiestnenie:',
        'priority' => 'Priorita',
        'changefreq' => 'Frekvencia kontroly',
        'always' => 'vždy',
        'hourly' => 'každú hodinu',
        'daily' => 'denne',
        'weekly' => 'týždenne',
        'monthly' => 'mesačne',
        'yearly' => 'ročne',
        'never' => 'nikdy',
        'editor_title' => 'Upraviť položku mapy stránok',
        'type' => 'Typ',
        'allow_nested_items' => 'Povoliť vnorené položky',
        'allow_nested_items_comment' => 'Vnorené položky môžu byť generované dynamicky statickou stránkou a niektorými ďalšími typmi položky',
        'url' => 'URL',
        'reference' => 'Referencia',
        'title_required' => 'Nadpis je povinný',
        'unknown_type' => 'Neznámy typ položky',
        'unnamed' => 'Nepomenovaná položka',
        'add_item' => 'Pridať <u>P</u>oložku',
        'new_item' => 'Nová položka',
        'cms_page' => 'CMS Stránka',
        'cms_page_comment' => 'Vyberte stránku z ktorej sa použije jej URL adresa.',
        'reference_required' => 'Vyžaduje sa odkaz na položku.',
        'url_required' => 'URL adresa je povinná',
        'cms_page_required' => 'Vyberte prosím CMS stránku',
        'page' => 'Stránka',
        'check' => 'Skontrolovať',
        'definition' => 'Definícia',
        'save_definition' => 'Ukladám mapu stránok...',
        'load_indicator' => 'Mažem definíciu...',
        'empty_confirm' => 'Určite chcete zmazať definíciu mapy stránok?',
    ],
    'definition' => [
        'not_found' => 'Nebola nájdená žiadna mapa stránok. Najprv skúste nejakú vytvoriť.',
    ],
];
