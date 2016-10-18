jQuery( document ).ready( function ( $ ) {
    $( '#quick_rest_draft' ).on( 'submit', function(e) {

        e.preventDefault();
        var title = $( '#quick-rest-draft-title' ).val();
        var content = $( '#quick-rest-draft-content' ).val();
        var status = 'draft';

        var data = {
            title: title,
            content: content,
        };

        $.ajax({
            method: "POST",
            url: QUICK_REST_DRAFT.root + 'wp/v2/posts',
            data: data,
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', QUICK_REST_DRAFT.nonce );
            },
            success : function( response ) {
                console.log( response );
                console.log( QUICK_REST_DRAFT.success );
                $('#qrp_dashboard_widget .inside').html( QUICK_REST_DRAFT.success )
            },
            fail : function( response ) {
                console.log( response );
                $('#qrp_dashboard_widget .inside').html( QUICK_REST_DRAFT.success )

            }

        });

    });

} );
