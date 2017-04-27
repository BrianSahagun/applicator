function initSearch( component ) {
        
        // Create Markup
        var searchToggle = $( '<div />', { 'class': 'cp search-toggle', 'data-name': 'Search Toggle' } )
                .append( $( '<div />', { 'class': 'search-toggle--cr' } ) ),
            
            searchToggleAction = $( '<button />', { 'class': 'b a search-toggle--a' } )
                .append( $( '<span />', { 'class': 'search-toggle--a-l' } ) ),
            
            searchToggleActionLabel = $( '<span />', { 'class': 'search-toggle--a--word--l', 'text': applicatorSearchLabel.searchShowLabel } ),
            
            searchActiveClass = 'search--active',
            searchInactiveClass = 'search--inactive',
            searchInputEmptyClass = 'search-input--empty',
            
            aplSearchActiveClass = 'apl--search--active',
            aplSearchInactiveClass = 'apl--search--inactive',
            
            $searchComponent = $( '.arbitrary-nav' ),
            $searchInput = component.find( '.search-term--input--text' ),
            $searchForm = component.find( '.search-form' ),
            $searchToggleLabel,
            $searchToggleAction,
            
            $searchSubmit = component.find( '.search-form-submit--a-l' ),
            $searchReset = component.find( '.search-form-reset--a-l' );
        
        // Attach Markup
        component.find( '.search-form' ).before( searchToggle );
        component.find( '.search-toggle--cr' ).append( searchToggleAction );
        
        component.find( '.search-toggle--a-l' )
            .append( searchToggleActionLabel )
            .append( ' ' )
            .append( applicatorSearchLabel.searchIcon )
            .append( applicatorSearchLabel.searchDismissIcon );
        
        $searchSubmit.append( ' ' )
            .append( applicatorSearchLabel.searchIcon );
        
        $searchReset.append( ' ' )
            .append( applicatorSearchLabel.searchDismissIcon );
        
        
        // ------------------------- Set Defaults
        component.addClass( searchInactiveClass );
        
        
        $searchToggleLabel = component.find( '.search-toggle--a--word--l' );
        $searchToggleAction = component.find( '.search-toggle--a' );
        $searchToggleResetAction = component.find( '.search-form-reset--a' );
        
        
        // ------------------------- Search Toggle Status
        function searchStatusToggle() {
            
            // Set defaults for text label and aria-expanded based on Status Class
            if ( $searchComponent.hasClass( searchInactiveClass ) ) {
                $searchToggleAction.attr( 'aria-expanded', 'false' );
                $searchToggleAction.attr( 'title', applicatorSearchLabel.searchShowLabel );
                $searchToggleLabel.text( applicatorSearchLabel.searchShowLabel );
                $html.addClass( aplSearchInactiveClass );
                $html.removeClass( aplSearchActiveClass );
            
            } else if ( $searchComponent.hasClass( searchActiveClass ) ) {
                $searchToggleAction.attr( 'aria-expanded', 'true' );
                $searchToggleAction.attr( 'title', applicatorSearchLabel.searchHideLabel );
                $searchToggleLabel.text( applicatorSearchLabel.searchHideLabel );
                $html.addClass( aplSearchActiveClass );
                $html.removeClass( aplSearchInactiveClass );
            }
        }
        searchStatusToggle();
        
        // ------------------------- Function: Initial State of Input
        function searchInputStatus() {
        
            // Empty Input
            if ( $searchInput.val() == '' ) {
                component.addClass( 'search-input--empty' );
                component.removeClass( 'search-input--populated' );
            }

            // Populated Input (as seen in Search Results page)
            if ( ! $searchInput.val() == '' ) {
                component.addClass( 'search-input--populated' );
                component.removeClass( 'search-input--empty' );
            }
            
        }
        searchInputStatus();
        
        // ------------------------- Toggle Search
        $searchToggleAction.click( function( e ) {
            var _this = $( this );
            
            e.preventDefault();
            
            // Toggle Component Status
            $searchComponent
                .toggleClass( searchActiveClass )
                .toggleClass( searchInactiveClass );
            
            searchStatusToggle();
            
            // Focus on Input
            if ( $searchComponent.hasClass( searchActiveClass ) ) {
                $searchInput.focus();
            }
            
            
        } );
        
        // ------------------------- Reset Action
        $searchToggleResetAction.click( function( e ) {
            var _this = $( this );
            
            e.preventDefault();
            
            // Reset value and focus on Input
            $searchInput.val( '' ).focus();
            
            searchInputStatus();
        } );
        
        // ------------------------- Text Input Detection
        $searchInput.on( 'keypress.applicator input.applicator', function() {
            searchInputStatus();
        } );
        
        
        // ------------------------- Function: Deactivate Search
        function searchDeactivate() {
            $searchComponent
                .addClass( searchInactiveClass )
                .removeClass( searchActiveClass );
            
            $searchToggleAction.attr( 'aria-expanded', 'false' );
            
            $searchToggleLabel.text( applicatorSearchLabel.searchShowLabel );
            
            $html
                .addClass( aplSearchInactiveClass )
                .removeClass( aplSearchActiveClass );
        }
        
        
        // ------------------------- Deactivate Search on click outside the component itself
        $document.on( 'touchmove.applicator click.applicator', function ( e ) {
            var _this = $( this );
            if ( ! $( e.target ).closest( '.arbitrary-nav' ).length && $searchComponent.hasClass( searchActiveClass ) ) {
                searchDeactivate();
            }
        } );


        // ------------------------- Deactivate Search upon ESC key
        $window.load( function () {
            $( document ).on( 'keyup.applicator', function ( e ) {
                if ( e.keyCode == 27 && $searchComponent.hasClass( searchActiveClass ) ) {
                    searchDeactivate();
                }
            } );
        } );
        
    }
    initSearch( $( '#arbitrary-nav' ) );