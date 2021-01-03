<div id="main" class="column2 column2-right-sidebar boxed"><!-- main -->


	<div class="container">


		<div class="row main-content-wrap">

			<!-- main content -->
			<div class="main-content col-lg-9">


				<div id="content" role="main" class="">

					<div class="blog-posts posts-medium posts-container">
						<?= list_artikel($article); ?>


						<div class="clearfix"></div>
						<div class="pagination-wrap">
							<?= $pagination; ?>
							<!--							<div class="pagination" role="navigation">-->
							<!--								<span aria-current='page' class='page-numbers current'>1</span><a class='page-numbers'-->
							<!--																								  href='page/2/index.html'>2</a><span-->
							<!--										class="page-numbers dots">&hellip;</span><a class='page-numbers'-->
							<!--																					href='page/23/index.html'>23</a><a-->
							<!--										class="next page-numbers" href="page/2/index.html">Next&nbsp;&nbsp;<i-->
							<!--											class="fa fa-long-arrow-right"></i></a></div>-->
						</div>
					</div>


				</div>


			</div><!-- end main content -->

			<div class="col-lg-3 sidebar porto-blog-sidebar right-sidebar"><!-- main sidebar -->
				<div class="sidebar-content">
					<?php view('artikel/berita_terbaru');?>

				</div>
			</div><!-- end main sidebar -->

		</div>
	</div>


</div><!-- end main -->
