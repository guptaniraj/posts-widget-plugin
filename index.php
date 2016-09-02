<?php
/*
Plugin Name: N Posts Widget Plugin
Description: N Posts Widget Plugin
Version: 1.1
Author: Niraj Gupta
Author URI: 
*/

class npostwidget_plugin extends WP_Widget
{
	// constructor
    function npostwidget_plugin() 
	{
        parent::WP_Widget(false, $name = __('N Posts Widget', 'wp_widget_plugin') );
    }

	// widget form creation
	function form($instance)
	{
		// Check values
		if( $instance)
		{
			 $wtitle = esc_attr($instance['wtitle']);
			 $count = esc_attr($instance['count']);			 
			 $date = esc_attr($instance['date']);	
			 $author = esc_attr($instance['author']);
			 $content = esc_attr($instance['content']);
			 $excerpt = esc_attr($instance['excerpt']);			 
			 $category = esc_attr($instance['category']);
			 $image = esc_attr($instance['image']);
		} 
		else
		{
			 $wtitle = '';
			 $count = '';			 
			 $date = '';
			 $author = '';
			 $content = '';
			 $excerpt = '';			 
			 $category = '';
			 $image = '';
		}	?>
		<p>
		<label for="<?php echo $this->get_field_id('wtitle'); ?>"><?php _e('Text', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('wtitle'); ?>" name="<?php echo $this->get_field_name('wtitle'); ?>" type="text" value="<?php echo $wtitle; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts to dispaly', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" min="1" value="<?php echo $count; ?>" />
		</p>

		
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $date ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php _e( 'Display post date?', 'wp_widget_plugin' ); ?></label>
		</p>
		
		
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'author' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $author ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php _e( 'Display post author?', 'wp_widget_plugin' ); ?></label>
		</p>
		
		
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $content ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php _e( 'Display post content?', 'wp_widget_plugin' ); ?></label>
		</p>
				
				
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $excerpt ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>"><?php _e( 'Display post excerpt?', 'wp_widget_plugin' ); ?></label>
		</p>
		
		
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $category ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php _e( 'Display post category?', 'wp_widget_plugin' ); ?></label>
		</p>
		
				
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $image ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( 'Display post featured image?', 'wp_widget_plugin' ); ?></label>
		</p>
				
<?php
	} 	
	
	// update widget
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		// Fields
		$instance['wtitle'] = strip_tags($new_instance['wtitle']);
		$instance['count'] = strip_tags($new_instance['count']);		
		$instance['date'] = strip_tags($new_instance['date']);
		$instance['author'] = strip_tags($new_instance['author']);
		$instance['content'] = strip_tags($new_instance['content']);
		$instance['excerpt'] = strip_tags($new_instance['excerpt']);		
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['image'] = strip_tags($new_instance['image']);
		return $instance;
	}

	// display widget
	function widget($args, $instance)
	{
		extract( $args );		
		$wtitle = $instance['wtitle'];
		$count = $instance['count'];		
		$date = $instance['date'];
		$author = $instance['author'];
		$content = $instance['content'];
		$excerpt = $instance['excerpt'];
		$category = $instance['category'];
		$image = $instance['image'];

		
		echo $before_widget;
		
		$ajax_file = plugins_url( '', __FILE__ ).'/getvalue.php/';
		
		               		
 
		?>
	 	<div class="image">
		<?php
		if($wtitle !=='')
		{
			echo '<h2>'.$wtitle.'</h2> ';
		}
		if($count =='')
		{
			$countt = '5';
		}else
		{
			$countt = $count;
		}   
		?>
	</div>	
	<?php
query_posts('post_type=post&showposts='.$countt.'&orderby=ID&order=ASC');
 while (have_posts()) : the_post(); ?>
 

	<div class="image">
		<?php echo $featured_image = ($image =='1' ) ?  the_post_thumbnail( 'large','style=max-width:30%;height:auto;') : '';?>
	</div>

	<div class="others"> 
	<h2><a href="<?php the_permalink(); ?>" title="Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	
<?php 
if($date=='1')
{
	echo '<small>'.the_time('F jS, Y').'</small> ';
}
if($author=='1')
{
	echo '<small>'.the_author_posts_link().'</small>';
}
if($content=='1')
{
	echo '<div class="entry">'.the_content().'</div>';
}	
if($excerpt=='1')
{
	echo '<div class="entry">'.the_excerpt().'</div>';
}	
if($category=='1')
{
	echo '<p class="postmetadata">'. _e( 'Posted in ' ).the_category( ', ' ).'</p>';
}		
	?>	
	

</div>

 
 
 
 <?php
 
 endwhile;   
 
 
 
 
	echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("npostwidget_plugin");'));