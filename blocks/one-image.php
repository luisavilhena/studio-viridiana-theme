<?php
 
use Carbon_Fields\Block;
use Carbon_Fields\Field;
 
add_action( 'after_setup_theme', 'studio_viridiana' );
 
function one_image() {
	Block::make( 'Coluna com uma imagem maior' )
		->add_fields( array(
			Field::make('image', 'img', 'Imagem'),
		) )
		->set_render_callback( function ( $block ) {
 
			// ob_start();
			?>
 
			<div class="one-image">
				<div class="one-image__item">
					<div style="background-image: url('<?php echo wp_get_attachment_image_src($block['img'],'horizontal-a')[0]; ?>');">
					</div>
				</div>
			</div>
			<?php
 
			// return ob_get_flush();
		} );
}
add_action( 'carbon_fields_register_fields', 'one_image' );