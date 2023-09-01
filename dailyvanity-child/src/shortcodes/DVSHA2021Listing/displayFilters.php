
<div class="container-fluid" id="filter-container">
    <div class="row no-gutters">
        <div class="col py-3 px-0 align-self-end text-center text-md-right">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
                <div class="dropdown-menu filter-dropdown-menu row" aria-labelledby="filterDropdown">
                    <form method="GET" action="" id="filterForm">
                        <div class="col-6 px-0 pt-0 pb-2 dropdown-menu-item">
                            <h2>Brands</h2>
                            <div class="dropdown-menu-item-list p-2">
                                <?php echo $this->getBrandsFilterItem( $args['brands'] ); ?>
                            </div>
                        </div>
                        <?php foreach( $parents as $parent ): ?>
                            <div class="col-6 px-0 pt-0 pb-2 dropdown-menu-item">
                                <h2><?php echo $parent['name'] ?></h2>
                                <div class="dropdown-menu-item-list p-2">
                                    <?php echo $this->getFilterItem( $parent['term_id'], $parent['slug'], $args['awards'], $args['misc'], $args['priceranges'], $args['skinconcerns'], $args['skintypes'], $args['hairconcerns'], $args['bodyconcerns'] ); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12 dropdown-menu-item p-2 text-center no-border">
                            <button type="button" class="apply-btn box-shadow py-1 px-4 me-1">Apply</button>
                            <input type="reset" value="Reset" class="reset-btn box-shadow py-1 px-4 ms-1" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery( document ).ready( function( $ ) {
        $( '#filterDropdown' ).on( 'click', function(e) {
            if( $( '.filter-dropdown-menu' ).is( ':visible' ) ) {
                $( '.filter-dropdown-menu' ).hide();
            } else {
                $( '.filter-dropdown-menu' ).show();
            }
        } );

        $( '.apply-btn' ).on( 'click', function() {
            $( '#filterForm' ).submit();
        } );

        $( '.reset-btn' ).on( 'click', function() {
            $( '.filter-checkbox' ).prop( 'checked', false );
            $( '.filter-checkbox' ).attr( 'checked', false );
        } );
    } );
</script>