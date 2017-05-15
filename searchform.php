<?php
$unique_id = esc_attr( uniqid( 'search-term-creation-input--' ) );
?>

<div class="cp search-cp" data-name="Search">
    <div class="cr search---cr">
        <div class="hr search---hr">
            <div class="hr_cr search---hr_cr">
                <h2 class="h search---h"><span class="h_l search---h_l"><?php esc_html_e( 'Search', $GLOBALS['apl_textdomain'] ); ?></span></h2>
            </div>
        </div>
        <div class="ct search---ct">
            <div class="ct_cr search---ct_cr">
                <form class="form search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search" data-name="Search Form">
                    <div class="fieldsets search-form-fieldsets">
                        <div class="cr search-form-fieldsets---cr">

                            <div class="cp fs-item search-term-creation" data-name="Search Term Creation">
                                <div class="cr search-term-crt---cr">
                                    <div class="hr search-term-crt---hr">
                                        <div class="hr_cr search-term-crt---hr_cr">
                                            <div class="h search-term-crt---h"><span class="h_l search-term-crt---h_l"><?php esc_html_e( 'Search Term Creation', $GLOBALS['apl_textdomain'] ); ?></span></div>
                                        </div>
                                    </div>
                                    <div class="ct search-term-crt---ct">
                                        <div class="ct_cr search-term-crt---ct_cr">
                                            <span class="obj search-term-creation-label---obj" data-name="Search Term Creation Label">
                                                <label class="label search-term-crt-lbl---label" for="<?php echo $unique_id; ?>"><span class="label_l search-term-crt-lbl---label_l"><?php esc_html_e( 'Search Term', $GLOBALS['apl_textdomain'] ); ?></span></label>
                                            </span>
                                            <span class="obj search-term-creation-input---obj" data-name="Search Term Creation Input">
                                                <span class="ee--input-text search-term-crt-inp---ee--input-text"><input id="<?php echo $unique_id; ?>" class="input-text search-term-crt-inp--input-text" name="s" type="text" placeholder="<?php esc_attr_e( 'Enter search term', $GLOBALS['apl_textdomain'] ); ?>" value="<?php echo get_search_query(); ?>" required></span>
                                            </span>
                                        </div>
                                    </div><!-- ct -->
                                </div>
                            </div><!-- Search Term Creation -->

                        </div>
                    </div><!-- fieldsets -->
                    <div class="axns search-form-axns" data-name="Search Form Actions">
                        <div class="cr search-form-axns---cr">
                            <div class="h search-form-axns---h"><span class="h_l search-form-axns---h_l">Search Form Actions</span></div>
                            <div class="ct search-form-axns---ct">
                                <div class="ct_cr search-form-axns---ct_cr">
                                    <div class="obj axn search-submit-axn" data-name="Search Submit Action">
                                        <button class="b search-submit-axn---b" type="submit" title="<?php esc_attr_e( 'Submit Search Term', $GLOBALS['apl_textdomain'] ); ?>"><span class="b_l search-submit-axn---b_l"><span class="word search---word"><?php esc_html_e( 'Submit', $GLOBALS['apl_textdomain'] ); ?></span></span></button>
                                    </div><!-- search-submit-axn -->
                                    <div class="obj axn search-reset-axn" data-name="Search Reset Action">
                                        <button class="b search-reset-axn---b" type="reset" title="<?php esc_attr_e( 'Reset Search Term', $GLOBALS['apl_textdomain'] ); ?>"><span class="b_l search-reset-axn---b_l"><span class="word reset---word"><?php esc_html_e( 'Reset', $GLOBALS['apl_textdomain'] ); ?></span></span></button>
                                    </div><!-- search-reset-axn -->
                                </div>
                            </div><!-- search-form-axns---ct -->
                        </div>
                    </div><!-- search-form-axns -->
                </form><!-- Search Form -->
            </div>
        </div><!-- search---ct -->
    </div>
</div><!-- search-cp -->