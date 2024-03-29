<?php

include "header.php";

$verified = 'false';
$deactivated = AICONTENTT()->helpers->ai_content_deactivation_get_option();
$license_key = AICONTENTT()->helpers->ai_content_get_option();

$new_deactivated = str_replace(' ', '', $deactivated);
$new_license_key = str_replace(' ', '', $license_key);

If($new_deactivated != '' || empty($new_license_key)) {
	$verified = 'false';
} else {
	$verified = 'true';
}

?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?page=ai-content-tool-dashboard"><img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Navbar_Logo.png'; ?>" alt="AI Content Toolkit Logo" width="300" height="60">
	</a>
  </div>
</nav>
<div class="container-fluid w-75 m-0 gap-3 p-4">
		<h1 class="mt-5 mb-5">AI Toolkit</h1>

		<!-- Top Row -->
		<div class="row gy-3 mb-5">

			<!-- Card 1 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_1.png'; ?>" alt="robot city background" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Blog Post Tool</h5>
						<p class="card-text">This template will help you create a blog post.</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-blog-post' ); ?>" title="<?php echo __( 'AI Blog Post', 'toolkit' ) ?>" class="btn btn-primary" id="createBlogButton">Create Blog Post</a>
					</div>
				</div>
			</div>
			
			<!-- Card 2 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_2.png'; ?>" alt="robot idea" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Blog Post Outline Tool</h5>
						<p class="card-text">This template will create an outline for your blog post or article.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-blog-post-outline' ); ?>" title="<?php echo __( 'AI Blog Post Outline', 'toolkit' ) ?>" class="btn btn-primary" id="createBlogPostOutline">Create Blog Post Outline</a>
					</div>
				</div>
			</div>

			<!-- Card 3 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_3.png'; ?>" alt="robot thinking" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Brainstorming Tool</h5>
						<p class="card-text">This tool will help you brainstorm topics.</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-brainstorming' ); ?>" title="<?php echo __( 'AI Brainstorming', 'toolkit' ) ?>" class="btn btn-primary" id="brainstorm">Brainstorm A Topic</a>
					</div>
				</div>
			</div>
			
		</div>
		<!-- End of Row -->

		<!-- Row 2 -->
		<div class="row gy-3 mb-5">

			<!-- Card 4 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_4.png'; ?>" alt="robot head exploded" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Mind Map Tool</h5>
						<p class="card-text">This AI tool will help you create content for a mindmap.</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-mindmap' ); ?>" title="<?php echo __( 'AI Mind Map', 'toolkit' ) ?>" class="btn btn-primary" id="mindmap">Create Mind Map</a>
					</div>
				</div>
			</div>

			<!-- Card 5 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_5.png'; ?>" alt="robot idea" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Advanced Blog Post Tool</h5>
						<p class="card-text">This template will create an outline for your blog post or article.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-advanced-blog-post' ); ?>" title="<?php echo __( 'AI Advanced Blog Post Tool', 'toolkit' ) ?>" class="btn btn-primary" id="advancedpost">Create Advanced Post</a>
					</div>
				</div>
			</div>

			<!-- Card 6 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_6.png'; ?>" alt="robot thinking" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Keyword Tool</h5>
						<p class="card-text">This tool will help you find keywords with intent.</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-keywords' ); ?>" title="<?php echo __( 'AI Keywords', 'toolkit' ) ?>" class="btn btn-primary" id="findkeywords">Find Keywords</a>
					</div>
				</div>
			</div>
		</div>
		<!-- End of Row -->

		<!-- Row 3 -->

		<div class="row gy-3 mb-5">

			<!-- Card 7 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_7.png'; ?>" alt="robot head exploded" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">How To Article Tool</h5>
						<p class="card-text">This AI tool will help you create a How To... Article.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-how-to-article' ); ?>" title="<?php echo __( 'AI Article Tool - How To', 'toolkit' ) ?>" class="btn btn-primary" id="createarticle">Create Article</a>
					</div>
				</div>
			</div>

			<!-- Card 8 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_8.png'; ?>" alt="robot idea" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">List Blog Post Tool</h5>
						<p class="card-text">This template will create a list blog post or article.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-list-article' ); ?>" title="<?php echo __( 'AI List Blog Post Tool', 'toolkit' ) ?>" class="btn btn-primary" id="createlistpost">Create List Post</a>
					</div>
				</div>
			</div>

			<!-- Card 9 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_9.png'; ?>" alt="robot thinking" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Astrology Tool</h5>
						<p class="card-text">This tool will help you give an astrology reading.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-astrology' ); ?>" title="<?php echo __( 'AI Astrology Tool', 'toolkit' ) ?>" class="btn btn-primary" id="astrologyreading">Astrology Reading</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Row 4 -->

		<div class="row gy-3 mb-5">

			<!-- Card 10 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_10.png'; ?>" alt="robot head exploded" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Video Script Tool</h5>
						<p class="card-text">This AI tool will help you generate video scripts.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-video-script' ); ?>" title="<?php echo __( 'AI Video Script Tool', 'toolkit' ) ?>" class="btn btn-primary" id="createscript">Create Script</a>
					</div>
				</div>
			</div>

			<!-- Card 8 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_11.png'; ?>" alt="robot idea" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Answer The Public Keyword Tool</h5>
						<p class="card-text">This template will create a list of long tail keywords.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-long-tail-keywords' ); ?>" title="<?php echo __( 'AI Long Tail Keyword Tool', 'toolkit' ) ?>" class="btn btn-primary" id="createkeywordlist">Create Keyword List</a>
					</div>
				</div>
			</div>

			<!-- Card 9 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_12.png'; ?>" alt="robot thinking" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Image Generator Tool</h5>
						<p class="card-text">This tool will help generate AI Images.</p>
						<a href="<?php menu_page_url( 'ai-content-tool-image-generator' ); ?>" title="<?php echo __( 'AI Image Generator Tool', 'toolkit' ) ?>" class="btn btn-primary" id="generateimages">Generate Images</a>
					</div>
				</div>
			</div>
		</div>


		<!-- Row 5 -->

		<div class="row gy-3 mb-5">

			<!-- Card 31 -->
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_33.png'; ?>" alt="robot head exploded" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Chat With GPT Button</h5>
						<p class="card-text">This AI tool will allow you to place a ChatGPT Button anywhere on your website..</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-chat-with-gpt' ); ?>" title="<?php echo __( 'Chat With GPT', 'toolkit' ) ?>" class="btn btn-primary" id="Pro19">Create Chat Button</a>
					</div>
				</div>
			</div>

			<!-- Card 32 
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_29.png'; ?>" alt="robot idea" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Prepositions Keyword Tool</h5>
						<p class="card-text">This tool will help you generate prepositions keywords similar to AnswerThePublic.com.</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-prepositions' ); ?>" title="<?php echo __( 'AI Prepositions Tool', 'toolkit' ) ?>" class="btn btn-primary" id="Pro20">Create</a>
					</div>
				</div>
			</div>

			-- Card 33 --
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card h-100 shadow p-3 mb-5 bg-white rounded">
					<img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Toolkit_Plugin_Image_30.png'; ?>" alt="robot thinking" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">Comparisons Keyword Tool</h5>
						<p class="card-text">This tool will help generate comparison keywords similar to AnswerThePublic.com.</p><br/>
						<a href="<?php menu_page_url( 'ai-content-tool-comparisons' ); ?>" title="<?php echo __( 'AI Comparisons Tool', 'toolkit' ) ?>" class="btn btn-primary" id="Pro21">Create</a>
					</div>
				</div>
			</div>
		</div> -->


	</div>
	<div>
	<input type="hidden" id="verified" value="<?php echo $verified; ?>">
	</div>

