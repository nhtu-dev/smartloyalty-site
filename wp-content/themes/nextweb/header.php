<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
	
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3P4GVJS5K6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3P4GVJS5K6');
</script>

<?php global $sh_option;?>
<body
 <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<script>
let modalBtn = document.getElementById("popup-btn");
let modal = document.querySelector(".popup");
let closeBtn = document.querySelector(".close-btn");
// Hiển thị popup khi nhấp chuột vào button
modalBtn.onclick = function(){
modal.style.display = "block"
}
// Đóng popup khi ấn vào nút đóng
closeBtn.onclick = function(){
modal.style.display = "none"
}
// Đóng khi nhấp chuột vào bất cứ khu vực nào trên màn hình
window.onclick = function(e){
if(e.target == modal){
modal.style.display = "none"
}
}
</script>
<?php do_action( 'sh_before_header' );?>
<div id="page" class="site">

	<header id="masthead" <?php header_class();?> role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<!-- Start Top Header -->
		<?php if( $sh_option['display-topheader-widget'] == 1 ) : ?>
			<div class="top-header">
				<div class="container">
					<?php dynamic_sidebar( 'Top Header' );?>
				</div>
			</div>
		<?php endif; ?>
		<!-- End Top Header -->

		<?php sh_header_layout();?>

	</header><!-- #masthead -->
	
	<div id="content" class="site-content">
	<?php if(is_front_page()){?>
	<?php echo do_shortcode( '[rev_slider alias="slider"]' );?>
	<?php }?>

		<?php do_action( 'before_content' ) ?>

			<div class="container">
