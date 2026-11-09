<?php
 
use Carbon_Fields\Block;
use Carbon_Fields\Field;
 
add_action( 'after_setup_theme', 'studio_viridiana' );
 
function text_box() {
	Block::make( 'Text box' )
		->add_fields( array(
			Field::make( 'select', 'select', __( 'Background options' ) )
				->set_options( array(
					'structure-color-light-pink' => 'light',
					'structure-color-green' => 'dark',
					'structure-color-black' => 'black',
				) ),
			Field::make('complex', 'topic', 'Topic')
			  ->add_fields(array(
			  	Field::make('rich_text', 'title', 'Title before box'),
			    Field::make('text', 'text', 'Text'),
			    Field::make('text', 'link_id', 'Scroll link - if there is columns box with link'),
			    Field::make('complex', 'more', 'More')
			      ->add_fields(array(
			        Field::make('rich_text', 'more_text', 'Text'),
			      ))
			  ))
			  ->set_layout('tabbed-vertical')
		) )
		->set_render_callback( function ( $block ) {
 
			// ob_start();
			?>
 			
			<div class="text-box ">
				<?php foreach ($block['topic'] as $topic) : ?>
				<?php if ($topic['title']) : ?>
					<div class="text-box__item__title rich_text ">
						<?php echo $topic['title']; ?>
					</div>
				<?php  endif; ?>
				<div id="<?php $columns['link_id'] ?>"  class="text-box__item <?php echo $block['select']?>">
					<h4><?php echo $topic['text']; ?></h4>
					<?php foreach ($topic['more'] as $more) : ?>
					<div class="text-box__item__more">
						<div class="text-box__item__more-button">
							<div>
								<span></span>
								<span></span>
							</div>
						</div>
					</div>
					<div class="text-box__item__more-text rich-text">
						<?php echo $more['more_text']; ?>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endforeach;  ?>
			</div>
			<?php
 
			// return ob_get_flush();
		} );
}
add_action( 'carbon_fields_register_fields', 'text_box' );