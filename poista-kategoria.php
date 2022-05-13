<?php
/**
 * Poista haluttu kategoria parent kategorian näkymästä.
 */
add_action( 'pre_get_posts', function( $query ) {

    if ( is_admin() || ! $query->is_main_query() || ! is_product_category() ) {
        return;
    }

    // Lisää tähän pilkulla erotettuna kaikkien kategorioiden polkutunnukset joista haluat poistaa "Otteluliput" kategorian. Jos lisäät uusia "seuroja", muista lisätä myös tähän.
    $categories = array( 'seura-1', 'seura-2', 'seura-3' );

    // Muuta tämä jos poistettavan ketegorian nimi ei ole "Otteluliput", tarvittaessa tähän voi myös lisätä poistettavia kategorioita pilkulla erotettuna.
    $exlude_cat = array( 'otteluliput' );

    if ( is_product_category( $categories ) ) {

        $query->set( 'tax_query', array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'name',
                'terms'    => $exlude_cat,
                'operator' => 'NOT IN',
            )
        ) );
    }
} );
