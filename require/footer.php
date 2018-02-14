<!-- FOOTER START -->
<footer class="global_footer">
		<div class="satellite"></div>
		
		<div class="pl_big orange_skin put_center">
			<div class="pl_small"></div>
		</div>
	</footer>
<!-- /FOOTER END -->

<!-- JS Files -->
	<script src="content/js/jquery-3.2.1.min.js"></script>
    <script src="content/js/main.js"></script>

<script type="text/javascript">
$(document).ready(function() {
   $('a[href^="#"]').click(function () { 
     elementClick = $(this).attr("href");
     destination = $(elementClick).offset().top;
     if($.browser.safari){
       $('body').animate( { scrollTop: destination }, 1100 );
     }else{
       $('html').animate( { scrollTop: destination }, 1100 );
     }
     return false;
   });
 });
</script>
</body>
</html>