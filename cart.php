
//get color name by it slug

$taxonomy = 'pa_dress-color';
//get color slug
$meta = $_product->attributes['pa_dress-color'];
//get color data
$term = get_term_by('slug', $meta, $taxonomy);
//outpot color name
<p class="product-color"><?php echo $term->name; ?></p>	

***************************************************************************************************************************
